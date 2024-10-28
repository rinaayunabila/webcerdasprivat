<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $foto_profil = $_FILES['foto_profil']['name']; // Mengambil nama file foto profil
    $nama = $_POST['name'];
    $deskripsi = $_POST['deskripsi'];
    $pendidikan = $_POST['qualification'];
    $mata_pelajaran = $_POST['subject'];
    $pengalaman_mengajar = $_POST['experience'];
    $level = $_POST['level']; // Misal: TK, SD, SMP, SMA, MAHASISWA, UMUM
    $tarif = $_POST['tarif'];
    $alamat = $_POST['address'];
    $email = $_POST['email'];
    $no_hp = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi kata sandi

    // Menyimpan foto profil ke direktori
    $target_dir = "uploads/"; // Folder untuk menyimpan upload
    $target_file = $target_dir . basename($foto_profil);
    move_uploaded_file($_FILES['foto_profil']['tmp_name'], $target_file); // Upload file

    // Menyusun query untuk memasukkan data
    $sql = "INSERT INTO Guru (foto_profil, nama, deskripsi, pendidikan, mata_pelajaran, pengalaman_mengajar, level, tarif, alamat, email, no_hp, password) 
            VALUES ('$target_file', '$nama', '$deskripsi', '$pendidikan', '$mata_pelajaran', '$pengalaman_mengajar', '$level', '$tarif', '$alamat', '$email', '$no_hp', '$password')";

    // Mengeksekusi query
    if ($conn->query($sql) === TRUE) {
        header("location:page-guru.php"); // Ganti dengan halaman yang sesuai setelah berhasil
        exit(); // Keluar untuk menghindari eksekusi lebih lanjut
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close(); // Menutup koneksi
}
?>
