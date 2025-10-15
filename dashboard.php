<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Inventaris Motor</title>
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

    .dashboard-container {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 40px;
      height: 80vh;
    }

    .card {
      width: 250px;
      height: 180px;
      background-color: white;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(244, 194, 13, 0.4);
      text-align: center;
      padding: 30px 10px;
      transition: all 0.3s ease;
      cursor: pointer;
      text-decoration: none;
      color: #222;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(244, 194, 13, 0.6);
    }

    .card h3 {
      margin-top: 20px;
      color: #f4c20d;
    }

    footer {
      background-color: #222;
      color: #fff;
      text-align: center;
      padding: 12px;
      font-size: 14px;
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <h1>Dashboard Admin</h1>
    <a href="logout.php">Logout</a>
  </div>

  <div class="dashboard-container">
    <a href="motor_list.php" class="card">
      <img src="https://img.icons8.com/ios-filled/100/f4c20d/motorcycle.png" alt="Motor Icon">
      <h3>Motor</h3>
      <p>Tambah dan kelola data motor</p>
    </a>  

    <a href="penyimpanan_list.php" class="card">
      <img src="https://img.icons8.com/ios-filled/100/f4c20d/garage.png" alt="Storage Icon">
      <h3>Penyimpanan</h3>
      <p>Atur lokasi penyimpanan motor</p>
    </a>

    <a href="admin_list.php" class="card">
      <img src="https://img.icons8.com/ios-filled/100/f4c20d/admin-settings-male.png" alt="Admin Icon">
      <h3>Admin</h3>
      <p>Kelola data akun admin</p>
    </a>
  </div>

  <footer>
    &copy; 2025 Inventaris Motor
  </footer>
</body>
</html>
