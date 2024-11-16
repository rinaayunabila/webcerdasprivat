<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Guru') {
    header("Location: login.php");
    exit();
}

// Mengambil data guru berdasarkan id user yang login
$user_id = $_SESSION['user_id'];
$query = "SELECT g.nama, g.pendidikan, g.mata_pelajaran, g.pengalaman_mengajar, g.level, g.tarif, g.deskripsi, g.alamat, g.email, g.no_hp, g.foto_profil
          FROM Guru g
          JOIN Users u ON g.email = u.email
          WHERE u.id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $guru = $result->fetch_assoc();
} else {
    echo "Data Guru tidak ditemukan.";
    exit();
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Beranda Guru</title>
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
    main {
      margin-top: -50px;
    }
    main {
      margin-top: -50px;
    }

    .icon-box .icon i {
      font-size: 2rem; /* Adjust size if needed */
      color: white; /* Sets the icon color to white */
    }

    .icon-box .title {
      color: white; /* Ensures the title (h4) color is also white */
      margin-top: 10px;
    }

    .container ul li {
      text-align: justify;
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
            <li><a href="guru-beranda.php" class="active">Beranda<br></a></li>
            <li><a href="guru_siswa.php">Siswa</a></li>
            <li><a href="guru_pendaftaransiswa.php">Pendaftaran</a></li>
            <li><a href="guru_pembayaran.php">Pembayaran</a></li>
            <li>
              <a href="guru_profillguru.php">
                <img src="<?= htmlspecialchars($guru['foto_profil']); ?>" alt="User Profile" class="profile-img rounded-circle" >
              </a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </div>
  </header>

  <main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section background-color">
     <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
       <div class="row gy-5 justify-content-between">
         <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
           <h2><span>Hello </span><span class="accent">Cerdas Privat</span></h2>
           <p>Nabila</p></br></br>
           <div class="d-flex">
             <a href="daftarakun.html" class="btn-get-started ">Daftar</a>
             <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Tonton Vidio</span></a>
           </div>
         </div>
         <div class="col-lg-5 order-1 order-lg-2">
         </br></br></br> <img src="assets/img/cerdas1.png" class="img-fluid" alt="" style="width: 300px; height: auto; margin-left: 80px;">
         </div>
       </div>
     </div>
 
     <div class="icon-boxes position-relative" data-aos="fade-up" data-aos-delay="200" style="margin-top: -30px;">
       <div class="container position-relative">
         <div class="row gy-4 mt-5">
     
           <div class="col-xl-3 col-md-6">
             <div class="icon-box">
               <div class="icon"><i class="bi bi-easel"></i></div>
               <h4 class="title">Pendidikan berkualitas</h4>
             </div>
           </div><!--End Icon Box -->
     
           <div class="col-xl-3 col-md-6">
             <div class="icon-box">
               <div class="icon"><i class="bi bi-gem"></i></div>
               <h4 class="title">Investasi berharga</h4>
             </div>
           </div><!--End Icon Box -->
     
           <div class="col-xl-3 col-md-6">
             <div class="icon-box">
               <div class="icon"><i class="bi bi-geo-alt"></i></div>
               <h4 class="title">Akses mudah</h4>
             </div>
           </div><!--End Icon Box -->
     
           <div class="col-xl-3 col-md-6">
             <div class="icon-box">
               <div class="icon"><i class="bi bi-command"></i></div>
               <h4 class="title">Fleksibilitas waktu</h4>
             </div>
           </div><!--End Icon Box -->
     
         </div>
       </div>
     </div>
     
 
   </section><!-- /Hero Section -->
 
     <!-- About Section -->
     <section id="about" class="about section">
 
       <!-- Section Title -->
       <div class="container section-title" data-aos="fade-up">
         <h2>Tentang<br></h2>
         <p>Selamat datang di Cerdas Privat, solusi terbaik untuk pendidikan berkualitas!</p>
       </div><!-- End Section Title -->
 
       <div class="container">
         <div class="row gy-4">
           <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
             <h3>Kami berkomitmen membantu dan meningkatkan prestasi siswa </h3>
             <img src="assets/img/belajar3.jpeg" class="img-fluid rounded-4 mb-4" alt="">
             <p>Kami adalah layanan les privat yang berkomitmen membantu siswa dari berbagai jenjang untuk mencapai potensi terbaik mereka dalam bidang akademik. Dengan tim pengajar berpengalaman, Cerdas Privat menawarkan metode belajar yang interaktif dan personal, sesuai dengan kebutuhan setiap siswa.</p>
             <p>Di Cerdas Privat, kami percaya bahwa setiap siswa memiliki cara belajar yang unik. Oleh karena itu, kami menghadirkan pendekatan yang fleksibel dan efektif, membantu siswa lebih mudah memahami materi yang sulit serta meraih prestasi akademik yang lebih baik. Baik itu mata pelajaran Matematika, Bahasa Inggris, hingga Fisika dan Kimia, kami siap mendampingi siswa untuk belajar dengan lebih menyenangkan dan hasil yang nyata.</p>
           </div>
           <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
             <div class="content ps-0 ps-lg-5">
               <p class="fst-italic">Keunggulan Cerdas Privat</p>
               <ul>
                 <li><i class="bi bi-check-circle-fill"></i> <span>Pengajar Profesional</span></li>
                 <li><i class="bi bi-check-circle-fill"></i> <span>Pendekatan Personal</span></li>
                 <li><i class="bi bi-check-circle-fill"></i> <span>Fleksibilitas Waktu</span></li>
                 <li><i class="bi bi-check-circle-fill"></i> <span>Belajar Interaktif</span></li>
                 <li><i class="bi bi-check-circle-fill"></i> <span>Pembelajaran Online & Offline</span></li>
                 <li><i class="bi bi-check-circle-fill"></i> <span>Fokus pada Peningkatan Prestasi</span></li>
                 <li><i class="bi bi-check-circle-fill"></i> <span>Harga Terjangkau</span></li>
               </ul>
               <p>Bergabunglah dengan kami, dan rasakan pengalaman belajar yang berbeda, dengan perhatian penuh dari guru-guru profesional yang berdedikasi untuk kesuksesan Anda!</p>
 
               <div class="position-relative mt-4">
                 <img src="assets/img/belajar2.jpeg" class="img-fluid rounded-4" alt="">
                 <!-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a> -->
               </div>
             </div>
           </div>
         </div>
       </div>
 
     </section><!-- /About Section -->
         <!-- Stats Section -->
         <section id="stats" class="stats section">
           <div class="container" data-aos="fade-up" data-aos-delay="100">
             <div class="row gy-4 align-items-center">
               <div class="col-lg-5">
                 <img src="assets/img/belajar.png" alt="" class="img-fluid">
               </div>
               <div class="col-lg-7">
                 <div class="row gy-4">
                   <div class="col-lg-6">
                     <div class="stats-item d-flex">
                       <i class="bi bi-emoji-smile flex-shrink-0"></i>
                       <div>
                         <span data-purecounter-start="0" data-purecounter-end="80" data-purecounter-duration="1" class="purecounter"></span>
                         <p><strong style="font-size: 18px; color: #222645;">Guru</strong> <span>mendedikasikan ilmunya</span></p>
                       </div>
                     </div>
                   </div><!-- End Stats Item -->
     
                   <div class="col-lg-6">
                     <div class="stats-item d-flex">
                       <i class="bi bi-journal-richtext flex-shrink-0"></i>
                       <div>
                         <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1" class="purecounter"></span>
                         <p><strong style="font-size: 18px; color: #222645;">Siswa</strong> <span>telah bergabung</span></p>
                       </div>
                     </div>
                   </div><!-- End Stats Item -->
     
                   <div class="col-lg-6">
                     <div class="stats-item d-flex">
                       <i class="bi bi-headset flex-shrink-0"></i>
                       <div>
                         <span data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="1" class="purecounter"></span>
                         <p><strong style="font-size: 18px; color: #222645;">Asal sekolah</strong> <span>siswa</span></p>
                       </div>
                     </div>
                   </div><!-- End Stats Item -->
     
                   <div class="col-lg-6">
                     <div class="stats-item d-flex">
                       <i class="bi bi-people flex-shrink-0"></i>
                       <div>
                         <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1" class="purecounter"></span>
                         <p><strong style="font-size: 18px; color: #222645;">Mata Pelajaran</strong> <span>yang disediakan</span></p>
                       </div>
                     </div>
                   </div><!-- End Stats Item -->
                 </div>
               </div>
             </div>
           </div>
         </section><!-- /Stats Section -->
 
     <!-- Team Section -->
     <section id="team" class="team section">
 
       <!-- Section Title -->
       <div id="guru" class="container section-title" data-aos="fade-up">
         <h2>Guru Terbaik</h2>
         <p>Kenalan dulu dengan guru terbaik sepekan ini</p>
       </div><!-- End Section Title -->
 
       <div class="container">
         <div class="row gy-4">
           <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
             <div class="member">
               <img src="assets/img/guru1.jpg" class="img-fluid" alt="">
               <h4>Fitri Desrianti Harahap</h4>
               <span>Matematika</span>
               <div class="social">
                 <a href=""><i class="bi bi-twitter-x"></i></a>
                 <a href=""><i class="bi bi-facebook"></i></a>
                 <a href=""><i class="bi bi-instagram"></i></a>
                 <a href=""><i class="bi bi-linkedin"></i></a>
               </div>
             </div>
           </div><!-- End Team Member -->
       
           <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
             <div class="member">
               <img src="assets/img/rw5.jpg" class="img-fluid" alt="">
               <h4>Miss Rina Ayu Nabila</h4>
               <span>Bahasa Inggris</span>
               <div class="social">
                 <a href=""><i class="bi bi-twitter-x"></i></a>
                 <a href=""><i class="bi bi-facebook"></i></a>
                 <a href=""><i class="bi bi-instagram"></i></a>
                 <a href=""><i class="bi bi-linkedin"></i></a>
               </div>
             </div>
           </div><!-- End Team Member -->
       
           <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
             <div class="member">
               <img src="assets/img/guru2.jpg" class="img-fluid" alt="">
               <h4>Septania Daniati Panjaitan</h4>
               <span>Fisika</span>
               <div class="social">
                 <a href=""><i class="bi bi-twitter-x"></i></a>
                 <a href=""><i class="bi bi-facebook"></i></a>
                 <a href=""><i class="bi bi-instagram"></i></a>
                 <a href=""><i class="bi bi-linkedin"></i></a>
               </div>
             </div>
           </div><!-- End Team Member -->
         </div>
       </div>
     </section><!-- /Team Section -->
 
     <!-- Testimonials Section -->
     <section id="testimoni" class="testimonials section">
 
       <!-- Section Title -->
       <div class="container section-title" data-aos="fade-up">
         <h2>Testimoni</h2>
         <p>Pengalaman belajar teman teman Cerdas Privat</p>
       </div><!-- End Section Title -->
 
       <div class="container" data-aos="fade-up" data-aos-delay="100">
 
         <div class="swiper init-swiper">
           <script type="application/json" class="swiper-config">
             {
               "loop": true,
               "speed": 600,
               "autoplay": {
                 "delay": 5000
               },
               "slidesPerView": "auto",
               "pagination": {
                 "el": ".swiper-pagination",
                 "type": "bullets",
                 "clickable": true
               },
               "breakpoints": {
                 "320": {
                   "slidesPerView": 1,
                   "spaceBetween": 40
                 },
                 "1200": {
                   "slidesPerView": 3,
                   "spaceBetween": 10
                 }
               }
             }
           </script>
           <div class="swiper-wrapper">
 
             <div class="swiper-slide">
               <div class="testimonial-item">
                 <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                 <h3>Ayu Nabila</h3>
                 <h4>Kelas 12</h4>
                 <div class="stars">
                   <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                 </div>
                 <p>
                   <i class="bi bi-quote quote-icon-left"></i>
                   <span>Belajar di Cerdas Privat benar-benar membantu saya memahami pelajaran yang sulit! Guru-gurunya sangat sabar dan metode pengajarannya mudah dimengerti. Saya merasa lebih percaya diri menghadapi ujian, dan nilai-nilai saya meningkat sejak belajar di sini. Terima kasih, Cerdas Privat!</span>
                   <i class="bi bi-quote quote-icon-right"></i>
                 </p>
               </div>
             </div><!-- End testimonial item -->
 
             <div class="swiper-slide">
               <div class="testimonial-item">
                 <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                 <h3>Daniati</h3>
                 <h4>Kelas 9</h4>
                 <div class="stars">
                   <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                 </div>
                 <p>
                   <i class="bi bi-quote quote-icon-left"></i>
                   <span>Sebelumnya, saya sering kesulitan mengerjakan tugas matematika, tapi setelah mengikuti les di Cerdas Privat, saya jadi lebih paham konsep-konsepnya. Pengajarnya sangat mendukung dan selalu memberikan tips belajar yang efektif.</span>
                   <i class="bi bi-quote quote-icon-right"></i>
                 </p>
               </div>
             </div><!-- End testimonial item -->
 
             <div class="swiper-slide">
               <div class="testimonial-item">
                 <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                 <h3>Desrianti Harahap</h3>
                 <h4>Kelas 10</h4>
                 <div class="stars">
                   <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                 </div>
                 <p>
                   <i class="bi bi-quote quote-icon-left"></i>
                   <span>Saya suka cara pengajar di Cerdas Privat menjelaskan materi. Mereka menggunakan contoh-contoh nyata yang membuat saya lebih mudah mengerti. Saya sekarang jauh lebih percaya diri dan nyaman dalam belajar!</span>
                   <i class="bi bi-quote quote-icon-right"></i>
                 </p>
               </div>
             </div><!-- End testimonial item -->
 
             <div class="swiper-slide">
               <div class="testimonial-item">
                 <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                 <h3>Fatimah Alfihri</h3>
                 <h4>Kelas 12</h4>
                 <div class="stars">
                   <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                 </div>
                 <p>
                   <i class="bi bi-quote quote-icon-left"></i>
                   <span>Dulu, saya merasa pelajaran fisika itu rumit, tapi setelah ikut les di Cerdas Privat, saya jadi bisa memahaminya dengan lebih baik. Gurunya ramah dan sabar, selalu memberikan solusi yang jelas untuk setiap pertanyaan.</span>
                   <i class="bi bi-quote quote-icon-right"></i>
                 </p>
               </div>
             </div><!-- End testimonial item -->
 
             <div class="swiper-slide">
               <div class="testimonial-item">
                 <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                 <h3>Afnan</h3>
                 <h4>Kelas 7</h4>
                 <div class="stars">
                   <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                 </div>
                 <p>
                   <i class="bi bi-quote quote-icon-left"></i>
                   <span>Les privat di sini sangat membantu saya memperbaiki nilai-nilai saya di sekolah. Setiap sesi benar-benar fokus pada kelemahan saya, dan saya jadi lebih semangat belajar setelah melihat kemajuan yang signifikan."</span>
                   <i class="bi bi-quote quote-icon-right"></i>
                 </p>
               </div>
             </div><!-- End testimonial item -->
           </div>
           <div class="swiper-pagination"></div>
         </div>
       </div>
     </section><!-- /Testimonials Section -->
   </main>

  <footer id="footer" class="footer footer-background">
    <div class="container copyright mt-4">
      <p>© <span>Cerdas Private 2024</span></p>
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