<?php
session_start();
include '../config/db.php';

// Jika user sudah login, redirect
if (isset($_SESSION['role'])) {
    header("Location: ../index.php");
    exit;
}

$success = "";
$error = "";

// Proses registrasi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string(trim($_POST['username']));
    $password = trim($_POST['password']);
    $confirm  = trim($_POST['confirm']);

    if ($password !== $confirm) {
        $error = "Konfirmasi password tidak sesuai.";
    } elseif (strlen($password) < 6) {
        $error = "Password minimal 6 karakter.";
    } else {
        // Cek username sudah ada atau belum
        $cek = $conn->query("SELECT * FROM users WHERE username = '$username'");
        if ($cek->num_rows > 0) {
            $error = "Username sudah terdaftar.";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Simpan ke database dengan password ter-hash
            $conn->query("INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', 'pasien')");
            $success = "Registrasi berhasil! Silakan login.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Pasien</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-box {
            background: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }

        .register-box h2 {
            text-align: center;
            color: #0984e3;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
            color: #2d3436;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        input:focus {
            border-color: #0984e3;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #0984e3;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #00a8ff;
        }

        .error, .success {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #636e72;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="register-box">
    <h2>Registrasi Pasien</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php elseif (!empty($success)): ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" required>
        </div>

        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-group">
            <label>Konfirmasi Password:</label>
            <input type="password" name="confirm" required>
        </div>

        <button type="submit">Daftar</button>
    </form>

    <div class="back-link">
        <p><a href="login.php">← Sudah punya akun? Login</a></p>
        <p><a href="../index.php">← Kembali ke Beranda</a></p>
    </div>
</div>

</body>
</html>