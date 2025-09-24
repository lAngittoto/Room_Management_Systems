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

<section class="w-screen p-10" id="rooms-container"></section>

<script>
const checkAvailable = document.querySelector('#checkAvailable');
const roomTypeSelect = document.querySelector('#roomTypeSelect');
const floorSelect = document.querySelector('#floorSelect');
const resetBtn = document.querySelector('#resetBtn');
const roomsContainer = document.querySelector('#rooms-container');

// Render rooms sa page
function renderRooms(rooms) {
  roomsContainer.innerHTML = "";
  rooms.forEach(room => {
    const div = document.createElement('div');
    div.className = "border rounded p-5 mb-5 flex flex-col sm:flex-row gap-5 items-center";
    div.innerHTML = `
      <img src="${room.img}" alt="${room.room_type}" class="w-[200px] h-[150px] object-cover rounded">
      <div>
        <h2 class="text-2xl">${room.room_type} - ${room.status}</h2>
        <p>${room.description}</p>
        <p><b>Floor:</b> ${room.floor}</p>
      </div>
    `;
    roomsContainer.appendChild(div);
  });
}

// Fetch rooms mula sa PHP
function fetchRooms() {
  // Kung pareho Select None ang room type at floor at hindi checked ang available → blank
  if (roomTypeSelect.value === "" && floorSelect.value === "" && !checkAvailable.checked) {
    roomsContainer.innerHTML = ""; // walang lalabas
    return; // walang fetch
  }

  const params = new URLSearchParams();
  if (checkAvailable.checked) params.append("status", "Available");
  if (roomTypeSelect.value !== "") params.append("type", roomTypeSelect.value);
  if (floorSelect.value !== "") params.append("floor", floorSelect.value);

  fetch('views/filterrooms.php?' + params.toString())
    .then(res => res.json())
    .then(data => {
      roomsContainer.innerHTML = "";
      if (data.length === 0) return; // walang message kapag walang match
      renderRooms(data);
    })
    .catch(err => console.error(err));
}

// Auto trigger kapag nagbago filters
checkAvailable.addEventListener('change', fetchRooms);
roomTypeSelect.addEventListener('change', fetchRooms);
floorSelect.addEventListener('change', fetchRooms);

// Reset button
resetBtn.addEventListener('click', () => {
  roomTypeSelect.value = "";
  floorSelect.value = "";
  checkAvailable.checked = false;
  setTimeout(fetchRooms, 100);
});

// Initial load → walang filter = blank
fetchRooms();
</script>
