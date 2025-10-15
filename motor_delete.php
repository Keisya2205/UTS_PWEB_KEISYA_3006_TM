<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'inc/db.php';


if (!isset($conn)) {
    die("Koneksi ke database gagal. Pastikan variabel \$conn ada di db.php");
}

if (!isset($_GET['id'])) {
    die("ID motor tidak ditemukan.");
}

$id_motor = intval($_GET['id']);

$query_check = "SELECT * FROM motor WHERE id_motor = $id_motor";
$result_check = $conn->query($query_check);

if ($result_check->num_rows === 0) {
    die("Data motor tidak ditemukan.");
}


$query_delete = "DELETE FROM motor WHERE id_motor = $id_motor";
if ($conn->query($query_delete) === TRUE) {
    $conn->query("SET @count = 0");
    $conn->query("UPDATE motor SET id_motor = (@count := @count + 1) ORDER BY id_motor ASC");
    $conn->query("ALTER TABLE motor AUTO_INCREMENT = 1");

    header("Location: motor_list.php?msg=deleted");
    exit();
} else {
    echo "Gagal menghapus data: " . $conn->error;
}

$conn->close();
?>
