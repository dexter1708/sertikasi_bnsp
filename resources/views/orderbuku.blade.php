@extends('home')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="flex justify-between items-center p-6 bg-blue-900 text-white">
        <h2 class="text-2xl font-bold">Daftar Data Penjualan</h2>
        <a href="/order/create" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
            Tambah data
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama Pembeli</th>
                    <th scope="col" class="px-6 py-3">Alamat</th>
                    <th scope="col" class="px-6 py-3">Buku</th>
                    <th scope="col" class="px-6 py-3">Gambar</th>
                    <th scope="col" class="px-6 py-3">Jumlah</th>
                    <th scope="col" class="px-6 py-3">Harga Satuan</th>
                    <th scope="col" class="px-6 py-3">Total Harga</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Nama Admin</th>
                    <th scope="col" class="px-6 py-3">Tanggal Penjualan</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $o)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $o->pembeli->nama_pembeli }}</td>
                    <td class="px-6 py-4">{{ $o->pembeli->alamat_pembeli }}</td>
                    <td class="px-6 py-4">{{ $o->buku->nama ?? 'Buku tidak tersedia' }}</td>
                    <td class="px-6 py-4">
                        @if($o->buku)
                            <img src="{{ asset('storage/buku/'.$o->buku->gambar) }}" class="w-16 h-24 object-cover" alt="Gambar Buku">
                        @else
                            <span>Gambar tidak tersedia</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $o->jumlah }}</td>
                    <td class="px-6 py-4">
                        @if($o->buku)
                            Rp{{ number_format($o->buku->harga, 0, ',', '.') }}
                        @else
                            Tidak tersedia
                        @endif
                    </td>
                    <td class="px-6 py-4">Rp{{ number_format($o->subtotal, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">{{ $o->status }}</td>
                    <td class="px-6 py-4">{{ $o->user->name ?? 'Tidak tersedia' }}</td> 
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($o->tanggal_order)->format('d/m/Y') }}</td>
                    <td class="px-6 py-4">

                        <a href="{{ route('orders.edit', $o->order_id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                        <form action="{{ route('orders.destroy', $o->order_id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus order ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<div id="orderModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                    Detail Order
                </h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500">
                        <strong>Order ID:</strong> <span id="modal-order-id"></span><br>
                        <strong>Buku ID:</strong> <span id="modal-buku-id"></span><br>
                        <strong>Pembeli ID:</strong> <span id="modal-pembeli-id"></span><br>
                        <strong>Judul Buku:</strong> <span id="modal-judul"></span><br>
                        <strong>Kategori:</strong> <span id="modal-kategori"></span><br>
                        <strong>Penulis:</strong> <span id="modal-penulis"></span><br>
                        <strong>Nama Pembeli:</strong> <span id="modal-pembeli"></span><br>
                        <strong>Alamat:</strong> <span id="modal-alamat"></span><br>
                        <strong>Total:</strong> <span id="modal-total"></span><br>
                        <strong>Tanggal Order:</strong> <span id="modal-tanggal"></span><br>
                        <strong>Status:</strong> <span id="modal-status"></span>
                    </p>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeModal()">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(orderId) {
    fetch(`/api/orders/${orderId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Isi modal dengan data
            document.getElementById('modal-order-id').textContent = data.order_id;
            document.getElementById('modal-buku-id').textContent = data.buku_id;
            document.getElementById('modal-pembeli-id').textContent = data.pembeli_id;
            document.getElementById('modal-judul').textContent = data.buku.nama;
            document.getElementById('modal-kategori').textContent = data.buku.kategori;
            document.getElementById('modal-penulis').textContent = data.buku.penulis;
            document.getElementById('modal-pembeli').textContent = data.pembeli.nama_pembeli;
            document.getElementById('modal-alamat').textContent = data.pembeli.alamat_pembeli;
            document.getElementById('modal-total').textContent = `Rp${data.subtotal.toLocaleString('id-ID')}`;

            //const tanggalOrder = new Date(data.tanggal_order);
            //const tanggalFormatted = tanggalOrder.getDate().toString().padStart(2, '0') + '/' +
                         //(tanggalOrder.getMonth() + 1).toString().padStart(2, '0') + '/' +
                         //tanggalOrder.getFullYear();
            //document.getElementById('modal-tanggal').textContent = tanggalFormatted;

            //const tanggalOrder = new Date(data.tanggal_order);
           // document.getElementById('modal-tanggal').textContent = tanggalOrder.toLocaleDateString('id-ID');
            
            //document.getElementById('modal-status').textContent = data.status;

            // Tampilkan modal
            document.getElementById('orderModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengambil data order');
        });
}

</script>
@endsection
