<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Guru-Daftar Akun</title>
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
    profil-siswa {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin-top: 50px auto;
    }

    .form-container {
      margin: 100px auto;
      padding: 20px;
      background-color: white;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.9);
      border-radius: 8px;
      max-width: 600px;
    }

    .profile-pic {
      display: block;
      margin: 0 auto 20px;
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }
  </style>
</head>

<body class="index-page">

  <header id="header" class="header fixed-top">
    <div class="branding d-flex align-items-cente">
      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
          <img src="assets/img/logoCP2.png" alt="" style="width: 40px; height: auto;">
          <h1 class="sitename">Cerdas Privat</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="index.html">Beranda<br></a></li>
            <li><a href="#about">Tentang</a></li>
            <li><a href="#guru">Guru</a></li>
            <li><a href="#testimoni">Testimoni</a></li>
            <li><a href="#footer">Kontak</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <div class="d-flex">
          <a href="daftarakun.html" class="btn btn-primary btn-custom me-2" style="background-color: #f7f7f7; font-size: 18px; color: #222645; border: 1px solid #222645; border-radius: 30px; padding: 5px 10px; height: 40px; width: 100px;">Daftar</a>
          <a href="login siswa.html" class="btn btn-secondary btn-custom" style="background-color: #f7f7f7; font-size: 18px; color: #222645; border: 1px solid #222645; border-radius: 30px; padding: 5px 10px; height: 40px; width: 100px;">Masuk</a>
        </div>
      </div>
    </div>
  </header>

  <main class="profil-siswa">
    <div class="form-container">
        <h2 class="text-center mb-4">Ingin Belajar?</h2>
        <p style="text-align: center">Ayo Daftar</p>
        <form action="dbsiswa-daftarakun.php" method="post" enctype="multipart/form-data">
            <div class="text-center">
                <div class="mb-3">
                    <label for="profile-pic" class="form-label" style="text-align: left">Unggah Foto Profil</label>
                    <input class="form-control" type="file" id="profile-pic" name="profile-pic" accept="image/*" onchange="previewImage(event)" required>
                    <img id="imagePreview" class="profile-pic" src="#" alt="Preview Gambar" style="display:none;">
                </div>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" required>
            </div>
            <div class="mb-3">
                <label for="sekolah" class="form-label">Sekolah</label>
                <input type="text" class="form-control" id="sekolah" name="sekolah" placeholder="Masukkan nama sekolah" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
            </div>
            <div class="mb-3">
                <label for="parent-name" class="form-label">Nama Orang Tua</label>
                <input type="text" class="form-control" id="parent-name" name="parent-name" placeholder="Masukkan nama orang tua" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan alamat" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">No.Telepon</label>
                <input type="number" class="form-control" id="phone" name="phone" placeholder="Masukkan nomor telepon" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Buat Kata Sandi</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Buat kata sandi" required minlength="8">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="registerAsSiswa" name="registerAsSiswa" checked>
                <label class="form-check-label" for="registerAsSiswa">Daftar sebagai Siswa</label>
            </div>
            <button type="submit" class="btn btn-primary w-100" style="background-color: #222645;">Daftar</button>
        </form>
    </div>
</main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
