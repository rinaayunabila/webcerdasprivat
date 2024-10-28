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
    $pengalamanMengajar = $_POST['teaching_experience']; // Corrected key here
    $tarif = $_POST['tarif'];
    $noHp = $_POST['phone'];
    $alamat = $_POST['address'];
    $levelMengajar = $_POST['teaching_level'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Meng-hash password

    // Mengupload file foto profil
    $targetDir = "uploads/"; // Folder untuk menyimpan foto profil
    $targetFile = $targetDir . basename($fotoProfil);
    move_uploaded_file($_FILES['profile-pic']['tmp_name'], $targetFile);

    // Menyiapkan pernyataan SQL dengan jumlah kolom yang sesuai
    $stmt = $conn->prepare("INSERT INTO Guru (foto_profil, nama, deskripsi, pendidikan, mata_pelajaran, no_hp, alamat, tarif, pengalaman_mengajar, level, password, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Mengikat parameter yang sesuai
    $stmt->bind_param("ssssssssssss", $targetFile, $nama, $deskripsi, $pendidikan, $mataPelajaran, $noHp, $alamat, $tarif, $pengalamanMengajar, $levelMengajar, $password, $email);

    // Menjalankan pernyataan dan memeriksa keberhasilan
    if ($stmt->execute()) {
        // Pendaftaran berhasil, alihkan ke halaman login
        header("Location: login.html"); // Ganti dengan nama file halaman login Anda
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Menutup pernyataan dan koneksi
    $stmt->close();
} else {
    echo "Gagal mengupload file foto profil.";
}

// Menutup koneksi
$conn->close();
?>