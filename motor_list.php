<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'inc/db.php';

$result = $conn->query("SELECT * FROM motor ORDER BY id_motor DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Motor - Inventaris Motor</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #fffde7, #fff59d, #fff176);
      margin: 0;
      padding: 0;
    }

    .navbar {
      background-color: #f4c20d;
      color: #222;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }

    .navbar a {
      text-decoration: none;
      color: #222;
      font-weight: bold;
    }

    .container {
      width: 90%;
      max-width: 900px;
      margin: 50px auto;
      background-color: #fff;
      border-radius: 16px;
      padding: 25px 35px;
      box-shadow: 0 10px 25px rgba(244, 194, 13, 0.4);
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .header h2 {
      color: #222;
      font-size: 22px;
    }

    .icon-btn {
      background: #f4c20d;
      border: none;
      color: #222;
      padding: 10px 14px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: all 0.3s ease;
      text-decoration: none;
    }

    .icon-btn:hover {
      background: #fdd835;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    th, td {
      padding: 12px;
      border-bottom: 2px solid #f4c20d;
      text-align: left;
    }

    th {
      background-color: #fff8e1;
    }

    td a {
      text-decoration: none;
      color: #f4c20d;
      font-weight: bold;
      margin-right: 10px;
    }

    td a:hover {
      text-decoration: underline;
    }

    .empty {
      text-align: center;
      color: #999;
      padding: 20px;
    }

    footer {
      background-color: #222;
      color: #fff;
      text-align: center;
      padding: 12px;
      font-size: 14px;
      width: 100%;
      margin-top: 40px;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <h1>Daftar Motor</h1>
    <a href="dashboard.php">Kembali</a>
  </div>

  <div class="container">
    <div class="header">
      <h2>Data Motor di Penyimpanan</h2>
      <a href="motor_add.php" class="icon-btn">+ Tambah Motor</a>
    </div>

    <?php if ($result && $result->num_rows > 0): ?>
      <table>
        <tr>
          <th>ID</th>
          <th>Merk Motor</th>
          <th>Harga</th>
          <th>Aksi</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id_motor'] ?></td>
          <td><?= htmlspecialchars($row['merk']) ?></td>
          <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
<td>
  <a href="motor_edit.php?id=<?= $row['id_motor'] ?>" class="edit">✏️ Edit</a>
  <a href="motor_delete.php?id=<?= $row['id_motor'] ?>" class="delete" onclick="return confirm('Yakin ingin menghapus data ini?')">🗑️ Hapus</a>
</td>
        </tr>
        <?php endwhile; ?>

      </table>
    <?php else: ?>
      <p class="empty">Belum ada data motor yang tersimpan.</p>
    <?php endif; ?>
  </div>

  <footer>
    &copy; 2025 Inventaris Motor
  </footer>
</body>
</html>
