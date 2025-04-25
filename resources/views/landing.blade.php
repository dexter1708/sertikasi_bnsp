<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Buku BERKAH</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-100 to-green-300 min-h-screen flex items-center justify-center">

    <div class="text-center px-6">
        <img src="https://img.icons8.com/fluency/96/000000/book.png" alt="Logo Buku" class="mx-auto mb-6">
        <h1 class="text-4xl font-bold text-green-800 mb-2">Selamat Datang</h1>
        <p class="text-lg text-gray-700 mb-6">di Website <span class="font-semibold text-green-600">Toko Buku BERKAH</span></p>
        <p class="text-sm text-gray-600 mb-10">Temukan berbagai buku pilihan dan kemudahan transaksi hanya di sini.</p>
        <a href="{{ route('login') }}"
           class="inline-block bg-green-600 text-white px-8 py-3 rounded-xl text-lg font-medium hover:bg-green-700 transition duration-300 shadow-lg">
            Login Sekarang
        </a>
    </div>

</body>
</html>
