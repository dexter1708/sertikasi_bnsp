@extends('home')

@section('content')
<section class="min-h-screen p-6 flex items-center justify-center bg-gray-100">
    <div class="container max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <form action="{{ route('orders') }}" method="POST">
                @csrf
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-blue-900 uppercase">
                        Tambah Order Baru
                    </h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Silakan isi detail order yang akan ditambahkan
                    </p>
                </div>

                <div class="space-y-6">
                    <!-- Ganti input pembeli dan alamat dengan dropdown pembeli -->
                    <div>
                        <label for="pembeli_id">Pembeli</label>
                        <select name="pembeli_id" id="pembeli_id" required>
                            @foreach($pembeli as $p)
                                <option value="{{ $p->pembeli_id }}">{{ $p->nama_pembeli }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="buku_id" class="block text-sm font-medium text-gray-700">Pilih Buku</label>
                        <select name="buku_id" id="buku_id" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Buku</option>
                            @foreach ($buku as $b)
                                <option value="{{ $b->buku_id }}" data-harga="{{ $b->harga }}">{{ $b->nama }} {{$b->stok}}</option>
                            @endforeach
                        </select>
                        @error('buku_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700">Harga Satuan</label>
                        <input type="text" id="harga" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-100 shadow-sm" readonly>
                    </div>

                    <div>
                        <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Beli</label>
                        <input type="number" name="jumlah" id="jumlah" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="subtotal" class="block text-sm font-medium text-gray-700">Total Harga</label>
                        <input type="text" id="subtotal" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-100 shadow-sm" readonly>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm font-medium text-white transition-colors duration-200">
                            Tambah Transaksi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Script for Dynamic Price and Total Calculation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bukuSelect = document.getElementById('buku_id');
            const hargaInput = document.getElementById('harga');
            const jumlahBeliInput = document.getElementById('jumlah');
            const totalHargaInput = document.getElementById('subtotal');

            bukuSelect.addEventListener('change', function() {
                const selectedOption = bukuSelect.options[bukuSelect.selectedIndex];
                const harga = selectedOption.getAttribute('data-harga');
                hargaInput.value = harga;

                hitungTotal();
            });

            jumlahBeliInput.addEventListener('input', function() {
                hitungTotal();
            });

            function hitungTotal() {
                const harga = parseInt(hargaInput.value) || 0;
                const jumlahBeli = parseInt(jumlahBeliInput.value) || 0;
                const total = `Rp ${(harga*jumlahBeli).toLocaleString()}`;
                totalHargaInput.value = total;
            }
        });
    </script>
</section>
@endsection
