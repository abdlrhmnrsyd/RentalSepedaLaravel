@extends('layouts.layout') 

@section('content')
<a href="{{ route('peminjam.create') }}" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded mb-3 inline-block">Tambah Peminjam</a>

<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Nama</th>
                <th class="py-3 px-6 text-left">Alamat</th>
                <th class="py-3 px-6 text-left">Foto</th>
                <th class="py-3 px-6 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach ($peminjams as $p)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6">{{ $p->nama }}</td>
                <td class="py-3 px-6">{{ $p->alamat }}</td>
                <td class="py-3 px-6 text-center"><img src="{{ asset('storage/' .$p->foto) }}" alt="" class="w-24 h-auto mx-auto"></td>
                <td class="py-3 px-6">
                    <a href="{{ route('peminjam.edit', $p->id) }}" class="bg-yellow-500 text-white font-bold py-1 px-3 rounded">Edit</a>
                    <form action="{{ route('peminjam.destroy', $p->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white font-bold py-1 px-3 rounded">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection