<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Siswa-Guru</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

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
  <section id="services" class="services section">
    <div class="container section-title" data-aos="fade-up">
      <h2>Guru</h2>
      <p>Silahkan pilih guru yang sesuai dengan kriteria kamu.</p>
    </div><!-- End Section Title -->
  
    <div class="container">
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
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal" data-guru-id="<?php echo $row['id_guru']; ?>">Daftar</button>
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

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Pendaftaran</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Apakah Anda yakin ingin mendaftar?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
            <button type="button" class="btn btn-primary" id="confirm-register">Iya</button>
          </div>
        </div>
      </div>
    </div>
    
  </section><!-- /Services Section -->
</main>

<footer id="footer" class="footer accent-background">
  <div class="container copyright mt-4">
    <p>© <span>Copyright</span></p>
  </div>
</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Custom JavaScript Code for Registration -->
<script>
  document.querySelectorAll('.btn-primary').forEach(button => {
  button.addEventListener('click', function() {
    const guruId = this.getAttribute('data-guru-id');
    // Attach guruId directly to the function call in the next listener
    document.getElementById('confirm-register').onclick = () => registerGuru(guruId);
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