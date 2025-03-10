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
        // Ambil transaksi berdasarkan role user
        if (auth()->user()->role === 'admin') {
            $transaksis = Transaksi::with(['peminjam', 'sepeda'])->get();
        } else {
            $transaksis = Transaksi::with(['peminjam', 'sepeda'])
                ->whereHas('peminjam', function($query) {
                    $query->where('nama', auth()->user()->name);
                })->get();
        }
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $sepedas = Sepeda::all();

        if (auth()->user()->role === 'admin') {
            $peminjams = Peminjam::all();
            return view('transaksi.create', compact('peminjams', 'sepedas'));
        }

        return view('transaksi.create', compact('sepedas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sepeda_id' => 'required|exists:sepedas,id',
            'tgl_pinjam' => 'required|date',
            'tgl_pulang' => 'required|date|after_or_equal:tgl_pinjam',
            'bayar' => 'required|numeric|min:0',
            'jaminan' => 'required|string',
            'status' => 'required|in:Pinjam,Kembali',
        ]);

        if (auth()->user()->role === 'admin') {
            // Jika admin, gunakan peminjam_id dari form
            $request->validate([
                'peminjam_id' => 'required|exists:peminjams,id'
            ]);
            $peminjam_id = $request->peminjam_id;
        } else {
            // Jika user biasa, buat peminjam baru dari data user yang login
            $peminjam = Peminjam::firstOrCreate(
                ['nama' => auth()->user()->name],
                [
                    'alamat' => auth()->user()->address,
                    'foto' => auth()->user()->photo,
                ]
            );
            $peminjam_id = $peminjam->id;
        }

        $sepeda = Sepeda::find($request->sepeda_id);
        $tgl_pinjam = Carbon::parse($request->tgl_pinjam);
        $tgl_pulang = Carbon::parse($request->tgl_pulang);
        $durasi_sewa = $tgl_pinjam->diffInDays($tgl_pulang);
        $bayar = $sepeda->sewa * $durasi_sewa;

        $transaksi = Transaksi::create([
            'peminjam_id' => $peminjam_id,
            'sepeda_id' => $request->sepeda_id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_pulang' => $request->tgl_pulang,
            'bayar' => $bayar,
            'denda' => 0,
            'jaminan' => $request->jaminan,
            'status' => 'Pinjam',
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Yeay! Sepeda berhasil dirental. Selamat menikmati perjalanan Anda! 🚲',
                'transaksi_id' => $transaksi->id
            ]);
        }

        return redirect('/')->with('success_rental', [
            'message' => 'Yeay! Sepeda berhasil dirental. Selamat menikmati perjalanan Anda! 🚲',
            'transaksi_id' => $transaksi->id
        ]);
    }

    public function edit(Transaksi $transaksi)
    {
        $peminjams = Peminjam::all();
        $sepedas = Sepeda::all();
        return view('transaksi.edit', compact('transaksi', 'peminjams', 'sepedas'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'status' => 'required|in:Pinjam,Kembali',
        ]);

        $transaksi->update([
            'status' => $request->status,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Status transaksi berhasil diperbarui.');
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
