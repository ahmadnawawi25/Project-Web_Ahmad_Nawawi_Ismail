<?php
session_start();
include '../config/db.php';

// Ambil input dari form
$username = trim($conn->real_escape_string($_POST['username']));
$password = trim($_POST['password']);

// Query cari user berdasarkan username
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

// Cek apakah user ditemukan
if ($result && $result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verifikasi password hash
    if (password_verify($password, $user['password'])) {
        // Simpan data ke session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect berdasarkan role
        if ($user['role'] === 'admin') {
            header("Location: ../admin/dashboard.php");
            exit;
        } elseif ($user['role'] === 'pasien') {
            header("Location: ../pasien/dashboard.php");
            exit;
        }if ($user['role'] === 'dokter') {  
            header("Location: ../dokter/dashboard_dokter.php");
        exit;
}
    } else {
        echo "Password salah.";
    }
} else {
    echo "Username tidak ditemukan.";
}
?>
