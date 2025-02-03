@extends('layouts.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Transaksi</h2>

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="peminjam_id" class="form-label">Peminjam</label>
            <select class="form-control" id="peminjam_id" name="peminjam_id" required>
                @foreach ($peminjams as $peminjam)
                    <option value="{{ $peminjam->id }}" {{ $peminjam->id == $transaksi->id_peminjam ? 'selected' : '' }}>{{ $peminjam->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="sepeda_id" class="form-label">Sepeda</label>
            <select class="form-control" id="sepeda_id" name="sepeda_id" required>
                @foreach ($sepedas as $sepeda)
                    <option value="{{ $sepeda->id }}" {{ $sepeda->id == $transaksi->id_sepeda ? 'selected' : '' }}>{{ $sepeda->merk }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="{{ $transaksi->tgl_pinjam }}" required>
        </div>

        <div class="mb-3">
            <label for="tgl_pulang" class="form-label">Tanggal Pulang</label>
            <input type="date" class="form-control" id="tgl_pulang" name="tgl_pulang" value="{{ $transaksi->tgl_pulang }}" required>
        </div>

        <div class="mb-3">
            <label for="bayar" class="form-label">Bayar</label>
            <input type="number" class="form-control" id="bayar" name="bayar" value="{{ $transaksi->bayar }}" required>
        </div>

        <div class="mb-3">
            <label for="denda" class="form-label">Denda</label>
            <input type="number" class="form-control" id="denda" name="denda" value="{{ $transaksi->denda }}" required>
        </div>

        <div class="mb-3">
            <label for="jaminan" class="form-label">Jaminan</label>
            <input type="text" class="form-control" id="jaminan" name="jaminan" value="{{ $transaksi->jaminan }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Pinjam" {{ $transaksi->status == 'Pinjam' ? 'selected' : '' }}>Pinjam</option>
                <option value="Kembali" {{ $transaksi->status == 'Kembali' ? 'selected' : '' }}>Kembali</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
