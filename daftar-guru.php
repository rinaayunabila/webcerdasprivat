<?php
// Memulai session untuk mengakses id_siswa yang tersimpan
session_start();

// Memasukkan koneksi ke database
include 'koneksi.php';

// Mendekode JSON dari request body
$data = json_decode(file_get_contents("php://input"), true);
$id_guru = $data['id_guru']; // ID guru yang dikirim dari JavaScript

// Memastikan id_siswa sudah ada di session
if (isset($_SESSION['id_siswa']) && $id_guru) {
    $id_siswa = $_SESSION['id_siswa'];

    // Query SQL untuk menyimpan data pendaftaran ke tabel Pendaftaran
    $sql = "INSERT INTO Pendaftaran (id_guru, id_siswa) VALUES ('$id_guru', '$id_siswa')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal menyimpan data: " . $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "ID Guru atau ID Siswa tidak ditemukan"]);
}

// Menutup koneksi database
$conn->close();
?>
