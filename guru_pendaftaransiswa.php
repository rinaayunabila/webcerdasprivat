<?php
// Mulai sesi untuk mendapatkan informasi login
session_start();

// Include file koneksi
include('koneksi.php');
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

// Dapatkan id_guru dari akun yang sedang login
$id_guru = $_SESSION['id_guru']; // Pastikan id_guru disimpan dalam sesi login

// Query untuk mengambil data siswa yang mendaftar pada guru yang login
// $query = "SELECT S.nama, S.sekolah, P.id_pendaftaran, P.tanggal_pendaftaran, P.status 
//           FROM Pendaftaran P
//           JOIN Siswa S ON P.id_siswa = S.id_siswa
//           WHERE P.id_guru = ?";
// Query untuk mengambil data siswa yang mendaftar pada guru yang login, kecuali yang sudah diterima atau ditolak
// $query = "SELECT S.nama, S.sekolah, P.id_pendaftaran, P.tanggal_pendaftaran, P.status 
//           FROM Pendaftaran P
//           JOIN Siswa S ON P.id_siswa = S.id_siswa
//           WHERE P.id_guru = ? AND (P.status IS NULL OR P.status = '')"; 
$query = "SELECT S.nama, S.sekolah, P.id_pendaftaran, P.tanggal_pendaftaran, P.status 
          FROM Pendaftaran P
          JOIN Siswa S ON P.id_siswa = S.id_siswa
          WHERE P.id_guru = ? AND P.status = 'Diproses'";


$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_guru);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Guru-Pendaftaran</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/image cerdas privat/logoCP2.png" rel="icon">
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
    /* Main content container */
main.container {
    padding-top: 10px; /* Reduce padding from the header */
    margin-top: 0; /* Ensure no extra space is added above */
}

.card {
    margin-top: 10px; /* Reduce the space between cards */
    padding: 10px; /* Reduce padding inside the card */
}

h2 {
    border-bottom: 2px solid #ddd; /* Garis bawah untuk "Informasi Pendaftaran" */
    padding-bottom: 10px;
    font-weight: 600; /* Untuk menonjolkan heading */
    color: #333; /* Warna teks heading */
}

.card {
    background-color: #f9f9f9; /* Warna latar belakang card */
    border-radius: 8px; /* Sudut membulat */
    margin-bottom: 20px; /* Memberi jarak antar card */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Efek bayangan */
}

.card p {
    margin: 0; /* Hilangkan margin default */
}

.card img {
    border: 2px solid #ccc; /* Border untuk gambar profil */
}

.btn-success {
    background-color: #28a745; /* Warna hijau untuk tombol 'Terima' */
    border: none; /* Hilangkan border default */
}

.btn-danger {
    background-color: #dc3545; /* Warna merah untuk tombol 'Tolak' */
    border: none; /* Hilangkan border default */
}

@media (max-width: 768px) {
    main.container {
        padding-top: 70px; /* Sesuaikan padding untuk perangkat kecil */
    }

    .card {
        flex-direction: column; /* Responsif, agar komponen di dalam card stack secara vertikal pada layar kecil */
        text-align: center; /* Teks di tengah */
    }

    .card img {
        margin-bottom: 15px; /* Tambah margin bawah pada gambar */
    }
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
  color: #000000; }
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
            <li><a href="guru_pendaftaransiswa.php"class="active">Pendaftaran</a></li>
            <li><a href="guru_pembayaran.php">Pembayaran</a></li>
            <li><a href="guru_profillguru.php">
              <img src="<?= htmlspecialchars($guru['foto_profil']); ?>" alt="User Profile" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
            </a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </div>
  </header>
  </header>

  <!-- Content Section -->
<section style="padding-top: 100px;"> <!-- Sesuaikan padding-top dengan tinggi header -->
  <div class="class-container d-flex align-items-center" style="padding-left: 20px;">
    <a href="guru_pendaftaransiswa.php" class="me-3" style="font-weight: bold; text-decoration: none">
        Siswa Mendaftar
    </a>
    <span style="color: #222645;" >|</span>
    <a href="guru_riwayat.php" class="ms-3" style="font-weight: bold; text-decoration: none;">
        Riwayat
    </a>
  </div>
</section>

  <!-- Main Content -->
  <main class="container mt-5">
        <h2>Informasi Siswa yang Mendaftar</h2>
        <div class="row gy-4">

            <?php
            // Loop melalui setiap pendaftaran untuk menampilkan detail siswa
            while ($row = $result->fetch_assoc()) {
                ?>
<div class="col-md-12">
    <div class="card p-3 shadow-sm d-flex align-items-center justify-content-between flex-md-row">
        <div class="d-flex align-items-center">
            <img src="assets/img/services.jpg" class="rounded-circle me-3" alt="Profile Picture" style="width: 60px; height: 60px; object-fit: cover;">
            <div>
                <p class="m-0"><strong>Nama:</strong> <?php echo htmlspecialchars($row['nama']); ?></p>
                <p class="m-0">Sekolah: <?php echo htmlspecialchars($row['sekolah']); ?></p>
                <p class="m-0">Tanggal Pendaftaran: <?php echo htmlspecialchars($row['tanggal_pendaftaran']); ?></p>
                
            </div>
        </div>
        
        <div class="d-flex">
        <button class="btn btn-success me-2" onclick="showConfirmationModal(<?php echo $row['id_pendaftaran']; ?>, 'Diterima')">Terima</button>
        <button class="btn btn-danger" onclick="showConfirmationModal(<?php echo $row['id_pendaftaran']; ?>, 'Ditolak')">Tolak</button>
        </div>
    </div>
</div>

                    </div>
                </div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="modalText">Apakah Anda yakin untuk memilih tindakan ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <button type="button" class="btn btn-primary" id="confirmAcceptBtn">Iya</button>
      </div>
    </div>
  </div>
</div>



            <?php
            }
            ?>
        </div>
    </main>

    <script>
let selectedPendaftaranId = null;
let selectedStatus = null;

function showConfirmationModal(idPendaftaran, status) {
    // Simpan id_pendaftaran dan status yang dipilih
    selectedPendaftaranId = idPendaftaran;
    selectedStatus = status;

    // Tentukan teks modal berdasarkan status
    const modalText = document.getElementById('modalText');
    if (status === 'Diterima') {
        modalText.textContent = 'Apakah Anda yakin menerima pendaftaran siswa?';
    } else if (status === 'Ditolak') {
        modalText.textContent = 'Apakah Anda yakin menolak pendaftaran siswa ?';
    }

    // Tampilkan modal
    var myModal = new bootstrap.Modal(document.getElementById('confirmModal'));
    myModal.show();
}

// Tangani klik tombol "Iya"
document.getElementById('confirmAcceptBtn').addEventListener('click', function() {
    if (selectedPendaftaranId && selectedStatus) {
        updateStatus(selectedPendaftaranId, selectedStatus);
    }
    // Tutup modal setelah aksi
    var myModal = new bootstrap.Modal(document.getElementById('confirmModal'));
    myModal.hide();
});


function updateStatus(idPendaftaran, status) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "statusdaftar.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText); // Display success or error message
            location.reload(); // Reload the page after updating status
        }
    };

    xhr.send("id_pendaftaran=" + idPendaftaran + "&status=" + status);
}
</script>


<script>
    function updateStatus(idPendaftaran, status) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "statusdaftar.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText); // Display success or error message
                location.reload(); // Reload the page after updating status
            }
        };

        xhr.send("id_pendaftaran=" + idPendaftaran + "&status=" + status);
    }
</script>
  
    <!-- Scroll Top Button -->
    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
    <!-- CDN Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  </body>
  
  </html>
  

  <!-- Scroll Top Button -->
  <a class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- CDN Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>