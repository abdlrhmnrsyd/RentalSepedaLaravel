@extends('layouts.layout')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold mb-6">Edit Peminjam</h2>

    <form action="{{ route('peminjam.update', $peminjam->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-8">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama" class="block text-gray-700 text-sm font-medium mb-2">Nama</label>
            <input type="text" class="border border-gray-300 rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" id="nama" name="nama" value="{{ old('nama', $peminjam->nama) }}" required>
        </div>

        <div class="mb-4">
            <label for="alamat" class="block text-gray-700 text-sm font-medium mb-2">Alamat</label>
            <textarea class="border border-gray-300 rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $peminjam->alamat) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="foto" class="block text-gray-700 text-sm font-medium mb-2">Foto</label>
            <input type="file" class="border border-gray-300 rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" id="foto" name="foto" accept="image/*">
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Simpan Perubahan</button>
    </form>
</div>
@endsection