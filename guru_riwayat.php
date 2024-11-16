<?php
// Start the session to get login info
session_start();

// Include connection file
include('koneksi.php');

// Get the teacher's ID from the logged-in session
$id_guru = $_SESSION['id_guru']; // Ensure id_guru is stored in session

// Query untuk mengambil data siswa yang diterima atau ditolak pada guru yang login
$query = "SELECT S.nama, S.sekolah, P.id_pendaftaran, P.tanggal_pendaftaran, P.status 
          FROM Pendaftaran P
          JOIN Siswa S ON P.id_siswa = S.id_siswa
          WHERE P.id_guru = ? AND (P.status = 'Diterima' OR P.status = 'Ditolak')";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_guru);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Guru-Riwayat</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/image cerdas privat/logoCP2.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

<style>
.service-item {
  background-color: #fff;
  border-radius: 15px;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.profile-picture img {
  border: 3px solid #FFFFFF;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.profile-info {
  font-weight: bold;
  color: #333;
}

.profile-description p {
  font-size: 14px;
  color: #555;
}

#scroll-top:hover {
  background-color: #008fd4;
}

#scroll-top i {
  font-size: 24px;
}

section {
  padding-top: 80px; /* Sesuaikan dengan tinggi header */
}

/* Custom grid and margin adjustments */
.container.my-5 {
  margin-top: 50px;
  margin-bottom: 50px;
}

.container.text-center {
  margin-top: 20px;
}

.row.g-3 {
  margin-top: 30px;
}

.bg-custom {
  background-color: #e0e0e0;
  padding: 30px 0;
}

h2 {
  font-weight: bold;
  margin-bottom: 30px;
}

/*Search */
.search-container {
  position: absolute;
  right: 50px;
  top: 20px;
}
.search-input {
  width: 250px;
  padding: 5px 10px;
  border-radius: 20px;
  border: 1px solid #ccc;
}
.search-icon {
  position: relative;
  right: 30px;
  cursor: pointer;
  color: #6c757d;
}

/* siswa */
.class-container {
  width: 1200px;
  padding: 5px;
  margin: auto;
  
  border-radius: 10px;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
  background-color: #d9d9d9;
  font-size: 15px;
  color: #000000;
  margin-bottom: 30px; }
  </style>
</head>

<body class="index-page" style="background-color: #F8F4FC;">
<header id="header" class="header fixed-top">
  <div class="branding d-flex align-items-center">
    <div class="container position-relative d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logoCP2.png" alt="" style="width: 40px; height: auto;">
        <h1 class="sitename">Cerdas Privat</h1>
      </a>
        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="guru-beranda.php" >Beranda<br></a></li>
            <li><a href="guru_siswa.php" >Siswa</a></li>
            <li><a href="guru_pendaftaransiswa.php"class="active">Pendaftaran</a></li>
            <li><a href="guru_pembayaran.php">Pembayaran</a></li>
            <li><a href="guru_profillguru.php">
              <img src="assets/img/rw2.jpg" alt="User Profile" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
            </a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </div>
  </header>

<!-- Content Section -->
<section style="padding-top: 100px;"> <!-- Sesuaikan padding-top dengan tinggi header -->
  <div class="class-container d-flex align-items-center" style="padding-left: 20px;">
    <a href="guru_pendaftaransiswa.php" class="me-3" style="font-weight: bold; text-decoration: none">
        Siswa Mendaftar
    </a>
    <span style="color: #222645; padding-left: 20px;"> |</span>
    <a href="guru_riwayat.php" class="ms-3" style="font-weight: bold; text-decoration: none;">
        Riwayat
    </a>
  </div>
</section>


<main class="container">
    <h2>Riwayat Pendaftaran Siswa</h2>
    <div class="row gy-4">
      <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="col-md-12">
          <div class="card p-3 shadow-sm">
            <div class="d-flex align-items-center">
              <img src="assets/img/services.jpg" class="rounded-circle me-3" alt="Profile Picture" style="width: 60px; height: 60px;">
              <div>
                <p><strong>Nama:</strong> <?php echo htmlspecialchars($row['nama']); ?></p>
                <p>Sekolah: <?php echo htmlspecialchars($row['sekolah']); ?></p>
                <p>Tanggal Pendaftaran: <?php echo htmlspecialchars($row['tanggal_pendaftaran']); ?></p>
                <p><strong>Status:</strong> <?php echo htmlspecialchars($row['status']); ?></p>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </main>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Vendor JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- Initialize AOS (Animate on Scroll) -->
  <script>
    AOS.init();
  </script>

</body>
</html>