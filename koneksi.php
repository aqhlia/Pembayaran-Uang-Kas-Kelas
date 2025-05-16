<?php
// koneksi.php
$servername = "localhost";
$username = "root";
$password = ""; // Ganti jika perlu
$dbname = "kelas";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
