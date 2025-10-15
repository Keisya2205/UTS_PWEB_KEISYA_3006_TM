<?php
session_start();
require_once 'inc/db.php';

if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit;
}

// Pastikan ID ada
if (!isset($_GET['id'])) {
  die("ID penyimpanan tidak ditemukan.");
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM penyimpanan WHERE id_penyimpanan = $id");

if ($result->num_rows === 0) {
  die("Data penyimpanan tidak ditemukan.");
}

$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama_lokasi = $conn->real_escape_string($_POST['nama_lokasi']);
  $keterangan = $conn->real_escape_string($_POST['keterangan']);

  $sql = "UPDATE penyimpanan 
          SET nama_lokasi = '$nama_lokasi', 
              keterangan = '$keterangan' 
          WHERE id_penyimpanan = $id";

  if ($conn->query($sql)) {
    header("Location: penyimpanan_list.php?msg=updated");
    exit;
  } else {
    echo "Error: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Penyimpanan</title>
  <style>
    body {
      background: linear-gradient(135deg, #fffde7, #fff59d, #fff176);
      font-family: 'Poppins', sans-serif;
      margin: 0;
    }
    .form-container {
      max-width: 450px;
      margin: 80px auto;
      background: #fff;
      padding: 35px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(244, 194, 13, 0.4);
      text-align: center;
    }
    h2 {
      color: #222;
      margin-bottom: 25px;
    }
    input, textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 2px solid #f4c20d;
      border-radius: 8px;
      font-size: 14px;
      resize: none;
    }
    button {
      background-color: #f4c20d;
      color: #222;
      border: none;
      padding: 10px 25px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: all 0.3s ease;
    }
    button:hover {
      background-color: #fdd835;
      transform: translateY(-2px);
    }
    a {
      display: inline-block;
      margin-top: 15px;
      color: #222;
      text-decoration: none;
      font-weight: bold;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Edit Data Penyimpanan</h2>
    <form method="POST">
      <input type="text" name="nama_lokasi" value="<?= htmlspecialchars($row['nama_lokasi']) ?>" required>
      <textarea name="keterangan" rows="4" placeholder="Keterangan..." required><?= htmlspecialchars($row['keterangan']) ?></textarea>
      <button type="submit">Update</button>
    </form>
    <a href="penyimpanan_list.php">← Kembali</a>
  </div>
</body>
</html>
