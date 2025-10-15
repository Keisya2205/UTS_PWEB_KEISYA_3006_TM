<?php
include 'inc/db.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit;
}

$id = $_GET['id'];

$sql = "DELETE FROM admin WHERE id_admin=$id";
if ($conn->query($sql)) {
  header("Location: dashboard.php?msg=admin_deleted");
} else {
  echo "Error: " . $conn->error;
}
?>
