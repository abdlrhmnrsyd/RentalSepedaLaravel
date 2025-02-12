@extends('layouts.layout')

@section('content')
<div class="container mx-auto p-6">
    <a href="{{ route('transaksi.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2.5 px-5 rounded-full mb-6 inline-block transition duration-200 shadow-lg hover:shadow-xl">
        <i class="fas fa-plus mr-2"></i>Tambah Transaksi
    </a>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <table class="w-full table-auto" id="example">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-200">
                    <th class="px-6 py-3 text-center text-sm font-bold text-gray-700">No</th>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Peminjam</th>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Sepeda</th>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Tanggal Pinjam</th>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Tanggal Pulang</th>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Bayar</th>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Denda</th>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Total</th>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Jaminan</th>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Status</th>
                    <th class="px-6 py-3 text-center text-sm font-bold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksis as $transaksi)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4 text-center text-sm">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $transaksi->peminjam->nama }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $transaksi->sepeda->merk }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $transaksi->tgl_pinjam }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $transaksi->tgl_pulang }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ 'Rp ' . number_format($transaksi->bayar, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ 'Rp ' . number_format($transaksi->denda, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ 'Rp ' . number_format($transaksi->bayar + $transaksi->denda, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $transaksi->jaminan }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $transaksi->status }}</td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('transaksi.show', $transaksi->id) }}" 
                               class="inline-flex items-center px-3 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-md transition duration-200 shadow hover:shadow-md">
                                <i class="fas fa-eye mr-2"></i>Detail
                            </a>
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
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection