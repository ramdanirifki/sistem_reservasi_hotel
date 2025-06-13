<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Garut Indah</title>
  <link rel="icon" href="/src/img/logo.png" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- SweetAlert CSS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
          <h1 class="text-xl font-bold text-gray-800">Manajemen Kamar</h1>
          <div class="flex items-center space-x-4">
            <div class="relative">
              <i class="fas fa-bell text-gray-600"></i>
              <span
                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
            </div>
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
          <button id="addRoomButton"
            class="bg-[#1b1f58] hover:bg-[#101547] text-white px-4 py-2 rounded-lg flex items-center">
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
                  <h3 class="text-lg font-bold text-gray-800">Kamar Deluxe</h3>
                </div>
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
                  <p class="text-lg font-bold text-[#1b1f58]">Rp 950.000</p>
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
                  <h3 class="text-lg font-bold text-gray-800">Kamar Superior</h3>
                </div>
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
                  <p class="text-lg font-bold text-[#1b1f58]">Rp 750.000</p>
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
                  <h3 class="text-lg font-bold text-gray-800">Kamar Standard</h3>
                </div>
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
                  <p class="text-lg font-bold text-[#1b1f58]">Rp 550.000</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Room Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
          <!-- Bulk Actions -->
          <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Kamar</h2>
          </div>

          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    NO
                  </th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nama Kamar
                  </th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Tipe Kamar
                  </th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Harga per Malam
                  </th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                  </th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Aksi
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($kamars as $kamar)
                  <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{ $kamar->id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ $kamar->nama_kamar }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ ucfirst($kamar->tipe_kamar) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      Rp {{ number_format($kamar->harga_per_malam, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
              {{ $kamar->status == 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst(str_replace('_', ' ', $kamar->status)) }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                      <button class="text-red-600 hover:text-red-900 delete-btn" data-id="{{ $kamar->id }}">
                        <i class="fas fa-trash"></i> Delete
                      </button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
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
        <h3 class="text-lg font-semibold text-gray-800">Tambah Kamar Baru</h3>
        <button id="closeModal" class="text-gray-500 hover:text-gray-700">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="p-6">
        <form id="roomForm" action="{{ route('kamar.store') }}" method="POST">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="nama_kamar" class="block text-sm font-medium text-gray-700 mb-1">Nama Kamar</label>
              <input type="text" id="nama_kamar" name="nama_kamar" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#1b1f58] focus:border-[#1b1f58]">
            </div>
            <div>
              <label for="tipe_kamar" class="block text-sm font-medium text-gray-700 mb-1">Tipe Kamar</label>
              <select id="tipe_kamar" name="tipe_kamar" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#1b1f58] focus:border-[#1b1f58]">
                <option value="">Pilih Tipe Kamar</option>
                <option value="standard">Standard</option>
                <option value="superior">Superior</option>
                <option value="deluxe">Deluxe</option>
              </select>
            </div>
            <div>
              <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
              <select id="status" name="status" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#1b1f58] focus:border-[#1b1f58]">
                <option value="tersedia">Tersedia</option>
                <option value="tidak tersedia">Tidak Tersedia</option>
              </select>
            </div>
            <div>
              <label for="harga_per_malam" class="block text-sm font-medium text-gray-700 mb-1">Harga per
                Malam</label>
              <div class="relative">
                <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                <input type="number" id="harga_per_malam" name="harga_per_malam" required
                  class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-[#1b1f58] focus:border-[#1b1f58]"
                  placeholder="0">
              </div>
            </div>
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
    const roomPrices = {
      'standard': 550000,
      'superior': 750000,
      'deluxe': 950000
    };

    document.addEventListener('DOMContentLoaded', function() {
      // Ketika tipe kamar dipilih, set harga otomatis
      const tipeKamarSelect = document.getElementById('tipe_kamar');
      const hargaInput = document.getElementById('harga_per_malam');

      if (tipeKamarSelect && hargaInput) {
        tipeKamarSelect.addEventListener('change', function() {
          const selectedType = this.value;
          if (selectedType && roomPrices[selectedType]) {
            hargaInput.value = roomPrices[selectedType];
          } else {
            hargaInput.value = '';
          }
        });

        // Buat input harga tidak bisa diubah manual
        hargaInput.readOnly = true;
        hargaInput.style.backgroundColor = '#f3f4f6';
        hargaInput.style.cursor = 'not-allowed';
      }

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

      // Handle form submission with SweetAlert
      const roomForm = document.getElementById('roomForm');
      if (roomForm) {
        roomForm.addEventListener('submit', async function(e) {
          e.preventDefault();

          const form = e.target;
          const formData = new FormData(form);
          const url = form.action;

          try {
            // Show loading indicator
            Swal.fire({
              title: 'Memproses...',
              html: 'Sedang menyimpan data kamar',
              allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
              }
            });

            const response = await fetch(url, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
              },
              body: formData
            });

            const data = await response.json();

            if (response.ok) {
              // Show success message
              Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Kamar berhasil ditambahkan',
                confirmButtonColor: '#1b1f58',
              }).then((result) => {
                if (result.isConfirmed) {
                  // Close modal and reload page
                  closeModal();
                  window.location.reload();
                }
              });
            } else {
              // Show error message
              Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: data.message || 'Terjadi kesalahan saat menyimpan data',
                confirmButtonColor: '#1b1f58',
              });
            }
          } catch (error) {
            console.error('Error:', error);
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: 'Terjadi kesalahan saat mengirim data',
              confirmButtonColor: '#1b1f58',
            });
          }
        });
      }

      // Delete confirmation with SweetAlert
      // Update bagian delete confirmation dengan SweetAlert
      document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
          const roomId = this.getAttribute('data-id');

          Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1b1f58',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
              // Kirim request DELETE ke server
              fetch(`/admin/kamar/${roomId}`, {
                  method: 'DELETE',
                  headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                  }
                })
                .then(response => {
                  if (!response.ok) {
                    throw new Error('Network response was not ok');
                  }
                  return response.json();
                })
                .then(data => {
                  Swal.fire({
                    icon: 'success',
                    title: 'Terhapus!',
                    text: 'Kamar telah dihapus.',
                    confirmButtonColor: '#1b1f58',
                  }).then(() => {
                    window.location.reload();
                  });
                })
                .catch(error => {
                  console.error('Error:', error);
                  Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menghapus kamar',
                    confirmButtonColor: '#1b1f58',
                  });
                });
            }
          });
        });
      });

      // Edit button handler (you would implement your edit logic here)
      document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
          const roomId = this.getAttribute('data-id');
          // Here you would typically open an edit modal or similar
          Swal.fire({
            icon: 'info',
            title: 'Edit Kamar',
            text: `Anda akan mengedit kamar dengan ID ${roomId}`,
            confirmButtonColor: '#1b1f58',
          });
        });
      });
    });
  </script>
</body>

</html>
