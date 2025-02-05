@extends('layouts.layout')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-bold mb-6">Edit Sepeda</h2>

    <form action="{{ route('sepeda.update', $sepeda->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-lg rounded-lg p-8">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="merk" class="block text-gray-700 text-sm font-medium mb-2">Merk</label>
            <input type="text" class="border border-gray-300 rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" id="merk" name="merk" value="{{ old('merk', $sepeda->merk) }}" required>
        </div>

        <div class="mb-4">
            <label for="sewa" class="block text-gray-700 text-sm font-medium mb-2">Harga Sewa</label>
            <input type="number" class="border border-gray-300 rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" id="sewa" name="sewa" value="{{ old('sewa', $sepeda->sewa) }}" required>
        </div>

        <div class="mb-4">
            <label for="jumlah" class="block text-gray-700 text-sm font-medium mb-2">Jumlah</label>
            <input type="number" class="border border-gray-300 rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" id="jumlah" name="jumlah" value="{{ old('jumlah', $sepeda->jumlah) }}" required>
        </div>

        <div class="mb-4">
            <label for="foto" class="block text-gray-700 text-sm font-medium mb-2">Foto</label>
            <input type="file" class="border border-gray-300 rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500" id="foto" name="foto" accept="image/*">
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Simpan Perubahan</button>
    </form>
</div>
@endsection