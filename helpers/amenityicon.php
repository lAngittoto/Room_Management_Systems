<?php

function getAmenityIcon($amenity) {
    $icons = [
        "Wi-Fi" => 'fa-solid fa-wifi',
        "Private Bathroom" => 'fa-solid fa-sink',
        "Toiletries" => 'fa-solid fa-sink',
        "Blanket" => 'fa-solid fa-rug',
        "Air Conditioning" => 'fa-solid fa-wind',
        "Television" => 'fa-solid fa-tv',
        "Pillows" => 'fa-solid fa-mattress-pillow',
        "Wardrobe / desk" => 'fa-solid fa-person',
    ];

    return $icons[$amenity] ?? 'fa-solid fa-circle';
}