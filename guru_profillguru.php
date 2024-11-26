<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Guru') {
    header("Location: login.php");
    exit();
}

// Mengambil data guru berdasarkan id user yang login
$user_id = $_SESSION['user_id'];
$query = "SELECT g.nama, g.pendidikan, g.mata_pelajaran, g.pengalaman_mengajar, g.level, g.tarif, g.deskripsi, g.alamat, g.email, g.no_hp, g.foto_profil
          FROM Guru g
          JOIN Users u ON g.email = u.email
          WHERE u.id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $guru = $result->fetch_assoc();
} else {
    echo "Data Guru tidak ditemukan.";
    exit();
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Guru-Profil Saya</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/logoCP2.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    .profil-guru {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 50px auto;
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
    <div class="branding d-flex align-items-cente">
      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
          <img src="assets/img/logoCP2.png" alt="" style="width: 40px; height: auto;">
          <h3 class="sitename" style="font-weight: bold;">Cerdas Privat</h3> 
        </a>
        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="guru-beranda.html" class="active">Beranda<br></a></li>
            <li><a href="guru_siswa.php">Siswa</a></li>
            <li><a href="guru_pendaftaransiswa.php">Pendaftaran</a></li>
            <li><a href="guru_pembayaran.php">Pembayaran</a></li>
            <li><a href="guru_profillguru.php">
              <img src="<?= htmlspecialchars($guru['foto_profil']); ?>"alt="User Profile" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
            </a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </div>
  </header>

  <main class="profil-guru">
    <div class="form-container">
      <h2 class="text-center mb-4; underline-heading">Profil Saya</h2>
        <!-- Foto Profil -->
        <div class="text-center">
            <img src="<?= htmlspecialchars($guru['foto_profil']); ?>" alt="Foto Profil" class="profile-pic" id="profile-pic-preview">
        </div>
      
        <!-- Form Profil -->
        <form>
        <div class="mb-3">
          <label for="name" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" id="name" value="<?= htmlspecialchars($guru['nama']); ?>" readonly>
        </div>

          <div class="mb-3">
            <label for="pendidikan" class="form-label">Pendidikan</label>
            <input type="text" class="form-control" id="pendidikan" value="<?= htmlspecialchars($guru['pendidikan']); ?>" readonly>
          </div>

          <div class="mb-3">
            <label for="subject" class="form-label">Mata Pelajaran</label>
            <input type="text" class="form-control" id="subject" value="<?= htmlspecialchars($guru['mata_pelajaran']); ?>" readonly>
          </div>

          <div class="mb-3">
            <label for="experience" class="form-label">Pengalaman Mengajar</label>
            <input type="text" class="form-control" id="experience" value="<?= htmlspecialchars($guru['pengalaman_mengajar']); ?>" readonly>
          </div>

          <div class="mb-3">
            <label for="level" class="form-label">Level</label>
            <input type="text" class="form-control" id="level" value="<?= htmlspecialchars($guru['level']); ?>" readonly>
          </div>

          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" class="form-control" id="deskripsi" value="<?= htmlspecialchars($guru['deskripsi']); ?>" readonly>
          </div>

          <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="address" value="<?= htmlspecialchars($guru['alamat']); ?>" readonly>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($guru['email']); ?>" readonly>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label">No.Telepon</label>
            <input type="text" class="form-control" id="phone" value="<?= htmlspecialchars($guru['no_hp']); ?>" readonly>
          </div>
          <div class="text-center" action="logout.php" method="POST">
          <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin logout?');">Logout</button>
      </div>
        </form>
      </div>
  </main>
  

  <footer id="footer" class="footer default-background">
    <div class="container copyright text-center mt-4">
      <p>© <span>Cerdas Private 2024</span></p>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>