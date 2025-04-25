<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Buku BERKAH</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body class="flex bg-gray-100">
    <!-- Sidebar -->
    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen bg-green-900 transition-transform -translate-x-full sm:translate-x-0">
        <div class="h-full px-3 py-4 overflow-y-auto">
        
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('home') }}" class="flex items-center p-2 text-white rounded-lg group hover:bg-blue-800">
                        <span class="ms-3 text-2xl">Toko Buku BERKAH</span>
                    </a>
                </li>
                <li>
                @auth
                <div class="flex items-center space-x-4 p-4 mb-2 bg-green-800 rounded-lg text-white">
                    {{-- Foto Profil --}}
                    @if (Auth::user()->foto)
                        <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                            class="w-12 h-12 rounded-full object-cover border-2 border-white" alt="Foto Profil">
                    @else
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-green-900 font-bold text-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif

                    {{-- Info User --}}
                    <div>
                        <a href="{{ route('profile.view') }}" class="text-sm font-semibold hover:underline">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="text-xs">{{ Auth::user()->email }}</div>
                        <div class="text-xs italic text-gray-300">{{ ucfirst(Auth::user()->role) }}</div>
                    </div>
                </div>
                @endauth
            </li>

                <li>
                    <a href="{{ route('listBuku')}}" class="flex items-center p-2 text-white rounded-lg group hover:bg-blue-800">
                        <span class="ms-3">Buku</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('list_order')}}" class="flex items-center p-2 text-white rounded-lg group hover:bg-blue-800">
                        <span class="ms-3">Penjualan Buku</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pembeli.index')}}" class="flex items-center p-2 text-white rounded-lg group hover:bg-blue-800">
                        <span class="ms-3">Pembeli</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('register')}}" class="flex items-center p-2 text-white rounded-lg group hover:bg-blue-800">
                        <span class="ms-3">Tambah Akun</span>
                    </a>
                </li>
                <li class="mt-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center p-2 text-white rounded-lg hover:bg-red-700 bg-red-600 transition duration-200">
                    <span class="ms-3">Logout</span>
        </button>
    </form>
</li>
            </ul>
        </div>
    </aside>
    <!-- Main content -->
    <div class="flex-grow ml-64 p-8 ">
        @yield('content')
    </div>
</body>
</html>
