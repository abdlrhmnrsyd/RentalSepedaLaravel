@extends('layouts.layout')

@section('content')
<div class="container mx-auto p-8">
    <h2 class="text-3xl font-bold mb-6 text-center">Tambah Transaksi</h2>

    <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        @csrf

        @if(auth()->user()->role === 'admin')
        <div class="mb-6">
            <label for="peminjam_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Peminjam</label>
            <div class="relative">
                <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 pl-3 pr-10 py-2"
                        id="peminjam_id"
                        name="peminjam_id"
                        required>
                    <option value="">-- Pilih Peminjam --</option>
                    @foreach ($peminjams as $peminjam)
                        <option value="{{ $peminjam->id }}"
                                data-foto="{{ asset('storage/' . $peminjam->foto) }}"
                                data-alamat="{{ $peminjam->alamat }}">
                            {{ $peminjam->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Preview info peminjam -->
            <div id="peminjam_preview" class="hidden mt-4 p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center space-x-4">
                    <img id="peminjam_foto" src="" alt="Foto Peminjam"
                         class="w-16 h-16 rounded-full object-cover border-2 border-blue-500">
                    <div>
                        <h4 id="peminjam_nama" class="font-medium text-gray-900"></h4>
                        <p id="peminjam_alamat" class="text-sm text-gray-500"></p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="mb-4">
            <label for="sepeda_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Sepeda</label>
            <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500"
                    id="sepeda_id"
                    name="sepeda_id"
                    required>
                <option value="">-- Pilih Sepeda --</option>
                @foreach ($sepedas as $sepeda)
                    <option value="{{ $sepeda->id }}"
                            data-sewa="{{ $sepeda->sewa }}"
                            data-gambar="{{ asset('storage/' . $sepeda->foto) }}">
                        {{ $sepeda->merk }} - Rp {{ number_format($sepeda->sewa, 0, ',', '.') }}/hari
                    </option>
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

        <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 rounded hover:bg-blue-600">Simpan</button>
    </form>
</div>

<script>
    @if(auth()->user()->role === 'admin')
    document.getElementById('peminjam_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const preview = document.getElementById('peminjam_preview');
        const foto = document.getElementById('peminjam_foto');
        const nama = document.getElementById('peminjam_nama');
        const alamat = document.getElementById('peminjam_alamat');

        if (this.value) {
            preview.classList.remove('hidden');
            foto.src = selectedOption.dataset.foto;
            nama.textContent = selectedOption.text;
            alamat.textContent = selectedOption.dataset.alamat;
        } else {
            preview.classList.add('hidden');
        }
    });
    @endif

    document.getElementById('sepeda_id').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var sewa = selectedOption.getAttribute('data-sewa');
        var gambar = selectedOption.getAttribute('data-gambar');
        var tglPinjam = document.getElementById('tgl_pinjam').value;
        var tglPulang = document.getElementById('tgl_pulang').value;

        // Update gambar sepeda
        var gambarSepeda = document.getElementById('gambar_sepeda');
        if (gambar) {
            gambarSepeda.src = gambar;
            gambarSepeda.classList.remove('hidden');
        }

        if(tglPinjam && tglPulang) {
            calculateBayar();
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
