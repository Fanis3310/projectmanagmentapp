<?php
require_once 'config.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? $_POST['action'] ?? '';

// 📊 GET ALL PROJECTS
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
        
        // Fetch Comments (created_at is vital)
        $commentsSql = "SELECT author, comment_text as text, comment_date as date, created_at 
                        FROM project_comments WHERE project_id = $projectId 
                        ORDER BY created_at DESC";
        $commentsResult = $conn->query($commentsSql);
        $comments = [];
        while ($commentRow = $commentsResult->fetch_assoc()) {
            $comments[] = $commentRow;
        }
        
        // Fetch Files (created_at is vital)
        // ΠΡΟΣΟΧΗ: Εδώ παίρνουμε το created_at
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

// 💾 SAVE PROJECT (Update or Insert)
if ($action === 'saveProject') {
    $data = json_decode(file_get_contents('php://input'), true);
    
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
        
        // Clear old data to re-insert (Cleanest way for relations)
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
        
        // Διατήρηση παλιάς ημερομηνίας αν υπάρχει, αλλιώς NOW()
        $createdVal = "NOW()";
        if (isset($comment['created_at']) && !empty($comment['created_at'])) {
            $safeDate = $conn->real_escape_string($comment['created_at']);
            $createdVal = "'$safeDate'";
        }
        
        $conn->query("INSERT INTO project_comments (project_id, author, comment_text, comment_date, created_at) VALUES ($projectId, '$author', '$text', '$cDate', $createdVal)");

        // NOTIFICATION FOR NEW COMMENT
        if (isset($comment['is_new']) && $comment['is_new'] == true) {
            $stmt = $conn->prepare("INSERT INTO notifications (title, message, link, type) VALUES (?, ?, ?, 'comment')");
            $nTitle = "New Comment";
            $nMsg = "$author commented on '$name'";
            $nLink = "project.php";
            $stmt->bind_param("sss", $nTitle, $nMsg, $nLink);
            $stmt->execute();
        }
    }
    
    // Insert Files
    foreach ($files as $file) {
        $fname = $conn->real_escape_string($file['name']);
        $fsize = $conn->real_escape_string($file['size']);
        
        $createdVal = "NOW()";
        if (isset($file['created_at']) && !empty($file['created_at'])) {
            $safeDate = $conn->real_escape_string($file['created_at']);
            $createdVal = "'$safeDate'";
        }
        
        $conn->query("INSERT INTO project_files (project_id, filename, filesize, created_at) VALUES ($projectId, '$fname', '$fsize', $createdVal)");
        
        // ✅ ΚΑΘΕ FILE = NOTIFICATION (χωρίς is_new)
        $stmt = $conn->prepare("INSERT INTO notifications (title, message, link, type) VALUES (?, ?, ?, 'file')");
        $nTitle = "File Uploaded";
        $nMsg = "New file '$fname' added to project '$name'.";
        $nLink = "project.php";
        $stmt->bind_param("sss", $nTitle, $nMsg, $nLink);
        $stmt->execute();
        $stmt->close();
    }


        
        echo json_encode(['success' => true, 'id' => $projectId]);
        exit;
    }

    // 🗑️ DELETE PROJECT
    if ($action === 'deleteProject') {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = (int)$data['id'];
        $conn->query("DELETE FROM projects WHERE id = $id");
        echo json_encode(['success' => true]);
        exit;
    }

echo json_encode(['error' => 'Invalid action']);
?>