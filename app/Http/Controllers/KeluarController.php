<?php

namespace App\Http\Controllers;

use App\Models\Keluar;
use App\Http\Requests\StoreKeluarRequest;
use App\Http\Requests\UpdateKeluarRequest;
use App\Models\Stock;
use Illuminate\Http\Request;

class KeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keluars = Keluar::orderBy('created_at', 'desc')->get();
        $stocks = Stock::all();
        return view('pages.keluar.index', compact('keluars', 'stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $keluars = Keluar::all();
        return view('pages.keluar.index', compact('keluars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'date|required',
            'id_barang' => 'string|required',
            'pengambil' => 'string|required',
            'qty' => 'integer|required',
        ]);

        $data = $request->only([
            'tanggal',
            'id_barang',
            'pengambil',
            'qty'
        ]);

        Keluar::create($data);

        return redirect()->route('keluar.index')->with('success', 'Data Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Keluar $keluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keluar $keluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'date|required',
            'id_barang' => 'string|required',
            'pengambil' => 'string|required',
            'qty' => 'integer|required',
        ]);

        $keluar = Keluar::findOrfail($id);

        $data = $request->only([
            'tanggal',
            'id_barang',
            'pengambil',
            'qty'
        ]);

        $keluar->update($data);

        return redirect()->route('keluar.index')->with('warning', 'Data Berhasil Diupdate !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $keluar = Keluar::findOrfail($id);
        $keluar->delete();
        return redirect()->route('keluar.index')->with('danger', 'Data Berhasil Dihapus !');
    }
}
