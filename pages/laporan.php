<?php
  if (isset($_POST['update_submit'])) {
    include '../config/conn.php';

    $id = $_POST['update_id'];
    $mulai = $_POST['mulai'];
    $selesai = $_POST['selesai'];
    $penyebab = $_POST['penyebab'];
    $solusi = $_POST['solusi'];
    $lokasi = $_POST['lokasi'];

    // Hitung durasi
    $durasi = round((strtotime($selesai) - strtotime($mulai)) / 60);

    mysqli_query($conn, 
        "UPDATE laporan_gangguan 
        SET mulai='$mulai',
            selesai='$selesai',
            durasi='$durasi',
            penyebab='$penyebab',
            solusi='$solusi',
            lokasi='$lokasi'
        WHERE id='$id'"
    );

    header("Location: laporan.php");
    exit;
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tulip Group | Customer Data</title>
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
      <button id="toggleSidebar" class="flex items-center justify-center w-full">
        <img id="image" src="../assets/iconweb/menu.png" alt="logo" class="w-10 invert brightness-0">
        <span class="ml-3 sidebar-label font-semibold hidden whitespace-nowrap">Menu</span>
      </button>
    </div>

    <ul class="w-full flex flex-col gap-5 items-start">

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="dashboard.php" class="flex justify-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/home.png" alt="">
          <span class="ml-3 sidebar-label font-semibold hidden whitespace-nowrap">Home</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="laporan.php" class="flex justify-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/customer-data.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Customer Account</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="penilaian_petugas.php" class="flex justify-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/work.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Customer Experience</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="material.php" class="flex justify-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/image.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Management Asset</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="data_material.php" class="flex justify-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/folder.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Management Inventory</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="#" class="flex justify-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/user.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">User</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="#" class="flex justify-center">
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
        <img class="h-8 w-8" src="../assets/iconweb/back-button.png" alt="">
        <h1 class="text-3xl font-semibold flex items-center">Data Laporan Gangguan</h1>
      </div>

      <div class="content flex gap-5">

        <div class="left flex-1">
          <table class="w-[1300px] border border-gray-300 rounded-lg overflow-hidden">
            <thead>
              <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2 border-b">No</th>
                <th class="px-4 py-2 border-b">Mulai</th>
                <th class="px-4 py-2 border-b">Selesai</th>
                <th class="px-4 py-2 border-b">Durasi</th>
                <th class="px-4 py-2 border-b">Penyebab</th>
                <th class="px-4 py-2 border-b">Solusi</th>
                <th class="px-4 py-2 border-b">Lokasi</th>
                <th class="px-4 py-2 border-b">Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              include '../config/conn.php';

              $sql = "SELECT * FROM laporan_gangguan ORDER BY id DESC";
              $query = mysqli_query($conn, $sql);
              $no = 1;

              while($row = mysqli_fetch_assoc($query)):
              ?>
              <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100 cursor-pointer">
                  <td class="px-4 py-2 border-b"><?= $no++ ?></td>
                  <td class="px-4 py-2 border-b"><?= $row['mulai'] ?></td>
                  <td class="px-4 py-2 border-b"><?= $row['selesai'] ?></td>
                  <td class="px-4 py-2 border-b text-yellow-600 font-semibold"><?= $row['durasi'] ?> menit</td>
                  <td class="px-4 py-2 border-b"><?= $row['penyebab'] ?></td>
                  <td class="px-4 py-2 border-b"><?= $row['solusi'] ?></td>
                  <td class="px-4 py-2 border-b"><?= $row['lokasi'] ?></td>

                  <td class="px-4 py-2 border-b flex gap-2 items-center">
                      <a href="delete.php?id=<?= $row['id'] ?>">
                          <img class="w-5 h-5" src="../assets/iconweb/delete.png">
                      </a>
                      <a href="laporan.php?edit_id=<?= $row['id'] ?>" class="text-blue-500 hover:text-blue-700">Edit</a>
                  </td>
              </tr>
              <?php endwhile; ?>
            </tbody>

          </table>
        </div>

        <div class="right flex flex-2 flex-col gap-5">
          <div class="top">
            <div class="shadow-md border rounded-lg p-5 w-[500px]">
              <h2 class="font-semibold text-lg mb-4">Upload Laporan Gangguan</h2>
              
              <form action="upload.php" method="POST" class="flex flex-col gap-3">

                  <label class="text-sm font-medium">Mulai Gangguan</label>
                  <input type="datetime-local" name="mulai" class="border border-gray-300 rounded px-3 py-2">

                  <label class="text-sm font-medium">Selesai Gangguan</label>
                  <input type="datetime-local" name="selesai" class="border border-gray-300 rounded px-3 py-2">

                  <input type="text" name="penyebab" class="border border-gray-300 rounded px-3 py-2" placeholder="Penyebab">
                  <input type="text" name="solusi" class="border border-gray-300 rounded px-3 py-2" placeholder="Solusi">
                  <input type="text" name="lokasi" class="border border-gray-300 rounded px-3 py-2" placeholder="Lokasi">

                  <button class="mt-3 bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Upload</button>

              </form>


            </div>
          </div>

          <div class="bot">
            <div class="shadow-md border rounded-lg p-5 w-[500px]">
                <h2 class="font-semibold text-lg mb-4">Edit Laporan Gangguan</h2>

                <?php
                include '../config/conn.php';

                if (isset($_GET['edit_id'])) {
                    $id = $_GET['edit_id'];
                    $query = mysqli_query($conn, "SELECT * FROM laporan_gangguan WHERE id = '$id'");
                    $data = mysqli_fetch_assoc($query);
                } else {
                    $data = null;
                }
                ?>

                <?php if ($data): ?>
                <form method="POST" class="flex flex-col gap-3">

                    <input type="hidden" name="update_id" value="<?= $data['id'] ?>">

                    <input type="datetime-local" 
                          name="mulai"
                          value="<?= date('Y-m-d\TH:i', strtotime($data['mulai'])) ?>"
                          placeholder="Mulai Gangguan"
                          class="border px-3 py-2 rounded">

                    <input type="datetime-local" 
                          name="selesai"
                          value="<?= date('Y-m-d\TH:i', strtotime($data['selesai'])) ?>"
                          placeholder="Selesai Gangguan"
                          class="border px-3 py-2 rounded">

                    <input type="text"
                          name="penyebab"
                          value="<?= $data['penyebab'] ?>"
                          placeholder="Penyebab gangguan"
                          class="border px-3 py-2 rounded">

                    <input type="text"
                          name="solusi"
                          value="<?= $data['solusi'] ?>"
                          placeholder="Solusi penanganan"
                          class="border px-3 py-2 rounded">

                    <input type="text"
                          name="lokasi"
                          value="<?= $data['lokasi'] ?>"
                          placeholder="Lokasi gangguan"
                          class="border px-3 py-2 rounded">

                    <button name="update_submit" class="bg-blue-600 text-white py-2 rounded">
                        Update
                    </button>
                </form>

                <?php else: ?>
                    <p class="text-gray-500 text-sm">Klik tombol Edit pada data untuk mengubah laporan.</p>
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
