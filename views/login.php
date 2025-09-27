<?php
$title = 'Lunera Hotel - Login';
session_start();
ob_start();
?>
<section class="login-container">
    <div class="login-box">
        <h2>Login</h2>
        <p>Please sign in to continue</p>
       <form action="/rmsminicapstone/authenticate" method="POST">
            <label for="email">Email:</label>
            <input id="email" type="email" name="email" required placeholder="user@example.com" />
            
            <label for="password">Password:</label>
            <input id="password" type="password" name="password" required />

            <?php if (!empty($_SESSION['error'])): ?>
                <p style="color:#8b2d2d; font-size:14px; margin-bottom:15px;">
                    <?= $_SESSION['error']; ?>
                </p>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            
            <button type="submit">Sign in</button>
        </form>
        <div class="signup-text">
            <p>Don’t have an account? <a href="/rmsminicapstone/signup">Sign up</a></p>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include "layout.php";
?>
