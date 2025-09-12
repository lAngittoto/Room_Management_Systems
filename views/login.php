<?php
$title = 'Lunera Hotel - Login';
ob_start();
?>

<h2>Login</h2>
<form action="authenticate.php" method="POST">
    <label>Email:</label>
    <input type="email" name="email" required placeholder="user@example.com" />
    <label>Password:</label>
    <input type="password" name="password" required />
    <button type="submit">Sign in</button>
</form>
<?php
$content = ob_get_clean();
include "layout.php";
?>