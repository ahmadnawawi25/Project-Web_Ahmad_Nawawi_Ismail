<?php
session_start();

// Redirect jika sudah login
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin/dashboard.php");
        exit;
    } elseif ($_SESSION['role'] === 'pasien') {
        header("Location: pasien/dashboard.php");
        exit;
    } elseif ($_SESSION['role'] === 'dokter') {
        header("Location: dokter/dashboard_dokter.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda - Klinik As-Sifa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #dff9fb, #c7ecee);
            color: #2d3436;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 80px;
        }

        h1 {
            color: #0984e3;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.1rem;
            color: #636e72;
            margin-bottom: 30px;
        }

        .btn-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }

        a.button {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            background-color: #00cec9;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.2s;
        }

        a.button i {
            font-size: 18px;
        }

        a.button:hover {
            background-color: #0984e3;
            transform: translateY(-2px);
        }

        footer {
            margin-top: auto;
            padding: 20px 0;
            text-align: center;
            background-color: #00b894;
            color: #fff;
            font-size: 14px;
        }

        @media (max-width: 500px) {
            h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Selamat Datang di Klinik As-Sifa</h1>
    <p>Solusi praktis untuk membuat janji temu dan kelola rekam medis Anda.</p>

    <div class="btn-group">
        <a href="login/login.php" class="button"><i class="fas fa-user"></i> Login Pasien</a>
        <a href="login/register.php" class="button"><i class="fas fa-user-plus"></i> Daftar Pasien</a>
        <a href="login/login_admin.php" class="button"><i class="fas fa-user-shield"></i> Login Admin</a>
        <a href="login/login_dokter.php" class="button"><i class="fas fa-user-md"></i> Login Dokter</a>
    </div>
</div>

<footer>
    &copy; <?= date('Y') ?> Klinik As-Sifa. All rights reserved.
</footer>

</body>
</html>
