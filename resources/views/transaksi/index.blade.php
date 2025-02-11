@extends('layouts.layout')

@section('content')
<div class="container mx-auto p-6">
    <a href="{{ route('transaksi.create') }}" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 mb-4 inline-block">Tambah Transaksi</a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md table-auto">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-xs leading-normal">
                    <th class="py-2 px-4 text-left">Peminjam</th>
                    <th class="py-2 px-4 text-left">Sepeda</th>
                    <th class="py-2 px-4 text-left">Tanggal Pinjam</th>
                    <th class="py-2 px-4 text-left">Tanggal Pulang</th>
                    <th class="py-2 px-4 text-left">Bayar</th>
                    <th class="py-2 px-4 text-left">Denda</th>
                    <th class="py-2 px-4 text-left">Total</th>
                    <th class="py-2 px-4 text-left">Jaminan</th>
                    <th class="py-2 px-4 text-left">Status</th>
                    <th class="py-2 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-xs font-light">
                @foreach ($transaksis as $transaksi)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-2 px-4">{{ $transaksi->peminjam->nama }}</td>
                    <td class="py-2 px-4">{{ $transaksi->sepeda->merk }}</td>
                    <td class="py-2 px-4">{{ $transaksi->tgl_pinjam }}</td>
                    <td class="py-2 px-4">{{ $transaksi->tgl_pulang }}</td>
                    <td class="py-2 px-4">{{ 'Rp ' . number_format($transaksi->bayar, 0, ',', '.') }}</td>
                    <td class="py-2 px-4">{{ 'Rp ' . number_format($transaksi->denda, 0, ',', '.') }}</td>
                    <td class="py-2 px-4">{{ 'Rp ' . number_format($transaksi->bayar + $transaksi->denda, 0, ',', '.') }}</td>
                    <td class="py-2 px-4">{{ $transaksi->jaminan }}</td>
                    <td class="py-2 px-4">{{ $transaksi->status }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('transaksi.show', $transaksi->id) }}" class="bg-green-500 text-white font-semibold py-1 px-3 rounded hover:bg-green-600">Detail</a>
                        <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="bg-yellow-500 text-white font-semibold py-1 px-3 rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white font-semibold py-1 px-3 rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection