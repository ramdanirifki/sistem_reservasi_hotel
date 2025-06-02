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
    input[type="date"]::-webkit-calendar-picker-indicator {
      filter: invert(0.5);
      cursor: pointer;
    }

    input[type="date"] {
      appearance: none;
      -webkit-appearance: none;
      color: #1e2366;
      font-weight: 500;
    }

    #check-rates-btn:disabled {
      background-color: #1e236677 !important;
      cursor: not-allowed !important;
    }
  </style>
</head>

<body class="text-white" style="font-family: 'Poppins', sans-serif;">
  <!-- HEADER -->
  <header class="bg-[#1b1f58]">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center text-sm">
      <div class="flex items-center gap-6">
        <a href=""><img src="/src/img/logo.png" alt="Logo" class="w-20 h-auto"></a>
        <nav class="md:flex gap-6 uppercase">
          <a href="#" class="hover:underline font-semibold">Photo Gallery</a>
          <a href="#" class="hover:underline font-semibold">Locations</a>
          <a href="#" class="hover:underline font-semibold">Blog</a>
        </nav>
      </div>
      <div class="flex items-center gap-4">
        <span class="font-semibold uppercase">Call Us</span>
        <span>+62-21-7279 9797</span>
        <a href="#" class="uppercase">ID ▾</a>
      </div>
    </div>

    <nav class="bg-[#101547] border-t border-white/20">
      <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center text-sm">
        <ul class="flex flex-wrap gap-6">
          <li><a href="#" class="hover:underline">Selamat Datang</a></li>
          <li><a href="#" class="hover:underline">Promosi</a></li>
          <li><a href="#" class="hover:underline">Groups & Meetings</a></li>
          <li><a href="#" class="hover:underline">Hotel Kami ▾</a></li>
          <li><a href="#" class="hover:underline">Lokasi Kami ▾</a></li>
          <li><a href="#" class="hover:underline">Our People ▾</a></li>
          <li><a href="#" class="hover:underline">Galeri ▾</a></li>
          <li><a href="#" class="hover:underline">Berita Terkini</a></li>
          <li><a href="#" class="hover:underline">Karir</a></li>
        </ul>
        <ul class="flex gap-4 text-sm">
          <li><a href="#" aria-label="Facebook" class="hover:text-blue-500"><i class="fab fa-facebook-f"></i></a>
          </li>
          <li><a href="#" aria-label="Instagram" class="hover:text-pink-500"><i class="fab fa-instagram"></i></a>
          </li>
          <li><a href="#" aria-label="Twitter" class="hover:text-sky-400"><i class="fab fa-twitter"></i></a></li>
          <li><a href="#" aria-label="WhatsApp" class="hover:text-green-500"><i class="fab fa-whatsapp"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- SEARCH SECTION -->
  <section class="bg-[#1e2366] py-8 bg-cover bg-[position:center_bottom]"
    style="background-image: url('/src/img/hero2.jpg')">
    <h1 class="text-3xl font-bold mb-6 max-w-7xl mx-auto px-4">RESERVASI KAMAR</h1>
    <div class="flex justify-center">
      <!-- Search Form - Modified to remove empty space -->
      <div class="flex bg-white rounded shadow-lg overflow-hidden">
        <div class="p-5">
          <label class="block text-l font-bold text-gray-900 pb-2">FIND A HOTEL</label>
          <select id="hotel-select" class="w-40 bg-transparent border-none focus:ring-0 cursor-pointer"
            style="font-weight: 500; color:#1e2366">
            <option value="">-Please Select-</option>
            <option value="garut_kota">Garut Kota</option>
            <option value="cipanas">Cipanas</option>
            <option value="samarang">Samarang</option>
          </select>
        </div>
        <div class="p-5 text-center border-l border-gray-300">
          <label class="block text-l font-bold text-gray-900 pb-2">CHECK-IN</label>
          <input type="date" id="checkin-date"
            class="w-full mt-1 text-sm text-gray-800 bg-transparent border-none focus:ring-0" min="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="p-5 text-center border-l border-gray-300">
          <label class="block text-l font-bold text-gray-900 pb-2">CHECK-OUT</label>
          <input type="date" id="checkout-date"
            class="w-full mt-1 text-sm text-gray-800 bg-transparent border-none focus:ring-0" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
        </div>
        <div class="p-5 border-l border-gray-300">
          <label class="block text-l font-bold text-gray-900 pb-2">ROOM</label>
          <div class="mt-1">
            <select class="w-40 bg-transparent border-none focus:ring-0 cursor-pointer"
              style="font-weight: 500; color:#1e2366">
              <option>Standar</option>
              <option>Superior</option>
              <option>Deluxe</option>
              <option>Suite</option>
            </select>
          </div>
        </div>
        <div class="p-5 border-l border-gray-300">
          <label class="block text-l font-bold text-gray-900 pb-2">PROMO CODE</label>
          <input type="text"
            class="w-32 px-2 py-1 border border-gray-300 rounded text-gray-800 text-sm focus:outline-none focus:border-[#1e2366] focus:ring-1 focus:ring-[#1e2366]"
            style="font-weight: 500; color:#1e2366" />
        </div>
        <div class="bg-[#1e2366] hover:bg-[#1e2366]/90 text-white flex items-center justify-center">
          <button id="check-rates-btn" class="p-5 px-10 text-sm font-semibold h-full w-full cursor-pointer"
            disabled>CHECK RATES</button>
        </div>
      </div>
    </div>
  </section>

  <!-- ROOM SELECTION -->
  <section class="w-full bg-white py-14">
    <div class="max-w-7xl mx-auto px-4">
      <h2 class="text-[#1e2366] text-3xl font-bold mb-8">PILIH KAMAR</h2>

      <!-- Room 1 -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="col-span-1">
          <img src="/src/img/rooms/kamar2.jpg" alt="Kamar Standar"
            class="w-full h-64 object-cover rounded-lg shadow-md">
        </div>
        <div class="col-span-2 text-[#1e2366]">
          <h3 class="text-2xl font-bold mb-2">Kamar Standar</h3>
          <p class="mb-4">Kamar nyaman dengan tempat tidur double atau twin, AC, TV layar datar, dan kamar mandi
            pribadi dengan shower.</p>
          <div class="flex items-center gap-4 mb-4">
            <span class="font-bold text-xl">Rp 450.000</span>
            <span class="text-sm">/malam</span>
          </div>
          <button class="bg-[#1e2366] text-white px-6 py-2 rounded hover:bg-[#1e2366]/90 transition">Pilih
            Kamar</button>
        </div>
      </div>

      <!-- Room 2 -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="col-span-1">
          <img src="/src/img/rooms/kamar4.png" alt="Kamar Superior"
            class="w-full h-64 object-cover rounded-lg shadow-md">
        </div>
        <div class="col-span-2 text-[#1e2366]">
          <h3 class="text-2xl font-bold mb-2">Kamar Superior</h3>
          <p class="mb-4">Kamar lebih luas dengan view kota atau pegunungan, dilengkapi fasilitas lengkap termasuk
            minibar dan coffee maker.</p>
          <div class="flex items-center gap-4 mb-4">
            <span class="font-bold text-xl">Rp 650.000</span>
            <span class="text-sm">/malam</span>
          </div>
          <button class="bg-[#1e2366] text-white px-6 py-2 rounded hover:bg-[#1e2366]/90 transition">Pilih
            Kamar</button>
        </div>
      </div>

      <!-- Room 3 -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="col-span-1">
          <img src="/src/img/rooms/kamar1.png" alt="Kamar Deluxe"
            class="w-full h-64 object-cover rounded-lg shadow-md">
        </div>
        <div class="col-span-2 text-[#1e2366]">
          <h3 class="text-2xl font-bold mb-2">Kamar Deluxe</h3>
          <p class="mb-4">Kamar mewah dengan area lounge terpisah, kamar mandi luas dengan bathtub, dan fasilitas
            premium.</p>
          <div class="flex items-center gap-4 mb-4">
            <span class="font-bold text-xl">Rp 850.000</span>
            <span class="text-sm">/malam</span>
          </div>
          <button class="bg-[#1e2366] text-white px-6 py-2 rounded hover:bg-[#1e2366]/90 transition">Pilih
            Kamar</button>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="bg-[#1b1f58] text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-10">
      <!-- About -->
      <div>
        <h3 class="text-xl font-semibold mb-4">Tentang Garut Indah</h3>
        <p class="text-sm leading-relaxed">
          Hotel Garut Indah adalah destinasi akomodasi yang menggabungkan kenyamanan modern dengan keindahan alam
          pegunungan Garut. Nikmati pengalaman menginap yang tak terlupakan bersama kami.
        </p>
      </div>

      <!-- Navigation -->
      <div>
        <h3 class="text-xl font-semibold mb-4">Navigasi</h3>
        <ul class="space-y-2 text-sm">
          <li><a href="#" class="hover:underline">Beranda</a></li>
          <li><a href="#" class="hover:underline">Galeri Foto</a></li>
          <li><a href="#" class="hover:underline">Lokasi</a></li>
          <li><a href="#" class="hover:underline">Blog</a></li>
          <li><a href="#" class="hover:underline">Hubungi Kami</a></li>
        </ul>
      </div>

      <!-- Contact Info -->
      <div>
        <h3 class="text-xl font-semibold mb-4">Hubungi Kami</h3>
        <ul class="text-sm space-y-2">
          <li><i class="fas fa-map-marker-alt mr-2"></i> Jl. Cikuray No. 123, Garut, Jawa Barat</li>
          <li><i class="fas fa-phone mr-2"></i> +62-21-7279 9797</li>
          <li><i class="fas fa-envelope mr-2"></i> info@garutindah.com</li>
        </ul>
      </div>
    </div>

    <div class="border-t border-white/20 mt-10 py-4 text-center text-sm bg-[#101547]">
      <p>&copy; 2025 Hotel Garut Indah. All rights reserved.</p>
    </div>
  </footer>

  <!-- Scripts -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Date Picker Functionality
      const checkinDate = document.getElementById('checkin-date');
      const checkoutDate = document.getElementById('checkout-date');
      const hotelSelect = document.getElementById('hotel-select');
      const checkRatesBtn = document.getElementById('check-rates-btn');

      // Set initial dates
      const today = new Date().toISOString().split('T')[0];
      const tomorrow = new Date();
      tomorrow.setDate(tomorrow.getDate() + 1);
      const tomorrowStr = tomorrow.toISOString().split('T')[0];

      checkinDate.min = today;
      checkoutDate.min = tomorrowStr;
      checkinDate.value = today;
      checkoutDate.value = tomorrowStr;

      // Disable button initially
      checkRatesBtn.disabled = true;

      // Hotel select change handler
      hotelSelect.addEventListener('change', function() {
        checkRatesBtn.disabled = this.value === '';
      });

      // Checkin date change handler
      checkinDate.addEventListener('change', function() {
        if (this.value) {
          const nextDay = new Date(this.value);
          nextDay.setDate(nextDay.getDate() + 1);
          checkoutDate.min = nextDay.toISOString().split('T')[0];

          if (new Date(checkoutDate.value) < nextDay) {
            checkoutDate.value = checkoutDate.min;
          }
        }
      });
    });
  </script>
</body>

</html>
