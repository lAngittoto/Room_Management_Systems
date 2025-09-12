<?php
class Rooms
{
    public $img;
    public $RoomType;
    public $status;
    public $description;
    public $RoomNumber;
    public $people;

    public function __construct($img, $RoomType, $status, $description, $RoomNumber, $people)
    {
        $this->img = $img;
        $this->RoomType = $RoomType;
        $this->status = $status;
        $this->description = $description;
        $this->RoomNumber = $RoomNumber;
        $this->people = $people;
    }

    public function displayRoom()
    {
        echo '<div class="bg-[#f8f8f8] w-[30%] h-[70%] rounded-t-2xl  flex flex-col gap-5">';

        echo "<img src='{$this->img}' alt='Room Image' class='rounded-t-2xl w-full h-auto'>";

        echo '<div class="flex flex-row justify-between items-center p-3">';

        echo "<h1 class=' text-2xl'>{$this->RoomType}</h1>";
        echo "<h1 class=' text-[1rem] px-5 py-2 bg-green-500 text-amber-50 rounded-4xl'>{$this->status}</h1>";
        echo "</div>";

        echo "<p class='p-5'>{$this->description}</p>";

        echo '<div class="flex flex-row justify-between p-3">';
        echo "<h1 class=' text-2xl text-[#333333]'>Room: {$this->RoomNumber}</h1>";
        echo "<h1 class=' text-2xl text-[#333333]'><i class='fa-regular fa-user'></i> {$this->people} People</h1>";
        echo "</div>";

        echo '<div class="flex justify-center w-full">';
        echo "<a href='index.php?page=viewdetails&room={$this->RoomNumber}' class='w-full text-center px-5 py-2 bg-[#800000] text-white rounded-lg hover:bg-red-900 transition'>View Details</a>";
        echo "</div>";


        echo "</div>";
    }
}
