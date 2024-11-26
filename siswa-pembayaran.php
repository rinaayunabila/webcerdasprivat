<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Siswa-Pembayaran</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

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
    <div class="branding d-flex align-items-cente">
      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
          <img src="assets/img/logoCP2.png" alt="" style="width: 40px; height: auto;">
          <h3 class="sitename" style="font-weight: bold;">Cerdas Privat</h3> 
        </a>
        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="guru-beranda.php" class="active">Beranda<br></a></li>
            <li><a href="guru_siswa.php">Siswa</a></li>
            <li><a href="guru_pendaftaransiswa.php">Pendaftaran</a></li>
            <li><a href="guru_pembayaran.php">Pembayaran</a></li>
            <li><a href="guru_profillguru.php">
              <img src="<?= htmlspecialchars(string: $siswa['foto_profil']); ?>" alt="User Profile" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
            </a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </div>
  </header>

  <main id="main" class="main">
    <section class="container my-5">
      <div class="container">  
        <div class="d-flex justify-content-between mb-3 align-items-center">
          <h2>Informasi Pembayaran</h2>
          <div class="d-flex">
            <input type="text" class="form-control me-2" placeholder="Search..." style="width: 200px; height: 40px;">
            <!-- Button to trigger modal -->
            <button class="btn btn-success" style="background-color: #28a745; color: #ffffff; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; margin-left: 5px;" data-bs-toggle="modal" data-bs-target="#addPaymentModal">
                <i class="bi bi-plus"></i>
            </button>
          </div>
        </div>  

        <table class="table table-bordered table-striped">
          <thead class="table-light">
            <tr>
              <th style="text-align: center;">No</th>
              <th style="text-align: center;">Tanggal</th>
              <th style="text-align: center;">Nama Guru</th>
              <th style="text-align: center;">Mata Pelajaran</th>
              <th style="text-align: center;">Nominal</th>
              <th style="text-align: center;">Bukti Pembayaran</th>
              <th style="text-align: center;">Status</th>
            </tr>
          </thead>
          <tbody>
            <!-- Isi tabel -->
            <tr>
              <td style="text-align: center;">1</td>
              <td>12-11-2024</td>
              <td>Nabila</td>
              <td>Bahasa Inggris</td>
              <td>100.000</td>
              <td><a href="#">Lihat</a></td>
              <td>Diterima</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <!-- Modal for adding payment -->
  <div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPaymentModalLabel">Tambah Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="tanggal" class="form-label">Tanggal</label>
              <input type="date" class="form-control" id="tanggal" required>
            </div>
            <div class="mb-3">
              <label for="namaGuru" class="form-label">Nama Guru</label>
              <input type="text" class="form-control" id="namaGuru" required>
            </div>
            <div class="mb-3">
              <label for="mataPelajaran" class="form-label">Mata Pelajaran</label>
              <input type="text" class="form-control" id="mataPelajaran" required>
            </div>
            <div class="mb-3">
              <label for="nominal" class="form-label">Nominal</label>
              <input type="number" class="form-control" id="nominal" required>
            </div>
            <div class="mb-3">
              <label for="buktiPembayaran" class="form-label">Bukti Pembayaran</label>
              <input type="file" class="form-control" id="buktiPembayaran" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
