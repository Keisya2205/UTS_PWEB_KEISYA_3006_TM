<?php
session_start();
include 'inc/db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $admin = $res->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id_admin'];
            $_SESSION['admin_name'] = $admin['nama_admin'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Admin</title>
<style>
    body {
  font-family: 'Poppins', sans-serif;
  background-color: #fffdf5;
  margin: 0;
  padding: 0;
  color: #222;
}

.navbar {
  background-color: #f4c20d;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 30px;
  color: #222;
  box-shadow: 0 3px 6px rgba(0,0,0,0.1);
}

.navbar h1 {
  font-size: 22px;
  font-weight: 700;
}

.nav-right {
  display: flex;
  align-items: center;
  gap: 20px;
}

.btn-logout {
  background-color: #222;
  color: #fff;
  padding: 8px 14px;
  border-radius: 6px;
  text-decoration: none;
}

.container {
  padding: 30px;
}

.card {
  background-color: #fff;
  border: 2px solid #f4c20d;
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 30px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.card h2 {
  color: #222;
  border-left: 5px solid #f4c20d;
  padding-left: 10px;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
}

table th, table td {
  border: 1px solid #f0f0f0;
  padding: 10px;
  text-align: left;
}

table th {
  background-color: #fff8d6;
}

a {
  text-decoration: none;
  color: #f4c20d;
  font-weight: 600;
}

.btn {
  background-color: #f4c20d;
  color: #222;
  padding: 7px 12px;
  border-radius: 6px;
  text-decoration: none;
  margin-top: 10px;
  display: inline-block;
}

footer {
  text-align: center;
  background-color: #222;
  color: #fff;
  padding: 15px;
  font-size: 14px;
}

/* ===== LOGIN ===== */
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 85vh;
  background: linear-gradient(135deg, #fff9e6, #ffe082, #fdd835);
}

.login-card {
  background-color: #fff;
  border-radius: 15px;
  padding: 40px 35px;
  box-shadow: 0 8px 25px rgba(244, 194, 13, 0.3);
  width: 340px;
  text-align: center;
  transition: transform 0.3s ease;
}

.login-card:hover {
  transform: translateY(-5px);
}

.login-card h2 {
  color: #222;
  font-size: 22px;
  margin-bottom: 20px;
}

.login-card input[type="text"],
.login-card input[type="password"] {
  width: 100%;
  padding: 12px;
  margin-bottom: 12px;
  border: 2px solid #f4c20d;
  border-radius: 8px;
  font-size: 14px;
  outline: none;
  transition: border-color 0.3s;
}

.login-card input:focus {
  border-color: #fdd835;
  box-shadow: 0 0 6px rgba(244, 194, 13, 0.4);
}

.login-card button {
  width: 100%;
  padding: 10px;
  background-color: #f4c20d;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  font-size: 15px;
  cursor: pointer;
  transition: 0.3s;
}

.login-card button:hover {
  background-color: #fdd835;
  transform: translateY(-2px);
}

</style>
</head>
<body>
  <div class="navbar">
      <h1>Inventaris Motor</h1>
  </div>

  <div class="login-container">
      <div class="login-card">
          <h2>Login Admin</h2>

          <?php if ($error) echo "<p class='error'>$error</p>"; ?>

          <form method="POST">
              <input type="text" name="username" placeholder="Username" required>
              <input type="password" name="password" placeholder="Password" required>
              <button type="submit">Login</button>
          </form>

          <p>Belum punya akun? <a href="register.php">Daftar</a></p>
      </div>
  </div>

  <footer>
      &copy; 2025 Inventaris Motor
  </footer>
</body>


</html>
