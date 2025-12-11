<?php session_start(); ?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Login Kasir</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="login-box">
        <h2>Login Kasir</h2>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="error">
                <?= $_SESSION['error']; ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="cek_login.php" method="post">
            <label>Username</label><br>
            <input type="text" name="username" required><br>

            <label>Password</label><br>
            <input type="password" name="password" required><br>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
