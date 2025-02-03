@extends('layouts.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Transaksi</h2>

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="peminjam_id" class="form-label">Peminjam</label>
            <select class="form-control" id="peminjam_id" name="peminjam_id" required>
                @foreach ($peminjams as $peminjam)
                    <option value="{{ $peminjam->id }}">{{ $peminjam->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="sepeda_id" class="form-label">Sepeda</label>
            <select class="form-control" id="sepeda_id" name="sepeda_id" required>
                @foreach ($sepedas as $sepeda)
                    <option value="{{ $sepeda->id }}">{{ $sepeda->merk }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" required>
        </div>

        <div class="mb-3">
            <label for="tgl_pulang" class="form-label">Tanggal Pulang</label>
            <input type="date" class="form-control" id="tgl_pulang" name="tgl_pulang" required>
        </div>

        <div class="mb-3">
            <label for="bayar" class="form-label">Bayar</label>
            <input type="number" class="form-control" id="bayar" name="bayar" required>
        </div>

        <div class="mb-3">
            <label for="denda" class="form-label">Denda</label>
            <input type="number" class="form-control" id="denda" name="denda" required>
        </div>

        <div class="mb-3">
            <label for="jaminan" class="form-label">Jaminan</label>
            <input type="text" class="form-control" id="jaminan" name="jaminan" required>
        </div>

        <div class="mb-3">
        <label for="status" class="form-label">Status</label>
    <select class="form-control" id="status" name="status" required>
        <option value="Pinjam">Pinjam</option>
        <option value="Kembali">Kembali</option>
    </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
