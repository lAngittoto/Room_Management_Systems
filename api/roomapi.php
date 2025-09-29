<?php
header("Content-Type: application/json");
require_once __DIR__ . "/../models/db.php";

// ✅ Function to map amenity to icon
function getAmenityIcon($amenity)
{
    $icons = [
        "Wi-Fi" => 'fa-solid fa-wifi',
        "Private Bathroom" => 'fa-solid fa-sink',
        "Toiletries" => 'fa-solid fa-sink',
        "Blanket" => 'fa-solid fa-rug',
        "Air Conditioning" => 'fa-solid fa-wind',
        "Television" => 'fa-solid fa-tv',
        "Pillows" => 'fa-solid fa-mattress-pillow',
        "Wardrobe / desk" => 'fa-solid fa-person',
        "Safety deposit box" => 'fa-solid fa-box',
        "Mini Refrigerator / mini bar" => 'fa-solid fa-building-circle-check',
        "Coffee and tea maker" => 'fa-solid fa-mug-hot',
        "Setting area / table" => 'fa-solid fa-couch',
        "Extra Beds" => 'fa-solid fa-bed',
        "Crib / Baby Cot" => 'fa-solid fa-baby',
        "Microwave / Kitchenette" => 'fa-solid fa-kitchen-set',
        "Dining Table" => 'fa-solid fa-utensils',
        "Sofa Bed" => 'fa-solid fa-couch',
    ];

    return $icons[$amenity] ?? 'fa-solid fa-circle';
}

try {
    // Get all rooms
    $stmt = $pdo->query("
        SELECT id, img, room_number, room_type, status, people, floor, description 
        FROM rooms
    ");
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get amenities per room
    foreach ($rooms as &$room) {
        $stmt2 = $pdo->prepare("SELECT amenity FROM amenities WHERE room_id = ?");
        $stmt2->execute([$room['id']]);
        $amenities = $stmt2->fetchAll(PDO::FETCH_COLUMN);

        // Map icons
        $room['amenities'] = array_map(function($a) {
            return [
                "name" => $a,
                "icon" => getAmenityIcon($a)
            ];
        }, $amenities);
    }

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
