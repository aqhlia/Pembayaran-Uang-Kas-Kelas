<?php
session_start(); // Memulai session
include 'koneksi.php';

$name = $nim = $amount = "";
$name_err = $nim_err = $amount_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    if (empty(trim($_POST["name"]))) {
        $name_err = "Nama wajib diisi.";
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }

    if (empty(trim($_POST["nim"]))) {
        $nim_err = "NIM wajib diisi.";
    } else {
        $nim = htmlspecialchars(trim($_POST["nim"]));
    }

    if (empty(trim($_POST["amount"]))) {
        $amount_err = "Jumlah uang kas wajib diisi.";
    } else if (!is_numeric($_POST["amount"]) || floatval($_POST["amount"]) <= 0) {
        $amount_err = "Jumlah uang kas harus berupa angka positif.";
    } else {
        $amount = floatval($_POST["amount"]);
    }

    // Jika tidak ada kesalahan, simpan ke database
    if (empty($name_err) && empty($nim_err) && empty($amount_err)) {
        $stmt = $conn->prepare("INSERT INTO pembayaran_kas (nama, nim, jumlah_pembayaran) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $name, $nim, $amount);

        if ($stmt->execute()) {
            $_SESSION['success_msg'] = "Pembayaran berhasil disimpan.";
        } else {
            $_SESSION['error_msg'] = "Terjadi kesalahan saat menyimpan data: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Simpan pesan kesalahan ke session
        $_SESSION['errors'] = [
            'name_err' => $name_err,
            'nim_err' => $nim_err,
            'amount_err' => $amount_err
        ];
    }

    // Redirect kembali ke index.php
    header("Location: index.php");
    exit();
}

$conn->close();
?>
