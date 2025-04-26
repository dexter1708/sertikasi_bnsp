@extends('home')

@section('content')
<section class="min-h-screen p-6 flex items-center justify-center bg-gray-100">
    <div class="container max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                    <ul class="mt-3 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            <form action="{{ route('orders.update', $order->order_id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="buku_id" value="{{ $order->buku_id }}">
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-blue-900 uppercase">
                        Edit Data penjualan
                    </h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Silakan edit data penjualan
                </div>

                <div class="space-y-6">
                    <div>
                        <label for="pembeli_id" class="block text-sm font-medium text-gray-700">Pembeli</label>
                        <select name="pembeli_id" id="pembeli_id" disabled
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-100">
                            @foreach($pembeli as $p)
                                <option value="{{ $p->pembeli_id }}" {{ $order->pembeli_id == $p->pembeli_id ? 'selected' : '' }}>
                                    {{ $p->nama_pembeli }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="buku_id" class="block text-sm font-medium text-gray-700">Pilih Buku</label>
                        <select name="buku_id" id="buku_id" disabled
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-100">
                            @foreach ($buku as $b)
                                <option value="{{ $b->buku_id }}"
                                        data-harga="{{ $b->harga }}"
                                        {{ $order->buku_id == $b->buku_id ? 'selected' : '' }}>
                                    {{ $b->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700">Harga Satuan</label>
                        <input type="text" id="harga" value="{{ $order->buku->harga }}" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-100 shadow-sm" readonly>
                    </div>

                    <div>
                        <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Beli</label>
                        <input type="number" name="jumlah" id="jumlah" value="{{ $order->jumlah }}" required
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="subtotal" class="block text-sm font-medium text-gray-700">Total Harga</label>
                        <input type="text" id="subtotal" value="{{ $order->jumlah * $order->buku->harga }}" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-100 shadow-sm" readonly>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="Diproses" {{ $order->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Batal" {{ $order->status == 'Batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-4">
                    <a href="{{ route('list_order') }}"
                       class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Update data
                    </button>
                </div>

            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jumlahBeliInput = document.getElementById('jumlah');
            const hargaInput = document.getElementById('harga');
            const totalHargaInput = document.getElementById('subtotal');

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
