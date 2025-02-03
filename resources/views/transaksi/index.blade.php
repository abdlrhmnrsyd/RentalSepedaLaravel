@extends('layouts.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Transaksi</h2>
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3">Tambah Transaksi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Peminjam</th>
                <th>Sepeda</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Pulang</th>
                <th>Bayar</th>
                <th>Denda</th>
                <th>Jaminan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $transaksi)
            <tr>
                <td>{{ $transaksi->peminjam->nama }}</td>
                <td>{{ $transaksi->sepeda->merk }}</td>
                <td>{{ $transaksi->tgl_pinjam }}</td>
                <td>{{ $transaksi->tgl_pulang }}</td>
                <td>{{ $transaksi->bayar }}</td>
                <td>{{ $transaksi->denda }}</td>
                <td>{{ $transaksi->jaminan }}</td>
                <td>{{ $transaksi->status }}</td>
                <td>
                    <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
