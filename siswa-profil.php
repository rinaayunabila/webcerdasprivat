<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Siswa') {
    header("Location: login.php");
    exit();
}

// Mengambil data siswa berdasarkan id user yang login
$user_id = $_SESSION['user_id'];
$query = "SELECT s.nama, s.sekolah, s.email, s.nama_orang_tua, s.alamat, s.no_hp
          FROM Siswa s
          JOIN Users u ON s.email = u.email
          WHERE u.id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $siswa = $result->fetch_assoc();
} else {
    echo "Data siswa tidak ditemukan.";
    exit();
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Profil Siswa</title>
  <link href="assets/img/logoCP2.png" rel="icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  <style>
    .profil-siswa {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin-top: 50px;
    }
    .form-container {
      margin: 100px auto;
      padding: 20px;
      background-color: white;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.9);
      border-radius: 8px;
      max-width: 600px;
    }
    .profile-pic {
      display: block;
      margin: 0 auto 20px;
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }
  </style>
</head>

<body class="index-page">
<header id="header" class="header fixed-top">
  <div class="branding d-flex align-items-center">
    <div class="container position-relative d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logoCP2.png" alt="" style="width: 40px; height: auto;">
        <h1 class="sitename">Cerdas Privat</h1>
        <span>.</span>
      </a>
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="siswa-beranda.html" class="active">Beranda<br></a></li>
          <li><a href="siswa-guru.php">Guru</a></li>
          <li class="dropdown"><a href="#"><span>Kelas</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="siswa-jadwal.php">Kelas Aktif</a></li>
              <li><a href="siswa-statuspendaftaran.php">Status Pendaftaran</a></li>
            </ul>
          </li>
          <li><a href="siswa-profil.php">
              <img src="assets/img/services.jpg" alt="User Profile" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
            </a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </div>
</header>

  <main class="profil-siswa">
    <div class="form-container">
      <div class="text-center">
        <img src="assets/img/services.jpg" alt="Foto Profil" class="profile-pic" id="profile-pic-preview">
      </div>

      <form>
        <div class="mb-3">
          <label for="name" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" id="name" value="<?= htmlspecialchars($siswa['nama']); ?>" readonly>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($siswa['email']); ?>" readonly>
        </div>

        <div class="mb-3">
          <label for="school" class="form-label">Sekolah</label>
          <input type="text" class="form-control" id="school" value="<?= htmlspecialchars($siswa['sekolah']); ?>" readonly>
        </div>

        <div class="mb-3">
          <label for="parent_name" class="form-label">Nama Orang Tua</label>
          <input type="text" class="form-control" id="parent_name" value="<?= htmlspecialchars($siswa['nama_orang_tua']); ?>" readonly>
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">No. Telepon</label>
          <input type="tel" class="form-control" id="phone" value="<?= htmlspecialchars($siswa['no_hp']); ?>" readonly>
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Alamat</label>
          <textarea class="form-control" id="address" rows="3" readonly><?= htmlspecialchars($siswa['alamat']); ?></textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Update Profil</button>
          </div>
      </form>
    </div>
  </main>

  <footer id="footer" class="footer accent-background">
    <div class="container copyright text-center mt-4">
      <p>© Copyright Cerdas Privat</p>
    </div>
  </footer>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
