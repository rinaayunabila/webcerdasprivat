<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Profil Siswa</title>
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

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <!-- Logo cerdas privat -->
        <img src="assets/img/logoCP2.png" alt="" style="width: 40px; height: auto;">

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="berandasis.html" class="active">Beranda<br></a></li>
            <li><a href="gurusis.html">Guru</a></li>
            <li class="dropdown"><a href="#"><span>Kelas</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="jadwalsis.html">Kelas Aktif</a></li>
                <li><a href="statuspendafsis.html">Status Pendaftaran</a></li>
              </ul>
            </li>
            <li><a href="profilsis.html">
                <img src="assets/img/services.jpg" alt="User Profile" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
              </a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

      </div>

    </div>

  </header>
  <main class="profil-siswa">
    <div class="form-container">

        <!-- Foto Profil -->
        <div class="text-center">
          <img src="assets/img/services.jpg" alt="Foto Profil" class="profile-pic" id="profile-pic-preview">
          <div class="mb-3">
            <label for="profile-pic" class="form-label">Unggah Foto Profil</label>
            <input class="form-control" type="file" id="profile-pic" name="profile-pic" accept="image/*" onchange="previewImage(event)">
          </div>
        </div>
      
        <!-- Form Profil -->
        <form action="update_profile.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" name="name" value="Septania Daniati" required>
          </div>
      
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="septa890@gmail.com" required>
          </div>
      
          <div class="mb-3">
            <label for="school" class="form-label">Sekolah</label>
            <input type="text" class="form-control" id="school" name="school" value="SD Negeri 2 Pekanbaru" required>
          </div>
      
          <div class="mb-3">
            <label for="grade" class="form-label">Kelas</label>
            <input type="text" class="form-control" id="grade" name="grade" value="5" required>
          </div>
      
          <div class="mb-3">
            <label for="parent_name" class="form-label">Nama Orang Tua</label>
            <input type="text" class="form-control" id="parent_name" name="parent_name" value="Rina Ayu" required>
          </div>
      
          <div class="mb-3">
            <label for="phone" class="form-label">No. Telepon</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="081234567890" required>
          </div>
      
          <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea class="form-control" id="address" name="address" rows="3" required>Jl. Bangau Sakti</textarea>
          </div>
      
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Ubah password jika diperlukan">
          </div>
      
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Update Profil</button>
          </div>
        </form>
      </div>
      
  </main>
  <script>
    // Fungsi untuk menampilkan preview foto profil yang diupload
    function previewImage(event) {
      var reader = new FileReader();
      reader.onload = function(){
        var output = document.getElementById('profile-pic-preview');
        output.src = reader.result;
      };
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>
  
 


  <footer id="footer" class="footer accent-background">

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span></p>
    </div>

  </footer>

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