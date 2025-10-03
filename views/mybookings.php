<?php
$title = "My Bookings";
ob_start();

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /rmsminicapstone/login');
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

     <div class="border border-[#dcdcdc] bg-white p-6 rounded-2xl shadow-md flex flex-col gap-5">
                
                <!-- Room Image -->
                <img src="<?= $room['img'] ?>" alt="Room Image"
                    class="w-full h-40 sm:h-60 object-cover rounded-xl mb-5">

                <!-- Room Info -->
                <h2 class="sm:text-3xl font-bold"><?= $room['room_type'] ?></h2>
                <p class="sm:text-xl text-gray-700 mb-2">Room <?= $room['room_number'] ?></p>

                <!-- Guests -->
                <p class="mb-2 flex items-center gap-2 sm:text-lg text-gray-700">
                    <i class="fa-regular fa-user text-[#800000]"></i> 
                    <?= $room['people'] ?> Guests
                </p>

                <!-- Floor -->
                <div class="flex items-center gap-2 mb-5">
                    <i class="fa-solid fa-building text-[#800000]"></i>
                    <p class="sm:text-lg text-gray-600"> <?= $room['floor'] ?></p>
                </div>
                
                <!-- Check In / Out -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:text-lg">
                    <!-- Check In -->
                    <div class="flex flex-col">
                        <label for="in" class="mb-1 font-medium">Check In</label>
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-clock text-[#800000]"></i>
                            <input type="text" name="in" readonly disabled
                                placeholder="9:30"
                                class="outline-none bg-[#f8f8f8] py-2 px-3 w-full border border-[#dcdcdc] rounded-lg">
                        </div>
                    </div>

                    <!-- Check Out -->
                    <div class="flex flex-col">
                        <label for="out" class="mb-1 font-medium">Check Out</label>
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-clock text-[#800000]"></i>
                            <input type="text" name="out" readonly disabled
                                placeholder="9:30"
                                class="outline-none bg-[#f8f8f8] py-2 px-3 w-full border border-[#dcdcdc] rounded-lg">
                        </div>
                    </div>
                </div>

                <!-- Button -->
                <a href="index.php?page=viewdetails&room=<?= $room['id'] ?>"
                    class="mt-6 block w-full text-center px-5 py-3 bg-[#800000] text-white rounded-xl shadow hover:bg-red-900 transition">
                    View Details <i class="fa-regular fa-file-lines ml-2"></i>
                </a>
            </div>

<?php endforeach;
    echo "</div>";
}
?>

<?php
$content = ob_get_clean();
include "layout.php";
?>