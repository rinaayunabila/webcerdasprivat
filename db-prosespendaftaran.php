<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'koneksi.php';

// Menetapkan header konten sebagai JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengecek id_siswa dalam sesi login
    if (!isset($_SESSION['id_siswa'])) {
        echo json_encode(['success' => false, 'message' => 'Anda harus login sebagai siswa untuk mendaftar.']);
        exit;
    }

    $id_siswa = $_SESSION['id_siswa'];
    $data = json_decode(file_get_contents('php://input'), true);
    $id_guru = $data['id_guru'];
    $tanggal_pendaftaran = date('Y-m-d'); // Tanggal hari ini

    // Menyimpan pendaftaran ke database
    $sql = "INSERT INTO Pendaftaran (id_siswa, id_guru, tanggal_pendaftaran) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $id_siswa, $id_guru, $tanggal_pendaftaran);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data pendaftaran.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Metode tidak valid.']);
}
?>
