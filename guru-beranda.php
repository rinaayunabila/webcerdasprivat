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
  <title>Beranda Guru</title>
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
    main {
      margin-top: -50px;
    }
    main {
      margin-top: -50px;
    }

    .icon-box .icon i {
      font-size: 2rem; /* Adjust size if needed */
      color: white; /* Sets the icon color to white */
    }

    .icon-box .title {
      color: white; /* Ensures the title (h4) color is also white */
      margin-top: 10px;
    }

    .container ul li {
      text-align: justify;
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
            <li><a href="guru-beranda.php" class="active">Beranda<br></a></li>
            <li><a href="guru_siswa.php">Siswa</a></li>
            <li><a href="guru_pendaftaransiswa.php">Pendaftaran</a></li>
            <li><a href="guru_pembayaran.php">Pembayaran</a></li>
            <li>
              <a href="guru_profillguru.php">
                <img src="<?= htmlspecialchars($guru['foto_profil']); ?>" alt="User Profile" class="profile-img rounded-circle" >
              </a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </div>
  </header>

  <main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section background-color">
     <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
       <div class="row gy-5 justify-content-between">
         <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center"></br>
           <h2><span>Hello </span> <span class="accent" style="color: #008374;"><?php echo $guru['nama']; ?></span></h2>
           </br></br>
           
           <div class="d-flex">
             <a href="daftarakun.html" class="btn-get-started ">Daftar</a>
             <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Tonton Vidio</span></a>
           </div>
         </div>
         <div class="col-lg-5 order-1 order-lg-2">
         </br></br></br>  <img src="uploads/cerdas1.png" class="img-fluid" alt="" style="width: 300px; height: auto; margin-left: 80px;">
         </div>
       </div>
     </div>
   </section><!-- /Hero Section -->
   </main>


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