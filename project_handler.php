<?php
require_once 'config.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? $_POST['action'] ?? '';

// 📊 1. GET ALL PROJECTS
if ($action === 'getProjects') {
    $sql = "SELECT * FROM projects ORDER BY created_at DESC";
    $result = $conn->query($sql);
    
    $projects = [];
    while ($row = $result->fetch_assoc()) {
        $projectId = $row['id'];
        
        // Fetch Users
        $usersSql = "SELECT username FROM project_users WHERE project_id = $projectId";
        $usersResult = $conn->query($usersSql);
        $users = [];
        while ($userRow = $usersResult->fetch_assoc()) {
            $users[] = $userRow['username'];
        }
        
        // Fetch Comments
        $commentsSql = "SELECT author, comment_text as text, comment_date as date, created_at 
                        FROM project_comments WHERE project_id = $projectId 
                        ORDER BY created_at DESC";
        $commentsResult = $conn->query($commentsSql);
        $comments = [];
        while ($commentRow = $commentsResult->fetch_assoc()) {
            $comments[] = $commentRow;
        }
        
        // Fetch Files
        $filesSql = "SELECT filename as name, filesize as size, created_at 
                     FROM project_files WHERE project_id = $projectId 
                     ORDER BY created_at DESC";
        $filesResult = $conn->query($filesSql);
        $files = [];
        while ($fileRow = $filesResult->fetch_assoc()) {
            $files[] = $fileRow;
        }
        
        $phpDate = strtotime($row['created_at']);
        $formattedDate = date("d M, Y", $phpDate);

        $projects[] = [
            'id' => (int)$row['id'],
            'name' => $row['name'],
            'desc' => $row['description'],
            'status' => $row['status'],
            'members' => (int)$row['members'],
            'date' => $formattedDate,
            'users' => $users,
            'comments' => $comments,
            'files' => $files
        ];
    }
    
    echo json_encode($projects);
    exit;
}

// 💾 2. SAVE PROJECT
if ($action === 'saveProject') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    if (!$data) {
        echo json_encode(['error' => 'Invalid JSON data']);
        exit;
    }
    
    $name = $conn->real_escape_string($data['name']);
    $desc = $conn->real_escape_string($data['desc']);
    $status = $conn->real_escape_string($data['status']);
    $members = (int)$data['members'];
    $date = isset($data['date']) ? $conn->real_escape_string($data['date']) : '';
    $users = $data['users'] ?? [];
    $comments = $data['comments'] ?? [];
    $files = $data['files'] ?? [];
    
    // Check if Update or Insert
    if (isset($data['id']) && $data['id'] > 0) {
        $id = (int)$data['id'];
        $sql = "UPDATE projects SET name='$name', description='$desc', status='$status', members=$members, date='$date' WHERE id=$id";
        $conn->query($sql);
        $projectId = $id;
        
        // Καθαρισμός παλιών για να μπουν τα updated
        $conn->query("DELETE FROM project_users WHERE project_id = $projectId");
        $conn->query("DELETE FROM project_comments WHERE project_id = $projectId");
        $conn->query("DELETE FROM project_files WHERE project_id = $projectId");
    } else {
        $sql = "INSERT INTO projects (name, description, status, members, date) VALUES ('$name', '$desc', '$status', $members, '$date')";
        if ($conn->query($sql)) {
            $projectId = $conn->insert_id;
            
            // Notification for New Project
            $stmt = $conn->prepare("INSERT INTO notifications (title, message, link, type) VALUES (?, ?, ?, 'project')");
            $nTitle = "New Project Created";
            $nMsg = "Project '$name' has been initiated.";
            $nLink = "project.php";
            $stmt->bind_param("sss", $nTitle, $nMsg, $nLink);
            $stmt->execute();
        } else {
            echo json_encode(['error' => 'Failed to create project']);
            exit;
        }
    }
    
    // Insert Users
    foreach ($users as $username) {
        $username = $conn->real_escape_string($username);
        $conn->query("INSERT INTO project_users (project_id, username) VALUES ($projectId, '$username')");
    }
    
    // Insert Comments
    foreach ($comments as $comment) {
        $author = $conn->real_escape_string($comment['author']);
        $text = $conn->real_escape_string($comment['text']);
        $cDate = $conn->real_escape_string($comment['date']);
        
        $createdVal = "NOW()";
        if (isset($comment['created_at']) && !empty($comment['created_at'])) {
            $safeDate = $conn->real_escape_string($comment['created_at']);
            $createdVal = "'$safeDate'";
        }
        
        $conn->query("INSERT INTO project_comments (project_id, author, comment_text, comment_date, created_at) VALUES ($projectId, '$author', '$text', '$cDate', $createdVal)");

        if (isset($comment['is_new']) && $comment['is_new'] == true) {
            $stmt = $conn->prepare("INSERT INTO notifications (title, message, link, type) VALUES (?, ?, ?, 'comment')");
            $nTitle = "New Comment";
            $nMsg = "$author commented on '$name'";
            $nLink = "project.php";
            $stmt->bind_param("sss", $nTitle, $nMsg, $nLink);
            $stmt->execute();
        }
    }
    
   
    foreach ($files as $file) {
        $fname = $conn->real_escape_string($file['name']);
        $fsize = $conn->real_escape_string($file['size']);
        
        $createdVal = "NOW()";
        if (isset($file['created_at']) && !empty($file['created_at'])) {
            $safeDate = $conn->real_escape_string($file['created_at']);
            $createdVal = "'$safeDate'";
        }
        
        
        $conn->query("INSERT INTO project_files (project_id, filename, filesize, created_at) VALUES ($projectId, '$fname', '$fsize', $createdVal)");
    }

    
    if (!empty($files)) {
        $fileCount = count($files);
        $fileNames = array_map(function($f) { return $f['name']; }, $files);
        $filesList = implode(', ', array_slice($fileNames, 0, 2));
        $moreText = count($fileNames) > 2 ? ' + ' . (count($fileNames) - 2) . ' more' : '';
        
        $stmt = $conn->prepare("INSERT INTO notifications (title, message, link, type) VALUES (?, ?, ?, 'file')");
        $nTitle = "Files Uploaded";
        $nMsg = "Uploaded $fileCount file(s): $filesList$moreText to project '$name'.";
        $nLink = "project.php";
        $stmt->bind_param("sss", $nTitle, $nMsg, $nLink);
        $stmt->execute();
        $stmt->close();
    }
        
    echo json_encode(['success' => true, 'id' => $projectId]);
    exit;
}

// 🗑️ 3. DELETE PROJECT
if ($action === 'deleteProject') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['id'])) {
        $id = (int)$data['id'];
        $conn->query("DELETE FROM projects WHERE id = $id");
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'No ID provided']);
    }
    exit;
}

echo json_encode(['error' => 'Invalid action']);
?>