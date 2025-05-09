<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Buku;
use App\Models\Pembeli;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    
    public function create()
    {
        $buku = Buku::all(); 
        $pembeli = Pembeli::all(); 
        $users = Auth::id(); 
        return view('inputorder', compact('buku', 'pembeli', 'users'));
    }

   
    public function orders()
    {
        $orders = Orders::all(); 
        return view('orderbuku', compact('orders'));
    }

    
    public function edit($order_id)
    {
        $pembeli = Pembeli::all();
        $order = Orders::with('buku')->findOrFail($order_id);
        $buku = Buku::all();
        return view('editorder', compact('order', 'buku', 'pembeli'));
    }

    
    public function update(Request $request, $order_id)
    {
        try {
            $order = Orders::findOrFail($order_id);
            $oldJumlah = $order->jumlah;

           
            $request->validate([
                'jumlah' => 'required|integer|min:1',
                'status' => 'required|in:Diproses,Selesai,Batal',
            ]);

            $buku = Buku::findOrFail($request->buku_id);

           
            if (($request->buku_id != $order->buku_id) || ($request->jumlah > $oldJumlah)) {
                $additionalStock = $request->jumlah - ($request->buku_id == $order->buku_id ? $oldJumlah : 0);
                if ($buku->stok < $additionalStock) {
                    return back()->with('error', 'Stok tidak mencukupi')->withInput();
                }
            }

            DB::beginTransaction();

            
            if ($request->buku_id != $order->buku_id) {
                $oldBuku = Buku::findOrFail($order->buku_id);
                $oldBuku->increment('stok', $oldJumlah);
                $buku->decrement('stok', $request->jumlah);
            } else {
                
                $stockDiff = $request->jumlah - $oldJumlah;
                if ($stockDiff > 0) {
                    $buku->decrement('stok', $stockDiff);
                } else {
                    $buku->increment('stok', abs($stockDiff));
                }
            }

           
            $subtotal = $buku->harga * $request->jumlah;

           
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
    
            // Validasi input
            $request->validate([
                'buku_id' => 'required|exists:buku,buku_id',
                'pembeli_id' => 'required|exists:pembeli,pembeli_id',
                'jumlah' => 'required|integer|min:1',
                'status' => 'required|in:Diproses,Selesai,Batal',
                'tanggal_order' => 'required|date',
            ]);
    
            // Mendapatkan buku dan pembeli
            $buku = Buku::findOrFail($request->buku_id);
            $pembeli = Pembeli::findOrFail($request->pembeli_id);
            $user_id = Auth::id();
    
            // Cek apakah stok cukup
            if ($buku->stok < $request->jumlah) {
                throw new \Exception('Stok tidak mencukupi');
            }
    
            // Hitung subtotal
            $subtotal = $buku->harga * $request->jumlah;
    
            // Buat order baru
            $order = Orders::create([
                'buku_id' => $request->buku_id,
                'pembeli_id' => $request->pembeli_id,
                'user_id' => $user_id, 
                'jumlah' => $request->jumlah,
                'subtotal' => $subtotal,
                'tanggal_order' => $request->tanggal_order,
                'status' => $request->status
            ]);
    
            // Kurangi stok buku dan update total pembelian pembeli
            $buku->decrement('stok', $request->jumlah);
            $pembeli->increment('total_pembelian', $subtotal);
    
            DB::commit();
            return redirect('/orders')->with('success', 'Order berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
    
    // Menampilkan daftar order
    public function listorder()
    {
        $orders = Orders::with('buku')->get();
        return view('orderbuku', compact('orders'));
    }

    // Menghapus order berdasarkan ID
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

