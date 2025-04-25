@extends('home')

@section('content')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-md space-y-6">
    <h2 class="text-2xl font-semibold text-center text-gray-700">Tambah Akun Admin</h2>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-600">Nama</label>
            <input type="text" name="name" id="name" placeholder="Nama Lengkap"
class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none border-gray-300" required>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
            <input type="email" name="email" id="email" placeholder="Email"class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none border-gray-300" required>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
            <input type="password" name="password" id="password" placeholder="Password"class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none border-gray-300" required>
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Ulangi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none border-gray-300" required>
        </div>

        <div>
            <label for="foto" class="block text-sm font-medium text-gray-600">Foto Profil</label>
            <input type="file" name="foto" id="foto" class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none border-gray-300" accept="image/*">
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-600">Role</label>
            <select name="role" id="role"class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none border-gray-300" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>

        <div>
            <button type="submit"class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200">
                Tambah Akun
            </button>
        </div>
    </form>
</div>
@endsection
