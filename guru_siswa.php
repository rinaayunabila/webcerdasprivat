<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Guru-Siswa</title>
  <link href="assets/img/image cerdas privat/logoCP2.png" rel="icon">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
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

<body class="index-page" style="background-color: #F8F4FC;">

  <!-- Header -->
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
            <li><a href="berandaguru.html">Beranda</a></li>
            <li><a href="guru_siswa.html" class="active">Siswa</a></li>
            <li><a href="guru_pendaftaransiswa.html">Pendaftaran</a></li>
            <li><a href="guru_pembayaran.html">Pembayaran</a></li>
            <li><a href="guru_profillguru.html">
              <img src="assets/img/image cerdas privat/rw2.jpg" alt="User Profile" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
            </a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </div>
  </header>

  <!-- Content Section -->
  <section style="padding-top: 100px;">
    <div class="class-container d-flex align-items-center" style="padding-left: 20px;">
      <a href="Guru-Siswa.html" class="me-3" style="font-weight: bold; text-decoration: none">Kelasku</a>
      <span style="color: #222645;">|</span>
      <a href="guru_jadwalkelas.html" class="ms-3" style="font-weight: bold; text-decoration: none;">Jadwal Kelas</a>
    </div>
  </section>

  <!-- Main Content -->
  <main id="main" class="container my-5">
    <div class="container">
      <div class="d-flex justify-content-between mb-3 align-items-center">
        <h2>Daftar Siswa</h2>
        <div class="d-flex">
          <input type="text" class="form-control me-2" placeholder="Search..." style="width: 200px; height: 40px;">
        </div>
      </div>
    </div>

    <div class="row g-3">
      <?php
      // Memasukkan koneksi ke database
      include 'koneksi.php';

      // Query SQL untuk mengambil data dari tabel Siswa
      $sql = "SELECT * FROM Siswa";
      $result = $conn->query($sql);

      // Mengecek apakah ada hasil
      if ($result->num_rows > 0) {
          // Menampilkan setiap row data sebagai card
          while ($row = $result->fetch_assoc()) {
      ?>
      <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="service-item position-relative">
          <div class="d-flex align-items-start">
            <div class="profile-picture" style="margin-right: 20px;">
              <img src="assets/img/image cerdas privat/Student.png" class="rounded-circle" alt="Profile Picture" style="width: 80px;">
            </div>
            <div class="profile-info">
              <p class="card-title font-weight-bold">Nama: <?php echo $row['nama']; ?></p>
              <p class="card-text">Sekolah: <?php echo $row['sekolah']; ?></p>
              <p class="card-text">Email: <?php echo $row['email']; ?></p>
              <p class="card-text">Nama Orang Tua: <?php echo $row['nama_orang_tua']; ?></p>
              <p class="card-text">Alamat: <?php echo $row['alamat']; ?></p>
              <p class="card-text">No Hp: <?php echo $row['no_hp']; ?></p>
            </div>
          </div>
          <div class="mt-3 text-end">
            <a href="guru_profilsiswa.html" class="btn btn-primary">Profil</a>
          </div>
        </div>
      </div>
      <?php
          }
      } else {
          echo "<p>Belum ada data siswa tersedia.</p>";
      }

      // Menutup koneksi database
      $conn->close();
      ?>
    </div>
  </main>

  <!-- Footer -->
  <footer id="footer" class="footer default-background py-3">
    <div class="container text-center">
      <p>© <strong>Cerdas Privat 2024</strong></p>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Vendor JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
  <script>AOS.init();</script>
</body>
</html>
