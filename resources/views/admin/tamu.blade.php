@if(!session('email') && !session('password'))
    <script>
        alert("Anda belum login");
        window.location.href = '/admin/login';
    </script>
@endif

@php
  $i = 1;
@endphp

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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <a href="/admin/dashboard" class="flex items-center px-4 py-3 text-white hover:bg-[#101547]">
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
        <a href="/admin/pembayaran" class="flex items-center px-4 py-3 text-white hover:bg-[#101547]">
          <i class="fas fa-credit-card w-6"></i>
          <span class="nav-text ml-3">Pembayaran</span>
        </a>
        <a href="/admin/tamu" class="flex items-center px-4 py-3 bg-[#101547] text-white">
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
          <h1 class="text-xl font-bold text-gray-800">Manajemen Tamu</h1>
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

      <!-- Tamu Content -->
      <main class="p-6">
        <!-- Filter dan Pencarian -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            {{-- <div class="flex-1">
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text"
                  class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                  placeholder="Cari tamu...">
              </div>
            </div>
            <div class="flex items-center space-x-2">
              <select
                class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                <option>Semua Status</option>
                <option>Aktif</option>
                <option>Non-Aktif</option>
                <option>VIP</option>
              </select>
              <button
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-filter mr-2"></i> Filter
              </button>
            </div> --}}
            <button id="tambahTamuBtn"
              class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
              <i class="fas fa-plus mr-2"></i> Tambah Tamu
            </button>
          </div>
        </div>

        <!-- Daftar Tamu -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
          <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Tamu</h2>
            <div class="text-sm text-gray-500">Total: 125 tamu</div>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NO</th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total
                    Reservasi</th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <!-- Tamu 1 -->
                @foreach ($tamu as $dataTamu)
                  <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $i++ }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div>
                          <div class="text-sm font-medium text-gray-900">{{ $dataTamu->nama }}</div>
                          <div class="text-sm text-gray-500">{{ $dataTamu->alamat }}</div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $dataTamu->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $dataTamu->nomor_telepon }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ count($dataTamu->reservasi) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                      <button href="#" onclick="openEditModal({{ $dataTamu->id }})"
                        class="text-blue-600 hover:text-blue-900 mr-3">
                        <i class="fas fa-edit"></i> Edit
                      </button>
                      <button href="#" onclick="konfirmasiHapus({{ $dataTamu->id }})"
                        class="text-red-600 hover:text-red-900">
                        <i class="fas fa-trash"></i> Delete
                      </button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- Pagination -->
          {{-- <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-between sm:hidden">
              <a href="#"
                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Sebelumnya </a>
              <a href="#"
                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Selanjutnya </a>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
              <div>
                <p class="text-sm text-gray-700">
                  Menampilkan
                  <span class="font-medium">1</span>
                  sampai
                  <span class="font-medium">5</span>
                  dari
                  <span class="font-medium">125</span>
                  tamu
                </p>
              </div>
              <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                  <a href="#"
                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                    <span class="sr-only">Sebelumnya</span>
                    <i class="fas fa-chevron-left"></i>
                  </a>
                  <a href="#" aria-current="page"
                    class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                    1 </a>
                  <a href="#"
                    class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                    2 </a>
                  <a href="#"
                    class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                    3 </a>
                  <a href="#"
                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                    <span class="sr-only">Selanjutnya</span>
                    <i class="fas fa-chevron-right"></i>
                  </a>
                </nav>
              </div>
            </div>
          </div> --}}

        </div>
      </main>
    </div>
  </div>

  <!-- Modal Tambah/Edit Tamu -->
  <div class="fixed inset-0 z-50 flex items-center justify-center hidden" id="tamuModal">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" aria-hidden="true" onclick="closeModal()">
    </div>

    <!-- Modal Content -->
    <div class="relative transform overflow-hidden rounded-lg bg-white shadow-xl transition-all w-full max-w-lg mx-4">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <h3 class="text-lg font-semibold leading-6 text-gray-900 mb-4" id="modalTitle">Tambah Tamu Baru</h3>
        <form id="tamuForm" method="POST">
          @csrf
          <input type="hidden" name="_method" id="formMethod" value="POST">
          <input type="hidden" name="id" id="tamu_id">

          <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" required
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2 px-3 border">
          </div>
          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" required
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2 px-3 border">
          </div>
          <div class="mb-4">
            <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
            <input type="tel" name="nomor_telepon" id="nomor_telepon" required
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2 px-3 border">
          </div>
          <div class="mb-4">
            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3" required
              class="mt-1 block w-full rounded-md border-gray-300 resize-none shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2 px-3 border"></textarea>
          </div>
        </form>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
        <button type="submit" form="tamuForm" id="submitTamuBtn"
          class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
          <span id="submitButtonText">Simpan</span>
        </button>
        <button type="button" onclick="closeModal()"
          class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
          Batal
        </button>
      </div>
    </div>
  </div>

  <script>
    // Fungsi untuk membuka modal
    function openModal(mode = 'add', id = null) {
      const modal = document.getElementById('tamuModal');
      const title = document.getElementById('modalTitle');
      const submitBtn = document.getElementById('submitTamuBtn');
      const submitBtnText = document.getElementById('submitButtonText');
      const form = document.getElementById('tamuForm');

      // Reset form dan clear errors
      form.reset();
      clearFormErrors();

      if (mode === 'add') {
        title.textContent = 'Tambah Tamu Baru';
        submitBtnText.textContent = 'Simpan';
        form.action = "{{ route('tamu.store') }}";
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('tamu_id').value = '';
      } else if (mode === 'edit' && id) {
        title.textContent = 'Edit Data Tamu';
        submitBtnText.textContent = 'Update';
        form.action = `/admin/tamu/${id}`;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('tamu_id').value = id;

        // Fetch data tamu
        fetch(`/admin/tamu/${id}/edit`)
          .then(response => response.json())
          .then(data => {
            document.getElementById('nama').value = data.nama;
            document.getElementById('email').value = data.email;
            document.getElementById('nomor_telepon').value = data.nomor_telepon;
            document.getElementById('alamat').value = data.alamat;
          })
          .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'Gagal memuat data tamu');
          });
      }

      // Tampilkan modal
      modal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    // Fungsi untuk menutup modal
    function closeModal() {
      document.getElementById('tamuModal').classList.add('hidden');
      document.body.style.overflow = 'auto';
    }

    // Fungsi untuk membuka modal edit
    function openEditModal(id) {
      openModal('edit', id);
    }

    // Fungsi untuk clear error messages
    function clearFormErrors() {
      document.querySelectorAll('.error-message').forEach(el => el.remove());
      document.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
    }

    // Fungsi untuk menampilkan alert
    function showAlert(icon, title, text = '') {
      Swal.fire({
        icon: icon,
        title: title,
        text: text,
        confirmButtonColor: '#1b1f58'
      });
    }

    // Handle form submission
    document.getElementById('tamuForm').addEventListener('submit', function(e) {
      e.preventDefault();

      const form = e.target;
      const formData = new FormData(form);
      const url = form.action;
      const method = document.getElementById('formMethod').value;

      fetch(url, {
          method: 'POST', // Tetap POST karena kita menggunakan _method
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
          },
          body: formData
        })
        .then(response => {
          if (!response.ok) {
            return response.json().then(err => {
              throw err;
            });
          }
          return response.json();
        })
        .then(data => {
          if (data.success) {
            showAlert('success', 'Sukses!', data.message);
            closeModal();
            window.location.reload();
          }
        })
        .catch(error => {
          if (error.errors) {
            // Handle validation errors
            Object.entries(error.errors).forEach(([field, messages]) => {
              const input = document.querySelector(`[name="${field}"]`);
              if (input) {
                input.classList.add('border-red-500');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message text-red-500 text-sm mt-1';
                errorDiv.textContent = messages[0];
                input.parentNode.appendChild(errorDiv);
              }
            });
          } else {
            showAlert('error', 'Error', error.message || 'Terjadi kesalahan');
          }
        });
    });

    // Event listeners
    document.addEventListener('DOMContentLoaded', function() {
      // Tombol tambah
      document.getElementById('tambahTamuBtn').addEventListener('click', function() {
        openModal('add');
      });

      // Tutup modal saat klik di luar
      document.getElementById('tamuModal').addEventListener('click', function(e) {
        if (e.target === this) {
          closeModal();
        }
      });

      // Tutup modal saat tekan ESC
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          closeModal();
        }
      });
    });

    // Fungsi untuk konfirmasi penghapusan
    function konfirmasiHapus(id) {
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data tamu akan dihapus secara permanen dan tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1b1f58',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          hapusTamu(id);
        }
      });
    }

    // Fungsi untuk menghapus tamu
    function hapusTamu(id) {
      // Tampilkan loading
      Swal.fire({
        title: 'Menghapus...',
        html: 'Sedang memproses penghapusan data',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });

      // Kirim request DELETE
      fetch(`/admin/tamu/${id}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          }
        })
        .then(response => {
          if (!response.ok) {
            return response.json().then(err => {
              throw err;
            });
          }
          return response.json();
        })
        .then(data => {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: data.message || 'Data tamu berhasil dihapus',
            confirmButtonColor: '#1b1f58'
          }).then(() => {
            // Refresh halaman setelah berhasil dihapus
            window.location.reload();
          });
        })
        .catch(error => {
          Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: error.message || 'Terjadi kesalahan saat menghapus data',
            confirmButtonColor: '#1b1f58'
          });
        });
    }
  </script>
</body>

</html>
