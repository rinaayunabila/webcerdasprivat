<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Admin Siswa</title>
  <link href="assets/img/logoCP2.png" rel="icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  <style>
    .btn-custom { padding: 0.25rem 0.5rem; font-size: 0.75rem; }
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
                <li><a href="admin-beranda.html">Beranda<br></a></li>
                <li><a href="admin_guru.php" >Guru</a></li>
                <li><a href="admin_siswa.php"class="active">Siswa</a></li>
                <li><a href="admin_pendaftaran.php">Pendaftaran</a></li>
                <li><a href="admin_pembayaran.php">Pembayaran</a></li>
              </ul>
              <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
          </div>
        </div>
      </header>

  <main class="main">
    <div class="container">
      <div class="row">
        <section id="guru-details" class="guru-details section">
          <div class="container">  
            <br><br><br>
            <div class="d-flex justify-content-between mb-3 align-items-center">
              <h2>Siswa</h2> 
              <div class="d-flex">
                <input type="text" class="form-control me-2" placeholder="Search..." style="width: 200px; height: 40px;">
                <button class="btn btn-success" style="background-color: #28a745; color: #ffffff; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; margin-left: 5px;">
                    <i class="bi bi-plus"></i>
                </button>
              </div>
            </div><br>
            <div class="container">
              <table id="table" class="table table-striped table-bordered" style="width:100%">
                <thead> 
                  <tr>
                    <th>No</th>
                    <th>Foto Profil</th>
                    <th>Nama</th>
                    <th>Sekolah</th>
                    <th>Email</th>
                    <th>Nama Orang Tua</th>
                    <th>Alamat</th>
                    <th>Nomor HP</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    include 'koneksi.php'; // Include the database connection file
                    $query = "SELECT id_siswa, nama, sekolah, email, nama_orang_tua, alamat, no_hp FROM siswa";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                      $no = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td><img src='https://via.placeholder.com/50' alt='Foto Profil'></td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['sekolah'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['nama_orang_tua'] . "</td>";
                        echo "<td>" . $row['alamat'] . "</td>";
                        echo "<td>" . $row['no_hp'] . "</td>";
                        echo "<td>
                                <div class='d-flex'>
                                  <button class='btn btn-warning btn-custom me-2'><i class='bi bi-pencil'></i></button>
                                  <button class='btn btn-danger btn-custom'><i class='bi bi-trash'></i></button>
                                </div>
                              </td>";
                        echo "</tr>";
                      }
                    } else {
                      echo "<tr><td colspan='9' class='text-center'>No data available</td></tr>";
                    }

                    mysqli_close($conn); // Close the database connection
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>
