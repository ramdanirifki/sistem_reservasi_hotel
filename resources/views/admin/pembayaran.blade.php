@if(!session('email') && !session('password'))
    <script>
        alert("Anda belum login");
        window.location.href = '/admin/login';
    </script>
@endif

@php
  //dd($data);
  $i = 1;
@endphp
@php
  $i = 1;
  // dd($pembayaran);
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pembayaran - Garut Indah</title>
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
    .payment-card {
      transition: all 0.3s;
    }
    .payment-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .payment-card.selected {
      border-color: #1b1f58;
      background-color: #f8f9fa;
    }
    .pagination nav div:nth-child(2) div:nth-child(2) {
    margin-left: 30px;
    }

    .pagination nav div:nth-child(2) div:nth-child(2) span {
      background-color: white;

    }

    .pagination nav div:nth-child(2) div:nth-child(2) a {
      background-color: white;
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
        <a href="/admin/pembayaran" class="flex items-center px-4 py-3 bg-[#101547] text-white">
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
          <h1 class="text-xl font-bold text-gray-800">Manajemen Pembayaran</h1>
          <div class="flex items-center space-x-4">
            <div class="flex items-center">
              <span class="ml-2 text-gray-700">Admin</span>
            </div>
          </div>
        </div>
      </header>

      <!-- Pembayaran Content -->
      <main class="p-6">
        <!-- Filter dan Pencarian -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-4 md:mb-0">
              <button id="buttonAddPayment" class="bg-[#1b1f58] text-white px-4 py-2 rounded-md hover:bg-[#101547] transition">
                <i class="fas fa-plus mr-2"></i>Tambah Pembayaran
              </button>
            </div>
            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
              {{-- <div class="relative">
                <select class="block appearance-none w-full bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                  <option>Semua Status</option>
                  <option>Pending</option>
                  <option>Lunas</option>
                  <option>Gagal</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                  <i class="fas fa-chevron-down"></i>
                </div>
              </div> --}}
              <div class="relative">
                <form action="/admin/pembayaran" method="GET">
                    <input
                        type="text"
                        name="search" {{-- Tambahkan atribut 'name' dengan nilai 'search' --}}
                        placeholder="Cari pembayaran..."
                        class="bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 pr-10 rounded w-full focus:outline-none focus:bg-white focus:border-gray-500"
                        value="{{ request('search') }}" {{-- Tambahkan ini untuk mempertahankan nilai pencarian setelah submit --}}
                    >
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <button type="submit" class="p-0 border-0 bg-transparent"> {{-- Ubah div menjadi button type submit --}}
                            <i class="fas fa-search text-gray-400"></i>
                        </button>
                    </div>
                </form>
            </div>
            </div>
          </div>
        </div>
        @if (Session::has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ Session::get('success') }}</span>
        </div>
        @endif

        @if (Session::has('error') )
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ Session::get('error') }}</span>
        </div>
        @elseif ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
          <span class="block sm:inline">{{ $errors }}</span>
      </div>
        @endif
        <!-- Tabel Pembayaran -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
          <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Pembayaran</h2>
            <div class="text-sm text-gray-500">
              Menampilkan {{ $pembayaran->firstItem() }} sampai {{ $pembayaran->lastItem() }} dari {{ $pembayaran->total() }} Hasil
            </div>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Reservasi</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tamu</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Bayar</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <!-- Sample data rows -->
                @foreach ($pembayaran as $dataPembayaran)
                  
                
                <tr class="hover:bg-gray-50">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ $loop->iteration + ($pembayaran->currentPage() - 1) * $pembayaran->perPage()  }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-blue-600">#RV{{ $dataPembayaran->reservasi_id }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div>
                        <div class="text-sm font-medium text-gray-900">{{ $dataPembayaran->reservasi->tamu->nama }}</div>
                        <div class="text-sm text-gray-500">{{ $dataPembayaran->reservasi->tamu->email }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $dataPembayaran->tanggal_bayar }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">Rp. {{ number_format($dataPembayaran->jumlah_bayar, 0, ',', '.'); }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900 capitalize">{{ $dataPembayaran->metode_bayar }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex space-x-2">
                      <button class="text-blue-600 hover:text-blue-900 view-payment-btn"  data-id="{{ $dataPembayaran->id }}">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button class="text-yellow-600 hover:text-yellow-900 edit-payment-btn" data-id="{{ $dataPembayaran->id }}">
                        <i class="fas fa-edit"></i>
                      </button>
                      <form action="/admin/pembayaran/hapus/{{ $dataPembayaran->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pembayaran ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>

                @endforeach
                <!-- Add more sample rows as needed -->
              </tbody>
            </table>
          </div>
          <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-between sm:hidden">
              <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Previous
              </a>
              <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Next
              </a>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
              <div>
                <p class="text-sm text-gray-700">
                  Menampilkan
                  <span class="font-medium">{{ $pembayaran->firstItem() }}</span>
                  sampai
                  <span class="font-medium">{{ $pembayaran->lastItem() }}</span>
                  dari
                  <span class="font-medium">{{ $pembayaran->total() }}</span>
                  hasil
                </p>
              </div>
              <div class="pl-2">
                <div class="pagination bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200">
                  {{ $pembayaran->links() }}
              </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Tambah Pembayaran -->
        <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="paymentModal">
          <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-black bg-opacity-50" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                  <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                      Tambah Pembayaran Baru
                    </h3>
                    <form action="/admin/pembayaran" method="POST" enctype="multipart/form-data">
                      @csrf
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                      <div class="sm:col-span-6">
                        <label for="reservation" class="block text-sm font-medium text-gray-700">Reservasi</label>
                        <select id="reservation" name="reservasi_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                          <option>Pilih Reservasi</option>
                          @foreach ($reservasi as $data_reservasi)
                            <option value="{{ $data_reservasi->id }}">
                              @php
                              $checkinDate = new DateTime($data_reservasi->tanggal_checkin);
                              $checkoutDate = new DateTime($data_reservasi->tanggal_checkout);
                  
                              $interval = $checkinDate->diff($checkoutDate);
                              $numberOfNights = $interval->days;
                  
                              $totalHarga = $data_reservasi->kamar->harga_per_malam * $numberOfNights;
                              $totalHarga = number_format($totalHarga, 0, ',', '.');
                              @endphp
                               #RV{{ $data_reservasi->tamu_id }} {{ $data_reservasi->tamu->nama }} - RP. {{ $totalHarga }}
                            </option>
                          @endforeach
                        </select>
                      </div>

                      <div class="sm:col-span-3">
                        <label for="payment-date" class="block text-sm font-medium text-gray-700">Tanggal Pembayaran</label>
                        <input type="date" name="tanggal_bayar" id="payment-date" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                      </div>

                      <div class="sm:col-span-3">
                        <label for="payment-amount" class="block text-sm font-medium text-gray-700">Jumlah Pembayaran</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">Rp</span>
                          </div>
                          <input type="text" name="jumlah_bayar" id="payment-amount" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                        </div>
                      </div>

                      <div class="sm:col-span-3">
                        <label for="payment-method" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                        <select id="payment-method" name="metode_bayar" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                          <option value="Transfer Bank">Transfer Bank</option>
                          <option value="Kartu Kredit">Kartu Kredit</option>
                          <option value="Tunai">Tunai</option>
                          <option value="E-Wallet">E-Wallet</option>
                        </select>
                      </div>

                      

                      <div class="sm:col-span-6">
                        <label class="block text-sm font-medium text-gray-700">Bukti Pembayaran</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                          <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                              <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                      
                            <div class="flex text-sm text-gray-600">
                              <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload file</span>
                                <input id="file-upload" name="bukti_pembayaran" type="file" class="sr-only" accept="image/*,application/pdf">
                              </label>
                              <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">
                              PNG, JPG, PDF up to 5MB
                            </p>
                      
                            <!-- Preview -->
                            <div id="preview-container" class="mt-4 hidden">
                              <p class="text-sm text-gray-600 mb-2">Preview:</p>
                              <img id="image-preview" class="mx-auto h-40 rounded shadow" alt="Preview Gambar">
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <!-- JavaScript -->
                      <script>
                        const fileInput = document.getElementById('file-upload');
                        const previewContainer = document.getElementById('preview-container');
                        const imagePreview = document.getElementById('image-preview');
                      
                        fileInput.addEventListener('change', function () {
                          const file = this.files[0];
                          
                          if (file) {
                            const fileType = file.type;
                            const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                      
                            if (validImageTypes.includes(fileType)) {
                              const reader = new FileReader();
                      
                              reader.onload = function (e) {
                                imagePreview.src = e.target.result;
                                previewContainer.classList.remove('hidden');
                              }
                      
                              reader.readAsDataURL(file);
                            } else {
                              imagePreview.src = '';
                              previewContainer.classList.add('hidden');
                            }
                          } else {
                            imagePreview.src = '';
                            previewContainer.classList.add('hidden');
                          }
                        });
                      </script>

                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                  Simpan Pembayaran
                </button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="cancelPaymentModal">
                  Batal
                </button>
              </form>
              </div>
            </div>
          </div>
        </div>


        <!-- Modal Edit Pembayaran -->
        <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="paymentEditModal">
          <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-black bg-opacity-50" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                  <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                      Edit Pembayaran Baru
                    </h3>
                    <form action="/admin/pembayaran/update" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id" id="edit-pembayaran-id">
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                      <div class="sm:col-span-6">
                        <label for="reservation-edit" class="block text-sm font-medium text-gray-700">Reservasi</label>
                        <select id="reservation-edit" name="reservasi_id_edit" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                          <option>Pilih Reservasi</option>
                          @foreach ($reservasi as $data_reservasi)
                            <option value="{{ $data_reservasi->id }}">
                              @php
                              $checkinDate = new DateTime($data_reservasi->tanggal_checkin);
                              $checkoutDate = new DateTime($data_reservasi->tanggal_checkout);
                  
                              $interval = $checkinDate->diff($checkoutDate);
                              $numberOfNights = $interval->days;
                  
                              $totalHarga = $data_reservasi->kamar->harga_per_malam * $numberOfNights;
                              $totalHarga = number_format($totalHarga, 0, ',', '.');
                              @endphp
                               #RV{{ $data_reservasi->tamu_id }} {{ $data_reservasi->tamu->nama }} - RP. {{ $totalHarga }}
                            </option>
                          @endforeach
                        </select>
                      </div>

                      <div class="sm:col-span-3">
                        <label for="payment-date-edit" class="block text-sm font-medium text-gray-700">Tanggal Pembayaran</label>
                        <input type="date" name="tanggal_bayar_edit" id="payment-date-edit" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                      </div>

                      <div class="sm:col-span-3">
                        <label for="payment-amount-edit" class="block text-sm font-medium text-gray-700">Jumlah Pembayaran</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">Rp</span>
                          </div>
                          <input type="text" name="jumlah_bayar_edit" id="payment-amount-edit" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                        </div>
                      </div>

                      <div class="sm:col-span-3">
                        <label for="payment-method-edit" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                        <select id="payment-method-edit" name="metode_bayar_edit" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                          <option value="Transfer Bank">Transfer Bank</option>
                          <option value="Kartu Kredit">Kartu Kredit</option>
                          <option value="Tunai">Tunai</option>
                          <option value="E-Wallet">E-Wallet</option>
                        </select>
                      </div>

                      <input type="hidden" name="bukti_pembayaran_old"  id="bukti_pembayaran_old">

                      <div class="sm:col-span-6">
                        <label class="block text-sm font-medium text-gray-700">Bukti Pembayaran</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                          <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                              <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                           

                            <div class="flex text-sm text-gray-600">
                              <label for="file-upload-edit" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload file</span>
                                <input id="file-upload-edit" name="bukti_pembayaran_edit" type="file" class="sr-only" accept="image/*,application/pdf">
                              </label>
                              <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">
                              PNG, JPG, PDF up to 5MB
                            </p>
                      
                            <!-- Preview -->
                            <div id="preview-container-edit" class="mt-4 hidden">
                              <p class="text-sm text-gray-600 mb-2">Preview:</p>
                              <img id="image-preview-edit" class="mx-auto h-40 rounded shadow" alt="Preview Gambar">
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <!-- JavaScript -->
                      <script>
                        const fileInput_edit = document.getElementById('file-upload-edit');
                        const previewContainer_edit = document.getElementById('preview-container-edit');
                        const imagePreview_edit = document.getElementById('image-preview-edit');
                      
                        fileInput_edit.addEventListener('change', function () {
                          const fileEdit = this.files[0];
                          
                          if (fileEdit) {
                            const fileTypeEdit = fileEdit.type;
                            const validImageTypesEdit = ['image/jpeg', 'image/png', 'image/jpg'];
                      
                            if (validImageTypesEdit.includes(fileTypeEdit)) {
                              const readerEdit = new FileReader();
                      
                              readerEdit.onload = function (e) {
                                imagePreview_edit.src = e.target.result;
                                previewContainer_edit.classList.remove('hidden');
                              }
                      
                              readerEdit.readAsDataURL(fileEdit);
                            } else {
                              imagePreview_edit.src = '';
                              previewContainer_edit.classList.add('hidden');
                            }
                          } else {
                            imagePreview_edit.src = '';
                            previewContainer_edit.classList.add('hidden');
                          }
                        });
                      </script>

                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                  Update Pembayaran
                </button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="cancelEditPaymentModal">
                  Batal
                </button>
              </form>
              </div>
            </div>
          </div>
        </div>

            <!-- Modal Detail Pembayaran -->
            <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="paymentDetailModal">
              <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-black bg-opacity-50" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                  <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                      <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div class="sm:flex sm:items-start flex-col space-y-2">
                <h3 class="text-lg font-semibold text-gray-800">Detail Pembayaran</h3>
                <div id="modalPaymentDetailContent">
                  <p>Loading...</p>
                </div>
              </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
              <button type="button" id="closeModalDetailBtn" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                Tutup
              </button>
            </div>

              </div>
            </div>
          </div>
        </div>

      </main>
    </div>
  </div>

  <script>
    // Handle modal
    document.addEventListener('DOMContentLoaded', function() {
      const modal = document.getElementById('paymentModal');
      const addBtn = document.getElementById('buttonAddPayment');
      const cancelBtn = document.getElementById('cancelPaymentModal');
      
      if (addBtn) {
        addBtn.addEventListener('click', function() {
          modal.classList.remove('hidden');
        });
      }
      
      if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
          modal.classList.add('hidden');
        });
      }

      // Auto-fill payment amount when reservation is selected
      const reservationSelect = document.getElementById('reservation');
      const paymentAmount = document.getElementById('payment-amount');
      
      if (reservationSelect && paymentAmount) {
        reservationSelect.addEventListener('change', function() {
          const selectedOption = this.options[this.selectedIndex];
          const totalAmount = selectedOption.getAttribute('data-total');
          if (totalAmount) {
            paymentAmount.value = new Intl.NumberFormat('id-ID').format(totalAmount);
          }
        });
      }

     
        const modalDetail = document.getElementById("paymentDetailModal");
        const closeModalDetailBtn = document.getElementById("closeModalDetailBtn");
        const modalDetailContent = document.getElementById("modalPaymentDetailContent");
       //console.log(closeModalDetailBtn);

        document.querySelectorAll(".view-payment-btn").forEach(button => {
          button.addEventListener("click", function () {
            const pembayaranId = this.dataset.id;

            // Tampilkan loading
            modalDetailContent.innerHTML = "<p>Loading...</p>";
            modalDetail.classList.remove("hidden");

            // Kirim request AJAX
            fetch(`/admin/pembayaran/${pembayaranId}`)
              .then(response => response.json())
              .then(data => {
                let bukti_pembayaran = null;
                if (data.bukti_pembayaran == 'tidak-ada'){
                  bukti_pembayaran = `<strong style="color: red">!!Gambar Gagal dimuat!!</strong>`
                }else{
                  bukti_pembayaran = `<img src="/storage/${data.bukti_pembayaran}">`;
                }
                modalDetailContent.innerHTML = `
                  <p><strong>Nama Tamu:</strong> ${data.tamu}</p>
                  <p><strong>Tanggal Bayar:</strong> ${data.tanggal_bayar}</p>
                  <p><strong>Jumlah Bayar:</strong> Rp. ${data.jumlah_bayar}</p>
                  <p><strong>Metode Pembayaran:</strong> ${data.metode_bayar}</p>
                  <center>
                    <h3>Bukti pembayaran</h3>
                       ${bukti_pembayaran}
      
                    
                    
                    </center>`
                  ;
              })
              .catch(error => {
                modalDetailContent.innerHTML = "<p class='text-red-600'>Gagal memuat data pembayaran.</p>";
                console.error('Error:', error);
              });
          });
        });

        // Tutup modal
        closeModalDetailBtn.addEventListener("click", function () {
          modalDetail.classList.add("hidden");
        });

        // Tutup jika klik area hitam
        modalDetail.addEventListener("click", function (e) {
          if (e.target === modal) {
            modal.classList.add("hidden");
          }
        });
      });


      document.querySelectorAll(".edit-payment-btn").forEach(button => {
        button.addEventListener("click", function () {
         const id = this.dataset.id;

          fetch(`/admin/pembayaran/edit/${id}`)
            .then(res => res.json())
            .then(data => {
             //console.log(data.metode_bayar);
              // Isi data form
              document.getElementById('bukti_pembayaran_old').value = data.bukti_pembayaran;
              document.getElementById('reservation-edit').value = data.reservasi_id;
              document.getElementById('payment-date-edit').value = data.tanggal_bayar;
              document.getElementById('payment-amount-edit').value = data.jumlah_bayar;
              document.getElementById('payment-method-edit').value = data.metode_bayar;
              document.getElementById('edit-pembayaran-id').value = data.id;

              // Set action URL pada form
              // const form = document.getElementById('form-edit-pembayaran');
              // form.action = `/admin/pembayaran/edit/${data.id}`;

              // Preview jika ada
              if (data.bukti_pembayaran) {
                const previewContainer = document.getElementById('preview-container-edit');
                const imagePreview = document.getElementById('image-preview-edit');
                imagePreview.src = `/storage/${data.bukti_pembayaran}`;
                previewContainer.classList.remove('hidden');
              }

              // Tampilkan modal edit
              const modalEdit = document.getElementById('paymentEditModal');
              modalEdit.classList.remove('hidden');
              // Cancel Modal Edit
              const cancelEditPaymentModal = document.getElementById('cancelEditPaymentModal');
              cancelEditPaymentModal.addEventListener('click',function () {
                modalEdit.classList.add('hidden');
              })
            });
        });
});




  </script>
</body>

</html>