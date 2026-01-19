<?php
require_once "../config/conn.php";

// Handle Insert
if (isset($_POST['add_submit'])) {
  $tanggal_cek = $_POST['tanggal_cek'];
  $tanggal_insiden = $_POST['tanggal_insiden'];
  $nama_mitra = $_POST['nama_mitra'];
  $nama_petugas_close = $_POST['nama_petugas_close'];
  $sbu = $_POST['sbu'];
  $kp = $_POST['kp'];
  $penyebab = $_POST['penyebab'];
  $evd_k3 = $_POST['evd_k3'];
  $evd_summary = $_POST['evd_summary'];
  $foto_penyebab = $_POST['foto_penyebab'];
  $foto_perbaikan = $_POST['foto_perbaikan'];
  $kesesuaian = $_POST['kesesuaian'];

  $sql = "INSERT INTO penilaian_petugas 
          (tanggal_cek, tanggal_insiden, nama_mitra, nama_petugas_close, sbu, kp, penyebab, evd_k3, evd_summary, foto_penyebab, foto_perbaikan, kesesuaian)
          VALUES ('$tanggal_cek', '$tanggal_insiden', '$nama_mitra', '$nama_petugas_close', '$sbu', '$kp', '$penyebab', '$evd_k3', '$evd_summary', '$foto_penyebab', '$foto_perbaikan', '$kesesuaian')";

  mysqli_query($conn, $sql);
  header("Location: penilaian_petugas.php");
  exit;
}

// Handle Update
if (isset($_POST['update_submit'])) {
  $id = $_POST['update_id'];
  $tanggal_cek = $_POST['tanggal_cek'];
  $tanggal_insiden = $_POST['tanggal_insiden'];
  $nama_mitra = $_POST['nama_mitra'];
  $nama_petugas_close = $_POST['nama_petugas_close'];
  $sbu = $_POST['sbu'];
  $kp = $_POST['kp'];
  $penyebab = $_POST['penyebab'];
  $evd_k3 = $_POST['evd_k3'];
  $evd_summary = $_POST['evd_summary'];
  $foto_penyebab = $_POST['foto_penyebab'];
  $foto_perbaikan = $_POST['foto_perbaikan'];
  $kesesuaian = $_POST['kesesuaian'];

  $sql = "UPDATE penilaian_petugas 
          SET tanggal_cek='$tanggal_cek',
              tanggal_insiden='$tanggal_insiden',
              nama_mitra='$nama_mitra',
              nama_petugas_close='$nama_petugas_close',
              sbu='$sbu',
              kp='$kp',
              penyebab='$penyebab',
              evd_k3='$evd_k3',
              evd_summary='$evd_summary',
              foto_penyebab='$foto_penyebab',
              foto_perbaikan='$foto_perbaikan',
              kesesuaian='$kesesuaian'
          WHERE id='$id'";

  mysqli_query($conn, $sql);
  header("Location: penilaian_petugas.php");
  exit;
}

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
  <title>Tulip Group | Work</title>
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
        <a href="dashboard.php" class="flex justify-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/home.png" alt="">
          <span class="ml-3 sidebar-label font-semibold hidden whitespace-nowrap">Home</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="laporan.php" class="flex justify-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/customer-data.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Customer Data</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="penilaian_petugas.php" class="flex justify-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/work.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Work</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="material.php" class="flex justify-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/image.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Foto Material</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="data_material.php" class="flex justify-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/folder.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Data Material</span>
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
    <div class="card min-h-screen rounded-lg shadow-xl m-10 p-7 w-auto relative">
      <div class="flex items-center justify-between gap-5 mb-7">
        <div class="flex items-center gap-5">
          <a href="dashboard.php">
            <img class="h-8 w-8" src="../assets/iconweb/back-button.png" alt="">
          </a>
          <h1 class="text-3xl font-semibold flex items-center">Penilaian Petugas</h1>
        </div>
        <button id="addBtn" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition duration-200">
          + Tambah Data
        </button>
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
                    <button class="deleteBtn" data-id="<?= $row['id'] ?>">
                      <img src="../assets/iconweb/delete.png" class="w-5 h-5 cursor-pointer">
                    </button>
                    <button class="editBtn" data-id="<?= $row['id'] ?>" class="text-blue-500 hover:text-blue-700 transition duration-200">
                      Edit
                    </button>
                  </div>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>

        </div>

      </div>
    </div>

    <!-- Modal Add/Edit -->
    <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg p-8 w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
          <h2 id="modalTitle" class="text-2xl font-semibold">Tambah Data Penilaian</h2>
          <button id="closeModal" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>

        <form id="dataForm" method="POST" class="space-y-4">
          <input type="hidden" id="updateId" name="update_id">
          
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium mb-1">Tanggal Cek</label>
              <input type="date" name="tanggal_cek" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Tanggal Insiden</label>
              <input type="date" name="tanggal_insiden" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Nama Mitra</label>
              <input type="text" name="nama_mitra" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Nama Petugas Close</label>
              <input type="text" name="nama_petugas_close" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">SBU</label>
              <select name="sbu" class="w-full border border-gray-300 rounded px-3 py-2" required>
                <option value="">Pilih SBU</option>
                <option value="RBNT">RBNT</option>
                <option value="RJBB">RJBB</option>
                <option value="RJBT">RJBT</option>
                <option value="RJKB">RJKB</option>
                <option value="RJTG">RJTG</option>
                <option value="RKLM">RKLM</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">KP</label>
              <input type="text" name="kp" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <div class="col-span-2">
              <label class="block text-sm font-medium mb-1">Penyebab</label>
              <input type="text" name="penyebab" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Evd K3</label>
              <select name="evd_k3" class="w-full border border-gray-300 rounded px-3 py-2" required>
                <option value="">Pilih</option>
                <option value="Ada">Ada</option>
                <option value="Tidak ada">Tidak ada</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Evd Summary</label>
              <select name="evd_summary" class="w-full border border-gray-300 rounded px-3 py-2" required>
                <option value="">Pilih</option>
                <option value="Ada">Ada</option>
                <option value="Tidak ada">Tidak ada</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Foto Penyebab</label>
              <select name="foto_penyebab" class="w-full border border-gray-300 rounded px-3 py-2" required>
                <option value="">Pilih</option>
                <option value="Ada">Ada</option>
                <option value="Tidak ada">Tidak ada</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Foto Perbaikan</label>
              <select name="foto_perbaikan" class="w-full border border-gray-300 rounded px-3 py-2" required>
                <option value="">Pilih</option>
                <option value="Ada">Ada</option>
                <option value="Tidak ada">Tidak ada</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Kesesuaian</label>
              <select name="kesesuaian" class="w-full border border-gray-300 rounded px-3 py-2" required>
                <option value="">Pilih</option>
                <option value="Ada">Ada</option>
                <option value="Tidak ada">Tidak ada</option>
              </select>
            </div>
          </div>

          <div class="flex gap-3 justify-end mt-6">
            <button type="button" id="cancelBtn" class="px-5 py-2 border border-gray-300 rounded hover:bg-gray-100">Batal</button>
            <button type="submit" id="submitBtn" class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
          </div>
        </form>
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

    // Modal CRUD
    const modal = document.getElementById('modal');
    const addBtn = document.getElementById('addBtn');
    const closeModal = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const dataForm = document.getElementById('dataForm');
    const modalTitle = document.getElementById('modalTitle');
    const submitBtn = document.getElementById('submitBtn');
    const updateId = document.getElementById('updateId');

    // Open Modal for Add
    addBtn.addEventListener('click', () => {
      modal.classList.remove('hidden');
      modalTitle.textContent = 'Tambah Data Penilaian';
      submitBtn.textContent = 'Simpan';
      submitBtn.name = 'add_submit';
      updateId.value = '';
      dataForm.reset();
    });

    // Close Modal
    closeModal.addEventListener('click', () => modal.classList.add('hidden'));
    cancelBtn.addEventListener('click', () => modal.classList.add('hidden'));

    // Close Modal when clicking outside
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.add('hidden');
      }
    });

    // Edit Button
    document.querySelectorAll('.editBtn').forEach(btn => {
      btn.addEventListener('click', function() {
        const id = this.dataset.id;
        
        // Fetch data dari server
        fetch(`get_penilaian.php?id=${id}`)
          .then(res => res.json())
          .then(data => {
            document.querySelector('input[name="tanggal_cek"]').value = data.tanggal_cek;
            document.querySelector('input[name="tanggal_insiden"]').value = data.tanggal_insiden;
            document.querySelector('input[name="nama_mitra"]').value = data.nama_mitra;
            document.querySelector('input[name="nama_petugas_close"]').value = data.nama_petugas_close;
            document.querySelector('select[name="sbu"]').value = data.sbu;
            document.querySelector('input[name="kp"]').value = data.kp;
            document.querySelector('input[name="penyebab"]').value = data.penyebab;
            document.querySelector('select[name="evd_k3"]').value = data.evd_k3;
            document.querySelector('select[name="evd_summary"]').value = data.evd_summary;
            document.querySelector('select[name="foto_penyebab"]').value = data.foto_penyebab;
            document.querySelector('select[name="foto_perbaikan"]').value = data.foto_perbaikan;
            document.querySelector('select[name="kesesuaian"]').value = data.kesesuaian;

            updateId.value = data.id;
            modalTitle.textContent = 'Edit Data Penilaian';
            submitBtn.textContent = 'Update';
            submitBtn.name = 'update_submit';

            modal.classList.remove('hidden');
          });
      });
    });

    // Delete Button
    document.querySelectorAll('.deleteBtn').forEach(btn => {
      btn.addEventListener('click', function() {
        const id = this.dataset.id;
        if (confirm('Yakin ingin menghapus data ini?')) {
          window.location.href = `delete_penilaian.php?id=${id}`;
        }
      });
    });
  </script>

</body>
</html>