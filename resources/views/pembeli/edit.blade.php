@extends('Home')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg mt-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Pembeli</h1>
    <form action="{{ route('pembeli.update', $pembeli->pembeli_id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Nama Pembeli -->
        <div>
            <label for="nama_pembeli" class="block text-sm font-medium text-gray-700 mb-1">Nama Pembeli</label>
            <input type="text" id="nama_pembeli" name="nama_pembeli"
                value="{{ old('nama_pembeli', $pembeli->nama_pembeli) }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
        </div>

        <!-- Alamat Pembeli -->
        <div>
            <label for="alamat_pembeli" class="block text-sm font-medium text-gray-700 mb-1">Alamat Pembeli</label>
            <input type="text" id="alamat_pembeli" name="alamat_pembeli"
                value="{{ old('alamat_pembeli', $pembeli->alamat_pembeli) }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
        </div>

        <!-- Total Pembelian -->
        <div>
            <label for="total_pembelian" class="block text-sm font-medium text-gray-700 mb-1">Total Pembelian</label>
            <input type="number" step="0.01" id="total_pembelian" name="total_pembelian"
                value="{{ old('total_pembelian', $pembeli->total_pembelian) }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
        </div>

        <!-- Tombol Submit -->
        <div class="text-right">
            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
