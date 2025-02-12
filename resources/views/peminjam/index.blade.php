@extends('layouts.layout') 

@section('content')
<a href="{{ route('peminjam.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2.5 px-5 rounded-full mb-6 inline-block transition duration-200 shadow-lg hover:shadow-xl">
    <i class="fas fa-plus mr-2"></i>Tambah Peminjam
</a>

<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <table class="w-full table-auto" id="example">
        <thead>
            <tr class="bg-gray-100 border-b border-gray-200">
                <th class="px-6 py-3 text-center text-sm font-bold text-gray-700">NO</th>
                <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Nama</th>
                <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Alamat</th>
                <th class="px-6 py-3 text-center text-sm font-bold text-gray-700">Foto</th>
                <th class="px-6 py-3 text-center text-sm font-bold text-gray-700">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjams as $p)
            <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="px-6 py-4 text-center text-sm">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $p->nama }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $p->alamat }}</td>
                <td class="px-6 py-4">
                    <div class="flex justify-center">
                        <img src="{{ asset('storage/' .$p->foto) }}" alt="" class="w-40 h-20 object-cover rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="flex justify-center space-x-2">
                        <a href="{{ route('peminjam.edit', $p->id) }}" 
                           class="inline-flex items-center px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md transition duration-200 shadow hover:shadow-md">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                        @if (Auth::user()->role === 'admin') <!-- Cek apakah pengguna adalah admin -->
                    <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md transition duration-200 shadow hover:shadow-md"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            <i class="fas fa-trash mr-2"></i>Hapus
                        </button>
                    </form>
                    @endif
                        
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection