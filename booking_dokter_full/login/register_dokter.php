<?php
session_start();
include '../config/db.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($conn->real_escape_string($_POST['username']));
    $password = trim($_POST['password']);

    // Cek apakah username sudah digunakan
    $cek = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($cek->num_rows > 0) {
        $error = "Username sudah terdaftar.";
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Simpan ke database
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', 'dokter')";
        if ($conn->query($sql) === TRUE) {
            $success = "Akun dokter berhasil dibuat!";
        } else {
            $error = "Gagal menyimpan: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Dokter</title>
    <style>
        body { font-family: Arial; background: #f8f8f8; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.2); width: 350px; }
        h2 { text-align: center; }
        .form-group { margin-bottom: 15px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; }
        button { width: 100%; padding: 10px; background: #2ecc71; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .success { color: green; text-align: center; margin-bottom: 10px; }
        .error { color: red; text-align: center; margin-bottom: 10px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Registrasi Dokter</h2>

    <?php if ($success): ?>
        <div class="success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Username Dokter</label>
            <input type="text" name="username" required>
        </div>

        <div class="form-group">
            <label>Password Dokter</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Register</button>
    </form>
</div>

</body>
</html>
