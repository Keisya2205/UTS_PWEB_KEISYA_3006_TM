<?php
include 'inc/db.php';
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_admin']);
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($nama && $username && $password) {
        $stmt = $conn->prepare("INSERT INTO admin (nama_admin, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $username, $password);
        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        } else {
            $msg = "Gagal mendaftar. Coba lagi.";
        }
    } else {
        $msg = "Semua kolom wajib diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Admin</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <div class="navbar">
        <h1>Inventaris Motor</h1>
        <a href="login.php" class="nav-login">Login</a>
    </div>

    <div class="register-container">
        <div class="register-card">
            <h2>Daftar Admin Baru</h2>
            <?php if ($msg): ?>
                <p class="error"><?= htmlspecialchars($msg) ?></p>
            <?php endif; ?>

            <form method="POST">
                <input type="text" name="nama_admin" placeholder="Nama Lengkap" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Daftar</button>
            </form>

            <p>Sudah punya akun? <a href="login.php">Login</a></p>
        </div>
    </div>

    <footer>
        &copy; 2025 Inventaris Motor
    </footer>
</body>
</html>
