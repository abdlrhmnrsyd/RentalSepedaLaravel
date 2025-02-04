@extends('layouts.layout')  <!-- Memanggil layout dari folder layouts -->

@section('content')
<!-- Konten dari halaman ini -->
<h2 class="mb-4">Daftar Peminjam</h2>
<a href="{{ route('peminjam.create') }}" class="btn btn-primary mb-3">Tambah Peminjam</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($peminjams as $p)
        <tr>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->alamat }}</td>
            <td class="text-center"><img src="{{ asset('storage/' .$p->foto) }}" alt="" style="width: 100px; height: auto;"></td>>
            <td>
                <a href="{{ route('peminjam.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('peminjam.destroy', $p->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
