<?php
require_once "models/roomdata.php";  // class Rooms
require_once __DIR__ . "/../models/db.php"; // PDO connection

// Kukunin lahat ng rooms na 1st floor (room_number = 100–199)
$stmt = $pdo->prepare("SELECT * FROM rooms WHERE room_number BETWEEN 100 AND 199 ORDER BY room_number ASC");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Convert bawat row into Rooms object
$firstFloor = [];
foreach ($rows as $r) {
    $firstFloor[] = new Rooms(
        $r['id'],
        $r['img'],
        $r['room_type'],
        $r['status'],
        $r['description'],
        $r['room_number'],
        $r['people']
    );
}

// I-display lahat ng rooms sa first floor
foreach ($firstFloor as $room) {
    $room->displayRoom();
}
?>
