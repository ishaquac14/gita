<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $stocks = Stock::orderBy('created_at', 'desc')->get();

        return view('pages.stock.index', compact('stocks'));
    }

    public function create()
    {
        return view('pages.stock.index');
    }

    public function edit($id)
    {
        $stock = Stock::findOrfail($id);
        return view('pages.stock.index', compact('stock'));
    }

    public function destroy($id)
    {
        $stock = Stock::findOrfail($id);
        $stock->delete();
        return redirect()->route('stock.index')->with('error', 'Data Berhasil Dihapus !');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'string|required',
            'deskripsi'=> 'string|required',
            'stock'=> 'numeric|required'
        ]);

        $data = $request->only([
            'nama_barang',
            'deskripsi',
            'stock'
        ]);

        Stock::create($data);

        return redirect()->route('stock.index')->with('success', 'Data Berhasil Ditambahkan !');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'string|required',
            'deskripsi'=> 'string|required',
            'stock'=> 'numeric|required'
        ]);

        $stock = Stock::findOrFail($id);

        $data = $request->only([
            'nama_barang',
            'deskripsi',
            'stock'
        ]);

        $stock->update($data);
        return redirect()->route('stock.index')->with('success', 'Data Berhasil Diupdate !');
    }
}
