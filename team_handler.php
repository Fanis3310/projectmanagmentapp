<?php
require_once 'config.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? $_POST['action'] ?? '';

// 📊 GET ALL TEAM MEMBERS
if ($action === 'getMembers') {
    $sql = "SELECT * FROM team_members ORDER BY name ASC";
    $result = $conn->query($sql);
    
    $members = [];
    while ($row = $result->fetch_assoc()) {
        $members[] = [
            'id' => (int)$row['id'],
            'name' => $row['name'],
            'email' => $row['email'],
            'role' => $row['role'],
            'department' => $row['department'],
            'phone' => $row['phone'],
            'status' => $row['status']
        ];
    }
    
    echo json_encode($members);
    exit;
}

// 💾 SAVE TEAM MEMBER (New or Update)
if ($action === 'saveMember') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $name = $conn->real_escape_string($data['name']);
    $email = $conn->real_escape_string($data['email']);
    $role = $conn->real_escape_string($data['role'] ?? '');
    $department = $conn->real_escape_string($data['department'] ?? '');
    $phone = $conn->real_escape_string($data['phone'] ?? '');
    $status = $conn->real_escape_string($data['status'] ?? 'active');
    
    if (isset($data['id']) && $data['id'] > 0) {
        // UPDATE existing member
        $id = (int)$data['id'];
        $sql = "UPDATE team_members SET 
                name = '$name', 
                email = '$email', 
                role = '$role', 
                department = '$department',
                phone = '$phone',
                status = '$status'
                WHERE id = $id";
        $conn->query($sql);
        echo json_encode(['success' => true, 'id' => $id]);
    } else {
        // INSERT new member
        $sql = "INSERT INTO team_members (name, email, role, department, phone, status) 
                VALUES ('$name', '$email', '$role', '$department', '$phone', '$status')";
        
        if ($conn->query($sql)) {
            echo json_encode(['success' => true, 'id' => $conn->insert_id]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    }
    exit;
}

// 🗑️ DELETE TEAM MEMBER
if ($action === 'deleteMember') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = (int)$data['id'];
    
    $sql = "DELETE FROM team_members WHERE id = $id";
    $conn->query($sql);
    
    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['error' => 'Invalid action']);
?>
