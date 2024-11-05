<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Admin Pembayaran</title>
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
    /* CSS untuk mengecilkan ukuran tombol */
    .btn-custom {
      padding: 0.25rem 0.5rem; /* Atur padding untuk memperkecil ukuran tombol */
      font-size: 0.75rem; /* Ukuran font lebih kecil */
    }
  </style>
</head>

<body class="blog-details-page">
  <header id="header" class="header fixed-top">
    <div class="branding d-flex align-items-center">
      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="assets/img/logoCP2.png" alt="" style="width: 40px; height: auto;">
            <h1 class="sitename">Cerdas Privat</h1>
          </a>

          <nav id="navmenu" class="navmenu">
            <ul>
              <li><a href="admin-beranda.html">Beranda<br></a></li>
              <li><a href="admin_guru.php" >Guru</a></li>
              <li><a href="admin_siswa.php">Siswa</a></li>
              <li><a href="admin_pendaftaran.php">Pendaftaran</a></li>
              <li><a href="admin_pembayaran.php" class="active">Pembayaran</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
          </nav>
      </div>
    </div>
  </header>

  <main class="main">
    <div class="container">
      <div class="row">
        <div>
          <!-- Blog Details Section -->
          <section id="guru-details" class="guru-details section">
            <div class="container">  
              <br><br><br>
              <div class="d-flex justify-content-between mb-3 align-items-center">
                <h2 style="margin-left: 10px;"> Pembayaran</h2>
                <div class="d-flex">
                    <input type="text" class="form-control me-2" placeholder="Search..." style="width: 200px; height: 40px;">
                    <button class="btn btn-success" style="background-color: #28a745; color: #ffffff; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; margin-left: 5px;">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div><br>
              <div class="container">
                <table id="table" class="table table-striped table-bordered" style="width:100%">
                  <thead> 
                    <tr>
                      <th>No</th>
                      <th>Tanggal Pembayaran</th>
                      <th>Nama Siswa</th>
                      <th>Nama Guru</th>
                      <th>Mata Pelajaran</th>
                      <th>Bukti Bayar</th>
                      <th>Aksi</th> <!-- Kolom Aksi -->
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>12-10-2024</td>
                      <td>Ayuna</td>
                      <td>Miss Fitri</td>
                      <td>Bahasa Inggris</td>
                      <td></td>
                      <td>
                        <div class="d-flex">
                            <button class="btn btn-warning btn-custom me-2" style="background-color: #ffcc00; color: #ffffff; padding: 5px 10px; font-size: 14px;">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-custom" style="background-color: #dc3545; color: #ffffff; padding: 5px 10px; font-size: 14px;">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                    </tr>   
                    <tr>
                        <td>2</td>
                        <td>24-9-2024</td>
                        <td>Nabila</td>
                        <td>Septania S.T</td>
                        <td>Informatika</td>
                        <td></td>
                        <td>
                          <div class="d-flex">
                              <button class="btn btn-warning btn-custom me-2" style="background-color: #ffcc00; color: #ffffff; padding: 5px 10px; font-size: 14px;">
                                  <i class="bi bi-pencil"></i>
                              </button>
                              <button class="btn btn-danger btn-custom" style="background-color: #dc3545; color: #ffffff; padding: 5px 10px; font-size: 14px;">
                                  <i class="bi bi-trash"></i>
                              </button>
                          </div>
                      </td>
                      </tr>   
                    <!-- Tambahkan baris lain sesuai kebutuhan -->
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>
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