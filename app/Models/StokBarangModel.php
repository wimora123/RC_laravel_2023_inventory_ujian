<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarangModel extends Model
{
    use HasFactory;

     // Kita maunya table terserah kita, bukan table pakai "s" di belakang sebagai plural
     protected $table = 'stok_barang';
     // Kita gk butuh timpestamp
     public $timestamps = false;

     // Lindungi id
     protected $guarded = ["id"];
}
