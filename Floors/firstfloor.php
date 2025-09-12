<?php
require_once "models/roomdata.php";

$firstFloor = [
    "" => [
        new Rooms("images/101.jpg","Cozy Single Room","Availabe","A cozy and compact room perfect for solo travelers, offering all the essenntiaL amenities for a comfortable and restful stay.",101,1)
       
    ],
];

foreach ($firstFloor as $floorName => $rooms) {
   
    foreach ($rooms as $room) {
        $room->displayRoom();
    }
}
?>