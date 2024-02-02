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
        return $this->belongsTo(Stock::class, 'id_device', 'id');
    }
}
