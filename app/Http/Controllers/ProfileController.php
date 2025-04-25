<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Menampilkan halaman profil
    public function view()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // Mengupdate profil user
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',  // hanya validasi jika ada perubahan password
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // validasi foto (optional)
        ]);

        // Cek jika ada foto baru yang diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto) {
                Storage::delete('public/' . $user->foto);
            }

            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('foto_profil', 'public');
            $user->foto = $fotoPath;
        }

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika password diubah, hash password baru
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Update role jika ada (opsional, hanya admin yang bisa mengubah role)
        if ($request->role && Auth::user()->role == 'admin') {
            $user->role = $request->role;
        }

        // Simpan perubahan user
        $user->save();

        return redirect()->route('profile.view')->with('success', 'Profil berhasil diperbarui!');
    }
}
