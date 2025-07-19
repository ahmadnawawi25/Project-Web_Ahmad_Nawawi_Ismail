<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head><title>Login Dokter</title></head>
<body>
    <h2>Login Dokter</h2>
    <form action="proses_login_dokter.php" method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
