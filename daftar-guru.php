<?php
include 'koneksi.php'; // Database connection

// Get data from request body
$data = json_decode(file_get_contents('php://input'), true);
$id_guru = $data['id_guru'];
$id_siswa = /* your logic here to get the currently logged-in student's ID */

// Prepare the SQL insert statement
$sql = "INSERT INTO Pendaftaran (id_siswa, id_guru, status, tanggal_pendaftaran)
        VALUES ('$id_siswa', '$id_guru', 'pending', NOW())";

$response = [];
if ($conn->query($sql) === TRUE) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['message'] = "Error: " . $sql . "<br>" . $conn->error;
}

echo json_encode($response);
$conn->close();
?>
