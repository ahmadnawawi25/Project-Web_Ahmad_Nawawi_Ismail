<?php
session_start();
include '../config/db.php';

// Cek jika user belum login atau bukan pasien
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pasien') {
    header("Location: ../login/login.php");
    exit;
}

// Ambil input pencarian
$q = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

// Ambil daftar dokter dari database, dengan filter jika ada pencarian
$query = "SELECT * FROM dokter";
if (!empty($q)) {
    $query .= " WHERE nama LIKE '%$q%' OR spesialis LIKE '%$q%'";
}
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cari Dokter</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #0984e3;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            justify-content: center;
            margin-bottom: 25px;
        }

        input[type="text"] {
            width: 60%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px 0 0 8px;
            outline: none;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            border: none;
            background-color: #00b894;
            color: #fff;
            font-size: 16px;
            border-radius: 0 8px 8px 0;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #00cec9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #dfe6e9;
            text-align: center;
        }

        th {
            background-color: #00cec9;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a.booking-btn {
            padding: 6px 14px;
            background-color: #0984e3;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.3s ease;
        }

        a.booking-btn:hover {
            background-color: #74b9ff;
        }

        .back {
            margin-top: 30px;
            text-align: center;
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
    <h2>🔍 Cari Dokter</h2>

    <form method="get" action="">
        <input type="text" name="q" placeholder="Masukkan nama atau spesialis..." value="<?= htmlspecialchars($q) ?>">
        <button type="submit">Cari</button>
    </form>

    <table>
        <tr>
            <th>Nama Dokter</th>
            <th>Spesialis</th>
            <th>Booking</th>
        </tr>

        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($dokter = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($dokter['nama']) ?></td>
                    <td><?= htmlspecialchars($dokter['spesialis']) ?></td>
                    <td>
                        <a class="booking-btn" href="booking.php?dokter_id=<?= $dokter['id'] ?>">Booking</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Tidak ada dokter ditemukan.</td>
            </tr>
        <?php endif; ?>
    </table>

    <div class="back">
        <p><a href="dashboard.php">← Kembali ke Dashboard Pasien</a></p>
    </div>
</div>

</body>
</html>