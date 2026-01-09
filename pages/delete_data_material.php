<?php
require_once "../config/conn.php";

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
  mysqli_query($conn, "DELETE FROM data_material WHERE id='$id'");
  header("Location: data_material.php");
  exit;
} else {
  header("Location: data_material.php");
  exit;
}
?>
