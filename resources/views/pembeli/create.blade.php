@extends('home')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Tambah Pembeli Baru</h2>

    <form action="{{ route('pembeli.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nama_pembeli" class="block text-gray-700 text-sm font-bold mb-2">Nama Pembeli:</label>
            <input type="text" name="nama_pembeli" id="nama_pembeli" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="alamat_pembeli" class="block text-gray-700 text-sm font-bold mb-2">Alamat Pembeli:</label>
            <textarea name="alamat_pembeli" id="alamat_pembeli" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Tambah Pembeli
            </button>
            <a href="{{ route('pembeli.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
