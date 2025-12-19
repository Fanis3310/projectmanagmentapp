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
        
      
        $usersSql = "SELECT username FROM project_users WHERE project_id = $projectId";
        $usersResult = $conn->query($usersSql);
        $users = [];
        while ($userRow = $usersResult->fetch_assoc()) {
            $users[] = $userRow['username'];
        }
        
     
        $commentsSql = "SELECT author, comment_text as text, comment_date as date 
                        FROM project_comments WHERE project_id = $projectId 
                        ORDER BY created_at DESC";
        $commentsResult = $conn->query($commentsSql);
        $comments = [];
        while ($commentRow = $commentsResult->fetch_assoc()) {
            $comments[] = $commentRow;
        }
        
      
        $filesSql = "SELECT filename as name, filesize as size 
                     FROM project_files WHERE project_id = $projectId 
                     ORDER BY created_at DESC";
        $filesResult = $conn->query($filesSql);
        $files = [];
        while ($fileRow = $filesResult->fetch_assoc()) {
            $files[] = $fileRow;
        }
        
        $projects[] = [
            'id' => (int)$row['id'],
            'name' => $row['name'],
            'desc' => $row['description'],
            'status' => $row['status'],
            'members' => (int)$row['members'],
            'date' => $row['date'],
            'users' => $users,
            'comments' => $comments,
            'files' => $files
        ];
    }
    
    echo json_encode($projects);
    exit;
}


if ($action === 'saveProject') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $name = $conn->real_escape_string($data['name']);
    $desc = $conn->real_escape_string($data['desc']);
    $status = $conn->real_escape_string($data['status']);
    $members = (int)$data['members'];
    $date = $conn->real_escape_string($data['date']);
    $users = $data['users'] ?? [];
    $comments = $data['comments'] ?? [];
    $files = $data['files'] ?? [];
    
    if (isset($data['id']) && $data['id'] > 0) {
        // UPDATE existing project
        $id = (int)$data['id'];
        $sql = "UPDATE projects SET 
                name = '$name', 
                description = '$desc', 
                status = '$status', 
                members = $members, 
                date = '$date' 
                WHERE id = $id";
        $conn->query($sql);
        $projectId = $id;
        
       
        $conn->query("DELETE FROM project_users WHERE project_id = $projectId");
        $conn->query("DELETE FROM project_comments WHERE project_id = $projectId");
        $conn->query("DELETE FROM project_files WHERE project_id = $projectId");
    } else {
        // INSERT new project
        $sql = "INSERT INTO projects (name, description, status, members, date) 
                VALUES ('$name', '$desc', '$status', $members, '$date')";
        $conn->query($sql);
        $projectId = $conn->insert_id;
    }
    

    foreach ($users as $username) {
        $username = $conn->real_escape_string($username);
        $conn->query("INSERT INTO project_users (project_id, username) 
                     VALUES ($projectId, '$username')");
    }
    
   
    foreach ($comments as $comment) {
        $author = $conn->real_escape_string($comment['author']);
        $text = $conn->real_escape_string($comment['text']);
        $commentDate = $conn->real_escape_string($comment['date']);
        $conn->query("INSERT INTO project_comments (project_id, author, comment_text, comment_date) 
                     VALUES ($projectId, '$author', '$text', '$commentDate')");
    }
    
   
    foreach ($files as $file) {
        $filename = $conn->real_escape_string($file['name']);
        $filesize = $conn->real_escape_string($file['size']);
        $conn->query("INSERT INTO project_files (project_id, filename, filesize) 
                     VALUES ($projectId, '$filename', '$filesize')");
    }
    
    echo json_encode(['success' => true, 'id' => $projectId]);
    exit;
}


if ($action === 'deleteProject') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = (int)$data['id'];
    
    
    $sql = "DELETE FROM projects WHERE id = $id";
    $conn->query($sql);
    
    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['error' => 'Invalid action']);
?>
