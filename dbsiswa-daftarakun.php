<?php
// Include the database connection file
include 'koneksi.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $name = $_POST['name'];
    $sekolah = $_POST['sekolah'];
    $email = $_POST['email'];
    $parent_name = $_POST['parent-name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $role = 'Siswa'; // Set role as 'Siswa'

    // Handle profile picture upload
    $fotoProfil = $_FILES['profile-pic']['name'];
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($fotoProfil);

    // Check if the file was uploaded successfully
    if (move_uploaded_file($_FILES['profile-pic']['tmp_name'], $targetFile)) {
        // Insert authentication data into the Users table
        $userQuery = "INSERT INTO Users (email, password, role) VALUES (?, ?, ?)";
        $userStmt = $conn->prepare($userQuery);
        $userStmt->bind_param("sss", $email, $password, $role);

        if ($userStmt->execute()) {
            // Insert profile data into the Siswa table
            $siswaQuery = "INSERT INTO Siswa (nama, sekolah, email, nama_orang_tua, alamat, no_hp, foto_profil) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $siswaStmt = $conn->prepare($siswaQuery);
            $siswaStmt->bind_param("sssssss", $name, $sekolah, $email, $parent_name, $address, $phone, $targetFile);

            if ($siswaStmt->execute()) {
                // Registration successful, redirect to the login page
                header("Location: login.html"); // Replace with your login page file name
                exit();
            } else {
                echo "Error saat menyimpan ke tabel Siswa: " . $siswaStmt->error;
            }
            $siswaStmt->close();
        } else {
            echo "Error saat menyimpan ke tabel Users: " . $userStmt->error;
        }
        $userStmt->close();
    } else {
        echo "Gagal mengupload file foto profil.";
    }

    // Close the connection
    $conn->close();
}
?>
