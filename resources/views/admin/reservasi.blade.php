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

@if ($errors->any())
    <script>alert('data gagal disimpan, masukan data yang valid')</script>
@endif


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservasi - Garut Indah</title>
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
        <a href="/admin/reservasi" class="flex items-center px-4 py-3 bg-[#101547] text-white">
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
          <h1 class="text-xl font-bold text-gray-800">Manajemen Reservasi</h1>
          <div class="flex items-center space-x-4">
            {{-- <div class="relative">
              <i class="fas fa-bell text-gray-600"></i>
              <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
            </div> --}}
            <div class="flex items-center">
              <span class="ml-2 text-gray-700">Admin</span>
            </div>
          </div>
        </div>
      </header>

      <!-- Reservasi Content -->
      <main class="p-6">
        <!-- Filter dan Pencarian -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-4 md:mb-0">
              <button id="buttonAddReservation" class="bg-[#1b1f58] text-white px-4 py-2 rounded-md hover:bg-[#101547] transition">
                <i class="fas fa-plus mr-2"></i>Tambah Reservasi
              </button>
            </div>
            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
              <form action="/admin/reservasi" method="GET" class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                <div class="relative">
                  <select name="status" onchange="this.form.submit()" class="block appearance-none w-full bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                  </select>
                  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down"></i>
                  </div>
                </div>
                <div class="relative">
                  <input type="text" name="search" placeholder="Cari reservasi..." value="{{ request('search') }}" class="bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 pr-10 rounded w-full focus:outline-none focus:bg-white focus:border-gray-500">
                  <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 focus:outline-none">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>


        @if (Session::has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ Session::get('success') }}</span>
        </div>
        @endif

        @if (Session::has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ Session::get('error') }}</span>
        </div>
        @endif

        <!-- Tabel Reservasi -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
          <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Reservasi</h2>
            <div class="text-sm text-gray-500">
              Menampilkan {{ $reservasi->firstItem() }} sampai {{ $reservasi->lastItem() }} dari {{ $reservasi->total() }} reservasi
            </div>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Reservasi</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tamu</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama/Type Kamar</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-In/Out</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @foreach ( $reservasi as $data_reservasi) {{-- Ganti $reservasi dengan $data_reservasi atau nama lain agar tidak konflik dengan objek paginator --}}
                <tr class="hover:bg-gray-50">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ $loop->iteration + ($reservasi->currentPage() - 1) * $reservasi->perPage()  }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-blue-600">#RV{{ $data_reservasi->id }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div>
                        <div class="text-sm font-medium text-gray-900">{{ $data_reservasi->tamu->nama }}</div>
                        <div class="text-sm text-gray-500">{{ $data_reservasi->tamu->email }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $data_reservasi->kamar->nama_kamar }}</div>
                    <div class="text-sm text-gray-500">{{ $data_reservasi->kamar->tipe_kamar }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $data_reservasi->tanggal_checkin }}</div>
                    <div class="text-sm text-gray-500">{{ $data_reservasi->tanggal_checkout }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    @php
                    $checkinDate = new DateTime($data_reservasi->tanggal_checkin);
                    $checkoutDate = new DateTime($data_reservasi->tanggal_checkout);
        
                    $interval = $checkinDate->diff($checkoutDate);
                    $numberOfNights = $interval->days;
        
                    $totalHarga = $data_reservasi->kamar->harga_per_malam * $numberOfNights;
                    $totalHarga = number_format($totalHarga, 0, ',', '.');
                    @endphp
        
                    Rp. {{ $totalHarga }}
        
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    @if ($data_reservasi->status_reservasi == 'cancelled')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                      Cancelled
                    </span>
                    @elseif ($data_reservasi->status_reservasi == 'pending')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                      Pending
                    </span>
                    @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                      Confirmed
                    </span>
                    @endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex space-x-2">
                      <button data-id="{{ $data_reservasi->id }}" class="text-blue-600 hover:text-blue-900 buttonDetailReservation">
                        <i class="fas fa-eye"></i>
                    </button>
                      <button data-id="{{ $data_reservasi->id }}" class="text-yellow-600 hover:text-yellow-900 buttonEditReservation">
                        <i class="fas fa-edit"></i>
                    </button>                    
                      <form action="/admin/reservasi/hapus/{{ $data_reservasi->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus reservasi ini?');">
                        @csrf
                        @method('DELETE') {{-- Method spoofing untuk DELETE request --}}
                        <button type="submit" class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash"></i>
                        </button>
                        
                    </form>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-between sm:hidden">
              {{ $reservasi->links('pagination::tailwind') }} {{-- Menggunakan Laravel built-in pagination links --}}
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
              <div>
                <p class="text-sm text-gray-700">
                  Menampilkan
                  <span class="font-medium">{{ $reservasi->firstItem() }}</span>
                  sampai
                  <span class="font-medium">{{ $reservasi->lastItem() }}</span>
                  dari
                  <span class="font-medium">{{ $reservasi->total() }}</span>
                  hasil
                </p>
              </div>
              <div class="pagination">
                
                  {{ $reservasi->links('pagination::tailwind') }} {{-- Menggunakan Laravel built-in pagination links --}}
                
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Tambah Reservasi (Hidden by default) -->
        <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="reservationModal">
          <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-black bg-opacity-50" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                  <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                      Tambah Reservasi Baru
                    </h3>
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                      
                      <div class="sm:col-span-3">
                        <form action="/admin/reservasi/tambah" method="post">
                          @csrf
                        <label for="customer" class="block text-sm font-medium text-gray-700">Tamu</label>
                        <select id="customer" name="tamu_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                          <option>Pilih Tamu</option>
                          @foreach ($tamu as $dataTamu)
                              <option value="{{ $dataTamu->id }}">{{ $dataTamu->nama }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="sm:col-span-3">
                        
                        <label for="room-type" class="block text-sm font-medium text-gray-700">Pilih Kamar</label>
                        <select id="room-type" name="kamar_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                          <option>Pilih Kamar</option>
                          @foreach ($kamar as $dataKamar)
                          <option value="{{ $dataKamar->id }}">{{ $dataKamar->nama_kamar }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="sm:col-span-2">
                        <label for="check-in" class="block text-sm font-medium text-gray-700">Check-In</label>
                        <input type="date" name="tanggal_checkin" id="check-in" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                      </div>

                      <div class="sm:col-span-2">
                        <label for="check-out" class="block text-sm font-medium text-gray-700">Check-Out</label>
                        <input type="date" name="tanggal_checkout" id="check-out" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                      </div>
                      <div class="sm:col-span-3">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status_reservasi" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                          <option value="pending">Pending</option>
                          <option value="confirmed">Confirmed</option>
                          <option value="cancelled">Cancelled</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                  Simpan Reservasi
                </button>
                <div class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="cancelModal">
                  Batal
                </div>
                   </form>
              </div>
            </div>
          </div>
        </div>


      <!-- Modal Detail Reservasi (Hidden by default) -->
          <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="reservationDetailModal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
              <div class="fixed inset-0 bg-black bg-opacity-50" aria-hidden="true"></div>
              <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
              <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                  <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                      <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Detail Reservasi
                      </h3>
                      <div id="detailContent" class="space-y-4 mt-4 text-sm text-gray-700">
                        <p><strong>Nama Tamu:</strong> <span id="detailNamaTamu"></span></p>
                        <p><strong>Nama Kamar:</strong> <span id="detailNamaKamar"></span></p>
                        <p><strong>Check-In:</strong> <span id="detailCheckIn"></span></p>
                        <p><strong>Check-Out:</strong> <span id="detailCheckOut"></span></p>
                        <p><strong>Status:</strong> <span id="detailStatus"></span></p>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                  <button type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:w-auto sm:text-sm" id="closeDetailModal">
                    Kembali
                  </button>
                </div>
                
              </div>
            </div>
          </div>


   <!-- Modal Edit Reservasi (Hidden by default) -->
   <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="reservationModalEdit">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div class="fixed inset-0 bg-black bg-opacity-50" aria-hidden="true"></div>
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
      <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
              <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                Edit Reservasi Baru
              </h3>
              <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                
                <div class="sm:col-span-3">
                  <form id="formEditReservation" action="/admin/reservasi/update" method="post">
                    @csrf
                    <input type="hidden" name="reservasi_id" id="reservasi_id">
                  <label for="customerEdit" class="block text-sm font-medium text-gray-700">Tamu</label>
                  <select id="customerEdit" name="tamu_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option>Pilih Tamu</option>
                    @foreach ($tamu as $dataTamu)
                        <option value="{{ $dataTamu->id }}">{{ $dataTamu->nama }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="sm:col-span-3">
                  
                  <label for="room-typeEdit" class="block text-sm font-medium text-gray-700">Pilih Kamar</label>
                  <select id="room-typeEdit" name="kamar_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option>Pilih Kamar</option>
                    @foreach ($kamar as $dataKamar)
                    <option value="{{ $dataKamar->id }}">{{ $dataKamar->nama_kamar }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="sm:col-span-2">
                  <label for="check-inEdit" class="block text-sm font-medium text-gray-700">Check-In</label>
                  <input type="date" name="tanggal_checkin" id="check-inEdit" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="sm:col-span-2">
                  <label for="check-outEdit" class="block text-sm font-medium text-gray-700">Check-Out</label>
                  <input type="date" name="tanggal_checkout" id="check-outEdit" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                

              
                <div class="sm:col-span-3">
                  <label for="statusEdit" class="block text-sm font-medium text-gray-700">Status</label>
                  <select id="statusEdit" name="status_reservasi" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
            Update Reservasi
          </button>
          <div class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="cancelModalEdit">
            Batal
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>

</main>
</div>
</div>

  <script>
    // Simple script to handle modal
    document.addEventListener('DOMContentLoaded', function() {
      const modal = document.getElementById('reservationModal');
      const addBtn = document.getElementById('buttonAddReservation');
      const cancelBtn = document.getElementById('cancelModal');

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

      const modalEdit = document.getElementById('reservationModalEdit');
      const editBtns = document.querySelectorAll('.buttonEditReservation');
      const cancelBtnEdit = document.getElementById('cancelModalEdit');


    editBtns.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            fetch(`/admin/reservasi/get/${id}`)
                .then(response => response.json())
                .then(data => {
                    // Set nilai ke input
                    document.getElementById('reservasi_id').value = data.id;
                    document.getElementById('check-inEdit').value = data.tanggal_checkin;
                    document.getElementById('check-outEdit').value = data.tanggal_checkout;

                    // Set selected option
                    document.getElementById('customerEdit').value = data.tamu_id;
                    // let tamuSelect = document.getElementById("customerEdit");
                    // for (let i = 0; i < tamuSelect.options.length; i++) {
                    //   if (tamuSelect.options[i].text === data.tamu.nama) {
                    //     tamuSelect.selectedIndex = i;
                    //     break;
                    //   }
                    // }

                    let roomType = document.getElementById('room-typeEdit');
                    // Buat elemen option baru
                    var optionRoom = document.createElement("option");
                    optionRoom.value = data.kamar_id;
                    optionRoom.text = data.nama_kamar;

                    // Tambahkan option ke dalam select
                    roomType.appendChild(optionRoom);
                    roomType.value = data.kamar_id;                   
                    // document.getElementById('payment-methodEdit').value = data.pembayaran.metode_pembayaran;
                    document.getElementById('statusEdit').value = data.status_reservasi;

                    // Tampilkan modal
                    modalEdit.classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal mengambil data reservasi');
                });
        });
    });

    cancelBtnEdit.addEventListener('click', function () {
        modalEdit.classList.add('hidden');
    });

    const detailBtns = document.querySelectorAll('.buttonDetailReservation');
    const modalDetail = document.getElementById('reservationDetailModal');
    const closeDetail = document.getElementById('closeDetailModal');

    detailBtns.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');

            fetch(`/admin/reservasi/get/${id}`)
                .then(response => response.json())
                .then(data => {
                    // Isi konten modal
                    document.getElementById('detailNamaTamu').textContent = data.nama_tamu;
                    document.getElementById('detailNamaKamar').textContent = data.nama_kamar;
                    document.getElementById('detailCheckIn').textContent = data.tanggal_checkin;
                    document.getElementById('detailCheckOut').textContent = data.tanggal_checkout;
                    document.getElementById('detailStatus').textContent = data.status_reservasi;

                    // Tampilkan modal
                    modalDetail.classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Gagal mengambil data detail:', error);
                    alert('Terjadi kesalahan saat mengambil data detail.');
                });
        });
    });

    closeDetail.addEventListener('click', function () {
        modalDetail.classList.add('hidden');
    });

  });

  
  </script>
</body>

</html>