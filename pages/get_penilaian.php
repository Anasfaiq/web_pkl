<?php
require_once "../config/conn.php";

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = mysqli_query($conn, "SELECT * FROM penilaian_petugas WHERE id = '$id'");
  $data = mysqli_fetch_assoc($query);
  
  header('Content-Type: application/json');
  echo json_encode($data);
} else {
  header('Content-Type: application/json');
  echo json_encode(['error' => 'ID tidak ditemukan']);
}
