<?php

$koneksi = new mysqli("localhost", "root", "", "inventaris_motor");


if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}



header("Location: login.php");
exit;
?>


// Query untuk mengambil data motor beserta lokasi penyimpanan
$sql = "SELECT motor.id_motor, motor.nama_motor, motor.merk, motor.harga, penyimpanan.nama_lokasi 
        FROM motor 
        JOIN penyimpanan ON motor.id_penyimpanan = penyimpanan.id_penyimpanan";
$result = $koneksi->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Motor</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        table { border-collapse: collapse; width: 70%; margin: 20px auto; }
        th, td { border: 1px solid #888; padding: 8px 12px; text-align: center; }
        th { background: #eee; }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Inventaris Motor</h1>
        <div class="nav-right">

        </div>
    </div>
    <div class="container">
        <div class="card">
            <h2>Daftar Motor</h2>
            <p>Selamat datang di Aplikasi Inventaris Motor!</p>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nama Motor</th>
                    <th>Merk</th>
                    <th>Harga</th>
                    <th>Lokasi Penyimpanan</th>
                </tr>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id_motor'] ?></td>
                            <td><?= $row['nama_motor'] ?></td>
                            <td><?= $row['merk'] ?></td>
                            <td><?= number_format($row['harga'], 2) ?></td>
                            <td><?= $row['nama_lokasi'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">Belum ada data motor.</td></tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
    <footer>
        &copy; 2025 Inventaris Motor
    </footer>
</body>
</html>
<?php
$koneksi->close();
?>