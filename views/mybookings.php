<?php
$title = "My Bookings";
ob_start();

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

require_once __DIR__ . "/../models/db.php";
require_once __DIR__ . "/../views/header.php"; // ✅ navbar/header
?>

<section class="w-full bg-[#f8f8f8] p-10 flex flex-col items-center">
    <h1 class="text-5xl mb-10 text-[#000000]">My Bookings</h1>
</section>

<?php
$userEmail = $_SESSION['user']['email'];

// Kunin lahat ng bookings ng user + details ng room
$stmt = $pdo->prepare("
    SELECT r.*, b.booking_date, b.status AS booking_status
    FROM bookings b
    JOIN rooms r ON b.room_id = r.id
    WHERE b.user_email = ?
");
$stmt->execute([$userEmail]);
$bookedRooms = $stmt->fetchAll();

if (!$bookedRooms) {
    echo "<p class='text-2xl text-gray-600 text-center'>You have no bookings yet.</p>";
} else {
    echo "<div class='flex flex-col gap-8 p-10 max-w-4xl mx-auto'>";
    foreach ($bookedRooms as $room): ?>
    
        <div class="border border-[#dcdcdc] bg-white p-6 rounded-2xl shadow-md">
            <img src="<?= $room['img'] ?>" alt="Room Image" 
                 class="w-full h-60 object-cover rounded-xl mb-5">

            <h2 class="text-3xl font-bold"><?= $room['room_type'] ?></h2>
            <p class="text-xl text-gray-700 mb-2">Room <?= $room['room_number'] ?></p>
            <p class="text-lg text-gray-600 mb-3"><?= $room['description'] ?></p>

            <p class="mb-2"><i class="fa-regular fa-user"></i> Up to <?= $room['people'] ?> People</p>
      

            <!-- Check In / Check Out -->
            <div class="flex flex-row justify-between text-2xl mt-5">
                <div class="flex flex-col">
                    <label for="in">Check in</label>
                    <div>
                        <i class="fa-regular fa-clock"></i>
                        <input type="text" name="in" readonly disabled
                               placeholder="9:30"
                               class="outline-none bg-[#f8f8f8] py-2 px-2 w-[200px] border border-[#dcdcdc] rounded-lg">
                    </div>
                </div>
                <div class="flex flex-col">
                    <label for="out">Check Out</label>
                    <div>
                        <i class="fa-regular fa-clock"></i>
                        <input type="text" name="out" readonly disabled
                               placeholder="9:30"
                               class="outline-none bg-[#f8f8f8] py-2 px-2 w-[200px] border border-[#dcdcdc] rounded-lg">
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach;
    echo "</div>";
}
?>

<?php
$content = ob_get_clean();
include "layout.php";
?>
