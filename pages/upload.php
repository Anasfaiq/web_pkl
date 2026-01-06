<?php
include '../config/conn.php';

$table = isset($_POST['table']) ? $_POST['table'] : 'laporan_gangguan';

if ($table === 'foto_material') {
  // Handle Material Upload
  $nomor_material = $_POST['nomor_material'];
  $nama = $_POST['nama'];
  $detail = $_POST['detail'];
  $foto = '';

  // Handle file upload
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $foto_name = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $foto_ext = pathinfo($foto_name, PATHINFO_EXTENSION);
    $foto_new_name = 'material_' . time() . '.' . $foto_ext;
    $foto_path = '../assets/iconweb/' . $foto_new_name;

    if (move_uploaded_file($foto_tmp, $foto_path)) {
      $foto = 'iconweb/' . $foto_new_name;
    }
  }

  $sql = "INSERT INTO foto_material (nomor_material, nama, detail, foto)
          VALUES ('$nomor_material', '$nama', '$detail', '$foto')";

  mysqli_query($conn, $sql);
  header("Location: material.php");
  exit;

} else {
  // Handle Laporan Upload (existing code)
  $mulai = $_POST['mulai'];
  $selesai = $_POST['selesai'];
  $penyebab = $_POST['penyebab'];
  $solusi = $_POST['solusi'];
  $lokasi = $_POST['lokasi'];

  $durasi = round((strtotime($selesai) - strtotime($mulai)) / 60);

  $sql = "INSERT INTO laporan_gangguan (mulai, selesai, durasi, penyebab, solusi, lokasi)
          VALUES ('$mulai', '$selesai', '$durasi', '$penyebab', '$solusi', '$lokasi')";

  mysqli_query($conn, $sql);

  header("Location: laporan.php");
  exit;
}
