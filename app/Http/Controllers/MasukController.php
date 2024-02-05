<?php

namespace App\Http\Controllers;

use App\Events\MasukBarang;
use App\Models\Masuk;
use App\Models\Stock;
use Illuminate\Http\Request;

class MasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $masuks = Masuk::orderBy('created_at', 'desc')->get();
        $stocks = Stock::all();
        return view('pages.masuk.index', compact('masuks', 'stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $masuks = Masuk::all();
        return view('pages.masuk.index', compact('masuks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'date|required',
            'id_barang' => 'string|required',
            'penerima' => 'string|required',
            'qty' => 'integer|required',
        ]);

        $data = $request->only([
            'tanggal',
            'id_barang',
            'penerima',
            'qty'
        ]);

        Masuk::create($data);

        return redirect()->route('masuk.index')->with('success', 'Data Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $masuks = Masuk::findOrfail($id);
        return view('pages.masuk.index', compact('masuk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'date|required',
            'id_barang' => 'string|required',
            'penerima' => 'string|required',
            'qty' => 'integer|required',
        ]);

        $masuk = Masuk::findOrfail($id);

        $data = $request->only([
            'tanggal',
            'id_barang',
            'penerima',
            'qty'
        ]);

        $masuk->update($data);

        return redirect()->route('masuk.index')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $masuk = Masuk::findOrfail($id);
        $masuk->delete();
        return redirect()->route('masuk.index')->with('error', 'Data Berhasil Dihapus !');
    }
}
