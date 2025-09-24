const checkAvailable = document.querySelector('#checkAvailable');
const roomTypeSelect = document.querySelector('#roomTypeSelect');
const floorSelect = document.querySelector('#floorSelect');
const resetBtn = document.querySelector('#resetBtn');

function fetchRooms() {
    const status = checkAvailable.checked ? "Available" : "";
    const type = roomTypeSelect.value;
    const floor = floorSelect.value;

   fetch('filterrooms.php?status=' + status + '&type=' + type + '&floor=' + floor)


    .then(res => res.text())
    .then(html => {
        document.querySelector("#rooms-container").innerHTML = html;
    });
}

// initial load
fetchRooms();

// events
checkAvailable.addEventListener("change", fetchRooms);
roomTypeSelect.addEventListener("change", fetchRooms);
floorSelect.addEventListener("change", fetchRooms);

// reset filters
resetBtn.addEventListener("click", () => {
    checkAvailable.checked = false;
    roomTypeSelect.value = "";
    floorSelect.value = "";
    fetchRooms();
});
