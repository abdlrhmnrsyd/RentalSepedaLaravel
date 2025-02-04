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
                    <option value="{{ $sepeda->id }}" data-sewa="{{ $sepeda->sewa }}" {{ $sepeda->id == $transaksi->id_sepeda ? 'selected' : '' }}>{{ $sepeda->merk }}</option>
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
            <input type="number" class="form-control" id="bayar" name="bayar" value="{{ $transaksi->bayar }}" readonly required>
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

<script>
    document.getElementById('sepeda_id').addEventListener('change', calculateBayar);
    document.getElementById('tgl_pinjam').addEventListener('change', calculateBayar);
    document.getElementById('tgl_pulang').addEventListener('change', calculateBayar);

    function calculateBayar() {
        var sewa = document.getElementById('sepeda_id').selectedOptions[0].getAttribute('data-sewa');
        var tglPinjam = document.getElementById('tgl_pinjam').value;
        var tglPulang = document.getElementById('tgl_pulang').value;

        if(tglPinjam && tglPulang && sewa) {
            var diff = Math.abs(new Date(tglPulang) - new Date(tglPinjam));
            var diffDays = Math.ceil(diff / (1000 * 3600 * 24)); 

            var totalBayar = diffDays * sewa;
            document.getElementById('bayar').value = totalBayar;
        }
    }
</script>
@endsection
