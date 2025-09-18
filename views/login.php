<?php
$title = 'Lunera Hotel - Login';
session_start();
ob_start();
?>
<section>
    <div>
        <div>
            <h2>Login</h2>
            <form action="index.php?page=authenticate" method="POST">
                <label>Email:</label>
                <input type="email" name="email" required placeholder="user@example.com" />
                
                <label>Password:</label>
                <input type="password" name="password" required />

                <?php if (!empty($_SESSION['error'])): ?>
                    <p class=" text-[#800000]"><?=$_SESSION['error']; ?></p>
                    <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                
                <button type="submit">Sign in</button>
            </form>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include "layout.php";
?>
