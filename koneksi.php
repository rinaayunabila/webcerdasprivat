<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "cerdasprivat"; 

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>
