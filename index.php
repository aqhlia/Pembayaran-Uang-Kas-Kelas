<?php
session_start(); // Memulai session

// Ambil pesan sukses dan error dari session jika ada
$success_msg = isset($_SESSION['success_msg']) ? $_SESSION['success_msg'] : '';
$error_msg = isset($_SESSION['error_msg']) ? $_SESSION['error_msg'] : '';

// Ambil pesan error validasi per field
$name_err = isset($_SESSION['errors']['name_err']) ? $_SESSION['errors']['name_err'] : '';
$nim_err = isset($_SESSION['errors']['nim_err']) ? $_SESSION['errors']['nim_err'] : '';
$amount_err = isset($_SESSION['errors']['amount_err']) ? $_SESSION['errors']['amount_err'] : '';

// Ambil nilai input lama dari session, jika ada
$old_name = isset($_SESSION['old']['name']) ? htmlspecialchars($_SESSION['old']['name']) : '';
$old_nim = isset($_SESSION['old']['nim']) ? htmlspecialchars($_SESSION['old']['nim']) : '';
$old_amount = isset($_SESSION['old']['amount']) ? htmlspecialchars($_SESSION['old']['amount']) : '';

// Setelah mengambil, hapus session agar pesan tidak muncul terus
unset($_SESSION['success_msg'], $_SESSION['error_msg'], $_SESSION['errors'], $_SESSION['old']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Pembayaran Uang Kas Kelas</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea, #764ba2);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        padding: 20px;
    }
    .container {
        background: white;
        padding: 30px 40px;
        border-radius: 12px;
        max-width: 400px;
        width: 100%;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    h2 {
        text-align: center;
        color: #4a3f6f;
        margin-bottom: 25px;
    }
    label {
        display: block;
        margin-bottom: 7px;
        font-weight: 600;
        color: #4a3f6f;
    }
    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 15px;
        border: 2px solid #ccc;
        border-radius: 8px;
        font-size: 1em;
        transition: border-color 0.3s ease;
    }
    input[type="text"]:focus,
    input[type="number"]:focus {
        border-color: #667eea;
        outline: none;
    }
    .error {
        color: #e74c3c;
        font-size: 0.9em;
        margin-top: -12px;
        margin-bottom: 12px;
    }
    .success {
        background-color: #2ecc71;
        color: white;
        text-align: center;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-weight: 600;
    }
    button {
        background-color: #764ba2;
        color: white;
        border: none;
        padding: 12px;
        width: 100%;
        border-radius: 8px;
        font-size: 1em;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-weight: 600;
    }
    button:hover {
        background-color: #667eea;
    }
    footer {
        margin-top: 15px;
        font-size: 0.8em;
        color: #bbb;
        text-align: center;
    }
</style>
</head>
<body>
    <div class="container">
        <h2>Pembayaran Uang Kas Kelas</h2>

        <?php if (!empty($success_msg)): ?>
            <div class="success"><?php echo $success_msg; ?></div>
        <?php endif; ?>

        <?php if (!empty($error_msg)): ?>
            <div class="error"><?php echo $error_msg; ?></div>
        <?php endif; ?>

        <form method="post" action="proses.php">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" value="<?php echo $old_name; ?>" />
            <?php if (!empty($name_err)) echo '<div class="error">' . $name_err . '</div>'; ?>

            <label for="nim">NIM</label>
            <input type="text" id="nim" name="nim" value="<?php echo $old_nim; ?>" />
            <?php if (!empty($nim_err)) echo '<div class="error">' . $nim_err . '</div>'; ?>

            <label for="amount">Jumlah Yang Dibayarkan (Rp)</label>
            <input type="number" id="amount" name="amount" step="0.01" value="<?php echo $old_amount; ?>" />
            <?php if (!empty($amount_err)) echo '<div class="error">' . $amount_err . '</div>'; ?>

            <button type="submit">Simpan</button>
        </form>

        <footer>&copy; Teknik Informatika - Pemrograman Web</footer>
    </div>
</body>
</html>

