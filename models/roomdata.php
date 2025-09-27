<?php
require_once __DIR__ . "/../helpers/colorcoding.php";

class Rooms
{
    public $id;
    public $img;
    public $RoomType;
    public $status;
    public $description;
    public $RoomNumber;
    public $people;
    public $floor; // 🔥 idinagdag lang

    public function __construct($id, $img, $RoomType, $status, $description, $RoomNumber, $people, $floor)
    {
        $this->id = $id;
        $this->img = $img;
        $this->RoomType = $RoomType;
        $this->status = $status;
        $this->description = $description;
        $this->RoomNumber = $RoomNumber;
        $this->people = $people;
        $this->floor = $floor; // 🔥 initialize floor
    }

    public function displayRoom() // 🔥 optional floor toggle
    {
        echo '<div class="bg-[#ffffff] rounded-t-2xl border border-[#dcdcdc] flex flex-col gap-3 select-none h-full">';

        echo "<img src='{$this->img}' alt='Room Image' class='rounded-t-2xl w-full h-[400px] object-cover'>";

        echo '<div class="flex flex-row justify-between items-center p-3">';

        echo "<h1 class='text-2xl'>{$this->RoomType}</h1>";
        $statusClass = getStatusClass($this->status);
        echo "<h1 class='text-[1rem] px-5 py-2 rounded-4xl {$statusClass}'>{$this->status}</h1>";

        echo "</div>";

        echo "<p class='p-5 text-[1.2rem] text-[#333333]'>{$this->description}</p>";

        echo '<div class="flex flex-row justify-between p-3 mt-auto">';
        echo "<h1 class='text-2xl text-[#333333]'>Room: {$this->RoomNumber}</h1>";
        echo "<h1 class='text-2xl text-[#333333]'><i class='fa-regular fa-user'></i> {$this->people} People</h1>";
        echo "</div>";

        // 🔥 Floor info lang kung gusto ipakita
       
        echo '<div class="flex justify-center w-full">';
        echo "<a href='index.php?page=viewdetails&room={$this->id}' class='w-full text-center px-5 py-3 bg-[#800000] text-white hover:bg-red-900 transition'>View Details <i class='fa-regular fa-file-lines'></i></a>";
        echo "</div>";

        echo "</div>";
    }
}
?>
