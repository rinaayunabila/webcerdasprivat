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
    table {
      width: 1200px;
      border-collapse: collapse;
      padding: 20px;
      margin: 20px auto;
    }

    table, th, td {
      border: 1px solid #000000;
    }

    th, td {
      padding: 5px;
      text-align: center;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
     /* Style untuk kontainer */
     .class-container {
      width: 1200px;
      padding: 5px;
      margin: 100px auto;
      
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
      background-color: #d9d9d9;
      font-size: 18px;
      color: #000000;
      margin-bottom: 10px; 
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
  <main class="main">
     <!-- Services Section -->
     <section id="services" class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Guru</h2>
          <p>Silahkan pilih guru yang sesuai dengan kriteria kamu.</p>
        </div><!-- End Section Title -->
  
        <div class="container">
  <h1 class="mt-5 mb-4">Daftar Guru</h1>
  <div class="row gy-4">
    <?php
    // Memasukkan koneksi ke database
    include 'koneksi.php';

    // Query SQL untuk mengambil data dari tabel Guru
    $sql = "SELECT * FROM Guru";
    $result = $conn->query($sql);

    // Mengecek apakah ada hasil
    if ($result->num_rows > 0) {
      // Menampilkan setiap row data sebagai card
      while ($row = $result->fetch_assoc()) {
    ?>
      <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="service-item position-relative border p-3 mb-4 rounded shadow-sm">
          <div class="d-flex align-items-start">
            <div class="profile-picture mr-3">
              <img src="<?php echo $row['foto_profil']; ?>" alt="Profile Picture" style="width: 80px; height: 80px;">
            </div>
            <div class="profile-info">
              <p class="mb-1"><strong>Nama:</strong> <?php echo $row['nama']; ?></p>
              <p class="mb-1"><strong>Pengalaman Mengajar:</strong> <?php echo $row['pengalaman_mengajar']; ?> tahun</p>
              <p class="mb-1"><strong>Mata Pelajaran:</strong> <?php echo $row['mata_pelajaran']; ?></p>
              <p class="mb-1"><strong>Tingkat:</strong> <?php echo $row['level']; ?></p>
              <p class="mb-1"><strong>Alamat:</strong> <?php echo $row['alamat']; ?></p>
              <p class="mb-1"><strong>Tarif:</strong> Rp<?php echo number_format($row['tarif'], 0, ',', '.'); ?> /jam</p>
            </div>
          </div>
          <div class="profile-description mt-3">
            <p><?php echo $row['deskripsi']; ?></p>
          </div>
          <div class="text-right mt-3">
            <!-- Tombol Daftar dengan atribut data-bs-toggle untuk memicu modal -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal">Daftar</button>
          </div>
        </div>
      </div>
    <?php
      }
    } else {
      echo "<p>Belum ada data guru tersedia.</p>";
    }

    // Menutup koneksi database
    $conn->close();
    ?>
  </div>
</div>
  <main class="main">
    <div class="class-container">
        <div class="class-title">Kelasku</div>
        <div class="active-class"><a href="statuspendafsis.html">Status Pendaftaran</a></div>
      </div>
        <table>
            <thead>
              <tr>
                <th>No.</th>
                <th>Mata Pelajaran</th>
                <th>Senin</th>
                <th>Selasa</th>
                <th>Rabu</th>
                <th>Kamis</th>
                <th>Jumat</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Matematika</td>
                <td>08:00 - 09:00</td>
                <td>09:00 - 10:00</td>
                <td>08:00 - 09:00</td>
                <td>10:00 - 11:00</td>
                <td>08:00 - 09:00</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Bahasa Indonesia</td>
                <td>09:00 - 10:00</td>
                <td>10:00 - 11:00</td>
                <td>09:00 - 10:00</td>
                <td>08:00 - 09:00</td>
                <td>09:00 - 10:00</td>
              </tr>
              <tr>
                <td>3</td>
                <td>IPA</td>
                <td>10:00 - 11:00</td>
                <td>08:00 - 09:00</td>
                <td>10:00 - 11:00</td>
                <td>09:00 - 10:00</td>
                <td>10:00 - 11:00</td>
              </tr>
              <tr>
                <td>4</td>
                <td>Bahasa Inggris</td>
                <td>11:00 - 12:00</td>
                <td>11:00 - 12:00</td>
                <td>11:00 - 12:00</td>
                <td>11:00 - 12:00</td>
                <td>11:00 - 12:00</td>
              </tr>
            </tbody>
          </table>
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