<?php
$title = "View Room Details";
ob_start();

require "header.php";
require_once __DIR__ . "/../models/db.php"; // ✅ correct relative path
require_once __DIR__ . "/../helpers/colorcoding.php";
require_once __DIR__ . "/../helpers/amenityicon.php";

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

$roomId = $_GET['room'] ?? null;

if ($roomId) {
    // Get room details
    $stmt = $pdo->prepare("SELECT * FROM rooms WHERE id = ?");
    $stmt->execute([$roomId]);
    $room = $stmt->fetch();

    // Get amenities
    $stmt = $pdo->prepare("SELECT amenity FROM amenities WHERE room_id = ?");
    $stmt->execute([$roomId]);
    $amenities = $stmt->fetchAll();
}

if (!$room) {
    echo "Room not found.";
    exit;
}
$statusClass = getStatusClass($room['status']);
?>
<section class=" w-screen  bg-[#f8f8f8] p-10 flex flex-row justify-around items-start ">
    <div class=" flex flex-col  w-[40%]  border border-[#dcdcdc] bg-[#ffffff]  text-[#333333] ">
        <img src="<?= $room['img'] ?>" alt="Room Image" class=" w-screen">
        <div class=" p-10">
        <h1 class=" text-5xl text-[#000000] "><?= $room['room_type'] ?></h1>
        <div class=" flex w-full flex-row justify-between text-2xl items-center mt-5 mb-10">
            <p>
                <span class=" <?= $statusClass ?> text-[1rem] px-5 py-2 rounded-4xl">
                    <?= $room['status'] ?>
                </span>
            </p>
            <p>Room <?= $room['room_number'] ?></p>
            <p><i class='fa-regular fa-user'></i> Up to <?= $room['people'] ?> People</p>
        </div>
        <p class=" text-2xl mb-5"><?= $room['description'] ?></p>
        <h2 class=" text-4xl text-[#000000] mb-5">Amenities</h2>
        <ul class="grid grid-cols-2 gap-4 text-lg">
            <?php foreach ($amenities as $a): ?>
                <li class="flex items-center gap-2">
                    <i class="<?= getAmenityIcon($a['amenity']) ?> text-[#800000]"></i>
                    <?= htmlspecialchars($a['amenity']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    </div>
    <div class=" flex flex-col w-[40%]   bg-[#ffffff] p-10 justify-between  border border-[#dcdcdc] gap-10 cursor-default">
        <div class=" flex flex-col text-2xl">
            <label for="date">Date</label>
            <div>
                <i class="fa-regular fa-calendar"></i>
                <input type="text" name="date" readonly disabled placeholder="Ex.05-06-2025" class="outline-none bg-[#f8f8f8] py-2 px-2  border border-[#dcdcdc]">
            </div>

        </div>
        <div class=" flex flex-row justify-between text-2xl">
            <div class=" flex flex-col">
                <label for="in">Check in</label>
                <div>
                    <i class="fa-regular fa-clock"></i>
                    <input type="text" name="in" readonly disabled placeholder="9:30" class="outline-none bg-[#f8f8f8] py-2 px-2 w-[250px]  border border-[#dcdcdc]">
                </div>
            </div>
            <div class=" flex flex-col">
                <label for="out">check Out</label>
                <div>
                    <i class="fa-regular fa-clock"></i>
                     <input type="text" name="out" placeholder="9:30" readonly disabled class="outline-none bg-[#f8f8f8] py-2 px-2 w-[250px]  border border-[#dcdcdc]">
                </div>
            </div>
        </div>
        <button class=" bg-[#800000] text-2xl py-3 mt-10 text-[#ffffff] rounded-2xl cursor-pointer">Confirm Booking</button>
    </div>
</section>
<?php
$content = ob_get_clean();
include "layout.php";
?>