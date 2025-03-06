<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Sepeda;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        // Hitung total users
        $totalUsers = User::count();

        // Hitung total sepeda
        $totalSepeda = Sepeda::sum('jumlah');

        // Hitung sepeda yang sedang dipinjam (total)
        $sepedaDipinjam = Transaksi::where('status', 'Pinjam')->count();

        // Statistik sepeda per merk dengan perhitungan yang diperbaiki
        $sepedaStats = Sepeda::select('id', 'merk', 'jumlah')
            ->get()
            ->map(function ($sepeda) {
                // Hitung jumlah sepeda yang sedang dipinjam untuk merk ini
                $dipinjam = Transaksi::where('sepeda_id', $sepeda->id)
                    ->where('status', 'Pinjam')
                    ->count();

                return [
                    'merk' => $sepeda->merk,
                    'total' => $sepeda->jumlah,
                    'dipinjam' => $dipinjam,
                    'tersedia' => $sepeda->jumlah - $dipinjam
                ];
            });

        // Debug: Tampilkan data transaksi untuk memverifikasi
        $activeTransactions = Transaksi::with(['sepeda'])
            ->where('status', 'Pinjam')
            ->get();

        // Tambahkan data debug ke view
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalSepeda',
            'sepedaDipinjam',
            'sepedaStats',
            'activeTransactions'
        ));
    }
} 