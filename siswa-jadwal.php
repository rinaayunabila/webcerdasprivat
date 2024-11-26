<?php
session_start();
include 'koneksi.php';

// Mengambil data siswa berdasarkan id user yang login
$user_id = $_SESSION['user_id'];
$query = "SELECT s.nama, s.sekolah, s.email, s.nama_orang_tua, s.alamat, s.no_hp, s.foto_profil
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

// Get id_siswa from session
$id_siswa = $_SESSION['id_siswa'];

$sql = "SELECT Guru.id_guru, Guru.nama, Guru.mata_pelajaran, Guru.level, Guru.tarif, Guru.foto_profil, Pendaftaran.status, Pendaftaran.id_pendaftaran 
        FROM Pendaftaran 
        JOIN Guru ON Pendaftaran.id_guru = Guru.id_guru 
        WHERE Pendaftaran.id_siswa = ? AND Pendaftaran.status = 'Diterima'";
$query = "SELECT s.nama, s.sekolah, s.email, s.nama_orang_tua, s.alamat, s.no_hp, s.foto_profil
FROM Siswa s
JOIN Users u ON s.email = u.email
WHERE u.id = ?";
        
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
  <title>Jadwal Siswa</title>
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
            <li><a href="siswa-beranda.php">Beranda<br></a></li>
            <li><a href="siswa-guru.php">Guru</a></li>
            <li class="dropdown"><a href="#"><span>Kelas</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="siswa-jadwal.php">Kelas Aktif</a></li>
                <li><a href="siswa-statuspendaftaran.php">Status Pendaftaran</a></li>
              </ul>
            </li>
            <li><a href="siswa-profil.php">
                <img src="<?= htmlspecialchars(string: $siswa['foto_profil']); ?>" alt="User Profile" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
              </a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </div>
  </header>


<main class="container mt-5" style="padding-top: 100px;">
  <h2>Kelas</h2>
    <div class="row gy-4">

      <?php
      // Loop melalui setiap pendaftaran yang diterima untuk menampilkan detail siswa
      while ($row = $result->fetch_assoc()) {
      ?>
        <div class="col-md-12">
  <div class="card p-3 shadow-sm d-flex align-items-center justify-content-between flex-md-row">
    <div class="d-flex align-items-center">
      <img src="assets/img/services.jpg" class="rounded-circle me-3" alt="Profile Picture" style="width: 60px; height: 60px; object-fit: cover;">
      <div>
        <p class="m-0"><strong><?php echo htmlspecialchars($row['nama']); ?></strong></p>
        <p class="m-0">Mata Pelajaran: <?php echo htmlspecialchars($row['mata_pelajaran']); ?></p>
        <p class="m-0">Tarif: <?php echo htmlspecialchars($row['tarif']); ?></p>
      </div>
    </div>
    <div class="d-flex">
            <a class="btn btn-success me-2" href="siswa-detailkelas.php?id_guru=<?php echo $row['id_guru']; ?>&id_pendaftaran=<?php echo $row['id_pendaftaran']; ?>">Selengkapnya</a>
      </div>
  </div>
</div>
      <?php
      }
      ?>
    </div>
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