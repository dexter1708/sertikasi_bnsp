@extends('home')

@section('content')
<section class="min-h-screen p-6 flex items-center justify-center bg-gray-100">
    <div class="container max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <form action="{{ route('orders') }}" method="POST">
                @csrf
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-blue-900 uppercase">
                        Tambah data penjualan
                    </h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Silakan isi detail data
                    </p>
                </div>

                <div class="space-y-6">
                    <!-- User -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Admin</label>
                        <input type="text"
                            value="{{ Auth::user()->name }}"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm bg-gray-100 cursor-not-allowed"
                            disabled>
                    </div>


                    <!-- Dropdown Pembeli -->
                    <div>
                        <label for="pembeli_id" class="block text-sm font-medium text-gray-700">Pembeli</label>
                        <select name="pembeli_id" id="pembeli_id" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Pembeli</option>
                            @foreach($pembeli as $p)
                                <option value="{{ $p->pembeli_id }}">{{ $p->nama_pembeli }}</option>
                            @endforeach
                        </select>
                        @error('pembeli_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Dropdown Buku -->
                    <div>
                        <label for="buku_id" class="block text-sm font-medium text-gray-700">Pilih Buku</label>
                        <select name="buku_id" id="buku_id" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Buku</option>
                            @foreach ($buku as $b)
                                <option value="{{ $b->buku_id }}" data-harga="{{ $b->harga }}">
                                    {{ $b->nama }} (Stok: {{ $b->stok }})
                                </option>
                            @endforeach
                        </select>
                        @error('buku_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Harga Satuan -->
                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700">Harga Satuan</label>
                        <input type="text" id="harga" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-100 shadow-sm" readonly>
                    </div>

                    <!-- Jumlah Beli -->
                    <div>
                        <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Beli</label>
                        <input type="number" name="jumlah" id="jumlah" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('jumlah')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        
                    </div>
                    <div class="border border-gray-300 rounded-lg p-4 shadow-sm bg-white">
                        <label for="tanggal_order" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Penjualan</label>
                        <input datepicker datepicker-autohide type="text" name="tanggal_order"  id="datepicker-input"
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            placeholder="Pilih tanggal " required />
                    </div>
                    <!-- Status Penjualan -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status Penjualan</label>
                        <select name="status" id="status" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Status</option>
                            <option value="Diproses">Diproses</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Batal">Batal</option>
                        </select>
                        @error('status')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Subtotal -->
                    <div>
                        <label for="subtotal" class="block text-sm font-medium text-gray-700">Total Harga</label>
                        <input type="text" id="subtotal" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-100 shadow-sm" readonly>
                    </div>

                    <!-- Error Handling -->
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

                    <!-- Tombol Submit -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm font-medium text-white transition-colors duration-200">
                            Tambah data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Script for Dynamic Price and Total Calculation -->
    <script>
    $(document).ready(function() {
            $('#datepicker-input').datepicker({
                dateFormat: 'yy-mm-dd',
                autoHide: true
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const bukuSelect = document.getElementById('buku_id');
            const hargaInput = document.getElementById('harga');
            const jumlahInput = document.getElementById('jumlah');
            const subtotalInput = document.getElementById('subtotal');

            function updateHargaDanSubtotal() {
                const selectedOption = bukuSelect.options[bukuSelect.selectedIndex];
                const harga = parseInt(selectedOption.getAttribute('data-harga')) || 0;
                const jumlah = parseInt(jumlahInput.value) || 0;

                hargaInput.value = harga.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                subtotalInput.value = (harga * jumlah).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
            }

            bukuSelect.addEventListener('change', updateHargaDanSubtotal);
            jumlahInput.addEventListener('input', updateHargaDanSubtotal);
        });
    </script>
</section>
@endsection
