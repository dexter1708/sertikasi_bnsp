@extends('home')

@section('content')
<section class="text-center">
    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-blue-900 md:text-5xl lg:text-6xl">Selamat Datang di TOKO BERKAH</h1>
    <p class="mb-8 text-lg font-normal text-gray-600 lg:text-xl sm:px-16 lg:px-48">TOKO BUKU BERKAH BELI DISINI SEMOGA BERKAH </p>
    <a href="{{ route('listBuku') }}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
        Mulai Cari Buku
        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
    </a>
</section>
@endsection
