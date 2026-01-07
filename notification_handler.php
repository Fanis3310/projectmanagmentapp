<?php
require_once 'config.php';
header('Content-Type: application/json');

$action = $_GET['action'] ?? '';


if ($action === 'getNotifications') {
    $sql = "SELECT * FROM notifications ORDER BY created_at DESC LIMIT 20";
    $result = $conn->query($sql);
    
    $notifications = [];
    $unreadCount = 0;

    while ($row = $result->fetch_assoc()) {
        if ($row['is_read'] == 0) {
            $unreadCount++;
        }
        $notifications[] = $row;
    }

    echo json_encode([
        'notifications' => $notifications,
        'unread_count' => $unreadCount
    ]);
    exit;
}


if ($action === 'markRead') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($id > 0) {
        $stmt = $conn->prepare("UPDATE notifications SET is_read = 1 WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo json_encode(['success' => true]);
    }
    exit;
}

if ($action === 'markAllRead') {
    $conn->query("UPDATE notifications SET is_read = 1 WHERE is_read = 0");
    echo json_encode(['success' => true]);
    exit;
}
?>