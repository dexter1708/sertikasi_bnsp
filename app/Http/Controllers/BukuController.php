<?php

namespace App\Http\Controllers;


use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class BukuController extends Controller
{
     public function index (){
        $buku =Buku::all();
        return view(view: 'default');
    }
    public function listbuku() {

        $buku = Buku::all(); // Fetch all books
        $buku = Buku::with('kategori')->get();
        return view('buku', compact('buku')); 
    }


    public function input()
    {
        $kategori = Kategori::all(); 
        return view('input', compact('kategori')); 
    }

    public function buku(Request $request){
        $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'harga' => 'required|numeric',
            'tanggal_terbit' => 'required|date',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048' 
        ]);

        $data = $request->except(['_token','submit']);

        if($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/buku', $filename);
            $data['gambar'] = $filename;
        }
        // Ambil nama kategori
        $kategori = Kategori::find($request->kategori_id);
        $data['kategori'] = $kategori->nama_kategori;

        Buku::create($data);
        return redirect('/listbuku');
    }

    public function edit($id){
        $buku = Buku::find($id);
        $kategori = Kategori::all();
        return view('edit', compact(['buku','kategori']));
    }

    public function update($id, Request $request){
        $buku = Buku::find($id);
    $data = $request->except(['_token', 'submit']);

    if($request->hasFile('gambar')){
        // Hapus file lama jika ada
        if($buku->gambar && Storage::exists('public/buku/' . $buku->gambar)){
            Storage::delete('public/buku/' . $buku->gambar);
        }

        // Upload file baru
        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/buku', $filename);
        $data['gambar'] = $filename;
    }

        $buku->update($data);
        return redirect('/listbuku');
    }

    public function delete($id)
{
    $buku = Buku::find($id);

    // Periksa apakah buku ada
    if (!$buku) {
        return redirect('/listbuku')->with('error', 'Buku tidak ditemukan');
    }

    // Hapus gambar jika ada

    // Hapus buku
    $buku->delete();
    return redirect('/listbuku')->with('success', 'Buku berhasil dihapus');
}

}
