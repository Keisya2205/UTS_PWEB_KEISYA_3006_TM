<?php
session_start();
include 'inc/db.php'; 


if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    $sql = "INSERT INTO admin (username, password, nama_admin) VALUES ('$username', '$password', '$nama')";

    if ($conn->query($sql)) {
        header("Location: admin_list.php?msg=added");
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
  <title>Tambah Admin</title>
  <link rel="stylesheet" href="css/style.css">
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
      padding: 40px;
    }

    .form-container {
      background-color: #fff;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(244, 194, 13, 0.4);
      width: 400px;
      text-align: center;
    }

    h2 {
      color: #222;
      margin-bottom: 25px;
      font-size: 24px;
    }

    input {
      width: 100%;
      padding: 12px;
      border: 2px solid #f4c20d;
      border-radius: 8px;
      margin-bottom: 15px;
      font-size: 14px;
      transition: 0.3s;
    }

    input:focus {
      border-color: #ffd54f;
      outline: none;
      box-shadow: 0 0 8px rgba(244,194,13,0.4);
    }

    button {
      background-color: #f4c20d;
      color: #222;
      border: none;
      padding: 12px 20px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background-color: #ffd54f;
      transform: translateY(-2px);
    }

    a.back {
      display: inline-block;
      margin-top: 15px;
      color: #222;
      text-decoration: none;
      font-weight: bold;
    }

    a.back:hover {
      text-decoration: underline;
    }

    footer {
      background-color: #222;
      color: #fff;
      text-align: center;
      padding: 12px;
      font-size: 14px;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <h1>Tambah Admin</h1>
    <a href="admin_list.php">Kembali</a>
  </div>

  <div class="form-wrapper">
    <div class="form-container">
      <h2>Form Tambah Admin</h2>
      <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <button type="submit">Tambah Admin</button>
      </form>
      <a href="admin_list.php" class="back">← Kembali ke Daftar Admin</a>
    </div>
  </div>

  <footer>
    &copy; 2025 Inventaris Motor
  </footer>
</body>
</html>
