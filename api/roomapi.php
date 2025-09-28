<?php
header("Content-Type: application/json");
require_once __DIR__ . "/../models/db.php";

try {
  $stmt = $pdo->query("
    SELECT 
        id, 
        img,          
        room_number, 
        room_type, 
        status, 
        people, 
        floor, 
        description 
    FROM rooms 
");


    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "data" => $rooms
    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}
