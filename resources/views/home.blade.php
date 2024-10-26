<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Buku Mas Rusdi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body class="flex bg-gray-100">
    <!-- Sidebar -->
    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen bg-blue-900 transition-transform -translate-x-full sm:translate-x-0">
        <div class="h-full px-3 py-4 overflow-y-auto">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('home') }}" class="flex items-center p-2 text-white rounded-lg group hover:bg-blue-800">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Toko Buku Mas Rusdi" class="h-8 w-auto">
                        <span class="ms-3">Toko Buku Mas Rusdi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('listBuku')}}" class="flex items-center p-2 text-white rounded-lg group hover:bg-blue-800">
                        <span class="ms-3">Buku</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('list_order')}}" class="flex items-center p-2 text-white rounded-lg group hover:bg-blue-800">
                        <span class="ms-3">Order Buku</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pembeli.index')}}" class="flex items-center p-2 text-white rounded-lg group hover:bg-blue-800">
                        <span class="ms-3">Pembeli</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <!-- Main content -->
    <div class="flex-grow ml-64 p-8 bg-white">
        @yield('content')
    </div>
</body>
</html>
