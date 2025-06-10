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
              <div class="relative">
                <select class="block appearance-none w-full bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                  <option>Semua Status</option>
                  <option>Pending</option>
                  <option>Lunas</option>
                  <option>Gagal</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                  <i class="fas fa-chevron-down"></i>
                </div>
              </div>
              <div class="relative">
                <input type="text" placeholder="Cari pembayaran..." class="bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 pr-10 rounded w-full focus:outline-none focus:bg-white focus:border-gray-500">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                  <i class="fas fa-search text-gray-400"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Tabel Pembayaran -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
          <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Pembayaran</h2>
            <div class="text-sm text-gray-500">
              Menampilkan 1 sampai 10 dari 25 hasil
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
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <!-- Sample data rows -->
                <tr class="hover:bg-gray-50">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">1</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-blue-600">#12345</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div>
                        <div class="text-sm font-medium text-gray-900">John Doe</div>
                        <div class="text-sm text-gray-500">john@example.com</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">2023-05-15</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">Rp 1.500.000</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900 capitalize">transfer</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                      Lunas
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex space-x-2">
                      <button class="text-blue-600 hover:text-blue-900">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button class="text-yellow-600 hover:text-yellow-900">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="text-red-600 hover:text-red-900">
                        <i class="fas fa-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
                <tr class="hover:bg-gray-50">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">2</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-blue-600">#12346</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div>
                        <div class="text-sm font-medium text-gray-900">Jane Smith</div>
                        <div class="text-sm text-gray-500">jane@example.com</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">2023-05-16</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">Rp 2.000.000</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900 capitalize">kartu_kredit</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                      Pending
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex space-x-2">
                      <button class="text-blue-600 hover:text-blue-900">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button class="text-yellow-600 hover:text-yellow-900">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="text-red-600 hover:text-red-900">
                        <i class="fas fa-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
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
                  <span class="font-medium">1</span>
                  sampai
                  <span class="font-medium">10</span>
                  dari
                  <span class="font-medium">25</span>
                  hasil
                </p>
              </div>
              <div class="pl-2">
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                  <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                    <span class="sr-only">Previous</span>
                    <i class="fas fa-chevron-left"></i>
                  </a>
                  <a href="#" aria-current="page" class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                    1
                  </a>
                  <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                    2
                  </a>
                  <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                    3
                  </a>
                  <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                    <span class="sr-only">Next</span>
                    <i class="fas fa-chevron-right"></i>
                  </a>
                </nav>
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
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                      <div class="sm:col-span-6">
                        <label for="reservation" class="block text-sm font-medium text-gray-700">Reservasi</label>
                        <select id="reservation" name="reservation" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                          <option>Pilih Reservasi</option>
                          <option value="1" data-total="1500000">#1 - John Doe (Rp 1.500.000)</option>
                          <option value="2" data-total="2000000">#2 - Jane Smith (Rp 2.000.000)</option>
                          <option value="3" data-total="1750000">#3 - Robert Johnson (Rp 1.750.000)</option>
                        </select>
                      </div>

                      <div class="sm:col-span-3">
                        <label for="payment-date" class="block text-sm font-medium text-gray-700">Tanggal Pembayaran</label>
                        <input type="date" name="payment-date" id="payment-date" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                      </div>

                      <div class="sm:col-span-3">
                        <label for="payment-amount" class="block text-sm font-medium text-gray-700">Jumlah Pembayaran</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">Rp</span>
                          </div>
                          <input type="text" name="payment-amount" id="payment-amount" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                        </div>
                      </div>

                      <div class="sm:col-span-3">
                        <label for="payment-method" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                        <select id="payment-method" name="payment-method" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                          <option value="transfer">Transfer Bank</option>
                          <option value="kartu_kredit">Kartu Kredit</option>
                          <option value="tunai">Tunai</option>
                          <option value="e-wallet">E-Wallet</option>
                        </select>
                      </div>

                      <div class="sm:col-span-3">
                        <label for="payment-status" class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                        <select id="payment-status" name="payment-status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                          <option value="pending">Pending</option>
                          <option value="lunas">Lunas</option>
                          <option value="gagal">Gagal</option>
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
                                <input id="file-upload" name="file-upload" type="file" class="sr-only">
                              </label>
                              <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">
                              PNG, JPG, PDF up to 5MB
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                  Simpan Pembayaran
                </button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="cancelPaymentModal">
                  Batal
                </button>
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
    });
  </script>
</body>

</html>