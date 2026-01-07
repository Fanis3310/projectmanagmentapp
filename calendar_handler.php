<?php
require_once 'config.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? $_POST['action'] ?? '';

// 📊 GET ALL EVENTS
if ($action === 'getEvents') {
    $sql = "SELECT 
                e.*,
                t.name as assigned_name,
                p.name as project_name
            FROM calendar_events e
            LEFT JOIN team_members t ON e.assigned_to = t.id
            LEFT JOIN projects p ON e.project_id = p.id
            ORDER BY e.start_date ASC, e.start_time ASC";
    
    $result = $conn->query($sql);
    
    $events = [];
    while ($row = $result->fetch_assoc()) {
        $events[] = [
            'id' => (int)$row['id'],
            'title' => $row['title'],
            'description' => $row['description'],
            'event_type' => $row['event_type'],
            'start_date' => $row['start_date'],
            'end_date' => $row['end_date'],
            'start_time' => $row['start_time'],
            'end_time' => $row['end_time'],
            'all_day' => (bool)$row['all_day'],
            'priority' => $row['priority'],
            'status' => $row['status'],
            'assigned_to' => $row['assigned_to'] ? (int)$row['assigned_to'] : null,
            'assigned_name' => $row['assigned_name'],
            'project_id' => $row['project_id'] ? (int)$row['project_id'] : null,
            'project_name' => $row['project_name']
        ];
    }
    
    echo json_encode($events);
    exit;
}

// 💾 SAVE EVENT (New or Update)
if ($action === 'saveEvent') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $title = $conn->real_escape_string($data['title']);
    $description = $conn->real_escape_string($data['description'] ?? '');
    $event_type = $conn->real_escape_string($data['event_type']);
    $start_date = $conn->real_escape_string($data['start_date']);
    $end_date = $data['end_date'] ? $conn->real_escape_string($data['end_date']) : 'NULL';
    $start_time = $data['start_time'] ? "'".$conn->real_escape_string($data['start_time'])."'" : 'NULL';
    $end_time = $data['end_time'] ? "'".$conn->real_escape_string($data['end_time'])."'" : 'NULL';
    $all_day = isset($data['all_day']) ? (int)$data['all_day'] : 0;
    $priority = $conn->real_escape_string($data['priority']);
    $status = $conn->real_escape_string($data['status']);
    $assigned_to = $data['assigned_to'] ? (int)$data['assigned_to'] : 'NULL';
    $project_id = $data['project_id'] ? (int)$data['project_id'] : 'NULL';
    
    if (isset($data['id']) && $data['id'] > 0) {
        // UPDATE
        $id = (int)$data['id'];
        $sql = "UPDATE calendar_events SET 
                title = '$title',
                description = '$description',
                event_type = '$event_type',
                start_date = '$start_date',
                end_date = ".($end_date === 'NULL' ? 'NULL' : "'$end_date'").",
                start_time = $start_time,
                end_time = $end_time,
                all_day = $all_day,
                priority = '$priority',
                status = '$status',
                assigned_to = $assigned_to,
                project_id = $project_id
                WHERE id = $id";
        $conn->query($sql);
        echo json_encode(['success' => true, 'id' => $id]);
   } else {
        // INSERT
        $sql = "INSERT INTO calendar_events 
                (title, description, event_type, start_date, end_date, start_time, end_time, all_day, priority, status, assigned_to, project_id)
                VALUES 
                ('$title', '$description', '$event_type', '$start_date', ".($end_date === 'NULL' ? 'NULL' : "'$end_date'").", $start_time, $end_time, $all_day, '$priority', '$status', $assigned_to, $project_id)";
        
        if ($conn->query($sql)) {
            $newId = $conn->insert_id;

            // --- NEW NOTIFICATION CODE (ΕΔΩ ΕΓΙΝΕ Η ΑΛΛΑΓΗ) ---
            $notifTitle = "New Event Added";
            $notifMsg = "Event '$title' is scheduled for $start_date.";
            $notifLink = "calendar.php";
            
            // Χρησιμοποιούμε prepare για ασφάλεια
            $stmtNotif = $conn->prepare("INSERT INTO notifications (title, message, link, type) VALUES (?, ?, ?, 'event')");
            if ($stmtNotif) {
                $stmtNotif->bind_param("sss", $notifTitle, $notifMsg, $notifLink);
                $stmtNotif->execute();
                $stmtNotif->close();
            }
            // ---------------------------------------------------

            echo json_encode(['success' => true, 'id' => $newId]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    }
    exit;
}

// 🗑️ DELETE EVENT
if ($action === 'deleteEvent') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = (int)$data['id'];
    
    $sql = "DELETE FROM calendar_events WHERE id = $id";
    $conn->query($sql);
    
    echo json_encode(['success' => true]);
    exit;
}

// 📅 GET EVENTS BY DATE RANGE
if ($action === 'getEventsByRange') {
    $start = $conn->real_escape_string($_GET['start']);
    $end = $conn->real_escape_string($_GET['end']);
    
    $sql = "SELECT 
                e.*,
                t.name as assigned_name,
                p.name as project_name
            FROM calendar_events e
            LEFT JOIN team_members t ON e.assigned_to = t.id
            LEFT JOIN projects p ON e.project_id = p.id
            WHERE e.start_date BETWEEN '$start' AND '$end'
            ORDER BY e.start_date ASC, e.start_time ASC";
    
    $result = $conn->query($sql);
    
    $events = [];
    while ($row = $result->fetch_assoc()) {
        $events[] = [
            'id' => (int)$row['id'],
            'title' => $row['title'],
            'description' => $row['description'],
            'event_type' => $row['event_type'],
            'start_date' => $row['start_date'],
            'end_date' => $row['end_date'],
            'start_time' => $row['start_time'],
            'end_time' => $row['end_time'],
            'all_day' => (bool)$row['all_day'],
            'priority' => $row['priority'],
            'status' => $row['status'],
            'assigned_to' => $row['assigned_to'] ? (int)$row['assigned_to'] : null,
            'assigned_name' => $row['assigned_name'],
            'project_id' => $row['project_id'] ? (int)$row['project_id'] : null,
            'project_name' => $row['project_name']
        ];
    }
    
    echo json_encode($events);
    exit;
}

echo json_encode(['error' => 'Invalid action']);
?>
