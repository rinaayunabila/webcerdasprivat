<?php
include('koneksi.php');

// Dapatkan data yang dikirimkan dari request
if (isset($_POST['id_pendaftaran']) && isset($_POST['status'])) {
    $id_pendaftaran = $_POST['id_pendaftaran'];
    $status = $_POST['status'];

    // Query untuk memperbarui status pendaftaran
    $query = "UPDATE Pendaftaran SET status = ? WHERE id_pendaftaran = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $id_pendaftaran);

    if ($stmt->execute()) {
        echo "Status berhasil diperbarui.";
    } else {
        echo "Gagal memperbarui status.";
    }

    $stmt->close();
}
?>
