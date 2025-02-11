@extends('layouts.layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Detail Transaksi</h1>
    <a href="{{ url()->previous() }}" class="inline-block mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Kembali</a>
    <div class="bg-white p-6 rounded-lg shadow-md">
        
        <table class="min-w-full bg-white">
            <thead>
                <tr class="w-full bg-gray-200">
                    <th class="py-2 px-4 text-left">Detail</th>
                    <th class="py-2 px-4 text-left">Informasi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border px-4 py-2 font-semibold">ID Transaksi</td>
                    <td class="border px-4 py-2">{{ $transaksi->id }}</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2 font-semibold">Peminjam</td>
                    <td class="border px-4 py-2">{{ $transaksi->peminjam->nama }}</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2 font-semibold">Foto Peminjam</td>
                    <td class="border px-4 py-2"><img src="{{ asset('storage/' . $transaksi->peminjam->foto) }}" alt="Foto Peminjam" class="w-32 h-32 shadow"></td>
                </tr>
                <tr>
                    <td class="border px-4 py-2 font-semibold">Alamat</td>
                    <td class="border px-4 py-2">{{ $transaksi->peminjam->alamat }}</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2 font-semibold">Jaminan</td>
                    <td class="border px-4 py-2">{{ $transaksi->jaminan }}</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2 font-semibold">Sepeda yang Dipinjam</td>
                    <td class="border px-4 py-2">{{ $transaksi->sepeda->merk }}</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2 font-semibold">Foto Sepeda</td>
                    <td class="border px-4 py-2"><img src="{{ asset('storage/' . $transaksi->sepeda->foto) }}" alt="Foto Sepeda" class="w-32 h-32 shadow"></td>
                </tr>
                <tr>
                    <td class="border px-4 py-2 font-semibold">Durasi</td>
                    <td class="border px-4 py-2">{{ $transaksi->durasi }} hari</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2 font-semibold">Total Bayar</td>
                    <td class="border px-4 py-2">{{ 'Rp ' . number_format($transaksi->bayar + $transaksi->denda, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
