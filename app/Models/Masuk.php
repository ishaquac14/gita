<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Masuk extends Model
{
    use HasFactory;

    protected $table = 'masuks';
    protected $guarded = [];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Event untuk menangani pembuatan record baru
        static::created(function ($masuk) {
            // Ambil record stock yang sesuai
            $stock = Stock::find($masuk->stock_id);

            // Jika stock ditemukan, tambahkan qty baru ke stock yang ada
            if ($stock) {
                $stock->stock += $masuk->qty; // Mengasumsikan 'stock' adalah jumlah qty
                $stock->save();
            }
        });
    }
}
