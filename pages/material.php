<?php
require_once "../config/conn.php";

// Handle Update
if (isset($_POST['update_submit'])) {
  $id = $_POST['update_id'];
  $nomor_material = $_POST['nomor_material'];
  $nama = $_POST['nama'];
  $detail = $_POST['detail'];

  mysqli_query($conn, 
    "UPDATE foto_material 
    SET nomor_material='$nomor_material',
        nama='$nama',
        detail='$detail'
    WHERE id='$id'"
  );

  header("Location: material.php");
  exit;
}

// Fetch all materials
$query = "SELECT * FROM foto_material ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tulip Group | Foto Material</title>
  <link rel="stylesheet" href="../src/output.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="../assets/logo6.1.png">

  <style>
    .sidebar-label {
    opacity: 0;
    transform: translateX(-8px);
    max-width: 0;
    overflow: hidden;
    transition:
      opacity 0.25s ease,
      transform 0.25s ease,
      max-width 0.3s ease;
    white-space: nowrap;
  }

  .sidebar-label.show {
    opacity: 1;
    transform: translateX(0);
    max-width: 160px;
  }

    #sidebar {
      box-shadow: 5px 0 10px rgba(0, 0, 0, 0.25);
      border-radius: 15px;
      margin-left: -13px;
    }
  </style>
</head>
<body class="min-h-screen flex">

  <!-- sidebar -->
  <div id="sidebar" class="sidebar z-10 fixed top-0 left-0 w-24 flex-shrink-0 h-screen text-white shadow-md flex flex-col items-center overflow-hidden transition-all duration-300 ease-in-out
                          bg-[linear-gradient(135deg,_#4949ec_0%,_#643fc0_50%,_#a8abff_100%)]">
    <div class="w-full mb-4 flex justify-center items-center border-b border-gray-800 pl-4 py-4">
      <button id="toggleSidebar" class="flex items-center justify-center w-full focus:outline-none">
        <img id="image" src="../assets/iconweb/menu.png" alt="logo" class="w-10 invert brightness-0">
        <span class="ml-3 sidebar-label font-semibold hidden whitespace-nowrap">Menu</span>
      </button>
    </div>

    <ul class="w-full flex flex-col gap-5 items-start">

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="dashboard.php" class="flex justify-center items-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/home.png" alt="">
          <span class="ml-3 sidebar-label font-semibold hidden whitespace-nowrap">Home</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="laporan.php" class="flex justify-center items-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/customer-data.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Customer Data</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="penilaian_petugas.php" class="flex justify-center items-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/work.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Work</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="material.php" class="flex justify-center items-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/image.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Foto Material</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="data_material.php" class="flex justify-center items-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/folder.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Data Material</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="#" class="flex justify-center items-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/user.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">User</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="#" class="flex justify-center items-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/setting.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Setting</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="../config/logout.php" class="flex justify-center">
          <img class="h-7 w-7 invert brightness-0" src="../assets/iconweb/logout.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Log Out </span>
        </a>
      </li>

    </ul>
  </div>

  <!-- main content -->
  <div class="main flex justify-center items-center flex-1 min-h-screen bg-gray-100 pl-24 transition-all duration-300">

    <!-- card -->
    <div class="card shadow-xl rounded-lg m-10 p-7 w-auto h-auto">
      <div class="flex items-center gap-5 mb-7">
        <a href="dashboard.php">
          <img class="h-8 w-8" src="../assets/iconweb/back-button.png" alt="">
        </a>
        <h1 class="text-3xl font-semibold flex items-center">Foto Material</h1>
      </div>

      <div class="content flex gap-5">

        <div class="left flex-1">
          <table class="w-[1300px] border border-gray-300 rounded-lg overflow-hidden">
            <thead>
              <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2 border-b">No</th>
                <th class="px-4 py-2 border-b">Nomor Material</th>
                <th class="px-4 py-2 border-b">Nama</th>
                <th class="px-4 py-2 border-b">Detail</th>
                <th class="px-4 py-2 border-b">Foto</th>
                <th class="px-4 py-2 border-b">Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $no = 1;
              mysqli_data_seek($result, 0);
              while ($row = mysqli_fetch_assoc($result)):
              ?>
              <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100 cursor-pointer">
                <td class="px-4 py-2 border-b"><?= $no++ ?></td>
                <td class="px-4 py-2 border-b"><?= $row['nomor_material'] ?></td>
                <td class="px-4 py-2 border-b"><?= $row['nama'] ?></td>
                <td class="px-4 py-2 border-b"><?= $row['detail'] ?></td>
                <td class="px-4 py-2 border-b">
                  <?php if (!empty($row['foto'])): ?>
                    <a href="../assets/<?= $row['foto'] ?>" target="_blank" class="text-blue-500 hover:text-blue-700">Lihat</a>
                  <?php else: ?>
                    <span class="text-gray-400">-</span>
                  <?php endif; ?>
                </td>

                <td class="px-4 py-2 border-b flex gap-2 items-center">
                  <a href="delete_material.php?id=<?= $row['id'] ?>">
                    <img class="w-5 h-5 cursor-pointer" src="../assets/iconweb/delete.png">
                  </a>
                  <a href="material.php?edit_id=<?= $row['id'] ?>" class="text-blue-500 hover:text-blue-700">Edit</a>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>

          </table>
        </div>

        <div class="right flex flex-2 flex-col gap-5">
          <div class="top">
            <div class="shadow-md border rounded-lg p-5 w-[500px]">
              <h2 class="font-semibold text-lg mb-4">Tambah Material</h2>
              
              <form action="upload.php" method="POST" enctype="multipart/form-data" class="flex flex-col gap-3">

                <input type="hidden" name="table" value="foto_material">

                <label class="text-sm font-medium">Nomor Material</label>
                <input type="number" name="nomor_material" class="border border-gray-300 rounded px-3 py-2" placeholder="Nomor Material" required>

                <label class="text-sm font-medium">Nama</label>
                <input type="text" name="nama" class="border border-gray-300 rounded px-3 py-2" placeholder="Nama Material" required>

                <label class="text-sm font-medium">Detail</label>
                <input type="text" name="detail" class="border border-gray-300 rounded px-3 py-2" placeholder="Detail Material" required>

                <label class="text-sm font-medium">Foto</label>
                <input type="file" name="foto" class="border border-gray-300 rounded px-3 py-2" accept="image/*">

                <button class="mt-3 bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Tambah</button>

              </form>


            </div>
          </div>

          <div class="bot">
            <div class="shadow-md border rounded-lg p-5 w-[500px]">
                <h2 class="font-semibold text-lg mb-4">Edit Material</h2>

                <?php
                if (isset($_GET['edit_id'])) {
                    $id = $_GET['edit_id'];
                    $query = mysqli_query($conn, "SELECT * FROM foto_material WHERE id = '$id'");
                    $data = mysqli_fetch_assoc($query);
                } else {
                    $data = null;
                }
                ?>

                <?php if ($data): ?>
                <form method="POST" class="flex flex-col gap-3">

                    <input type="hidden" name="update_id" value="<?= $data['id'] ?>">

                    <label class="text-sm font-medium">Nomor Material</label>
                    <input type="number" 
                          name="nomor_material"
                          value="<?= $data['nomor_material'] ?>"
                          placeholder="Nomor Material"
                          class="border px-3 py-2 rounded" required>

                    <label class="text-sm font-medium">Nama</label>
                    <input type="text"
                          name="nama"
                          value="<?= $data['nama'] ?>"
                          placeholder="Nama Material"
                          class="border px-3 py-2 rounded" required>

                    <label class="text-sm font-medium">Detail</label>
                    <input type="text"
                          name="detail"
                          value="<?= $data['detail'] ?>"
                          placeholder="Detail Material"
                          class="border px-3 py-2 rounded" required>

                    <button name="update_submit" class="bg-blue-600 text-white py-2 rounded">
                        Update
                    </button>
                </form>

                <?php else: ?>
                    <p class="text-gray-500 text-sm">Klik tombol Edit pada data untuk mengubah material.</p>
                <?php endif; ?>
            </div>


          </div>

        </div>
      </div>
    </div>

  </div>


  <script>
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebar');
    const labels = document.querySelectorAll('.sidebar-label');
    const items = document.querySelectorAll('.sidebar-item');
    const image = document.getElementById('image');
    const main = document.querySelector('.main');

    let open = false;

    toggleBtn.addEventListener('click', () => {
      open = !open;

      sidebar.classList.toggle('w-24', !open);
      sidebar.classList.toggle('w-60', open);

      main.style.paddingLeft = open ? "18rem" : "6rem";

      // item alignment smooth
      items.forEach(item => {
        if (open) {
          item.classList.add('justify-start', 'pl-10');
          item.classList.remove('justify-center');
        } else {
          setTimeout(() => {
            item.classList.remove('justify-start', 'pl-10');
            item.classList.add('justify-center');
          }, 250);
        }
      });

      // toggle button alignment
      if (open) {
        toggleBtn.classList.add('justify-start', 'pl-5');
        toggleBtn.classList.remove('justify-center');
      } else {
        setTimeout(() => {
          toggleBtn.classList.remove('justify-start', 'pl-5');
          toggleBtn.classList.add('justify-center');
        }, 250);
      }

      // label fade smooth
      labels.forEach(label => {
        if (open) {
          label.classList.remove('hidden');

          requestAnimationFrame(() => {
            label.classList.add('show');
          });

        } else {
          label.classList.remove('show');

          setTimeout(() => {
            label.classList.add('hidden');
          }, 250); // samain sama durasi transition
        }
      });

    });
  </script>

</body>
</html>