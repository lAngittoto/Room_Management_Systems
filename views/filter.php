<section class="w-screen flex flex-col p-10 items-center gap-5 select-none">
  <h1 class="text-4xl sm:text-5xl">Find Your Perfect Space</h1>
  <p class="text-[1rem] sm:text-2xl text-[#333333]">
    Browse our available rooms and find the perfect one for your needs.
  </p>
</section>

<section class="w-screen justify-center items-center flex select-none">
  <div class="w-[80%] border border-[#dcdcdc] bg-[#ffffff] rounded-4xl p-10">
    <form id="filterForm">
      <div class="flex sm:flex-row justify-around items-start flex-col">
        <!-- Checkbox -->
        <div class="flex flex-row gap-5 mt-13">
          <input type="checkbox" id="checkAvailable" class="w-8 h-8 accent-green-400" />
          <p class="sm:text-2xl text-[1.2rem]">Show Available Only</p>
        </div>

        <!-- Room Type -->
        <div class="flex flex-col gap-5">
          <label for="roomTypeSelect" class="sm:text-2xl text-[1.2rem]">Room Type</label>
          <select id="roomTypeSelect" class="border border-[#dcdcdc] p-2 md:w-[200px] w-[150px]">
            <option value="">Select None</option>
            <option value="Single">Single Room</option>
            <option value="Double">Double Room</option>
            <option value="Deluxe">Deluxe Room</option>
            <option value="Triple">Triple Room</option>
            <option value="Family">Family Room</option>
          </select>
        </div>

        <!-- Floor -->
        <div class="flex flex-col gap-5">
          <label for="floorSelect" class="sm:text-2xl text-[1.2rem]">Floor</label>
          <select id="floorSelect" class="border border-[#dcdcdc] rounded p-2 md:w-[200px] w-[150px]">
            <option value="">Select None</option>
            <option value="FirstFloor">First Floor</option>
            <option value="SecondFloor">Second Floor</option>
            <option value="ThirdFloor">Third Floor</option>
          </select>
          <button type="reset" id="resetBtn" class="md:w-[200px] w-[150px] border border-[#dcdcdc] rounded p-2 mt-10 cursor-pointer">
            Reset Filters
          </button>
        </div>
      </div>
    </form>
  </div>
</section>

<!-- 3-column grid -->
<section class="p-10 w-screen gap-10 items-stretch">
  <div id="rooms-container" class="grid grid-cols-3 gap-5"></div>
</section>

<script>
const checkAvailable = document.querySelector('#checkAvailable');
const roomTypeSelect = document.querySelector('#roomTypeSelect');
const floorSelect = document.querySelector('#floorSelect');
const resetBtn = document.querySelector('#resetBtn');
const roomsContainer = document.querySelector('#rooms-container');

function getStatusClass(status) {
  switch(status.toLowerCase()) {
    case 'available':
      return 'bg-green-500 text-white';
    case 'booked':
      return 'bg-blue-500 text-white';
    case 'under maintenance':
      return 'bg-yellow-500 text-black';
    case 'occupied':
      return 'bg-red-500 text-white';
    default:
      return 'bg-gray-500 text-white';
  }
}

// Render rooms sa page
function renderRooms(rooms) {
  roomsContainer.innerHTML = "";
  rooms.forEach(room => {
    const div = document.createElement('div');
    div.className = "bg-[#ffffff] rounded-t-2xl border border-[#dcdcdc] flex flex-col gap-3 select-none";

    div.innerHTML = `
      <img src="${room.img}" alt="Room Image" class="rounded-t-2xl w-full h-[400px] object-cover">
      
      <div class="flex flex-row justify-between items-center p-3">
        <h1 class="text-2xl">${room.room_type}</h1>
        <h1 class="text-[1rem] px-5 py-2 rounded-4xl ${getStatusClass(room.status)}">${room.status}</h1>
      </div>

      <p class="p-5 text-[1.2rem] text-[#333333]">${room.description}</p>

      <div class="flex flex-row justify-between p-3 mt-auto">
        <h1 class="text-2xl text-[#333333]">Room: ${room.room_number}</h1>
        <h1 class="text-2xl text-[#333333]"><i class="fa-regular fa-user"></i> ${room.people} People</h1>
      </div>

      <div class="flex justify-center w-full">
        <a href="index.php?page=viewdetails&room=${room.id}" class="w-full text-center px-5 py-3 bg-[#800000] text-white hover:bg-red-900 transition">
          View Details <i class="fa-regular fa-file-lines"></i>
        </a>
      </div>
    `;
    
    roomsContainer.appendChild(div);
  });
}

// Fetch rooms mula sa PHP
function fetchRooms() {
  if (roomTypeSelect.value === "" && floorSelect.value === "" && !checkAvailable.checked) {
    roomsContainer.innerHTML = ""; 
    return; 
  }

  const params = new URLSearchParams();
  if (checkAvailable.checked) params.append("status", "Available");
  if (roomTypeSelect.value !== "") params.append("type", roomTypeSelect.value);
  if (floorSelect.value !== "") params.append("floor", floorSelect.value);

  fetch('views/filterrooms.php?' + params.toString())
    .then(res => res.json())
    .then(data => {
      roomsContainer.innerHTML = "";
      if (data.length === 0) return; 
      renderRooms(data);
    })
    .catch(err => console.error(err));
}

checkAvailable.addEventListener('change', fetchRooms);
roomTypeSelect.addEventListener('change', fetchRooms);
floorSelect.addEventListener('change', fetchRooms);

resetBtn.addEventListener('click', () => {
  roomTypeSelect.value = "";
  floorSelect.value = "";
  checkAvailable.checked = false;
  setTimeout(fetchRooms, 100);
});

fetchRooms();
</script>
