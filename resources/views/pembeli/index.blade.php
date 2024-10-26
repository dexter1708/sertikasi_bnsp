@extends('home')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Daftar Pembeli</h2>
        <a href="{{ route('pembeli.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Tambah Pembeli
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <table class="min-w-full bg-white">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border-b">Nama Pembeli</th>
                <th class="py-2 px-4 border-b">Alamat</th>
                <th class="py-2 px-4 border-b">Total Pembelian</th>
                <th class="py-2 px-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembeli as $p)
            <tr>
                <td class="py-2 px-4 border-b">{{ $p->nama_pembeli }}</td>
                <td class="py-2 px-4 border-b">{{ $p->alamat_pembeli }}</td>
                <td class="py-2 px-4 border-b">Rp {{ number_format($p->total_pembelian, 0, ',', '.') }}</td>
                <td class="py-2 px-4 border-b">
                    {{-- <a href="{{ route('pembeli.edit', $p->pembeli_id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a> --}}
                    <form action="{{ route('pembeli.destroy', $p->pembeli_id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Apakah Anda yakin ingin menghapus pembeli ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
