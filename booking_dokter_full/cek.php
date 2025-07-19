<?php
$input = 'admin123'; // ganti dengan password yang kamu ketik di form login
$hash = '$2y$10$ZvnOaPfzBv76IXE9KymStOTgkbJvODL0nxijx9ohIqxk9gctZguq6'; // ganti dengan isi kolom password di database

if (password_verify($input, $hash)) {
    echo "Cocok!";
} else {
    echo "Tidak cocok!";
}
