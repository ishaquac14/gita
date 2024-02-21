<?php

namespace App\Http\Controllers;

use App\Models\Masuk;
use App\Models\Keluar;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $stocks = Stock::orderBy('created_at', 'desc')->get();
        // dd($stocks);
        return view('pages.stock.index', compact('stocks'));
    }

    public function create()
    {
        $stocks = Stock::all();
        return view('pages.stock.index', compact('stocks'));
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
        return redirect()->route('stock.index')->with('danger', 'Data Berhasil Dihapus !');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_device' => 'string|required',
            'nama_barang' => 'string|required',
            'deskripsi' => 'string|required',
            'stock' => 'integer|required'
        ]);

        $data = $request->only([
            'id_device',
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
            'id_device' => 'string|required',
            'nama_barang' => 'string|required',
            'deskripsi' => 'string|required',
            'stock' => 'integer|required'
        ]);

        $stock = Stock::findOrFail($id);

        $data = $request->only([
            'id_device',
            'nama_barang',
            'deskripsi',
            'stock'
        ]);

        $stock->update($data);

        return redirect()->route('stock.index')->with('warning', 'Data Berhasil Diupdate !');
    }
}
