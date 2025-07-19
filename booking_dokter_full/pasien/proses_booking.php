<?php
include '../config/db.php';

$id_dokter = intval($_POST['id_dokter']);
$id_pasien = intval($_POST['id_pasien']);
$keluhan = $conn->real_escape_string($_POST['keluhan']);
$tanggal = date('Y-m-d');

$sql = "INSERT INTO booking (id_dokter, id_pasien, tanggal, keluhan) 
        VALUES ($id_dokter, $id_pasien, '$tanggal', '$keluhan')";

if ($conn->query($sql)) {
    echo "Booking berhasil!";
} else {
    echo "Gagal booking: " . $conn->error;
}
?>
