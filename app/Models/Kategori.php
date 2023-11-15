<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

     // Kita maunya table terserah kita, bukan table pakai "s" di belakang sebagai plural
     protected $table = 'kategori';
     // Kita gk butuh timpestamp
     public $timestamps = false;

     // Lindungi id
     protected $guarded = ["id"];

    public function barang() {
        return $this->hasMany('App\Models\MasterBarangModel');
    }

}
