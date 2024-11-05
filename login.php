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

            // Jika pengguna adalah siswa, ambil id_siswa dan simpan dalam sesi
            if ($_SESSION['role'] === 'Siswa') {
                $siswa_query = "SELECT id_siswa FROM Siswa WHERE email = ?";
                $siswa_stmt = $conn->prepare($siswa_query);
                $siswa_stmt->bind_param("s", $email);
                $siswa_stmt->execute();
                $siswa_result = $siswa_stmt->get_result();

                if ($siswa_result->num_rows > 0) {
                    $siswa = $siswa_result->fetch_assoc();
                    $_SESSION['id_siswa'] = $siswa['id_siswa']; // Simpan id_siswa dalam sesi
                }

                $siswa_stmt->close();
                header("Location: siswa-beranda.html");
                exit();
            } elseif ($_SESSION['role'] === 'Guru') {
                header("Location: guru-beranda.html");
                exit();
            } elseif ($_SESSION['role'] === 'Admin') {
                header("Location: admin_guru.html");
                exit();
            }
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Email tidak terdaftar.";
    }
    $stmt->close();
    $conn->close();
}
?>
