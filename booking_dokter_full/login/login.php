<?php
session_start();
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: ../admin/dashboard.php");
        exit;
    } elseif ($_SESSION['role'] === 'pasien') {
        header("Location: ../pasien/dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Pengguna</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }

        .login-box h2 {
            margin-bottom: 25px;
            text-align: center;
            color: #2d3436;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #636e72;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #b2bec3;
            font-size: 15px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #0984e3;
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
            background-color: #74b9ff;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #0984e3;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .back-home {
            margin-top: 10px;
            text-align: center;
        }

        .back-home a {
            font-size: 13px;
            color: #636e72;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login Pengguna</h2>

    <form method="post" action="proses_login.php">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" required placeholder="Masukkan username">
        </div>

        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required placeholder="Masukkan password">
        </div>

        <button type="submit">Login</button>
    </form>

    <div class="register-link">
        Belum punya akun? <a href="register.php">Daftar Pasien</a>
    </div>

    <div class="back-home">
        <a href="../index.php">← Kembali ke Beranda</a>
    </div>
</div>

</body>
</html>