<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'inc/db.php';

if (!isset($_GET['id'])) {
    die("ID penyimpanan tidak ditemukan.");
}

$id = intval($_GET['id']);
$gudang = $conn->query("SELECT * FROM penyimpanan WHERE id_penyimpanan=$id")->fetch_assoc();
$motor = $conn->query("SELECT * FROM motor WHERE id_penyimpanan=$id");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Gudang - <?= htmlspecialchars($gudang['nama_gudang']) ?></title>
  <link rel="stylesheet" href="css/motor.css">
  <style>
    body {
      background: linear-gradient(135deg, #fffde7, #fff59d, #fff176);
      font-family: 'Poppins', sans-serif;
      margin: 0;
    }
    .navbar {
      background-color: #f4c20d;
      color: #222;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    }
    .navbar a {
      color: #222;
      text-decoration: none;
      font-weight: bold;
    }
    .container {
      padding: 40px;
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #222;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 10px 25px rgba(244, 194, 13, 0.3);
      margin-bottom: 30px;
    }
    th, td {
      border: 1px solid #f4c20d;
      padding: 12px;
      text-align: center;
    }
    th {
      background-color: #f4c20d;
      color: #222;
    }
    tr:hover {
      background-color: #fff59d;
    }
    .btn {
      display: inline-block;
      background-color: #f4c20d;
      color: #222;
      border: none;
      padding: 8px 14px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    .btn:hover {
      background-color: #fdd835;
      transform: translateY(-2px);
    }
    .btn-container {
      text-align: center;
      margin-top: 25px;
    }
    .btn-add {
      background-color: #222;
      color: #fff;
      padding: 10px 20px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
      display: inline-block;
    }
    .btn-add:hover {
      background-color: #444;
      transform: translateY(-2px);
    }
    footer {
      background-color: #222;
      color: #fff;
      text-align: center;
      padding: 12px;
      font-size: 14px;
      margin-top: 30px;
    }
  </style>
</head>
<body>

<div class="navbar">
  <h1>Gudang: <?= htmlspecialchars($gudang['nama_gudang']) ?></h1>
  <a href="penyimpanan_list.php">Kembali</a>
</div>

<div class="container">
  <h2>Motor dalam Gudang</h2>

  <table>
    <tr>
      <th>ID Motor</th>
      <th>Nama Motor</th>
      <th>Merk</th>
      <th>Tahun</th>
    </tr>
    <?php if ($motor->num_rows > 0): ?>
      <?php while ($row = $motor->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id_motor'] ?></td>
          <td><?= htmlspecialchars($row['nama_motor']) ?></td>
          <td><?= htmlspecialchars($row['merk']) ?></td>
          <td><?= htmlspecialchars($row['tahun']) ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="4">Belum ada motor di gudang ini.</td></tr>
    <?php endif; ?>
  </table>

  <!-- Tombol Tambah Motor ke Gudang Ini -->
  <div class="btn-container">
    <a href="motor_add.php?id_penyimpanan=<?= $gudang['id_penyimpanan'] ?>" class="btn-add">+ Tambah Motor ke Gudang Ini</a>
  </div>
</div>

<footer>
  &copy; 2025 Inventaris Motor
</footer>

</body>
</html>
