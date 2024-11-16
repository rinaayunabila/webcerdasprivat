<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Siswa-Guru</title>

  <!-- Favicons -->
  <link href="assets/img/logoCP2.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <style>
    .profile-picture img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
    }
    .profile-info {
        font-weight: bold;
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
            <li><a href="siswa-beranda.html" >Beranda<br></a></li>
            <li><a href="siswa-guru.php"class="active">Guru</a></li>
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
  <section id="services" class="services section">
    <div class="container section-title" data-aos="fade-up">
      <h2>Guru</h2>
      <p>Silahkan pilih guru yang sesuai dengan kriteria kamu.</p>
    </div>
    <section id="blog-author" class="blog-author section">
  <div class="container">
    <div class="row gy-4">
      <?php
      include 'koneksi.php';
      $sql = "SELECT * FROM Guru";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $fotoProfil = !empty($row['foto_profil']) ? $row['foto_profil'] : 'assets/img/blog/default-author.jpg';
              ?>
              <!-- Mulai elemen card guru -->
              <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="author-container d-flex align-items-start border p-3 mb-4 rounded shadow-sm">
                  <img src="<?php echo $fotoProfil; ?>" class="rounded-circle flex-shrink-0 mr-3" alt="Profile Picture" style="width: 100px; height: 100px; object-fit: cover;">
                  <div>
                    <h4 style="color:#222645;"><?php echo htmlspecialchars($row['nama']); ?></h4>
                    <p><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                    <p style="color: #222645;"><strong>Mata Pelajaran:</strong> <?php echo htmlspecialchars($row['mata_pelajaran']); ?></p>
                    <p><strong>Tarif:</strong> Rp<?php echo number_format($row['tarif'], 0, ',', '.'); ?> /jam</p>
                    <div class="mt-3">
                      <a href="siswa-detailguru.php?id_guru=<?php echo $row['id_guru']; ?>" class="btn btn-primary">Selengkapnya</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Akhir elemen card guru -->
              <?php
          }
      } else {
          echo "<p>Belum ada data guru tersedia.</p>";
      }
      $conn->close();
      ?>
    </div>
  </div>
</section>
</main>

<footer id="footer" class="footer accent-background">
  <div class="container copyright mt-4">
    <p>© <span>Copyright</span></p>
  </div>
</footer>

<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Custom JavaScript Code for Registration -->
<script>
document.querySelectorAll('.btn-primary').forEach(button => {
  button.addEventListener('click', function() {
    const guruId = this.getAttribute('data-guru-id');
    document.getElementById('confirm-register').onclick = function() {
      registerGuru(guruId);
    };
  });
});

function registerGuru(guruId) {
  fetch('daftar_guru.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ id_guru: guruId }),
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('Pendaftaran berhasil!');
      location.reload();
    } else {
      alert('Gagal mendaftar: ' + data.message);
    }
  })
  .catch(error => console.error('Error:', error));
}
</script>
</body>
</html>