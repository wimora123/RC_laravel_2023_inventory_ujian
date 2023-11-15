<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class stok_barangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stok_barang')->insert([
            [
                'kode'                  => 'TGO_KLG',
                'stok_masuk'            => 10,
                'stok_keluar'           => 0,
                'stok_sisa'             => 10,
                'stok_minimal'          => 5,
                'waktu_dibuat'          => date('Y-m-d H:i:s'),
                'dibuat_oleh'           => 1,
                'diperbaharui_kapan'    => null,
                'diperbaharui_oleh'     => null
            ],
            [
                'kode'                  => 'TGO_PLS',
                'stok_masuk'            => 27,
                'stok_keluar'           => 0,
                'stok_sisa'             => 27,
                'stok_minimal'          => 5,
                'waktu_dibuat'          => date('Y-m-d H:i:s'),
                'dibuat_oleh'           => 1,
                'diperbaharui_kapan'    => null,
                'diperbaharui_oleh'     => null
            ],
            [
                'kode'                  => 'ARG_PLS',
                'stok_masuk'            => 12,
                'stok_keluar'           => 0,
                'stok_sisa'             => 12,
                'stok_minimal'          => 5,
                'waktu_dibuat'          => date('Y-m-d H:i:s'),
                'dibuat_oleh'           => 1,
                'diperbaharui_kapan'    => null,
                'diperbaharui_oleh'     => null
            ]


        ]);
    }
}
