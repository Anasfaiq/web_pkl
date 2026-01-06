<?php
include '../config/conn.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM foto_material WHERE id=$id");

header("Location: material.php");
exit;
