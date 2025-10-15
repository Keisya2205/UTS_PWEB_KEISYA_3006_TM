<?php
include 'inc/db.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama_lokasi = $_POST['nama_lokasi'];
  $keterangan = $_POST['keterangan'];

  $sql = "INSERT INTO penyimpanan (nama_lokasi, keterangan) VALUES ('$nama_lokasi', '$keterangan')";
  if ($conn->query($sql)) {
    header("Location: penyimpanan_list.php?msg=penyimpanan_added");
  } else {
    echo "Error: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Penyimpanan</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #fffde7, #fff59d, #fff176);
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
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

    .form-wrapper {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-container {
      background-color: #fff;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(244, 194, 13, 0.4);
      width: 400px;
      text-align: center;
    }

    input, textarea {
      width: 100%;
      padding: 10px;
      border: 2px solid #f4c20d;
      border-radius: 8px;
      margin-bottom: 15px;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    input:focus, textarea:focus {
      outline: none;
      border-color: #fdd835;
      box-shadow: 0 0 5px rgba(244, 194, 13, 0.4);
    }

    button {
      padding: 10px 20px;
      background-color: #f4c20d;
      border: none;
      border-radius: 8px;
      color: #222;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    button:hover {
      background-color: #ffd54f;
      transform: translateY(-2px);
    }

    a.back-link {
      display: inline-block;
      margin-top: 15px;
      color: #222;
      text-decoration: none;
      font-weight: 600;
    }

    footer {
      background-color: #222;
      color: #fff;
      text-align: center;
      padding: 12px;
      font-size: 14px;
      margin-top: auto;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <h1>Tambah Penyimpanan</h1>
    <a href="penyimpanan_list.php">Kembali</a>
  </div>

  <div class="form-wrapper">
    <div class="form-container">
      <h2>Form Tambah Gudang</h2>
      <form method="POST">
        <input type="text" name="nama_lokasi" placeholder="Nama Gudang" required>
        <textarea name="keterangan" placeholder="Keterangan (kapasitas gudang)" required></textarea>
        <button type="submit">Tambah Gudang</button>
      </form>
      <a href="penyimpanan_list.php" class="back-link">← Kembali ke Daftar Penyimpanan</a>
    </div>
  </div>

  <footer>
    &copy; 2025 Inventaris Motor
  </footer>
</body>
</html>
