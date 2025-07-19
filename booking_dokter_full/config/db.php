<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "booking_dokter";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
<?php
$conn = new mysqli("localhost", "root", "", "booking_dokter");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>