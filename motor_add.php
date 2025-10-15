<?php
session_start();


if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'inc/db.php';
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $merk = trim($_POST['merk']);
    $harga = (int) $_POST['harga'];

    if (!empty($merk) && $harga > 0) {
        $stmt = $conn->prepare("INSERT INTO motor (merk, harga) VALUES (?, ?)");
        $stmt->bind_param("si", $merk, $harga);
        $stmt->execute();
        $stmt->close();

        header("Location: dashboard.php");
        exit;
    } else {
        $msg = "Semua kolom wajib diisi!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Motor</title>
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
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 80vh;
    }

    .card {
      background-color: #fff;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(244, 194, 13, 0.4);
      padding: 40px 35px;
      width: 400px;
      text-align: center;
    }

    input[type="text"], input[type="number"] {
      width: 100%;
      padding: 12px;
      border: 2px solid #f4c20d;
      border-radius: 8px;
      font-size: 14px;
      margin-bottom: 15px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #f4c20d;
      color: #222;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      font-size: 15px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    button:hover {
      background-color: #fdd835;
      transform: translateY(-2px);
    }

    .back {
      margin-top: 15px;
      display: inline-block;
      color: #f4c20d;
      text-decoration: none;
      font-weight: 600;
    }

    .back:hover {
      text-decoration: underline;
    }

    .error {
      color: #c62828;
      background: #fff3e0;
      border: 1px solid #ef9a9a;
      border-radius: 5px;
      padding: 8px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <h1>Tambah Data Motor</h1>
    <a href="dashboard.php">Kembali</a>
  </div>

  <div class="container">
    <div class="card">
      <h2>Input Motor Baru</h2>
      <?php if ($msg): ?>
        <p class="error"><?= htmlspecialchars($msg) ?></p>
      <?php endif; ?>

      <form method="POST">
        <input type="text" name="merk" placeholder="Masukkan Merk Motor" required>
        <input type="number" name="harga" placeholder="Masukkan Harga Sewa" required>
        <button type="submit">Simpan</button>
      </form>

      <a href="dashboard.php" class="back">← Kembali ke Dashboard</a>
    </div>
  </div>
</body>
</html>
