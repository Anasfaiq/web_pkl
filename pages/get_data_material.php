<?php
require_once "../config/conn.php";

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
  $query = mysqli_query($conn, "SELECT * FROM data_material WHERE id = '$id'");
  $data = mysqli_fetch_assoc($query);
  
  header('Content-Type: application/json');
  echo json_encode($data);
} else {
  header('Content-Type: application/json');
  echo json_encode(['error' => 'ID not provided']);
}
?>
