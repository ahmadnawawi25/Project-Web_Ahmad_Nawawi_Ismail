<?php
include '../config/db.php';
session_start();

// Cek apakah sudah login dan sebagai pasien
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pasien') {
    header("Location: ../login/login.php");
    exit;
}

$pasien_id = $_SESSION['user_id'];

// Validasi ID dokter
if (!isset($_GET['dokter_id']) || !is_numeric($_GET['dokter_id'])) {
    echo "ID dokter tidak valid.";
    exit;
}

$dokter_id = $_GET['dokter_id'];

// Ambil info dokter
$dokter_query = $conn->query("SELECT * FROM dokter WHERE id = $dokter_id");
$dokter = $dokter_query->fetch_assoc();

if (!$dokter) {
    echo "Dokter tidak ditemukan.";
    exit;
}

// Proses Booking
$berhasil = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal = $_POST['tanggal'];
    $keluhan = $conn->real_escape_string($_POST['keluhan']);
    $conn->query("INSERT INTO booking (pasien_id, dokter_id, tanggal, keluhan, status) VALUES ('$pasien_id', '$dokter_id', '$tanggal', '$keluhan', 'Menunggu')");
    $berhasil = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Booking Dokter</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        h2 {
            color: #0984e3;
            text-align: center;
            margin-bottom: 20px;
        }

        .success {
            background-color: #dff9fb;
            color: #0984e3;
            border: 1px solid #00cec9;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        button {
            margin-top: 20px;
            width: 100%;
            background-color: #00b894;
            color: #fff;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #00cec9;
        }

        .back {
            text-align: center;
            margin-top: 20px;
        }

        .back a {
            text-decoration: none;
            color: #636e72;
        }

        .back a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Booking ke <?= htmlspecialchars($dokter['nama']) ?> (<?= htmlspecialchars($dokter['spesialis']) ?>)</h2>

    <?php if ($berhasil): ?>
        <div class="success">
            Booking berhasil dikirim! Menunggu konfirmasi dari admin.
        </div>
    <?php endif; ?>

    <form method="post">
        <label for="tanggal">Tanggal Kunjungan:</label>
        <input type="date" name="tanggal" id="tanggal" required>

        <label for="keluhan">Keluhan:</label>
        <textarea name="keluhan" id="keluhan" rows="5" placeholder="Jelaskan keluhan Anda..." required></textarea>

        <button type="submit">Kirim Booking</button>
    </form>

    <div class="back">
        <p><a href="cari_dokter.php">← Kembali ke Daftar Dokter</a></p>
    </div>
</div>

</body>
</html>