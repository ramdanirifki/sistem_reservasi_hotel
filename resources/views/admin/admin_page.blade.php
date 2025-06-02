<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Garut Indah</title>
  <link rel="icon" href="/src/img/logo.png" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .sidebar {
      transition: all 0.3s;
    }
    .sidebar.collapsed {
      width: 80px;
    }
    .sidebar.collapsed .nav-text {
      display: none;
    }
    .content {
      transition: all 0.3s;
    }
    .content.expanded {
      margin-left: 80px;
    }
  </style>
</head>

<body class="bg-gray-100" style="font-family: 'Poppins', sans-serif;">
  <!-- Admin Layout -->
  <div class="flex h-screen">
    <!-- Sidebar -->
    <div class="sidebar bg-[#1b1f58] text-white w-64 fixed h-full overflow-y-auto">
      <div class="px-4 flex items-center justify-between border-b border-white/20">
        <div class="flex items-center">
          <img src="/src/img/logo.png" alt="Logo" class="py-[2px] w-14 h-auto">
          <span class="ml-3 font-bold">Admin Panel</span>
        </div>
      </div>
      <nav class="mt-4">
        <div class="px-4 py-2 text-sm uppercase text-white/50">Main Menu</div>
        <a href="/admin/dashboard" class="flex items-center px-4 py-3 bg-[#101547] text-white">
          <i class="fas fa-tachometer-alt w-6"></i>
          <span class="nav-text ml-3">Dashboard</span>
        </a>
        <a href="/admin/manajemen-kamar" class="flex items-center px-4 py-3 text-white hover:bg-[#101547]">
          <i class="fas fa-bed w-6"></i>
          <span class="nav-text ml-3">Manajemen Kamar</span>
        </a>
        <a href="/admin/reservasi" class="flex items-center px-4 py-3 text-white hover:bg-[#101547]">
          <i class="fas fa-calendar-check w-6"></i>
          <span class="nav-text ml-3">Reservasi</span>
        </a>
        <a href="/admin/pelanggan" class="flex items-center px-4 py-3 text-white hover:bg-[#101547]">
          <i class="fas fa-users w-6"></i>
          <span class="nav-text ml-3">Pelanggan</span>
        </a>
        <a href="" class="flex items-center px-4 py-3 text-white hover:bg-[#101547]">
          <i class="fas fa-sign-out-alt w-6"></i>
          <span class="nav-text ml-3">Log Out</span>
        </a>
      </nav>
    </div>

    <!-- Main Content -->
    <div class="content ml-64 flex-1 overflow-y-auto">
      <!-- Top Navigation -->
      <header class="bg-white shadow-sm">
        <div class="flex justify-between items-center p-4">
          <h1 class="text-xl font-bold text-gray-800">Dashboard</h1>
          <div class="flex items-center space-x-4">
            <div class="relative">
              <i class="fas fa-bell text-gray-600"></i>
              <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
            </div>
            <div class="flex items-center">
              <span class="ml-2 text-gray-700">Admin</span>
            </div>
          </div>
        </div>
      </header>

      <!-- Dashboard Content -->
      <main class="p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-bed"></i>
              </div>
              <div class="ml-4">
                <p class="text-sm text-gray-500">Total Kamar</p>
                <p class="text-2xl font-bold">42</p>
              </div>
            </div>
          </div>
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-calendar-check"></i>
              </div>
              <div class="ml-4">
                <p class="text-sm text-gray-500">Reservasi Hari Ini</p>
                <p class="text-2xl font-bold">8</p>
              </div>
            </div>
          </div>
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-users"></i>
              </div>
              <div class="ml-4">
                <p class="text-sm text-gray-500">Pelanggan Baru</p>
                <p class="text-2xl font-bold">5</p>
              </div>
            </div>
          </div>
          <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="p-3 rounded-full bg-red-100 text-red-600">
                <i class="fas fa-exclamation-circle"></i>
              </div>
              <div class="ml-4">
                <p class="text-sm text-gray-500">Pembatalan</p>
                <p class="text-2xl font-bold">2</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Reservations -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
          <div class="p-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Reservasi Terbaru</h2>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kamar</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-In</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-Out</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#RESV001</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Budi Santoso</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Deluxe Room</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15 Jun 2023</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">18 Jun 2023</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Confirmed</span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="#" class="text-blue-600 hover:text-blue-900">Detail</a>
                  </td>
                </tr>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#RESV002</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Ani Wijaya</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Superior Room</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">16 Jun 2023</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">19 Jun 2023</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="#" class="text-blue-600 hover:text-blue-900">Detail</a>
                  </td>
                </tr>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#RESV003</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Citra Dewi</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Standard Room</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">17 Jun 2023</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20 Jun 2023</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="#" class="text-blue-600 hover:text-blue-900">Detail</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Room Availability -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-4 border-b border-gray-200">
              <h2 class="text-lg font-semibold text-gray-800">Ketersediaan Kamar</h2>
            </div>
            <div class="p-4">
              <div class="mb-4">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Standard Room</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                  <div class="bg-blue-600 h-2.5 rounded-full" style="width: 75%"></div>
                </div>
                <div class="flex justify-between text-xs text-gray-500 mt-1">
                  <span>15/20 tersedia</span>
                  <span>75%</span>
                </div>
              </div>
              <div class="mb-4">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Superior Room</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                  <div class="bg-green-600 h-2.5 rounded-full" style="width: 50%"></div>
                </div>
                <div class="flex justify-between text-xs text-gray-500 mt-1">
                  <span>10/20 tersedia</span>
                  <span>50%</span>
                </div>
              </div>
              <div>
                <h3 class="text-sm font-medium text-gray-500 mb-2">Deluxe Room</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                  <div class="bg-yellow-600 h-2.5 rounded-full" style="width: 25%"></div>
                </div>
                <div class="flex justify-between text-xs text-gray-500 mt-1">
                  <span>5/20 tersedia</span>
                  <span>25%</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Recent Activities -->
          <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-4 border-b border-gray-200">
              <h2 class="text-lg font-semibold text-gray-800">Aktivitas Terkini</h2>
            </div>
            <div class="p-4">
              <div class="flex items-start pb-4 mb-4 border-b border-gray-100">
                <div class="flex-shrink-0">
                  <div class="flex items-center justify-center h-8 w-8 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-calendar-plus text-sm"></i>
                  </div>
                </div>
                <div class="ml-3">
                  <p class="text-sm font-medium text-gray-900">Reservasi baru dibuat</p>
                  <p class="text-sm text-gray-500">Budi Santoso memesan kamar Deluxe untuk 3 malam</p>
                  <p class="text-xs text-gray-400 mt-1">10 menit yang lalu</p>
                </div>
              </div>
              <div class="flex items-start pb-4 mb-4 border-b border-gray-100">
                <div class="flex-shrink-0">
                  <div class="flex items-center justify-center h-8 w-8 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-check text-sm"></i>
                  </div>
                </div>
                <div class="ml-3">
                  <p class="text-sm font-medium text-gray-900">Reservasi dikonfirmasi</p>
                  <p class="text-sm text-gray-500">Ani Wijaya mengkonfirmasi pembayaran</p>
                  <p class="text-xs text-gray-400 mt-1">1 jam yang lalu</p>
                </div>
              </div>
              <div class="flex items-start">
                <div class="flex-shrink-0">
                  <div class="flex items-center justify-center h-8 w-8 rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-times text-sm"></i>
                  </div>
                </div>
                <div class="ml-3">
                  <p class="text-sm font-medium text-gray-900">Reservasi dibatalkan</p>
                  <p class="text-sm text-gray-500">Citra Dewi membatalkan reservasi kamar Standard</p>
                  <p class="text-xs text-gray-400 mt-1">3 jam yang lalu</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</body>

</html>