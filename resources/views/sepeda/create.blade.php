@extends('layouts.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Sepeda</h2>

    <form action="{{ route('sepeda.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="merk" class="form-label">Merk</label>
            <input type="text" class="form-control" id="merk" name="merk" required>
        </div>

        <div class="mb-3">
            <label for="sewa" class="form-label">Harga Sewa</label>
            <input type="number" class="form-control" id="sewa" name="sewa" required>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
