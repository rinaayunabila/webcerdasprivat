<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $sekolah = $_POST['sekolah'];
    $email = $_POST['email'];
    $parent_name = $_POST['parent-name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'Siswa';

    // Simpan ke tabel Users terlebih dahulu
    $userQuery = "INSERT INTO Users (email, password, role) VALUES (?, ?, ?)";
    $userStmt = $conn->prepare($userQuery);
    $userStmt->bind_param("sss", $email, $password, $role);

    if ($userStmt->execute()) {
        // Jika berhasil, baru simpan ke tabel Siswa
        $siswaQuery = "INSERT INTO Siswa (nama, sekolah, email, nama_orang_tua, alamat, no_hp) VALUES (?, ?, ?, ?, ?, ?)";
        $siswaStmt = $conn->prepare($siswaQuery);
        $siswaStmt->bind_param("ssssss", $name, $sekolah, $email, $parent_name, $address, $phone);

        if ($siswaStmt->execute()) {
            header("Location: login.html");
            exit();
        } else {
            echo "Error saat menyimpan ke tabel Siswa: " . $siswaStmt->error;
        }
        $siswaStmt->close();
    } else {
        echo "Error saat menyimpan ke tabel Users: " . $userStmt->error;
    }

    $userStmt->close();
    $conn->close();
}
?>
