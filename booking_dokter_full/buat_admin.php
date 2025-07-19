<?php
// Koneksi langsung (tanpa include)
$host = "localhost";
$user = "root";
$pass = "";
$db   = "booking_dokter"; // Ganti jika nama database kamu berbeda

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Data akun admin
$username = 'admin';
$password_plain = 'admin123';
$role = 'admin';

// Buat hash password
$hash = password_hash($password_plain, PASSWORD_DEFAULT);

// Insert akun admin
$sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hash', '$role')";
if ($conn->query($sql)) {
    echo "✅ Akun admin berhasil dibuat.";
} else {
    echo "❌ Gagal: " . $conn->error;
}
?>
