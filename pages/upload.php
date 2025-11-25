<?php
include '../config/conn.php';

$mulai = $_POST['mulai'];
$selesai = $_POST['selesai'];
$penyebab = $_POST['penyebab'];
$solusi = $_POST['solusi'];
$lokasi = $_POST['lokasi'];

$durasi = round((strtotime($selesai) - strtotime($mulai)) / 60);

$sql = "INSERT INTO laporan_gangguan (mulai, selesai, durasi, penyebab, solusi, lokasi)
        VALUES ('$mulai', '$selesai', '$durasi', '$penyebab', '$solusi', '$lokasi')";

mysqli_query($conn, $sql);

header("Location: index.php");
exit;
