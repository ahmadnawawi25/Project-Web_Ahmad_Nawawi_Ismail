<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'pasien') {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pasien</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            color: #2d3436;
        }

        .container {
            max-width: 800px;
            margin: 80px auto;
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #00b894;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 30px;
        }

        .menu a {
            display: block;
            background-color: #00cec9;
            color: white;
            text-decoration: none;
            padding: 15px 25px;
            font-size: 18px;
            border-radius: 10px;
            transition: background 0.3s ease;
        }

        .menu a:hover {
            background-color: #0984e3;
        }

        .logout {
            margin-top: 40px;
        }

        .logout a {
            color: #d63031;
            text-decoration: none;
            font-weight: bold;
        }

        .logout a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Halo, <?= htmlspecialchars($_SESSION['username']) ?> 👋</h2>
    <p>Selamat datang di Dashboard Pasien</p>

    <div class="menu">
        <a href="cari_dokter.php">🔍 Cari Dokter</a>
        <a href="riwayat.php">📋 Riwayat Kunjungan</a>
    </div>

    <div class="logout">
        <p><a href="../login/logout.php">Logout</a></p>
    </div>
</div>

</body>
</html>