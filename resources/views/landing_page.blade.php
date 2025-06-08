<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Garut Indah</title>
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

  <!-- HERO -->
  <section class="relative z-10 h-[83vh]">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/src/img/hero1.webp');"></div>
    <div class="relative z-10 flex justify-center items-end h-full pb-16">
      <div class="flex bg-white rounded shadow-lg overflow-hidden divide-x divide-gray-300">
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
        <div class="p-5 text-center">
          <label class="block text-l font-bold text-gray-900 pb-2">CHECK-IN</label>
          <input type="date" id="checkin-date"
            class="w-full mt-1 text-sm text-gray-800 bg-transparent border-none focus:ring-0" min="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="p-5 text-center">
          <label class="block text-l font-bold text-gray-900 pb-2">CHECK-OUT</label>
          <input type="date" id="checkout-date"
            class="w-full mt-1 text-sm text-gray-800 bg-transparent border-none focus:ring-0" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
        </div>
        <div class="p-5">
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
        <div class="p-5">
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

  <!-- HOTEL SECTION -->
  <section class="w-full bg-white py-14">
    <h1 class="text-[#1e2366] text-5xl font-bold uppercase flex justify-center mb-10">Hotel Garut Indah</h1>
    <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-2 gap-20 items-center">
      <div class="text-cyan-950 space-y-4 font-thin">
        <p>Selamat datang di <strong class="font-black">Hotel Garut Indah – "Gerbang Menuju Pesona Garut"</strong>,
          pilihan sempurna bagi Anda yang menginginkan kenyamanan modern berpadu dengan sentuhan klasik khas pegunungan.
        </p>
        <p>Terletak di jantung kota Garut, hotel kami menawarkan akses mudah ke berbagai destinasi wisata, mulai dari
          pemandian air panas, situs budaya, hingga pesona alam yang memikat.</p>
        <p>Dengan suasana hangat, desain elegan, dan pelayanan ramah, <strong class="font-black">Hotel Garut
            Indah</strong> hadir untuk memberikan pengalaman menginap yang berkesan, baik untuk liburan maupun
          perjalanan bisnis Anda.</p>
      </div>
      <div class="flex justify-center">
        <img src="/src/img/gambar_hotel.jpg" alt="Hotel Garut Indah"
          class="w-[600px] h-[400px] rounded shadow-xl object-cover">
      </div>
    </div>
  </section>

  <!-- PHOTO GALLERY -->
  <section class="w-full py-14" style="background-color: #E9F3C2;">
    <h1 class="text-[#1e2366] text-4xl font-bold uppercase flex justify-center mb-10">Photo Gallery</h1>
    <div class="max-w-7xl mx-auto">
      <h2 class="text-[#1e2366] text-2xl font-bold flex justify-start mt-10 mb-5">Area Kamar</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <img src="/src/img/gallery/kamar1.png" alt="" class="w-full h-64 object-cover rounded shadow-md">
        <img src="/src/img/gallery/kamar2.jpg" alt="" class="w-full h-64 object-cover rounded shadow-md">
        <img src="/src/img/gallery/kamar4.png" alt="" class="w-full h-64 object-cover rounded shadow-md">
      </div>
    </div>
    <div class="max-w-7xl mx-auto">
      <h2 class="text-[#1e2366] text-2xl font-bold flex justify-start mt-10 mb-5">Area Luar</h2>
      <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <img src="/src/img/gallery/area_luar1.jpg" alt="" class="w-full h-64 object-cover rounded shadow-md">
        <img src="/src/img/gallery/area_luar2.jpg" alt="" class="w-full h-64 object-cover rounded shadow-md">
        <img src="/src/img/gallery/area_luar3.webp" alt=""
          class="w-full h-64 object-cover rounded shadow-md">
      </div>
    </div>
  </section>

  <!-- OUR LOCATIONS -->
  <section class="w-full py-14 bg-white">
    <h2 class="text-[#1e2366] text-4xl font-bold uppercase flex justify-center mb-10">Hotel & Lokasi Kami</h2>
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 px-4">
      <!-- Lokasi 1 -->
      <div
        class="bg-white rounded-lg shadow-2xl overflow-hidden text-gray-800 transition-transform duration-300 transform hover:scale-105">
        <img src="/src/img/lokasi/garut_kota.jpg" alt="Hotel Garut Kota" class="w-full h-48 object-cover">
        <div class="p-5 space-y-2">
          <h3 class="text-xl font-bold text-[#1e2366]">Hotel Garut Kota</h3>
          <p>Terletak strategis di pusat kota, dekat alun-alun Garut dan pusat oleh-oleh khas daerah.</p>
          <a href="https://www.google.com/maps/place/Kec.+Garut+Kota,+Kabupaten+Garut,+Jawa+Barat/@-7.2318882,107.8919601,13z/data=!3m1!4b1!4m6!3m5!1s0x2e68b1e90e25ddc5:0x326e55883d347c43!8m2!3d-7.2156958!4d107.8993157!16zL20vMGcwNDJs?entry=ttu&g_ep=EgoyMDI1MDUyOC4wIKXMDSoASAFQAw%3D%3D"
            class="inline-block mt-2 text-sm font-semibold text-[#1e2366] hover:underline" target="blank_">Lihat
            Lokasi</a>
        </div>
      </div>

      <!-- Lokasi 2 -->
      <div
        class="bg-white rounded-lg shadow-2xl overflow-hidden text-gray-800 transition-transform duration-300 transform hover:scale-105">
        <img src="/src/img/lokasi/cipanas.jpg" alt="Hotel Cipanas" class="w-full h-48 object-cover">
        <div class="p-5 space-y-2">
          <h3 class="text-xl font-bold text-[#1e2366]">Hotel Cipanas</h3>
          <p>Nikmati pemandian air panas alami langsung dari kaki Gunung Guntur, cocok untuk relaksasi keluarga.</p>
          <a href="https://www.google.com/maps/place/Cipanas+Garut/@-7.1783401,107.8665377,17z/data=!4m10!1m2!2m1!1scipanas+garut!3m6!1s0x2e68b17df9cac83b:0x6ad7d742369db4af!8m2!3d-7.1783401!4d107.8711657!15sCg1jaXBhbmFzIGdhcnV0Wg8iDWNpcGFuYXMgZ2FydXSSAQ5hcXVhdGljX2NlbnRlcpoBI0NoWkRTVWhOTUc5blMwVkpRMEZuU1VOc2MzTlVlVk5CRUFFqgFCEAEqCyIHY2lwYW5hcygmMh4QASIaOtMqYTgTXr-dhSwKY6y6U5SFFH3eIK85vOoyERACIg1jaXBhbmFzIGdhcnV04AEA-gEECAAQRw!16s%2Fg%2F11fm79vxc1?entry=ttu&g_ep=EgoyMDI1MDUyOC4wIKXMDSoASAFQAw%3D%3D"
            class="inline-block mt-2 text-sm font-semibold text-[#1e2366] hover:underline" target="blank_">Lihat
            Lokasi</a>
        </div>
      </div>

      <!-- Lokasi 3 -->
      <div
        class="bg-white rounded-lg shadow-2xl overflow-hidden text-gray-800 transition-transform duration-300 transform hover:scale-105">
        <img src="/src/img/lokasi/kebun_teh.jpg" alt="Hotel Samarang" class="w-full h-48 object-cover">
        <div class="p-5 space-y-2">
          <h3 class="text-xl font-bold text-[#1e2366]">Hotel Samarang</h3>
          <p>Terletak dekat perkebunan teh dan area camping, menawarkan pemandangan alam yang sejuk dan asri.</p>
          <a href="https://www.google.com/maps/place/Kebun+Mawar+SITUHAPA+Samarang/@-7.1857259,107.7749663,13z/data=!4m18!1m8!3m7!1s0x2e68ba342ecf78af:0x35a2ab908db9623a!2sKec.+Samarang,+Kabupaten+Garut,+Jawa+Barat!3b1!8m2!3d-7.2183112!4d107.8412619!16s%2Fg%2F121g1wfl!3m8!1s0x2e68bbd1a497396d:0x9686b95d592149b8!5m2!4m1!1i2!8m2!3d-7.1937845!4d107.8111818!16s%2Fg%2F12hnmg7dv?entry=ttu&g_ep=EgoyMDI1MDUyOC4wIKXMDSoASAFQAw%3D%3D"
            class="inline-block mt-2 text-sm font-semibold text-[#1e2366] hover:underline" target="blank_">Lihat
            Lokasi</a>
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
