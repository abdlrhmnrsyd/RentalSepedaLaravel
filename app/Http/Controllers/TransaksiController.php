<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Peminjam;
use App\Models\Sepeda;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['peminjam', 'sepeda'])->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $peminjams = Peminjam::all();
        $sepedas = Sepeda::all();
        return view('transaksi.create', compact('peminjams', 'sepedas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjam_id' => 'required|exists:peminjams,id',
            'sepeda_id' => 'required|exists:sepedas,id',
            'tgl_pinjam' => 'required|date',
            'tgl_pulang' => 'required|date|after_or_equal:tgl_pinjam',
            'bayar' => 'required|integer',
            'denda' => 'nullable|integer',
            'jaminan' => 'required|string',
            'status' => 'required|in:Pinjam,Kembali', 
        ]);

        Transaksi::create($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit(Transaksi $transaksi)
    {
        $peminjams = Peminjam::all();
        $sepedas = Sepeda::all();
        return view('transaksi.edit', compact('transaksi', 'peminjams', 'sepedas'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $validatedData = $request->validate([
            'peminjam_id' => 'required|exists:peminjams,id',
            'sepeda_id' => 'required|exists:sepedas,id',
            'tgl_pinjam' => 'required|date',
            'tgl_pulang' => 'required|date|after_or_equal:tgl_pinjam',
            'bayar' => 'required|integer',
            'denda' => 'nullable|integer',
            'jaminan' => 'required|string',
            'status' => 'required|in:Pinjam,Kembali',
        ]);

        
        $transaksi->update($validatedData);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
