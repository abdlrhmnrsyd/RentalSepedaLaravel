@extends('layouts.layout')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Edit Transaksi</h2>

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="status" name="status" required>
                <option value="Pinjam" {{ $transaksi->status == 'Pinjam' ? 'selected' : '' }}>Pinjam</option>
                <option value="Kembali" {{ $transaksi->status == 'Kembali' ? 'selected' : '' }}>Kembali</option>
            </select>
        </div>

        <button type="submit" class="mt-4 bg-blue-500 text-white font-bold py-2 px-4 rounded">Update Status</button>
    </form>
</div>
@endsection