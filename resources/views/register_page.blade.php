<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Garut Indah</title>
  <link rel="icon" href="/src/img/logo.png" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>


<body class="text-gray-800" style="font-family: 'Poppins', sans-serif;">
  <div class="min-h-screen flex items-center justify-center bg-[#0A1C50]">
    <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md">
      <h2 class="text-2xl font-bold text-center text-[#0A1C50] mb-6">Buat Akun Baru</h2>

      <form action="#" method="POST" class="space-y-5">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
          <input type="text" id="name" name="name" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#0A1C50] focus:border-[#0A1C50]">
        </div>

        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email" name="email" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#0A1C50] focus:border-[#0A1C50]">
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
          <input type="password" id="password" name="password" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#0A1C50] focus:border-[#0A1C50]">
        </div>

        <div>
          <label for="confirm-password" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
          <input type="password" id="confirm-password" name="confirm-password" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#0A1C50] focus:border-[#0A1C50]">
        </div>

        <button type="submit"
          class="w-full bg-[#0A1C50] text-white py-2 px-4 rounded-md hover:bg-[#1E2C75] transition duration-200">
          Daftar
        </button>
      </form>

      <p class="mt-6 text-center text-sm text-gray-600">
        Sudah punya akun?
        <a href="login.html" class="text-[#0A1C50] hover:underline font-medium">Masuk Sekarang</a>
      </p>
    </div>
  </div>
</body>

</html>
