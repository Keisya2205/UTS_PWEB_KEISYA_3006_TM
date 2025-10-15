<?php
session_start();
require_once 'inc/db.php';

if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit;
}


if (!isset($_GET['id'])) {
  die("ID penyimpanan tidak ditemukan.");
}

$id = intval($_GET['id']);

$delete = $conn->query("DELETE FROM penyimpanan WHERE id_penyimpanan = $id");

if ($delete) {
  $conn->query("SET @count = 0");
  $conn->query("UPDATE penyimpanan SET id_penyimpanan = @count:=@count+1 ORDER BY id_penyimpanan");
  $conn->query("ALTER TABLE penyimpanan AUTO_INCREMENT = 1");

  header("Location: penyimpanan_list.php?msg=deleted");
  exit;
} else {
  echo "Gagal menghapus data: " . $conn->error;
}
?>
