<?php
include '../config/conn.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM penilaian_petugas WHERE id=$id");

header("Location: penilaian_petugas.php");
exit;
