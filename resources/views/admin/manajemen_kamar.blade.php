@if(!session('email') && !session('password'))
    <script>
        alert("Anda belum login");
        window.location.href = '/admin/login';
    </script>
@endif

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Kamar - Garut Indah</title>
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

    .room-image {
      height: 180px;
      object-fit: cover;
      object-position: center bottom;
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
        <button id="toggle-sidebar" class="text-white">
          <i class="fas fa-bars"></i>
        </button>
      </div>
      <nav class="mt-4">
        <div class="px-4 py-2 text-sm uppercase text-white/50">Main Menu</div>
        <a href="/admin/dashboard" class="flex items-center px-4 py-3 text-white hover:bg-[#101547]">
          <i class="fas fa-tachometer-alt w-6"></i>
          <span class="nav-text ml-3">Dashboard</span>
        </a>
        <a href="/admin/manajemen-kamar" class="flex items-center px-4 py-3 bg-[#101547] text-white">
          <i class="fas fa-bed w-6"></i>
          <span class="nav-text ml-3">Manajemen Kamar</span>
        </a>
        <a href="/admin/reservasi" class="flex items-center px-4 py-3 text-white hover:bg-[#101547]">
          <i class="fas fa-calendar-check w-6"></i>
          <span class="nav-text ml-3">Reservasi</span>
        </a>
        <a href="/admin/pembayaran" class="flex items-center px-4 py-3 text-white hover:bg-[#101547]">
          <i class="fas fa-credit-card w-6"></i>
          <span class="nav-text ml-3">Pembayaran</span>
        </a>
        <a href="/admin/tamu" class="flex items-center px-4 py-3 text-white hover:bg-[#101547]">
          <i class="fas fa-users w-6"></i>
          <span class="nav-text ml-3">Tamu</span>
        </a>
        <form action="/admin/logout" method="post">
          @csrf
          <div>
            <button type="submit" class="flex items-center px-4 py-3 text-white hover:bg-[#101547] w-full">
            <i class="fas fa-sign-out-alt w-6"></i>
            <span class="nav-text ml-3">Log Out</span>
          </button>
          </div>
        </form>
      </nav>
    </div>

    <!-- Main Content -->
    <div class="content ml-64 flex-1 overflow-y-auto">
      <!-- Top Navigation -->
      <header class="bg-white shadow-sm">
        <div class="flex justify-between items-center p-4">
          <h1 class="text-xl font-bold text-gray-800">Manajemen Kamar</h1>
          <div class="flex items-center space-x-4">
          
            <div class="flex items-center">
              <span class="ml-2 text-gray-700">Admin</span>
            </div>
          </div>
        </div>
      </header>

      <!-- Main Content -->
      <main class="p-6">
        <!-- Header and Add Button -->
        <div class="flex justify-between items-center mb-6">
          <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Kamar</h2>
            <p class="text-gray-600">Kelola semua jenis kamar yang tersedia</p>
          </div>
          <button id="addRoomButton" class="bg-[#1b1f58] hover:bg-[#101547] text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Tambah Kamar
          </button>
        </div>

        <!-- Filter and Search -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Cari Kamar</label>
              <div class="relative">
                <input type="text"
                  class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-[#1b1f58] focus:border-[#1b1f58]"
                  placeholder="Nomor kamar atau nama...">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Kamar</label>
              <select
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#1b1f58] focus:border-[#1b1f58]">
                <option value="">Semua Tipe</option>
                <option value="standard">Standard</option>
                <option value="superior">Superior</option>
                <option value="deluxe">Deluxe</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
              <select
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#1b1f58] focus:border-[#1b1f58]">
                <option value="">Semua Status</option>
                <option value="available">Tersedia</option>
                <option value="occupied">Terisi</option>
                <option value="maintenance">Perawatan</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Room List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
          <!-- Room Card 1 -->
          <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="relative">
              <img src="/src/img/rooms/kamar1.png" alt="Deluxe Room" class="w-full room-image">
              <div class="absolute top-2 right-2 bg-[#1b1f58] text-white text-xs px-2 py-1 rounded">Deluxe</div>
            </div>
            <div class="p-4">
              <div class="flex justify-between items-start">
                <div>
                  <h3 class="text-lg font-bold text-gray-800">Kamar Deluxe 301</h3>
                  <p class="text-gray-600 text-sm">Lantai 3</p>
                </div>
                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Tersedia</span>
              </div>
              <div class="mt-3 flex items-center text-yellow-400">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span class="text-gray-500 text-sm ml-1">4.5 (32 reviews)</span>
              </div>
              <div class="mt-3">
                <p class="text-gray-700"><i class="fas fa-wifi text-gray-500 mr-2"></i> Free WiFi</p>
                <p class="text-gray-700"><i class="fas fa-tv text-gray-500 mr-2"></i> TV LED 56"</p>
                <p class="text-gray-700"><i class="fas fa-snowflake text-gray-500 mr-2"></i> AC</p>
              </div>
              <div class="mt-4 flex justify-between items-center">
                <div>
                  <p class="text-gray-500 text-sm">Harga per malam</p>
                  <p class="text-lg font-bold text-[#1b1f58]">Rp 850.000</p>
                </div>
                <div class="flex space-x-2">
                  <button class="p-2 text-blue-600 hover:bg-blue-100 rounded-full">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="p-2 text-red-600 hover:bg-red-100 rounded-full">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Room Card 2 -->
          <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="relative">
              <img src="/src/img/rooms/kamar4.png" alt="Superior Room" class="w-full room-image">
              <div class="absolute top-2 right-2 bg-blue-600 text-white text-xs px-2 py-1 rounded">Superior</div>
            </div>
            <div class="p-4">
              <div class="flex justify-between items-start">
                <div>
                  <h3 class="text-lg font-bold text-gray-800">Kamar Superior 205</h3>
                  <p class="text-gray-600 text-sm">Lantai 2</p>
                </div>
                <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded">Perawatan</span>
              </div>
              <div class="mt-3 flex items-center text-yellow-400">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <span class="text-gray-500 text-sm ml-1">4.0 (28 reviews)</span>
              </div>
              <div class="mt-3">
                <p class="text-gray-700"><i class="fas fa-wifi text-gray-500 mr-2"></i> Free WiFi</p>
                <p class="text-gray-700"><i class="fas fa-tv text-gray-500 mr-2"></i> TV LED 32"</p>
                <p class="text-gray-700"><i class="fas fa-snowflake text-gray-500 mr-2"></i> AC</p>
              </div>
              <div class="mt-4 flex justify-between items-center">
                <div>
                  <p class="text-gray-500 text-sm">Harga per malam</p>
                  <p class="text-lg font-bold text-[#1b1f58]">Rp 650.000</p>
                </div>
                <div class="flex space-x-2">
                  <button class="p-2 text-blue-600 hover:bg-blue-100 rounded-full">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="p-2 text-red-600 hover:bg-red-100 rounded-full">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Room Card 3 -->
          <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="relative">
              <img src="/src/img/rooms/kamar2.jpg" alt="Standard Room" class="w-full room-image">
              <div class="absolute top-2 right-2 bg-green-600 text-white text-xs px-2 py-1 rounded">Standard</div>
            </div>
            <div class="p-4">
              <div class="flex justify-between items-start">
                <div>
                  <h3 class="text-lg font-bold text-gray-800">Kamar Standard 102</h3>
                  <p class="text-gray-600 text-sm">Lantai 1</p>
                </div>
                <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Terisi</span>
              </div>
              <div class="mt-3 flex items-center text-yellow-400">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <i class="far fa-star"></i>
                <span class="text-gray-500 text-sm ml-1">3.5 (45 reviews)</span>
              </div>
              <div class="mt-3">
                <p class="text-gray-700"><i class="fas fa-wifi text-gray-500 mr-2"></i> Free WiFi</p>
                <p class="text-gray-700"><i class="fas fa-tv text-gray-500 mr-2"></i> TV LED 24"</p>
                <p class="text-gray-700"><i class="fas fa-snowflake text-gray-500 mr-2"></i> AC</p>
              </div>
              <div class="mt-4 flex justify-between items-center">
                <div>
                  <p class="text-gray-500 text-sm">Harga per malam</p>
                  <p class="text-lg font-bold text-[#1b1f58]">Rp 450.000</p>
                </div>
                <div class="flex space-x-2">
                  <button class="p-2 text-blue-600 hover:bg-blue-100 rounded-full">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="p-2 text-red-600 hover:bg-red-100 rounded-full">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Add New Room Card -->
          <div
            class="bg-white rounded-lg shadow overflow-hidden border-2 border-dashed border-gray-300 flex items-center justify-center">
            <button
              class="flex flex-col items-center justify-center p-8 w-full h-full text-gray-400 hover:text-[#1b1f58]">
              <i class="fas fa-plus-circle text-4xl mb-2"></i>
              <span class="font-medium">Tambah Kamar Baru</span>
            </button>
          </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center bg-white rounded-lg shadow p-4">
          <div>
            <p class="text-sm text-gray-700">
              Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">5</span> dari <span
                class="font-medium">12</span> kamar
            </p>
          </div>
          <div class="flex space-x-2">
            <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
              Sebelumnya
            </button>
            <button class="px-3 py-1 border border-[#1b1f58] rounded-md text-white bg-[#1b1f58]">
              1
            </button>
            <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
              2
            </button>
            <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
              3
            </button>
            <button class="px-3 py-1 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
              Selanjutnya
            </button>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- Modal Add Room (Hidden by default) -->
  <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden" id="addRoomModal">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
      <div class="flex justify-between items-center p-4 border-b">
        <h3 class="text-lg font-bold text-gray-800">Tambah Kamar Baru</h3>
        <button id="closeModal" class="text-gray-500 hover:text-gray-700">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="p-6">
        <form>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Kamar</label>
              <input type="text"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#1b1f58] focus:border-[#1b1f58]">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Kamar</label>
              <select
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#1b1f58] focus:border-[#1b1f58]">
                <option value="">Pilih Tipe Kamar</option>
                <option value="standard">Standard</option>
                <option value="superior">Superior</option>
                <option value="deluxe">Deluxe</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
              <select
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#1b1f58] focus:border-[#1b1f58]">
                <option value="available">Tersedia</option>
                <option value="occupied">Terisi</option>
                <option value="maintenance">Perawatan</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Harga per Malam</label>
              <div class="relative">
                <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                <input type="text"
                  class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-[#1b1f58] focus:border-[#1b1f58]"
                  placeholder="0">
              </div>
            </div>
            <div class="md:col-span-2">
              <label class="block text-sm font-medium text-gray-700 mb-1">Fasilitas</label>
              <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                <div class="flex items-center">
                  <input type="checkbox" id="wifi" class="rounded text-[#1b1f58] focus:ring-[#1b1f58]">
                  <label for="wifi" class="ml-2 text-sm text-gray-700">WiFi</label>
                </div>
                <div class="flex items-center">
                  <input type="checkbox" id="ac" class="rounded text-[#1b1f58] focus:ring-[#1b1f58]" checked>
                  <label for="ac" class="ml-2 text-sm text-gray-700">AC</label>
                </div>
                <div class="flex items-center">
                  <input type="checkbox" id="tv" class="rounded text-[#1b1f58] focus:ring-[#1b1f58]" checked>
                  <label for="tv" class="ml-2 text-sm text-gray-700">TV</label>
                </div>
                <div class="flex items-center">
                  <input type="checkbox" id="breakfast" class="rounded text-[#1b1f58] focus:ring-[#1b1f58]">
                  <label for="breakfast" class="ml-2 text-sm text-gray-700">Sarapan</label>
                </div>
                <div class="flex items-center">
                  <input type="checkbox" id="bathub" class="rounded text-[#1b1f58] focus:ring-[#1b1f58]">
                  <label for="bathub" class="ml-2 text-sm text-gray-700">Bathub</label>
                </div>
                <div class="flex items-center">
                  <input type="checkbox" id="safe" class="rounded text-[#1b1f58] focus:ring-[#1b1f58]">
                  <label for="safe" class="ml-2 text-sm text-gray-700">Brankas</label>
                </div>
              </div>
            </div>
            <div class="md:col-span-2">
              <label class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar</label>
              <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                  <div class="flex text-sm text-gray-600">
                    <label
                      class="relative cursor-pointer bg-white rounded-md font-medium text-[#1b1f58] hover:text-[#101547] focus-within:outline-none">
                      <span>Upload file</span>
                      <input type="file" class="sr-only">
                    </label>
                    <p class="pl-1">or drag and drop</p>
                  </div>
                  <p class="text-xs text-gray-500">
                    PNG, JPG, GIF up to 5MB
                  </p>
                </div>
              </div>
            </div>
            {{-- <div class="md:col-span-2">
              <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
              <textarea rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#1b1f58] focus:border-[#1b1f58]"></textarea>
            </div> --}}
          </div>
          <div class="mt-6 flex justify-end space-x-3">
            <button type="button" id="cancelAdd"
              class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
              Batal
            </button>
            <button type="submit"
              class="px-4 py-2 border border-transparent rounded-md shadow-sm text-white bg-[#1b1f58] hover:bg-[#101547]">
              Simpan Kamar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Toggle sidebar
      document.getElementById('toggle-sidebar')?.addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('collapsed');
        document.querySelector('.content').classList.toggle('expanded');
      });

      // Modal functionality
      const modal = document.getElementById('addRoomModal');
      const addBtn = document.getElementById('addRoomButton');
      const closeBtn = document.getElementById('closeModal');
      const cancelBtn = document.getElementById('cancelAdd');

      // Show modal
      if (addBtn) {
        addBtn.addEventListener('click', function() {
          modal.classList.remove('hidden');
        });
      }

      // Close modal
      function closeModal() {
        modal.classList.add('hidden');
      }

      if (closeBtn) closeBtn.addEventListener('click', closeModal);
      if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

      // Close when clicking outside
      window.addEventListener('click', function(e) {
        if (e.target === modal) {
          closeModal();
        }
      });
    });
  </script>
</body>

</html>