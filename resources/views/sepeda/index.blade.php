@extends('layouts.layout')
@section('content')
<div class="container mx-auto">
    <a href="{{ route('sepeda.create') }}" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded mb-3 inline-block">Tambah Sepeda</a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-2 px-4 text-left">Merk</th>
                    <th class="py-2 px-4 text-left">Sewa</th>
                    <th class="py-2 px-4 text-left">Jumlah</th>
                    <th class="py-2 px-4 text-left">Foto</th>
                    <th class="py-2 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($sepedas as $sepeda)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-2 px-4">{{ $sepeda->merk }}</td>
                    <td class="py-2 px-4">{{ $sepeda->sewa }}</td>
                    <td class="py-2 px-4">{{ $sepeda->jumlah }}</td>
                    <td class="py-2 px-4 text-center"><img src="{{ asset('storage/' .$sepeda->foto) }}" alt="" class="w-24 h-auto"></td>
                    <td class="py-2 px-4">
                        <a href="{{ route('sepeda.edit', $sepeda->id) }}" class="bg-yellow-500 text-white font-semibold py-1 px-3 rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('sepeda.destroy', $sepeda->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white font-semibold py-1 px-3 rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection