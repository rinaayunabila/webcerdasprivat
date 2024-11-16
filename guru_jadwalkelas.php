<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Guru-Jadwal Kelas</title>
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

/*Search */
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
            <li><a href="guru-beranda.php" >Beranda<br></a></li>
            <li><a href="guru_siswa.php" class="active">Siswa</a></li>
            <li><a href="guru_pendaftaransiswa.php">Pendaftaran</a></li>
            <li><a href="guru_pembayaran.php">Pembayaran</a></li>
            <li><a href="guru_profillguru.php">
              <img src="assets/img/rw2.jpg" alt="User Profile" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
            </a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </div>
  </header>

  <!-- Content Section -->
  <section style="padding-top: 100px;"> <!-- Sesuaikan padding-top dengan tinggi header -->
  <div class="class-container d-flex align-items-center" style="padding-left: 20px;">
    <a href="guru_siswa.php" class="me-3" style="font-weight: bold; text-decoration: none">
        Siswa
    </a>
    <span style="color: #222645;" >|</span>
    <a href="guru_jadwalkelas.php" class="ms-3" style="font-weight: bold; text-decoration: none;">
        Jadwal Kelas
    </a>
    <span style="color: #222645; padding-left: 20px;"> |</span>
  </div>
</section>

  <!-- Search bar -->
  <main id="main" class="main">
    <section class="container my-5" style="padding-top: 1px">  
        <div class="d-flex justify-content-between mb-3 align-items-center">
          <h2>Jadwal Kelas</h2>
          <div class="d-flex">
              <input type="text" class="form-control me-2" placeholder="Search..." style="width: 200px; height: 40px;">
              <button class="btn btn-success" style="background-color: #28a745; color: #ffffff; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; margin-left: 5px;">
                  <i class="bi bi-plus"></i>
              </button>
          </div>
      </div>

<!-- Modal -->
<div class="modal fade" id="tambahJadwal" tabindex="-1" aria-labelledby="addGuruModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addGuruModalLabel">Tambah Jadwal Kelas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" required>
          </div>
          <div class="mb-3">
            <label for="mataPelajaran" class="form-label">Mata Pelajaran</label>
            <textarea class="form-control" id="deskripsi" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="hari" class="form-label">Hari</label>
            <select class="form-select" id="level" required>
              <option value="" disabled selected>Pilih Hari</option>
              <option value="Senin">Senin</option>
              <option value="Selasa">Selasa</option>
              <option value="Rabu">Rabu</option>
              <option value="Kamis">Kamis</option>
              <option value="Jum'at">Jum'at</option>
              <option value="Sabtu">Sabtu</option>
              <option value="Minggu">Minggu</option>
            </select>
          <div class="mb-3">
            <label for="jam" class="form-label">Jam</label>
            <input type="text" class="form-control" id="mataPelajaran" required>
          </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
  // Event listener for the button to show the modal
  document.querySelector('.btn-success').addEventListener('click', function () {
    var myModal = new bootstrap.Modal(document.getElementById('tambahJadwal'));
    myModal.show();
  });
</script>

  </div>
      <div><table class="table table-bordered table-striped">
        <thead class="table-light">
          <tr>
            <th style="text-align: center;">No</th>
            <th style="text-align: center;">Nama</th>
            <th style="text-align: center;">Mata Pelajaran</th>
            <th style="text-align: center;">Senin</th>
            <th style="text-align: center;">Selasa</th>
            <th style="text-align: center;">Rabu</th>
            <th style="text-align: center;">Kamis</th>
            <th style="text-align: center;">Jum'at</th>
            <th style="text-align: center;">Sabtu</th>
            <th style="text-align: center;">Minggu</th>
          </tr>
        </thead>
        <tbody>
          <!-- Isi tabel -->
          <tr>
            <td style="text-align: center;">1</td>
            <td>Nabila</td>
            <td>Bahasa Inggris</td>
            <td>16.00-17.00</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
          </tr>
          <tr>
            <td style="text-align: center;">2</td>
            <td>Nabila</td>
            <td>Bahasa Inggris</td>
            <td>-</td>
            <td>16.00-17.00</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
          </tr>
          <tr>
            <td style="text-align: center;">3</td>
            <td>Nabila</td>
            <td>Bahasa Inggris</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>16.00-17.00</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
          </tr>
          <tr>
            <td style="text-align: center;">4</td>
            <td>Nabila</td>
            <td>Bahasa Inggris</td>
            <td></td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>16.00-17.00</td>
            <td>-</td>
            <td>-</td>
          </tr>
          <tr>
            <td style="text-align: center;">5</td>
            <td>Nabila</td>
            <td>Bahasa Inggris</td>
            <td></td>
            <td>-</td>
            <td>16.00-17.00</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
          </tr>
          <tr>
            <td style="text-align: center;">5</td>
            <td>Nabila</td>
            <td>Bahasa Inggris</td>
            <td></td>
            <td>-</td>
            <td>16.00-17.00</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>10.00-11.30</td>
          </tr>
          <tr>
            <td style="text-align: center;">5</td>
            <td>Nabila</td>
            <td>Bahasa Inggris</td>
            <td></td>
            <td>-</td>
            <td>16.00-17.00</td>
            <td>-</td>
            <td>-</td>
            <td>08.00-09.00</td>
            <td>-</td>
          </tr>
          <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
        </tbody>
      </table>
    </div>
  </main>
  </section>
</div>

  <!-- Scroll Top -->
  <a id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Footer -->
  <footer id="footer" class="footer default-background py-3">
    <div class="container text-center">
      <p>© <strong>Cerdas Privat 2024</strong></p>
    </div>
  </footer>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Scroll Top Functionality -->
  <script>
    const scrollTop = document.getElementById('scroll-top');
    window.onscroll = function() {
      if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        scrollTop.style.display = 'block';
      } else {
        scrollTop.style.display = 'none';
      }
    };

    scrollTop.onclick = function() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    };
  </script>

</body>

</html>