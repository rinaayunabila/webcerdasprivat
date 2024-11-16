<?php
session_start();
include 'koneksi.php';

// Get id_siswa from session
$id_siswa = $_SESSION['id_siswa'];

$sql = "SELECT Guru.nama, Guru.mata_pelajaran, Guru.level, Guru.tarif, Guru.foto_profil, Pendaftaran.status 
        FROM Pendaftaran 
        JOIN Guru ON Pendaftaran.id_guru = Guru.id_guru 
        WHERE Pendaftaran.id_siswa = ?";
        
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_siswa);
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Status Pendaftaran Siswa</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/logo.jpeg" rel="icon">
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
    .class-container {
      width: 1200px;
      padding: 5px;
      margin: auto;
      
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
      background-color: #d9d9d9;
      font-size: 15px;
      color: #000000;
      margin-bottom: 30px; 
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
        </a>
        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="siswa-beranda.html">Beranda<br></a></li>
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

  <main class="main">
     <section id="services" class="services section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3> </h3>
                <a href="#" class="btn btn-primary" style="padding: 5px 15px;">Filter</a>
              </div>
  
              <div class="row gy-4">
    <?php
    if ($result->num_rows > 0) {
      while ($guru = $result->fetch_assoc()) {
        echo '<div class="col-md-12" data-aos="fade-up" data-aos-delay="100">';
        echo '<div class="service-item position-relative" style="max-width: 1200px; margin:auto; padding: 20px; border-radius: 10px;">';
        echo '<div class="d-flex align-items-center justify-content-between">';
        
        // Bagian foto profil dengan validasi
        $image_path = 'uploads/' . $guru['foto_profil'];
        if (!file_exists($image_path) || empty($guru['foto_profil'])) {
            $image_path = 'assets/img/default-profile.png'; // Default image
        }
        echo '<div class="profile-picture" style="margin-right: 20px;">';
        echo '<img src="' . $image_path . '" class="rounded-circle" alt="Guru Image" style="width: 50px; height: 50px; object-fit: cover;">';
        echo '</div>';
        
        // Bagian informasi guru
        echo '<div class="profile-info" style="flex-grow: 1; font-weight: bold;">';
        echo '<p class="card-title mb-1">Nama: ' . $guru['nama'] . '</p>';
        echo '<p class="card-text mb-1">Mata Pelajaran: ' . $guru['mata_pelajaran'] . '</p>';
        echo '<p class="card-text mb-1">Tingkat: ' . $guru['level'] . '</p>';
        echo '</div>';
        
        // Bagian tarif dan status
        echo '<div class="profile-price text-right" style="margin-right: 20px; font-weight: bold;">';
        echo '<p class="card-text mb-0">Harga: Rp ' . number_format($guru['tarif'], 0, ',', '.') . '/jam</p>';
        echo '</div>';
        echo '<div>';
        echo '<a href="#" class="btn btn-primary" style="padding: 5px 10px;">' . $guru['status'] . '</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }    
    } else {
        echo '<p>Belum ada pendaftaran yang dilakukan</p>';
    }

    $stmt->close();
    $conn->close();
    ?>
</div>
        </div>
      </section>
  </main>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>
