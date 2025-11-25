<?php
require_once "../config/conn.php";

function score($value) {
  return $value === "Ada" ? 1 : 0;
}

$query = "SELECT * FROM penilaian_petugas ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="../assets/logo5.1.png">

  <style>
    .sidebar-label {
      opacity: 0;
      transition: opacity 0.25s ease;
      white-space: nowrap;
    }
    .sidebar-label.show {
      opacity: 1;
    }

    #sidebar {
      box-shadow: 5px 0 10px rgba(0, 0, 0, 0.25);
      border-radius: 15px;
      margin-left: -13px;
    }
  </style>
</head>
<body class="min-h-screen flex bg-gray-100">
  
  <!-- sidebar -->
  <div id="sidebar" class="sidebar z-10 fixed top-0 left-0 w-24 flex-shrink-0 h-screen text-white shadow-md flex flex-col items-center overflow-hidden transition-all duration-300 ease-in-out
                          bg-[linear-gradient(135deg,_#4949ec_0%,_#643fc0_50%,_#a8abff_100%)]">
    <div class="w-full mb-4 flex justify-center items-center border-b border-gray-800 pl-4 py-4">
      <button id="toggleSidebar" class="flex items-center justify-center w-full">
        <img id="image" src="../assets/iconweb/menu.png" alt="logo" class="w-10 invert brightness-0">
        <span class="ml-3 sidebar-label font-semibold hidden whitespace-nowrap">Menu</span>
      </button>
    </div>

    <ul class="w-full flex flex-col gap-5 items-start">

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/home.png" alt="">
        <span class="ml-3 sidebar-label font-semibold hidden whitespace-nowrap">Home</span>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/customer-data.png" alt="">
        <span class="ml-3 sidebar-label hidden whitespace-nowrap">Customer Data</span>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/work.png" alt="">
        <span class="ml-3 sidebar-label hidden whitespace-nowrap">Work</span>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/image.png" alt="">
        <span class="ml-3 sidebar-label hidden whitespace-nowrap">Image</span>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/folder.png" alt="">
        <span class="ml-3 sidebar-label hidden whitespace-nowrap">Folder</span>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/user.png" alt="">
        <span class="ml-3 sidebar-label hidden whitespace-nowrap">User</span>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/setting.png" alt="">
        <span class="ml-3 sidebar-label hidden whitespace-nowrap">Setting</span>
      </li>

    </ul>
  </div>

  <!-- main content -->
  <div class="main flex justify-center items-center flex-1 min-h-screen bg-gray-100 pl-24 transition-all duration-300">
    
    <!-- card -->
    <div class="card rounded-lg shadow-xl m-10 p-7 h-[900px] w-auto">
      <div class="flex items-center gap-5 mb-7">
        <a href="#">
          <img class="h-8 w-8" src="../assets/iconweb/back-button.png" alt="">
        </a>
        <h1 class="text-3xl font-semibold flex items-center">Penilaian Petugas</h1>
      </div>
    
    
      <div class="content flex gap-8">

        <div class="left flex-1">
          <table class="w-[2600px] border border-gray-300 rounded-lg overflow-hidden">
            <thead>
              <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2 border-b">No</th>
                <th class="px-4 py-2 border-b">Tgl Cek</th>
                <th class="px-4 py-2 border-b">Tgl Insiden</th>
                <th class="px-4 py-2 border-b">Mitra</th>
                <th class="px-4 py-2 border-b">Petugas Close</th>
                <th class="px-4 py-2 border-b">SBU</th>
                <th class="px-4 py-2 border-b">KP</th>
                <th class="px-4 py-2 border-b">Penyebab</th>
                <th class="px-4 py-2 border-b">Evd K3</th>
                <th class="px-4 py-2 border-b">Evd Sum</th>
                <th class="px-4 py-2 border-b">Foto Penyebab</th>
                <th class="px-4 py-2 border-b">Foto Perbaikan</th>
                <th class="px-4 py-2 border-b">Kesesuaian</th>

                <th class="px-4 py-2 border-b">K3</th>
                <th class="px-4 py-2 border-b">Sum</th>
                <th class="px-4 py-2 border-b">FT Pen</th>
                <th class="px-4 py-2 border-b">FT Per</th>
                <th class="px-4 py-2 border-b">Root Cause</th>
                <th class="px-4 py-2 border-b">Total</th>
                <th class="px-4 py-2 border-b">Keterangan</th>
                <th class="px-4 py-2 border-b">Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $no = 1;
              mysqli_data_seek($result, 0);
              while ($row = mysqli_fetch_assoc($result)):
                
                $k3 = score($row['evd_k3']);
                $sum = score($row['evd_summary']);
                $ftPen = score($row['foto_penyebab']);
                $ftPer = score($row['foto_perbaikan']);
                $ks = score($row['kesesuaian']);
                $total = $k3 + $sum + $ftPen + $ftPer + $ks;
              ?>
              <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100 cursor-pointer">
                <td class="px-4 py-2 border-b"><?= $no++ ?></td>
                <td class="px-4 py-2 border-b"><?= $row['tanggal_cek'] ?></td>
                <td class="px-4 py-2 border-b"><?= $row['tanggal_insiden'] ?></td>
                <td class="px-4 py-2 border-b"><?= $row['nama_mitra'] ?></td>
                <td class="px-4 py-2 border-b"><?= $row['nama_petugas_close'] ?></td>
                <td class="px-4 py-2 border-b"><?= $row['sbu'] ?></td>
                <td class="px-4 py-2 border-b"><?= $row['kp'] ?></td>
                <td class="px-4 py-2 border-b"><?= $row['penyebab'] ?></td>
                <td class="px-4 py-2 border-b"><?= $row['evd_k3'] ?></td>
                <td class="px-4 py-2 border-b"><?= $row['evd_summary'] ?></td>
                <td class="px-4 py-2 border-b"><?= $row['foto_penyebab'] ?></td>
                <td class="px-4 py-2 border-b"><?= $row['foto_perbaikan'] ?></td>
                <td class="px-4 py-2 border-b"><?= $row['kesesuaian'] ?></td>

                <!-- scoring -->
                <td class="px-4 py-2 border-b"><?= $k3 ?></td>
                <td class="px-4 py-2 border-b"><?= $sum ?></td>
                <td class="px-4 py-2 border-b"><?= $ftPen ?></td>
                <td class="px-4 py-2 border-b"><?= $ftPer ?></td>
                <td class="px-4 py-2 border-b"><?= $ks ?></td>
                <td class="px-4 py-2 border-b"><?= $total ?></td>
                <td class="px-4 py-2 border-b"><?= $row['penyebab'] ?></td>

                <td class="px-4 py-2 border-b">
                  <div class="flex gap-2">
                    <a href="delete.php?id=<?= $row['id'] ?>">
                      <img src="../assets/iconweb/delete.png" class="w-5 h-5">
                    </a>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="text-blue-500 hover:text-blue-700 transition duration-200">
                      Edit
                    </a>
                  </div>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>

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

      main.style.paddingLeft = open ? "15rem" : "6rem";

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

      if (open) {
        toggleBtn.classList.add('justify-start', 'pl-5');
        toggleBtn.classList.remove('justify-center');
      } else {
        setTimeout(() => {
          toggleBtn.classList.remove('justify-start', 'pl-5');
          toggleBtn.classList.add('justify-center');
        }, 250);
      }

      labels.forEach(label => {
        if (open) {
          label.classList.remove('hidden');
          setTimeout(() => label.classList.add('show'), 10);
        } else {
          label.classList.remove('show');
          setTimeout(() => label.classList.add('hidden'), 200);
        }
      });

    });
  </script>

</body>
</html>