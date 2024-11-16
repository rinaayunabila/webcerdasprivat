<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT id, email, password, role FROM Users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Simpan id pengguna dan peran dalam sesi
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if ($_SESSION['role'] === 'Siswa') {
                $siswa_query = "SELECT id_siswa, foto_profil FROM Siswa WHERE email = ?";
                $siswa_stmt = $conn->prepare($siswa_query);
                $siswa_stmt->bind_param("s", $email);
                $siswa_stmt->execute();
                $siswa_result = $siswa_stmt->get_result();

                if ($siswa_result->num_rows > 0) {
                    $siswa = $siswa_result->fetch_assoc();
                    $_SESSION['id_siswa'] = $siswa['id_siswa'];
                    $_SESSION['foto_profil'] = $siswa['foto_profil'] ?: 'default.jpg';
                     // Use default if empty
                }
                $siswa_stmt->close();
                header("Location: siswa-beranda.html");
                exit();
            } elseif ($_SESSION['role'] === 'Guru') {
                $guru_query = "SELECT id_guru, foto_profil FROM Guru WHERE email = ?";
                $guru_stmt = $conn->prepare($guru_query);
                $guru_stmt->bind_param("s", $email);
                $guru_stmt->execute();
                $guru_result = $guru_stmt->get_result();

                if ($guru_result->num_rows > 0) {
                    $guru = $guru_result->fetch_assoc();
                    $_SESSION['id_guru'] = $guru['id_guru'];
                    $_SESSION['foto_profil'] = $guru['foto_profil'] ?: 'default.jpg'; // Use default if empty
                }

                $guru_stmt->close();
                header("Location: guru-beranda.php");
                exit();
            } elseif ($_SESSION['role'] === 'Admin') {
                header("Location: admin-beranda.html");
                exit();
            }
        } else {
            $_SESSION['error'] = "Password salah.";
            header("Location: login.php"); 
            exit();
        }
    } else {
        $_SESSION['error'] = "Email tidak terdaftar.";
        header("Location: login.php"); 
        exit();
    }
    $stmt->close();
    $conn->close();
}
?>
