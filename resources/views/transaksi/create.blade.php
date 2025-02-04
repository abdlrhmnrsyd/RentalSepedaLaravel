@extends('layouts.layout')

@section('content')
<div class="container mx-auto p-8">
    <h2 class="text-2xl font-semibold mb-6">Tambah Transaksi</h2>

    <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-4">
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
                    <option value="{{ $sepeda->id }}" data-sewa="{{ $sepeda->sewa }}" data-gambar="{{ asset($sepeda->gambar) }}">{{ $sepeda->merk }}</option>
                @endforeach
            </select>
        </div>

        <!-- Gambar Sepeda -->
        <div class="mb-3">
            <img id="gambar_sepeda" src="" alt="Gambar Sepeda" style="display:none; max-width: 200px;" />
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
            <input type="number" class="form-control" id="bayar" name="bayar" readonly required>
        </div>

        <div class="mb-3">
            <label for="denda" class="form-label">Denda</label>
            <input type="number" class="form-control" id="denda" name="denda">
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

<script>
    document.getElementById('sepeda_id').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var sewa = selectedOption.getAttribute('data-sewa');
        var gambar = selectedOption.getAttribute('data-gambar');
        var tglPinjam = document.getElementById('tgl_pinjam').value;
        var tglPulang = document.getElementById('tgl_pulang').value;

        if(tglPinjam && tglPulang) {
            var diff = Math.abs(new Date(tglPulang) - new Date(tglPinjam));
            var diffDays = Math.ceil(diff / (1000 * 3600 * 24)); 

            var totalBayar = diffDays * sewa;
            document.getElementById('bayar').value = totalBayar;
        }
    });
   
    document.getElementById('tgl_pinjam').addEventListener('change', function() {
        calculateBayar();
    });

    document.getElementById('tgl_pulang').addEventListener('change', function() {
        calculateBayar();
    });

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
