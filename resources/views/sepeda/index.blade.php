@extends('layouts.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Sepeda</h2>
    <a href="{{ route('sepeda.create') }}" class="btn btn-primary mb-3">Tambah Sepeda</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Merk</th>
                <th>Sewa</th>
                <th>Jumlah</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
            @foreach ($sepedas as $sepeda)
            <tr>
                <td>{{ $sepeda->merk }}</td>
                <td>{{ $sepeda->sewa }}</td>
                <td>{{ $sepeda->jumlah }}</td>
                <td class="text-center"><img src="{{ asset('storage/' .$sepeda->foto) }}" alt="" style="width: 100px; height: auto;"></td>
                <td>
                    <a href="{{ route('sepeda.edit', $sepeda->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('sepeda.destroy', $sepeda->id) }}" method="POST" class="d-inline">
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
