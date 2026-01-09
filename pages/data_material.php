<?php
require_once "../config/conn.php";

// Handle Insert
if (isset($_POST['add_submit'])) {
  $kode = $_POST['kode'];
  $nama = $_POST['nama'];
  $kondisi = $_POST['kondisi'];
  $zona = $_POST['zona'];
  $rak = $_POST['rak'];

  $sql = "INSERT INTO data_material (kode, nama, kondisi, zona, rak)
          VALUES ('$kode', '$nama', '$kondisi', '$zona', '$rak')";
  
  mysqli_query($conn, $sql);
  header("Location: data_material.php");
  exit;
}

// Handle Update
if (isset($_POST['update_submit'])) {
  $id = $_POST['update_id'];
  $kode = $_POST['kode'];
  $nama = $_POST['nama'];
  $kondisi = $_POST['kondisi'];
  $zona = $_POST['zona'];
  $rak = $_POST['rak'];

  $sql = "UPDATE data_material 
          SET kode='$kode', nama='$nama', kondisi='$kondisi', zona='$zona', rak='$rak'
          WHERE id='$id'";

  mysqli_query($conn, $sql);
  header("Location: data_material.php");
  exit;
}

$query = "SELECT * FROM data_material ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tulip Group | Data Material</title>
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
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Material</span>
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
        <a href="../config/logout.php" class="flex justify-center items-center">
          <img class="h-7 w-7 invert brightness-0" src="../assets/iconweb/logout.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Log Out</span>
        </a>
      </li>

    </ul>
  </div>

  <!-- main content -->
  <div class="main flex justify-center items-center flex-1 min-h-screen bg-gray-100 pl-24 transition-all duration-300">
    
    <!-- card -->
    <div class="card min-h-screen rounded-lg shadow-xl m-10 p-7 w-full relative">
      <div class="flex items-center justify-between gap-5 mb-7">
        <div class="flex items-center gap-5">
          <a href="dashboard.php">
            <img class="h-8 w-8" src="../assets/iconweb/back-button.png" alt="">
          </a>
          <h1 class="text-3xl font-semibold">Data Material</h1>
        </div>
        <button id="addBtn" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition duration-200">
          + Tambah Data
        </button>
      </div>
    
      <div class="content">
        <div class="left">
          <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
            <thead>
              <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2 border-b">No</th>
                <th class="px-4 py-2 border-b">Kode</th>
                <th class="px-4 py-2 border-b">Nama</th>
                <th class="px-4 py-2 border-b">Kondisi</th>
                <th class="px-4 py-2 border-b">Zona</th>
                <th class="px-4 py-2 border-b">Rak</th>
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
                <td class="px-4 py-2 border-b"><?php echo $no; ?></td>
                <td class="px-4 py-2 border-b"><?php echo htmlspecialchars($row['kode']); ?></td>
                <td class="px-4 py-2 border-b"><?php echo htmlspecialchars($row['nama']); ?></td>
                <td class="px-4 py-2 border-b">
                  <span class="px-3 py-1 rounded text-white text-sm
                    <?php 
                      if ($row['kondisi'] == 'Baik') echo 'bg-green-500';
                      elseif ($row['kondisi'] == 'Dismantile') echo 'bg-red-500';
                      elseif ($row['kondisi'] == 'Rekondisi') echo 'bg-yellow-500';
                      else echo 'bg-gray-500';
                    ?>">
                    <?php echo htmlspecialchars($row['kondisi']); ?>
                  </span>
                </td>
                <td class="px-4 py-2 border-b font-semibold"><?php echo htmlspecialchars($row['zona']); ?></td>
                <td class="px-4 py-2 border-b"><?php echo htmlspecialchars($row['rak']); ?></td>
                <td class="px-4 py-2 border-b">
                  <button class="editBtn text-blue-600 hover:text-blue-800 font-semibold mr-3" data-id="<?php echo $row['id']; ?>">
                    Edit
                  </button>
                  <button class="deleteBtn text-red-600 hover:text-red-800 font-semibold" data-id="<?php echo $row['id']; ?>">
                    Hapus
                  </button>
                </td>
              </tr>
              <?php $no++; endwhile; ?>
            </tbody>

          </table>
        </div>
      </div>
    </div>

  </div>

  <!-- Modal Add/Edit -->
  <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-8 w-full max-w-2xl max-h-[90vh] overflow-y-auto">
      <div class="flex justify-between items-center mb-6">
        <h2 id="modalTitle" class="text-2xl font-semibold">Tambah Data Material</h2>
        <button id="closeModal" class="text-gray-500 hover:text-gray-700">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <form id="dataForm" method="POST" class="space-y-4">
        <input type="hidden" id="updateId" name="update_id">

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Kode</label>
          <input type="text" name="kode" id="kode" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
          <input type="text" name="nama" id="nama" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
          <select name="kondisi" id="kondisi" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <option value="">-- Pilih Kondisi --</option>
            <option value="Baik">Baik</option>
            <option value="Dismantile">Dismantile</option>
            <option value="Rekondisi">Rekondisi</option>
            <option value="Ex project">Ex project</option>
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Zona</label>
          <select name="zona" id="zona" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <option value="">-- Pilih Zona --</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Rak</label>
          <select name="rak" id="rak" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <option value="">-- Pilih Rak --</option>
            <option value="Level 1">Level 1</option>
            <option value="Level 2">Level 2</option>
            <option value="Level 3">Level 3</option>
            <option value="Level 4">Level 4</option>
          </select>
        </div>

        <div class="flex gap-3 pt-4">
          <button type="submit" id="submitBtn" name="add_submit" class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Simpan
          </button>
          <button type="button" id="cancelBtn" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition">
            Batal
          </button>
        </div>
      </form>
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
          requestAnimationFrame(() => {
            label.classList.add('show');
          });
        } else {
          label.classList.remove('show');
          setTimeout(() => {
            label.classList.add('hidden');
          }, 250);
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
      modalTitle.textContent = 'Tambah Data Material';
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
        const id = this.getAttribute('data-id');
        fetch('get_data_material.php?id=' + id)
          .then(response => response.json())
          .then(data => {
            document.getElementById('kode').value = data.kode;
            document.getElementById('nama').value = data.nama;
            document.getElementById('kondisi').value = data.kondisi;
            document.getElementById('zona').value = data.zona;
            document.getElementById('rak').value = data.rak;
            updateId.value = data.id;
            
            modalTitle.textContent = 'Edit Data Material';
            submitBtn.textContent = 'Update';
            submitBtn.name = 'update_submit';
            modal.classList.remove('hidden');
          });
      });
    });

    // Delete Button
    document.querySelectorAll('.deleteBtn').forEach(btn => {
      btn.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
          window.location.href = 'delete_data_material.php?id=' + id;
        }
      });
    });
  </script>

</body>
</html>
