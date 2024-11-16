<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data dari form
    $id_pendaftaran = $_POST['id_pendaftaran'];
    $jumlah = $_POST['nominal'];
    $tanggal_pembayaran = date('Y-m-d');

    // Periksa apakah id_pendaftaran ada di tabel Pendaftaran
    $sql_check = "SELECT id_pendaftaran FROM Pendaftaran WHERE id_pendaftaran = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $id_pendaftaran);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Mengupload file bukti transfer
        $target_dir = "uploads/";
        $file_name = basename($_FILES["bukti_transfer"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["bukti_transfer"]["tmp_name"], $target_file)) {
            // Jika file berhasil diupload, simpan data ke database
            $sql = "INSERT INTO Pembayaran (id_pendaftaran, jumlah, foto_bukti, status_pembayaran, tanggal_pembayaran) 
                    VALUES (?, ?, ?, 'Pending', ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iiss", $id_pendaftaran, $jumlah, $target_file, $tanggal_pembayaran);

            if ($stmt->execute()) {
                echo "Pembayaran berhasil disimpan!";
                // Redirect atau pesan sukses
                header("Location: siswa-detailkelas.php"); // Ganti dengan halaman yang sesuai
                exit;
            } else {
                echo "Terjadi kesalahan: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Gagal mengupload bukti transfer.";
        }
    } else {
        echo "Error: id_pendaftaran tidak ditemukan di tabel Pendaftaran.";
    }

    $stmt_check->close();
    $conn->close();
} else {
    echo "Metode tidak valid.";
}
?>
