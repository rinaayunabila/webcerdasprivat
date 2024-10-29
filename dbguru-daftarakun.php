<?php
// Memasukkan file koneksi database
include 'koneksi.php';

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $fotoProfil = $_FILES['profile-pic']['name'];
    $nama = $_POST['name'];
    $email = $_POST['email'];
    $deskripsi = $_POST['qualification'];
    $pendidikan = $_POST['experience'];
    $mataPelajaran = $_POST['subject'];
    $pengalamanMengajar = $_POST['teaching_experience'];
    $tarif = $_POST['tarif'];
    $noHp = $_POST['phone'];
    $alamat = $_POST['address'];
    $levelMengajar = $_POST['teaching_level'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $role = 'Guru'; // Role tetap sebagai 'Guru'

    // Mengupload file foto profil
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($fotoProfil);
    if (move_uploaded_file($_FILES['profile-pic']['tmp_name'], $targetFile)) {

        // Memasukkan data autentikasi ke tabel Users
        $userStmt = $conn->prepare("INSERT INTO Users (email, password, role) VALUES (?, ?, ?)");
        $userStmt->bind_param("sss", $email, $password, $role);

        if ($userStmt->execute()) {
            // Memasukkan data profil ke tabel Guru
            $stmt = $conn->prepare("INSERT INTO Guru (foto_profil, nama, deskripsi, pendidikan, mata_pelajaran, no_hp, alamat, tarif, pengalaman_mengajar, level, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssssss", $targetFile, $nama, $deskripsi, $pendidikan, $mataPelajaran, $noHp, $alamat, $tarif, $pengalamanMengajar, $levelMengajar, $email);

            if ($stmt->execute()) {
                // Pendaftaran berhasil, alihkan ke halaman login
                header("Location: login.html"); // Ganti dengan nama file halaman login Anda
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: " . $userStmt->error;
        }
        $userStmt->close();
    } else {
        echo "Gagal mengupload file foto profil.";
    }
}

// Menutup koneksi
$conn->close();
?>
