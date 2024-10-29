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
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if ($_SESSION['role'] === 'Siswa') {
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
