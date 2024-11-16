<?php
include('koneksi.php');
session_start();

if (!isset($_SESSION['id_guru'])) {
    header('Location: login.php'); // Redirect if not logged in
    exit();
}

$id_guru = $_SESSION['id_guru']; // Get the logged-in teacher's ID

// Query to get the payment data for this teacher (filtered by id_guru)
$query = "
    SELECT p.id_pembayaran, p.tanggal_pembayaran, s.nama AS nama_siswa, p.foto_bukti, p.status_pembayaran, p.jumlah
    FROM Pembayaran p
    JOIN Pendaftaran pd ON p.id_pendaftaran = pd.id_pendaftaran
    JOIN Siswa s ON pd.id_siswa = s.id_siswa
    WHERE pd.id_guru = $id_guru
";

$result = mysqli_query($conn, $query); // Use $conn instead of $koneksi

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Guru-Pembayaran</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/logoCP2.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Montserrat:wght@100;200;300;400;500;600;700;900&family=Poppins:wght@100;200;300;400;500;600;700;900&display=swap" rel="stylesheet">

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
            <li><a href="guru-beranda.php" >Beranda<br></a></li>
            <li><a href="guru_siswa.php" >Siswa</a></li>
            <li><a href="guru_pendaftaransiswa.php">Pendaftaran</a></li>
            <li><a href="guru_pembayaran.php" class="active">Pembayaran</a></li>
            <li><a href="guru_profillguru.php">
              <img src="assets/img/rw2.jpg" alt="User Profile" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
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
          </div>
        </div>  

        <div>
          <table class="table table-bordered table-striped">
            <thead class="table-light">
              <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Tanggal</th>
                <th style="text-align: center;">Nama Siswa</th>
                <th style="text-align: center;">Nominal</th>
                <th style="text-align: center;">Bukti Pembayaran</th>
                <!-- <th style="text-align: center;">Status</th> -->
              </tr>
            </thead>
            <tbody>
    <?php
    $no = 1; // Counter for row number
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td style='text-align: center;'>$no</td>";
        echo "<td style='text-align: center;'>{$row['tanggal_pembayaran']}</td>";
        echo "<td style='text-align: center;'>{$row['nama_siswa']}</td>";
        echo "<td style='text-align: center;'>{$row['jumlah']}</td>";
        // Check if the image file exists before displaying it
        $imagePath = 'uploads/' . $row['foto_bukti'];
        if (file_exists($imagePath)) {
            echo "<td style='text-align: center;'>
                    <a href='$imagePath' data-glightbox='payment-proof'>
                        <img src='$imagePath' alt='Bukti Pembayaran' width='100' height='auto'>
                    </a>
                  </td>";
        } else {
            echo "<td style='text-align: center;'>No image found</td>";
        }

        // echo "<td style='text-align: center;'>{$row['status_pembayaran']}</td>";
        echo "</tr>";
        $no++;
    }
    ?>
</tbody>
          </table>
        </div>

    </section>
  </main>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- GLightbox JS -->
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script>
    const lightbox = GLightbox({
        selector: '[data-glightbox="payment-proof"]',
        width: '80%',  // Adjust the width of the lightbox
        height: '80%'  // Adjust the height of the lightbox
    });
  </script>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
