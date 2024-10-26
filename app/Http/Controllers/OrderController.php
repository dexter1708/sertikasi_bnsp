<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Buku;
use App\Models\Pembeli;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function create()
    {
        // Ambil semua buku untuk digunakan di form pencarian
        $buku = Buku::all();
        $pembeli = Pembeli::all();
        return view('inputorder', compact('buku', 'pembeli'));
    }
    public function orders() {

        $orders = Orders::all(); // Fetch all books
        return view('orderbuku', compact('orders'));
    }

    public function detail($order_id){
        $order = Orders::with('buku')->findOrFail($order_id);
        return view('detailorder', compact('order'));
    }

    public function edit($order_id)
    {
        $pembeli = Pembeli::all();
        $order = Orders::with('buku')->findOrFail($order_id);
        $buku = Buku::all();
        return view('editorder', compact('order', 'buku','pembeli'));
    }

    public function update(Request $request, $order_id)
{
    try {
        $order = Orders::findOrFail($order_id);
        $oldJumlah = $order->jumlah;

        // Validate request
        $validated = $request->validate([
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|in:Diproses,Selesai,Batal',

        ]);

        $buku = Buku::findOrFail($request->buku_id);

        // Ini kalau ada perubahan, stocknya ikut kurang juga wak
        if (($request->buku_id != $order->buku_id) || ($request->jumlah > $oldJumlah)) {
            $additionalStock = $request->jumlah - ($request->buku_id == $order->buku_id ? $oldJumlah : 0);
            if ($buku->stok < $additionalStock) {
                return back()->with('error', 'Stok tidak mencukupi')->withInput();
            }
        }

        DB::beginTransaction();

        // Kembaliin Stock
        if ($request->buku_id != $order->buku_id) {
            $oldBuku = Buku::findOrFail($order->buku_id);
            $oldBuku->increment('stok', $oldJumlah);
            $buku->decrement('stok', $request->jumlah);
        } else {
            // Adjust stock for same book
            $stockDiff = $request->jumlah - $oldJumlah;
            if ($stockDiff > 0) {
                $buku->decrement('stok', $stockDiff);
            } else {
                $buku->increment('stok', abs($stockDiff));
            }
        }

        // Subtotal Baru
        $subtotal = $buku->harga * $request->jumlah;

        // Update order
        $order->update([
            'jumlah' => $request->jumlah,
            'subtotal' => $subtotal,
            'status' => $request->status
        ]);

        DB::commit();
        return redirect()->route('list_order')->with('success', 'Order berhasil diupdate');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
    }
}

public function order(Request $request)
{
    try {
        DB::beginTransaction();

        $validated = $request->validate([
            'buku_id' => 'required|exists:buku,buku_id',
            'pembeli_id' => 'required|exists:pembeli,pembeli_id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $buku = Buku::findOrFail($request->buku_id);
        $pembeli = Pembeli::findOrFail($request->pembeli_id);

        if ($buku->stok < $request->jumlah) {
            throw new \Exception('Stok tidak mencukupi');
        }

        $subtotal = $buku->harga * $request->jumlah;

        $order = Orders::create([
            'buku_id' => $request->buku_id,
            'pembeli_id' => $request->pembeli_id,
            'jumlah' => $request->jumlah,
            'subtotal' => $subtotal,
            'tanggal_order' => now(),
            'status' => 'Diproses'
        ]);

        $buku->decrement('stok', $request->jumlah); //ini buat ngurangin stok wak
        $pembeli->increment('total_pembelian', $subtotal); //nah ini nanti buat nambahin ke total pembelian tiap pembeli

        DB::commit();
        return redirect('/orders')->with('success', 'Order berhasil ditambahkan!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
    }
}


    public function listorder()
    {
        // Menampilkan daftar order
        $orders = Orders::with('buku')->get();
        return view('orderbuku', compact('orders'));
    }

    public function destroy($order_id)
{
    try {
        DB::beginTransaction();

        $order = Orders::findOrFail($order_id);
        Log::info('Attempting to delete order: ' . $order_id);

        if ($order->buku) {
            Log::info('Returning stock for book: ' . $order->buku->buku_id);
            $order->buku->increment('stok', $order->jumlah);
        }

        $order->delete();
        Log::info('Order deleted successfully');

        DB::commit();
        return redirect()->route('list_order')->with('success', 'Order berhasil dihapus');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error deleting order: ' . $e->getMessage());
        return back()->with('error', 'Terjadi kesalahan saat menghapus order: ' . $e->getMessage());
    }
}
}
