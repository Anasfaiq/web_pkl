<?php
include '../config/conn.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM laporan_gangguan WHERE id=$id");

header("Location: laporan.php");
exit;
