<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sepeda;

class SepedaController extends Controller
{
    public function index()
    {
        $sepedas = Sepeda::all();
        return view('sepeda.index', compact('sepedas'));
    }

    public function create()
    {
        return view('sepeda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required',
            'sewa' => 'required|integer',
            'jumlah' => 'required|integer',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = $request->file('foto')->store('sepeda_foto', 'public');

        Sepeda::create([
            'merk' => $request->merk,
            'sewa' => $request->sewa,
            'jumlah' => $request->jumlah,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('sepeda.index')->with('success', 'Sepeda berhasil ditambahkan.');
    }

    public function edit(Sepeda $sepeda)
    {
        return view('sepeda.edit', compact('sepeda'));
    }

    public function update(Request $request, Sepeda $sepeda)
    {
        $request->validate([
            'merk' => 'required',
            'sewa' => 'required|integer',
            'jumlah' => 'required|integer',
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('sepeda_foto', 'public');
            $sepeda->foto = $fotoPath;
        }

        $sepeda->update([
            'merk' => $request->merk,
            'sewa' => $request->sewa,
            'jumlah' => $request->jumlah,
            'foto' => $sepeda->foto,
        ]);

        return redirect()->route('sepeda.index')->with('success', 'Sepeda berhasil diperbarui.');
    }

    public function destroy(Sepeda $sepeda)
    {
        $sepeda->delete();
        return redirect()->route('sepeda.index')->with('success', 'Sepeda berhasil dihapus.');
    }
}
