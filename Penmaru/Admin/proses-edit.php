<?php

include("config.php");

// cek apakah tombol simpan sudah diklik atau belum?
if(isset($_POST['simpan'])){

    //ambil data dari formulir
    $id = $_POST['id'];
    $nama = $_POST['Nama'];
    $alamat = $_POST['Alamat'];
    $jk = $_POST['Jenis_Kelamin'];
    $agama = $_POST['Agama'];
    $sekolah = $_POST['Sekolah_Asal'];

    //buat query  update
    $sql = "update calon_siswa set Nama='$nama', Alamat='$alamat', Jenis_Kelamin='$jk',
    Agama='$agama', Sekolah_Asal='$sekolah' where id=$id";
    $query = mysqli_query($koneksi, $sql);

    //apakah query update berhasil? 
    if($query) {
        //kalau berhasil alihkan ke halaman list_siswa.php
        header('Location: List_calon_siswa.php');
    } else {
        //kalau gagal tampilkan pesan
        die("gagal menyimpan perubahan...");
    }
} else {
    die("akses dilarang...");
}
?>