<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #74ebd5, #acb6e5);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: white;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        h2 {
            color: #2d3436;
            margin-bottom: 10px;
        }

        p {
            color: #636e72;
            margin-bottom: 30px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin: 15px 0;
        }

        a {
            text-decoration: none;
            color: #fff;
            background-color: #0984e3;
            padding: 12px 20px;
            border-radius: 8px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #74b9ff;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Dashboard Admin</h2>
    <p>Selamat datang, Admin!</p>

    <ul>
        <li><a href="kelola_dokter.php">Kelola Dokter</a></li>
        <li><a href="kelola_jadwal.php">Validasi Booking</a></li>
        <li><a href="../login/logout.php">Logout</a></li>
    </ul>
</div>

</body>
</html>
