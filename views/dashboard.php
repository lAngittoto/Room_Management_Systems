<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
header('Location: /rmsminicapstone/login');
exit;

}
ob_start();
?>

<header>
  <h1>Lunera Hotel</h1>
  <a href="/rmsminicapstone/logout">Log out</a>

</header>

<!-- Dashboard Content -->
<main class="dashboard">
  <h2>Admin Dashboard</h2>
  <p>Welcome back, <?= htmlspecialchars($_SESSION['user']['email']) ?>. Here is an overview of your hotel.</p>

  <div class="card-container">
    <!-- Total Rooms -->
    <div class="card">
      <h3>Total Rooms <i class="fa-solid fa-bed"></i></h3>
      <p class="description">The total number of rooms in the hotel.</p>
      <span class="number">12</span>
    </div>

    <!-- Available Rooms -->
    <div class="card">
      <h3>Available Rooms <i class="fa-solid fa-bed" style="color:green;"></i></h3>
      <p class="description">Rooms currently available for booking.</p>
      <span class="number">8</span>
    </div>
  </div>
</main>

<?php
$content = ob_get_clean();
include "layout.php";
?>
