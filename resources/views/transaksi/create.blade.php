@extends('layouts.layout')

@section('content')
<div class="container mx-auto p-8">
    <h2 class="text-3xl font-bold mb-6 text-center">Tambah Transaksi</h2>

    <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="peminjam_id" class="block text-sm font-medium text-gray-700">Peminjam</label>
            <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" id="peminjam_id" name="peminjam_id" required>
                @foreach ($peminjams as $peminjam)
                    <option value="{{ $peminjam->id }}">{{ $peminjam->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="sepeda_id" class="block text-sm font-medium text-gray-700">Sepeda</label>
            <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" id="sepeda_id" name="sepeda_id" required>
                @foreach ($sepedas as $sepeda)
                    <option value="{{ $sepeda->id }}" data-sewa="{{ $sepeda->sewa }}" data-gambar="{{ asset($sepeda->gambar) }}">{{ $sepeda->merk }}</option>
                @endforeach
            </select>
        </div>

        <!-- Gambar Sepeda -->
        <div class="mb-4">
            <img id="gambar_sepeda" src="" alt="Gambar Sepeda" class="hidden max-w-xs mx-auto" />
        </div>

        <div class="mb-4">
            <label for="tgl_pinjam" class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
            <input type="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" id="tgl_pinjam" name="tgl_pinjam" required>
        </div>

        <div class="mb-4">
            <label for="tgl_pulang" class="block text-sm font-medium text-gray-700">Tanggal Pulang</label>
            <input type="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" id="tgl_pulang" name="tgl_pulang" required>
        </div>

        <div class="mb-4">
            <label for="bayar" class="block text-sm font-medium text-gray-700">Bayar</label>
            <input type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" id="bayar" name="bayar" readonly required>
        </div>

        <div class="mb-4">
            <label for="denda" class="block text-sm font-medium text-gray-700">Denda</label>
            <input type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" id="denda" name="denda">
        </div>

        <div class="mb-4">
            <label for="jaminan" class="block text-sm font-medium text-gray-700">Jaminan</label>
            <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" id="jaminan" name="jaminan" required>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" id="status" name="status" required>
                <option value="Pinjam">Pinjam</option>
                <option value="Kembali">Kembali</option>
            </select>
        </div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sepeda</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pulang</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Data tabel akan diisi di sini -->
            </tbody>
        </table>

        <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 rounded hover:bg-blue-600">Simpan</button>
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
