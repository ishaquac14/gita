<?php

namespace App\Listeners;

use App\Events\MasukBarang;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateStockQty
{
    /**
     * Handle the event.
     *
     * @param MasukBarang $event
     * @return void
     */
    public function handle(MasukBarang $event)
    {
        $masuk = $event->masuk;
        
        // Ambil data barang yang masuk
        $barang = $masuk->barang;
        
        // Periksa apakah barang sudah ada di tabel stocks
        $stock = $barang->stock;

        // Jika ada, tambahkan qty
        if ($stock) {
            $stock->qty += $masuk->qty;
            $stock->save();
        } else {
            // Jika tidak ada, buat data baru di tabel stocks
            $barang->stock()->create([
                'qty' => $masuk->qty
            ]);
        }
    }
}
