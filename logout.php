<?php
session_start();

// Periksa apakah permintaan logout berasal dari metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hapus semua data session
    session_unset();

    // Hancurkan session
    session_destroy();

    // Arahkan pengguna ke halaman login (atau halaman lain)
    header("Location: login.html");
    exit;
} 


