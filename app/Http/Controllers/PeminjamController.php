<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjam;

class PeminjamController extends Controller
{
    public function index()
    {
        $peminjams = Peminjam::all();
        return view('peminjam.index', compact('peminjams'));
    }

    public function create()
    {
        return view('peminjam.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = $request->file('foto')->store('peminjam_foto', 'public');

        Peminjam::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('peminjam.index')->with('success', 'Peminjam berhasil ditambahkan.');
    }

    public function edit(Peminjam $peminjam)
    {
        return view('peminjam.edit', compact('peminjam'));
    }

    public function update(Request $request, Peminjam $peminjam)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('peminjam_foto', 'public');
            $peminjam->foto = $fotoPath;
        }

        $peminjam->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'foto' => $peminjam->foto,
        ]);

        return redirect()->route('peminjam.index')->with('success', 'Peminjam berhasil diperbarui.');
    }

    public function destroy(Peminjam $peminjam)
    {
        $peminjam->delete();
        return redirect()->route('peminjam.index')->with('success', 'Peminjam berhasil dihapus.');
    }
}
