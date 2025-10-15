<?php
session_start();
require_once 'inc/db.php';

if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit;
}


if (!isset($_GET['id'])) {
  die("ID admin tidak ditemukan.");
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM admin WHERE id_admin=$id");

if ($result->num_rows == 0) {
  die("Data admin tidak ditemukan.");
}

$row = $result->fetch_assoc();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $nama = $_POST['nama_admin'];
  $password_baru = $_POST['password_baru'];
  $konfirmasi = $_POST['konfirmasi_password'];

  if (!empty($password_baru)) {
    if ($password_baru === $konfirmasi) {
      $hash = password_hash($password_baru, PASSWORD_DEFAULT);
      $sql = "UPDATE admin SET username='$username', nama_admin='$nama', password='$hash' WHERE id_admin=$id";
    } else {
      echo "<script>alert('Konfirmasi password tidak cocok!');</script>";
      $sql = null;
    }
  } else {
    $sql = "UPDATE admin SET username='$username', nama_admin='$nama' WHERE id_admin=$id";
  }

  if ($sql && $conn->query($sql)) {
    header("Location: admin_list.php?msg=updated");
    exit;
  } elseif ($sql) {
    echo "Error: " . $conn->error;
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Admin - Inventaris Motor</title>
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
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
    }

    .navbar a {
      color: #222;
      text-decoration: none;
      font-weight: bold;
    }

    .edit-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 80vh;
    }

    .edit-card {
      background-color: #fff;
      width: 450px;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(244, 194, 13, 0.4);
      text-align: center;
      transition: transform 0.3s ease;
    }

    .edit-card:hover {
      transform: translateY(-5px);
    }

    .edit-card h2 {
      margin-bottom: 25px;
      color: #222;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    input[type="text"],
    input[type="password"] {
      padding: 12px;
      border: 2px solid #f4c20d;
      border-radius: 8px;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    input:focus {
      border-color: #fdd835;
      box-shadow: 0 0 6px rgba(244, 194, 13, 0.4);
      outline: none;
    }

    button {
      padding: 12px;
      background: linear-gradient(90deg, #f4c20d, #ffd54f);
      color: #222;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      font-size: 15px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 10px;
    }

    button:hover {
      background: linear-gradient(90deg, #ffd54f, #f4c20d);
      transform: translateY(-2px);
    }

    .back-link {
      display: inline-block;
      margin-top: 15px;
      color: #222;
      font-weight: 600;
      text-decoration: none;
    }

    .back-link:hover {
      text-decoration: underline;
    }

    footer {
      background-color: #222;
      color: #fff;
      text-align: center;
      padding: 12px;
      font-size: 14px;
      width: 100%;
      position: fixed;
      bottom: 0;
      left: 0;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <h1>Edit Admin</h1>
    <a href="admin_list.php">Kembali</a>
  </div>

  <div class="edit-container">
    <div class="edit-card">
      <h2>Form Edit Admin</h2>
      <form method="POST">
        <input type="text" name="username" value="<?= htmlspecialchars($row['username']) ?>" required>
        <input type="text" name="nama_admin" value="<?= htmlspecialchars($row['nama_admin']) ?>" required>
        <input type="password" name="password_baru" placeholder="Password Baru (opsional)">
        <input type="password" name="konfirmasi_password" placeholder="Konfirmasi Password Baru">
        <button type="submit">Simpan Perubahan</button>
      </form>
      <a href="admin_list.php" class="back-link">← Kembali ke Daftar Admin</a>
    </div>
  </div>

  <footer>
    &copy; 2025 Inventaris Motor
  </footer>

</body>
</html>
