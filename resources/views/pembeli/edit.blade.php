@extends('Home')

@section('content')
<div class="container">
    <h1>Edit Pembeli</h1>
    <form action="{{ route('pembeli.update', $pembeli->pembeli_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_pembeli">Nama Pembeli</label>
            <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" value="{{ old('nama_pembeli', $pembeli->nama_pembeli) }}" required>
        </div>

        <div class="form-group">
            <label for="alamat_pembeli">Alamat Pembeli</label>
            <input type="text" class="form-control" id="alamat_pembeli" name="alamat_pembeli" value="{{ old('alamat_pembeli', $pembeli->alamat_pembeli) }}" required>
        </div>

        <div class="form-group">
            <label for="total_pembelian">Total Pembelian</label>
            <input type="number" step="0.01" class="form-control" id="total_pembelian" name="total_pembelian" value="{{ old('total_pembelian', $pembeli->total_pembelian) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
