<?php
require_once __DIR__.'/../models/db.php';
require_once __DIR__.'/../models/roomdata.php';

// Fetch rooms for First Floor
$stmt = $pdo->prepare("SELECT * FROM rooms WHERE floor = 'ThirdFloor' ORDER BY room_number");
$stmt->execute();
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($rooms as $roomData){
    $r = new Rooms(
        $roomData['id'],
        $roomData['img'],
        $roomData['room_type'],
        $roomData['status'],
        $roomData['description'],
        $roomData['room_number'],
        $roomData['people'],
        $roomData['floor']
    );
    $r->displayRoom();
}
?>
