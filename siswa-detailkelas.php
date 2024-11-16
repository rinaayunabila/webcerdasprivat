<?php
include 'koneksi.php';

// Get the teacher ID and registration ID from the URL
if (isset($_GET['id_guru']) && isset($_GET['id_pendaftaran'])) {
    $id_guru = $_GET['id_guru'];
    $id_pendaftaran = $_GET['id_pendaftaran'];
    
    // Retrieve teacher details
    $sql = "SELECT * FROM Guru WHERE id_guru = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_guru);
    $stmt->execute();
    $result = $stmt->get_result();
    $guru = $result->fetch_assoc();
    
    // Retrieve registration details based on id_pendaftaran
    $sql_pendaftaran = "SELECT * FROM Pendaftaran WHERE id_pendaftaran = ? AND id_siswa = ?";
    $stmt_pendaftaran = $conn->prepare($sql_pendaftaran);
    $stmt_pendaftaran->bind_param("ii", $id_pendaftaran, $_SESSION['id_siswa']);
    $stmt_pendaftaran->execute();
    $result_pendaftaran = $stmt_pendaftaran->get_result();
    $pendaftaran = $result_pendaftaran->fetch_assoc();
    
    $stmt->close();
    $stmt_pendaftaran->close();
} else {
    echo "Data tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Detail Guru</title>
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
  .mt-3 li a {
    display: flex;
    justify-content: space-between;
    text-decoration: none;
  }

.mt-3 .left {
  text-align: left;
  
}

.mt-3 .right {
  text-align: right;
  font-weight: bold;
  color: black;
}

.btn-bayar {
  background-color: #007bff; /* Ganti dengan warna yang diinginkan */
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s;
}

.btn-bayar:hover {
  background-color: #0056b3; /* Warna ketika tombol di-hover */
}

    /* Modal styling */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background-color: white;
      padding: 20px;
      border-radius: 5px;
      text-align: center;
      width: 300px;
    }

    .modal-footer button {
      margin: 5px;
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
    <div class="container" style="margin-top: 50px;">
      <div class="row">
        <div class="col-lg-8">

          <!-- Blog Details Section -->
          <section id="blog-details" class="blog-details section">
            <div class="container">
              <article class="article">
              <h2 class="title"><?php echo $guru['nama']; ?></h2>
                <div class="content">
                <blockquote>
                    <p style="font-size: medium;"><?php echo $guru['deskripsi']; ?></p>
                </blockquote>
            </div>
            <div class="tags-widget widget-item">

                <h3 class="widget-title">Tentang</h3>
                <ul>
                <li><a href="#">Pendidikan : <?php echo $guru['pendidikan']; ?></a></li>
                <li><a href="#">pengalaman Mengajar : <?php echo $guru['pengalaman_mengajar']; ?> Tahun</a></li>
                <li><a href="#">Alamat : <?php echo $guru['alamat']; ?></a></li>
                </ul>
                </div> </br><!--/Tags Widget -->
               <!-- End post content -->
              </article>
            </div>
          </section><!-- /Blog Details Section -->
        </div>

        <div class="col-lg-4 sidebar">
            <div class="widgets-container">
                <!-- Search Widget -->
                <img src="assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
                <div><br>
                    <h3 class="widget-title" style="text-align: center;"><?php echo $guru['nama']; ?> </h3>
                </div><!--/Search Widget -->

                <!-- Categories Widget -->
                <div class="categories-widget widget-item">
                <ul class="mt-3">
                    <li><a href="#"><span class="left">Mata Pelajaran</span><span class="right"><?php echo $guru['mata_pelajaran']; ?></span></a></li>
                    <li><a href="#"><span class="left">Tingkat</span><span class="right"><?php echo $guru['level']; ?></span></a></li>
                    <li><a href="#"><span class="left">Tarif :</span><span class="right">Rp. <?php echo $guru['tarif']; ?></span></a></li>
                </ul>
                </div>
                <!-- Daftar Button -->
                <div style="text-align: center; margin-top: 15px;">
      <button class="btn-bayar" onclick="openModal()">Bayar</button>
    </div>
            </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Modal -->
<div class="modal" id="bayarModal">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Pembayaran</h5>
      <button type="button" onclick="closeModal()">X</button>
    </div>
    <form action="proses_bayar.php" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <!-- Hidden input untuk id_pendaftaran -->
        <input type="hidden" name="id_pendaftaran" value="<?php echo $id_pendaftaran; ?>"> 

        <div class="mb-3">
          <label for="nominal" class="form-label">Nominal : </label>
          <input type="number" class="form-control" id="nominal" name="nominal" required>
        </div>
        
        <div class="mb-3">
          <label for="bukti_transfer" class="form-label">Upload Bukti Transfer : </label>
          <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" accept="image/*" required>
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
        <button type="submit" class="btn btn-primary">Bayar</button>
      </div>
    </form>
  </div>
</div>


<!-- JavaScript untuk membuka dan menutup modal -->
<script>
  function openModal() {
    document.getElementById('bayarModal').style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('bayarModal').style.display = 'none';
  }
</script>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>