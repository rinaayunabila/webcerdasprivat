<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data dari form
    $id_pendaftaran = $_POST['id_pendaftaran'] ?? null;
    $jumlah = $_POST['nominal'] ?? null;
    $tanggal_pembayaran = date('Y-m-d');

    // Debugging log untuk memastikan data diterima dengan benar
    if (empty($id_pendaftaran) || empty($jumlah)) {
        die("Data tidak lengkap. Pastikan semua field diisi.");
    }

    // Validasi id_pendaftaran di tabel Pendaftaran
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

        // Validasi dan upload file
        if ($_FILES["bukti_transfer"]["error"] === UPLOAD_ERR_OK) {
            if (move_uploaded_file($_FILES["bukti_transfer"]["tmp_name"], $target_file)) {
                // Simpan data pembayaran ke database
                $sql = "INSERT INTO Pembayaran (id_pendaftaran, jumlah, foto_bukti, status_pembayaran, tanggal_pembayaran) 
                        VALUES (?, ?, ?, 'Pending', ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iiss", $id_pendaftaran, $jumlah, $target_file, $tanggal_pembayaran);

                if ($stmt->execute()) {
                    // Berhasil
                    header("Location: siswa-detailkelas.php?status=sukses");
                    exit;
                } else {
                    // Kesalahan eksekusi query
                    die("Terjadi kesalahan saat menyimpan pembayaran: " . $stmt->error);
                }
            } else {
                die("Gagal mengupload bukti transfer. Pastikan folder 'uploads/' memiliki izin tulis.");
            }
        } else {
            die("Kesalahan saat mengupload file: " . $_FILES["bukti_transfer"]["error"]);
        }
    } else {
        die("Error: id_pendaftaran tidak ditemukan di tabel Pendaftaran.");
    }

    // Tutup statement dan koneksi
    $stmt_check->close();
    $conn->close();
} else {
    die("Metode tidak valid.");
}
?>