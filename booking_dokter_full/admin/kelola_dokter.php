<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

// Tambah dokter
if (isset($_POST['tambah'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $spesialis = $conn->real_escape_string($_POST['spesialis']);
    $conn->query("INSERT INTO dokter (nama, spesialis) VALUES ('$nama', '$spesialis')");
}

// Hapus dokter
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $conn->query("DELETE FROM dokter WHERE id='$id'");
}

// Ambil semua dokter
$dokter = $conn->query("SELECT * FROM dokter");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Dokter</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f1f2f6;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2d3436;
            margin-bottom: 30px;
        }

        form {
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        button {
            margin-top: 20px;
            background-color: #00b894;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #019875;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background-color: #dfe6e9;
        }

        table tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        a {
            color: #d63031;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .back {
            margin-top: 20px;
            display: block;
            text-align: center;
            color: #636e72;
            text-decoration: none;
        }

        .back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Kelola Dokter</h2>

    <form method="post">
        <label for="nama">Nama Dokter:</label>
        <input type="text" name="nama" required>

        <label for="spesialis">Spesialis:</label>
        <input type="text" name="spesialis" required>

        <button type="submit" name="tambah">Tambah Dokter</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Spesialis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $dokter->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['spesialis']) ?></td>
                <td><a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus dokter ini?')">Hapus</a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a class="back" href="dashboard.php">← Kembali ke Dashboard</a>
</div>

</body>
</html>
