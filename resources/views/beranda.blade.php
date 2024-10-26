@extends('home')

@section('content')
<div class="px-8 py-8 mt-12 bg-blue-950 text-white">

    <div class="flex justify-between items-center mb-6">
        <button type="button" class="transition duration-150 ease-in-out bg-blue-700 hover:scale-110 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <a href="/input">Add Product</a>
        </button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama Buku</th>
                    <th scope="col" class="px-6 py-3">Jenis</th>
                    <th scope="col" class="px-6 py-3">Jumlah</th>
                    <th scope="col" class="px-6 py-3">Tanggal Masuk</th>
                    <th scope="col" class="px-6 py-3">Tanggal Keluar</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventory as $i)
                    <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $i->nama_barang }}
                        </th>
                        <td class="px-6 py-4">{{ $i->jenis_barang }}</td>
                        <td class="px-6 py-4">{{ $i->jumlah }}</td>
                        <td class="px-6 py-4">{{ $i->tanggal_masuk }}</td>
                        <td class="px-6 py-4">{{ $i->tanggal_keluar }}</td>
                        <td class="px-6 py-4 flex">
                            <a href="/edit/{{ $i->id }}" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Edit</a>
                            <form action="/{{ $i->id }}" method="POST" class="ml-2">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
