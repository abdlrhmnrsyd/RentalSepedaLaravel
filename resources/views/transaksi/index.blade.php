@extends('layouts.layout')

@section('content')
<div class="container mx-auto p-6">
    <a href="{{ route('transaksi.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2.5 px-5 rounded-full mb-6 inline-block transition duration-200 shadow-lg hover:shadow-xl">
        <i class="fas fa-plus mr-2"></i>Tambah Transaksi
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($transaksis as $transaksi)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $transaksi->peminjam->nama }}</h3>
                    <span class="px-3 py-1 rounded-full text-sm {{ $transaksi->status == 'Selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $transaksi->status }}
                    </span>
                </div>
                
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Sepeda:</span>
                        <span class="text-gray-800">{{ $transaksi->sepeda->merk }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tanggal Pinjam:</span>
                        <span class="text-gray-800">{{ $transaksi->tgl_pinjam }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tanggal Pulang:</span>
                        <span class="text-gray-800">{{ $transaksi->tgl_pulang }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Bayar:</span>
                        <span class="text-gray-800">{{ 'Rp ' . number_format($transaksi->bayar, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Denda:</span>
                        <span class="text-gray-800">{{ 'Rp ' . number_format($transaksi->denda, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between font-semibold">
                        <span class="text-gray-600">Total:</span>
                        <span class="text-gray-800">{{ 'Rp ' . number_format($transaksi->bayar + $transaksi->denda, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Jaminan:</span>
                        <span class="text-gray-800">{{ $transaksi->jaminan }}</span>
                    </div>
                </div>

                <div class="mt-6 flex justify-center space-x-2">
                    <a href="{{ route('transaksi.show', $transaksi->id) }}" 
                       class="inline-flex items-center px-3 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-md transition duration-200 shadow hover:shadow-md">
                        <i class="fas fa-eye mr-2"></i>Detail
                    </a>
                    @if (Auth::user()->role === 'admin') 
                    <a href="{{ route('transaksi.edit', $transaksi->id) }}" 
                       class="inline-flex items-center px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md transition duration-200 shadow hover:shadow-md">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    
                    <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md transition duration-200 shadow hover:shadow-md"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            <i class="fas fa-trash mr-2"></i>Hapus
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection