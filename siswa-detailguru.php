<?php
include 'koneksi.php';
session_start();

// Periksa apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    echo "Anda harus login terlebih dahulu.";
    exit;
}

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
$siswa = $result->fetch_assoc(); // Ambil data siswa
$stmt->close();

// Berikan nilai default jika data siswa tidak ditemukan
if (!$siswa) {
    $siswa = [
        'nama' => 'Tidak Diketahui',
        'sekolah' => 'Tidak Diketahui',
        'email' => 'Tidak Diketahui',
        'nama_orang_tua' => 'Tidak Diketahui',
        'alamat' => 'Tidak Diketahui',
        'no_hp' => 'Tidak Diketahui',
        'foto_profil' => 'default-profile.png' // Gambar default jika tidak ditemukan
    ];
}

// Ambil data guru berdasarkan id_guru dari URL
if (isset($_GET['id_guru'])) {
    $id_guru = $_GET['id_guru'];
    $sql = "SELECT * FROM Guru WHERE id_guru = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_guru);
    $stmt->execute();
    $result = $stmt->get_result();
    $guru = $result->fetch_assoc();
    $stmt->close();

    if (!$guru) {
        echo "Data guru tidak ditemukan.";
        exit;
    }
} else {
    echo "ID guru tidak ditemukan.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Detail Guru</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
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

.btn-daftar {
  background-color: #007bff; /* Ganti dengan warna yang diinginkan */
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s;
}

.btn-daftar:hover {
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
            <li><a href="siswa-beranda.php" >Beranda<br></a></li>
            <li><a href="siswa-guru.php"class="active">Guru</a></li>
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
                <li><a href="#">Pengalaman Mengajar : <?php echo $guru['pengalaman_mengajar']; ?> Tahun</a></li>
                <li><a href="#">Alamat : <?php echo $guru['alamat']; ?></a></li>
                <li><a href="#">No HP : <?php echo $guru['no_hp']; ?></a></li>
                <li><a href="#">Email : <?php echo $guru['email']; ?></a></li>
                </ul>
                </div> </br><!--/Tags Widget -->
               <!-- End post content -->
              </article>
            </div>
          </section><!-- /Blog Details Section -->
        </div>

        <div class="col-lg-4 sidebar">
            <div class="widgets-container">
                <!-- <img src="<?php echo $fotoProfil; ?>" alt="Profile Picture" class="img-fluid">                 -->
                <img src="uploads/guru1.jpg" alt="Profile Picture" class="img-fluid"><div><br>
                    <h3 class="widget-title" style="text-align: center;"><?php echo $guru['nama']; ?> </h3>
                </div><!--/Search Widget -->

                <!-- Categories Widget -->
                <div class="categories-widget widget-item">
                <ul class="mt-3">
                    <li><a href="#"><span class="left">Mata Pelajaran</span><span class="right"><?php echo $guru['mata_pelajaran']; ?></span></a></li>
                    <li><a href="#"><span class="left">Tingkat</span><span class="right"><?php echo $guru['level']; ?></span></a></li>
                    <li><a href="#"><span class="left">Tarif :</span><span class="right">Rp. <?php echo $guru['tarif']; ?></span></a></li>
                </ul>

                </div><!--/Categories Widget -->

                <!-- Daftar Button -->
                <div style="text-align: center; margin-top: 15px;">
    <button class="btn-daftar" onclick="openModal()">Daftar</button>
</div>
            </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Modal Konfirmasi -->
<div class="modal" id="confirmationModal">
    <div class="modal-content">
        <p>Apakah anda yakin ingin mendaftar?</p>
        <div class="modal-footer">
            <button onclick="confirmDaftar(<?php echo $guru['id_guru']; ?>)">Iya</button>
            <button onclick="closeModal()">Tidak</button>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    function openModal() {
        document.getElementById('confirmationModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('confirmationModal').style.display = 'none';
    }

    function confirmDaftar(id_guru) {
        // Mengirim data ke server untuk menyimpan pendaftaran
        fetch('db-prosespendaftaran.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id_guru: id_guru })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Pendaftaran berhasil!');
                // Arahkan ke halaman status pendaftaran atau lainnya
                window.location.href = 'siswa-statuspendaftaran.php';
            } else {
                alert('Gagal mendaftar: ' + data.message);
            }
            closeModal();
        })
        .catch(error => {
            alert('Terjadi kesalahan: ' + error);
            closeModal();
        });
    }
    </script>
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