<?php
include 'inc/db.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit;
}

$result = $conn->query("SELECT * FROM penyimpanan ORDER BY id_penyimpanan ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Penyimpanan</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #fffde7, #fff59d, #fff176);
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
      color: #222;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 10px 25px rgba(244, 194, 13, 0.3);
      margin-bottom: 20px;
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

    .btn-delete {
      background-color: #c62828;
      color: white;
    }

    .btn-delete:hover {
      background-color: #e53935;
    }

    .btn-add {
      display: block;
      margin: 20px auto;
      background-color: #222;
      color: #fff;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: bold;
      width: fit-content;
      transition: all 0.3s ease;
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
  <h1>Daftar Penyimpanan</h1>
  <a href="dashboard.php">Kembali</a>
</div>

<div class="container">
  <h2>Data Gudang</h2>

  <table>
    <tr>
      <th>ID</th>
      <th>Nama Lokasi</th>
      <th>Keterangan</th>
      <th>Aksi</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id_penyimpanan'] ?></td>
        <td><?= htmlspecialchars($row['nama_lokasi']) ?></td>
        <td><?= htmlspecialchars($row['keterangan']) ?></td>
        <td>
          <a href="penyimpanan_edit.php?id=<?= $row['id_penyimpanan'] ?>" class="btn">Edit</a>
          <a href="penyimpanan_delete.php?id=<?= $row['id_penyimpanan'] ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

  <a href="penyimpanan_add.php" class="btn-add">+ Tambah Gudang</a>
</div>

<footer>
  &copy; 2025 Inventaris Motor
</footer>

</body>
</html>
