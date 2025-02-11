<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Peminjam;
use App\Models\Sepeda;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        // Validasi input
        $request->validate([
            'peminjam_id' => 'required|exists:peminjams,id',
            'sepeda_id' => 'required|exists:sepedas,id',
            'tgl_pinjam' => 'required|date',
            'tgl_pulang' => 'required|date|after_or_equal:tgl_pinjam',
            'denda' => 'nullable|integer',
            'jaminan' => 'required|string',
            'status' => 'required|in:Pinjam,Kembali',
        ]);

        // Ambil data sepeda berdasarkan id yang dipilih
        $sepeda = Sepeda::find($request->sepeda_id);

        // Hitung total bayar berdasarkan harga sewa sepeda dan jumlah hari sewa
        $tgl_pinjam = Carbon::parse($request->tgl_pinjam);
        $tgl_pulang = Carbon::parse($request->tgl_pulang);
        $durasi_sewa = $tgl_pinjam->diffInDays($tgl_pulang);

        // Total bayar = harga sewa per hari * durasi sewa
        $bayar = $sepeda->sewa * $durasi_sewa;

        // Buat transaksi dengan data yang sudah divalidasi dan bayar otomatis dihitung
        Transaksi::create([
            'peminjam_id' => $request->peminjam_id,
            'sepeda_id' => $request->sepeda_id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_pulang' => $request->tgl_pulang,
            'bayar' => $bayar,
            'denda' => $request->denda ?? 0,  
            'jaminan' => $request->jaminan,
            'status' => $request->status,
        ]);

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
        // Validasi input
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

        // Ambil data sepeda berdasarkan id yang dipilih
        $sepeda = Sepeda::find($request->sepeda_id);

        // Hitung total bayar berdasarkan harga sewa sepeda dan jumlah hari sewa
        $tgl_pinjam = Carbon::parse($request->tgl_pinjam);
        $tgl_pulang = Carbon::parse($request->tgl_pulang);
        $durasi_sewa = $tgl_pinjam->diffInDays($tgl_pulang);

        // Total bayar = harga sewa per hari * durasi sewa
        $bayar = $sepeda->sewa * $durasi_sewa;

        // Update transaksi dengan data yang sudah divalidasi
        $transaksi->update([
            'peminjam_id' => $request->peminjam_id,
            'sepeda_id' => $request->sepeda_id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_pulang' => $request->tgl_pulang,
            'bayar' => $bayar,
            'denda' => $request->denda ?? 0,
            'jaminan' => $request->jaminan,
            'status' => $request->status,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function show($id) {
        try {
            $transaksi = Transaksi::with('peminjam', 'sepeda')->where('id', $id)->firstOrFail();
            return view('transaksi.show', compact('transaksi',));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('transaksi.index')->with('error', 'Transaksi tidak ditemukan.');
        }
    }
}
