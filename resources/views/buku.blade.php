@extends('home')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="flex justify-between items-center p-6 bg-blue-900 text-white">
        <h2 class="text-2xl font-bold">Daftar Buku</h2>
        <a href="/input" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
            Tambah Buku
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Gambar</th>
                    <th scope="col" class="px-6 py-3">Judul Buku</th>
                    <th scope="col" class="px-6 py-3">Kategori</th>
                    <th scope="col" class="px-6 py-3">Penulis</th>
                    <th scope="col" class="px-6 py-3">Penerbit</th>
                    <th scope="col" class="px-6 py-3">Harga Satuan</th>
                    <th scope="col" class="px-6 py-3">Stok</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buku as $b)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-4">
                        <img src="{{ asset('storage/buku/'.$b->gambar) }}" class="w-16 h-24 object-cover" alt="{{ $b->nama }}">
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $b->nama }}</td>
                    <td class="px-6 py-4">{{ $b->kategori->nama_kategori }}</td>
                    <td class="px-6 py-4">{{ $b->penulis }}</td>
                    <td class="px-6 py-4">{{ $b->penerbit }}</td>
                    <td class="px-6 py-4">Rp{{ number_format($b->harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">{{ $b-> stok            }}</td>
                    <td class="px-6 py-4">
                        <a href="/edit/{{ $b->buku_id }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                        <form action="/{{ $b->buku_id }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                            @csrf
                            @method('delete')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
