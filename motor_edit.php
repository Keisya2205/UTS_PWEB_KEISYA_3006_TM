<?php
session_start();
require_once 'inc/db.php'; 

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}


if (!isset($conn)) {
    die("Koneksi ke database gagal. Pastikan variabel \$conn ada di inc/db.php");
}


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$result = $conn->query("SELECT * FROM motor WHERE id_motor = $id");

if ($result->num_rows === 0) {
    echo "<p>Data motor tidak ditemukan.</p>";
    exit();
}

$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_motor'];
    $merk = $_POST['merk'];
    $harga = $_POST['harga'];
    $id_penyimpanan = $_POST['id_penyimpanan'];

    $stmt = $conn->prepare("UPDATE motor SET nama_motor=?, merk=?, harga=?, id_penyimpanan=? WHERE id_motor=?");
    $stmt->bind_param("ssdii", $nama, $merk, $harga, $id_penyimpanan, $id);

    if ($stmt->execute()) {
        header("Location: motor_list.php");
        exit();
    } else {
        echo "<p style='color:red;'>Gagal memperbarui data: " . $stmt->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Data Motor</title>
    <link rel="stylesheet" href="css/motor.css">
</head>

<body>
    <div class="navbar">
        <h1>Inventaris Motor</h1>
        <a href="motor_list.php" class="nav-login">Kembali</a>
    </div>

    <div class="container">
        <div class="card">
            <h2>Edit Data Motor</h2>
            <form method="POST">
                <!-- <label>Nama Motor:</label>
                <input type="text" name="nama_motor"
                    value="<?= htmlspecialchars($data['nama_motor'] ?? '') ?>" required> -->

                <label>Merk:</label>
                <input type="text" name="merk"
                    value="<?= htmlspecialchars($data['merk'] ?? '') ?>" required>

                <label>Harga (Rp):</label>
                <input type="number" name="harga"
                    value="<?= htmlspecialchars($data['harga'] ?? '') ?>" required>
    <!-- 
                    <label>ID Penyimpanan:</label>
                    <input type="number" name="id_penyimpanan"
                        value="<?= htmlspecialchars($data['id_penyimpanan'] ?? '') ?>" required> -->

                <button type="submit" class="btn">Simpan Perubahan</button>
            </form>

        </div>
    </div>
</body>

</html>