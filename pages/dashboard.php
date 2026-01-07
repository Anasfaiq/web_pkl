<?php
require_once "../config/conn.php";

// Top Petugas
$topPetugasQuery = "SELECT nama_petugas_close, 
                          (COUNT(CASE WHEN evd_k3='Ada' THEN 1 END) +
                           COUNT(CASE WHEN evd_summary='Ada' THEN 1 END) +
                           COUNT(CASE WHEN foto_penyebab='Ada' THEN 1 END) +
                           COUNT(CASE WHEN foto_perbaikan='Ada' THEN 1 END) +
                           COUNT(CASE WHEN kesesuaian='Ada' THEN 1 END)) as total_skor
                    FROM penilaian_petugas 
                    GROUP BY nama_petugas_close 
                    ORDER BY total_skor DESC LIMIT 3";
$topPetugasResult = mysqli_query($conn, $topPetugasQuery);
$topPetugas = mysqli_fetch_all($topPetugasResult, MYSQLI_ASSOC);

// Fallback jika tidak ada data
if (empty($topPetugas)) {
  $topPetugas = [
    ['nama_petugas_close' => 'Belum ada data', 'total_skor' => 0],
    ['nama_petugas_close' => 'Belum ada data', 'total_skor' => 0],
    ['nama_petugas_close' => 'Belum ada data', 'total_skor' => 0]
  ];
}

// Total Reports
$totalReportsQuery = "SELECT COUNT(*) as total FROM laporan_gangguan";
$totalReportsResult = mysqli_query($conn, $totalReportsQuery);
$totalReportsData = mysqli_fetch_assoc($totalReportsResult);
$totalReports = $totalReportsData['total'];

// Status berdasarkan jumlah reports
if ($totalReports <= 5) {
  $status = "Bad";
  $statusColor = "red";
  $statusEmoji = "😢";
} elseif ($totalReports <= 10) {
  $status = "Good";
  $statusColor = "green";
  $statusEmoji = "😊";
} else {
  $status = "Excellent";
  $statusColor = "blue";
  $statusEmoji = "🎉";
}

// Current Data Material
$materialQuery = "SELECT COUNT(*) as total FROM foto_material";
$materialResult = mysqli_query($conn, $materialQuery);
$materialData = mysqli_fetch_assoc($materialResult);
$totalMaterial = $materialData['total'];

// Chart Penilaian Petugas (SBU)
$chartPetugasQuery = "SELECT sbu, COUNT(*) as jumlah FROM penilaian_petugas GROUP BY sbu";
$chartPetugasResult = mysqli_query($conn, $chartPetugasQuery);
$chartPetugasData = [];
while($row = mysqli_fetch_assoc($chartPetugasResult)) {
  $chartPetugasData[] = $row;
}

// Pie Chart Data Komplain (dari nama_mitra)
$pieChartQuery = "SELECT nama_mitra, COUNT(*) as jumlah FROM penilaian_petugas GROUP BY nama_mitra LIMIT 5";
$pieChartResult = mysqli_query($conn, $pieChartQuery);
$pieChartData = [];
while($row = mysqli_fetch_assoc($pieChartResult)) {
  $pieChartData[] = $row;
}

// Data Material untuk tabel
$materialTableQuery = "SELECT * FROM foto_material LIMIT 5";
$materialTableResult = mysqli_query($conn, $materialTableQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
<body class="flex min-h-screen bg-gray-100">

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
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Material</span>
        </a>
      </li>

      <li class="p-2 pl-5 w-full flex justify-center cursor-pointer sidebar-item
                hover:bg-[#7b61ff33] hover:scale-[1.03] transition-all duration-200 ease-out">
        <a href="#" class="flex justify-center items-center">
          <img class="h-8 w-8 invert brightness-0" src="../assets/iconweb/folder.png" alt="">
          <span class="ml-3 sidebar-label hidden whitespace-nowrap">Folder</span>
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


  
  <!-- main -->
  <div class="main flex flex-col justify-start items-center flex-1 min-h-screen bg-gray-100 pl-24 my-14 transition-all duration-300">
    <div class="flex w-[1700px] mb-5">
      <h1 class="text-3xl font-semibold justify-start items-start">Dashboard</h1>
    </div>

    <div class="grid grid-cols-[1fr_1fr_minmax(320px,390px)] w-[1700px] gap-5">

      <!-- row 2 -->
      <div class="border-1 border-gray-300 bg-white rounded-lg shadow-md w-auto px-3 pb-3 h-60">

        <!-- Judul -->
        <div class="flex items-center justify-center gap-3 mb-4 relative">
          <h1 class="text-2xl font-bold text-yellow-600 text-center leading-snug">
            Top Petugas <br>
            <span class="text-sm font-semibold text-yellow-500">This Month!</span>
          </h1>
          <img src="../assets/iconweb/trophy.png" class="w-12 h-12 absolute right-[160px]" alt="Trophy">
        </div>

        <div class="flex flex-col items-start gap-3">
          <?php
          $colors = [
            ['gradientFrom' => '#f87171', 'gradientTo' => '#ef4444', 'textColor' => '#dc2626'],
            ['gradientFrom' => '#fdba74', 'gradientTo' => '#fb923c', 'textColor' => '#f97316'],
            ['gradientFrom' => '#fcd34d', 'gradientTo' => '#fbbf24', 'textColor' => '#f59e0b']
          ];
          $positions = ['1st', '2nd', '3rd'];
          $widths = ['360px', '420px', '480px'];
          
          // Pastikan selalu ada 3 item
          while (count($topPetugas) < 3) {
            $topPetugas[] = ['nama_petugas_close' => '-', 'total_skor' => 0];
          }
          
          foreach($topPetugas as $index => $petugas):
            if ($index >= 3) break;
            $color = $colors[$index];
            $position = $positions[$index];
            $width = $widths[$index];
          ?>
          <div class="relative text-white rounded-md px-4 py-2 flex justify-between items-center shadow" 
               style="width: <?= $width ?>; background: linear-gradient(to right, <?= $color['gradientFrom'] ?>, <?= $color['gradientTo'] ?>);">
            <span class="font-bold"><?= $position ?></span>
            <span class="font-semibold"><?= htmlspecialchars($petugas['nama_petugas_close']) ?></span>
            <span class="absolute font-bold" style="right: -95px; color: <?= $color['textColor'] ?>;"><?= $petugas['total_skor'] ?> Points!</span>
          </div>
          <?php endforeach; ?>
        </div>

      </div>

      <div class="border-1 border-gray-300 bg-white rounded-lg shadow-md w-auto px-10 py-5 h-60 flex flex-col">

        <!-- Judul & Status -->
        <div class="flex justify-between items-center">
          <span class="text-2xl font-semibold">Total of Reports This Month!</span>
          <span class="text-<?= $statusColor ?> -500 font-bold text-3xl"><?= $status ?></span>
        </div>

        <!-- Icon + Angka -->
        <div class="flex items-center py-12 gap-6">
          <span class="text-6xl"><?= $statusEmoji ?></span>
          <span class="text-5xl font-bold text-<?= $statusColor ?>-500"><?= $totalReports ?> Reports</span>
        </div>

      </div>


      <div class="border-1 border-gray-300 bg-white rounded-lg shadow-md w-auto p-5 h-60 flex flex-col">

        <!-- Judul -->
        <h1 class="font-semibold text-2xl">Current Data Material</h1>

        <!-- Icon + Angka -->
        <div class="flex justify-center py-12 items-center gap-3">
          <img class="w-16 h-16" src="../assets/iconweb/folder-color.png" alt="">
          <span class="text-5xl font-bold text-blue-600"><?= $totalMaterial ?> Data</span>
        </div>

      </div>



      <!-- row 3 -->
      <div class="border-1 border-gray-300 bg-white rounded-lg shadow-md w-auto p-5 h-80 relative">
        <h2 class="font-semibold text-lg mb-4 absolute top-5 left-5">Chart Penilaian Petugas</h2>
        <div style="padding-top: 50px; height: 100%;">
          <canvas id="chartPetugas"></canvas>
        </div>
      </div>

      <div class="border-1 border-gray-300 bg-white rounded-lg shadow-md w-auto p-5 h-80 relative">
        <h2 class="font-semibold text-lg mb-4 absolute top-5 left-5">Data Komplain</h2>
        <div style="padding-top: 50px; height: 100%;" class="flex justify-center items-center">
          <div style="width: 250px; height: 200px;">
            <canvas id="pieChartKomplain"></canvas>
          </div>
        </div>
      </div>

      <div class="row-span-2 border-1 border-gray-300 bg-white rounded-lg shadow-md w-auto p-5 h-auto bg-[linear-gradient(135deg,_#4949ec_0%,_#643fc0_50%,_#a8abff_100%)]">
      </div>

      <!-- row 4 -->
      <div class="col-span-2 border-1 border-gray-300 bg-white rounded-lg shadow-md w-auto p-5">
        <h2 class="font-semibold text-lg mb-4">Data Material</h2>
        <div class="overflow-x-auto">
          <table class="w-full rounded-lg border-collapse overflow-hidden shadow-md">
            <thead>
              <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2 border-b">No</th>
                <th class="px-4 py-2 border-b">Nomor Material</th>
                <th class="px-4 py-2 border-b">Nama</th>
                <th class="px-4 py-2 border-b">Detail</th>
                <th class="px-4 py-2 border-b">Foto</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              while ($row = mysqli_fetch_assoc($materialTableResult)):
              ?>
              <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                <td class="px-4 py-2 border-b"><?= $no++ ?></td>
                <td class="px-4 py-2 border-b"><?= $row['nomor_material'] ?></td>
                <td class="px-4 py-2 border-b"><?= $row['nama'] ?></td>
                <td class="px-4 py-2 border-b"><?= $row['detail'] ?></td>
                <td class="px-4 py-2 border-b">
                  <?php if (!empty($row['foto'])): ?>
                    <img src="../assets/<?= $row['foto'] ?>" alt="Foto" class="w-12 h-12 object-cover rounded">
                  <?php else: ?>
                    <span class="text-gray-400">-</span>
                  <?php endif; ?>
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

    // Chart Penilaian Petugas
    const chartPetugasCtx = document.getElementById('chartPetugas').getContext('2d');
    const chartPetugasData = <?php echo json_encode($chartPetugasData); ?>;
    
    const sbuLabels = chartPetugasData.map(item => item.sbu);
    const sbuValues = chartPetugasData.map(item => item.jumlah);

    new Chart(chartPetugasCtx, {
      type: 'bar',
      data: {
        labels: sbuLabels,
        datasets: [{
          label: 'Jumlah Penilaian',
          data: sbuValues,
          backgroundColor: 'rgba(75, 192, 192, 0.7)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: {
            display: true,
            position: 'top'
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Pie Chart Data Komplain
    const pieChartCtx = document.getElementById('pieChartKomplain').getContext('2d');
    const pieChartData = <?php echo json_encode($pieChartData); ?>;
    
    const mitraLabels = pieChartData.map(item => item.nama_mitra);
    const mitraValues = pieChartData.map(item => item.jumlah);

    const colors = [
      'rgba(255, 99, 132, 0.7)',
      'rgba(54, 162, 235, 0.7)',
      'rgba(255, 206, 86, 0.7)',
      'rgba(75, 192, 192, 0.7)',
      'rgba(153, 102, 255, 0.7)'
    ];

    new Chart(pieChartCtx, {
      type: 'doughnut',
      data: {
        labels: mitraLabels,
        datasets: [{
          data: mitraValues,
          backgroundColor: colors.slice(0, mitraValues.length),
          borderColor: colors.slice(0, mitraValues.length),
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: {
            display: true,
            position: 'bottom'
          }
        }
      }
    });
  </script>

</body>
</html>
