<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->insert([
            [
                'nama' => 'Makanan',
                'waktu_dibuat'          => date('Y-m-d H:i:s'),
                'dibuat_oleh'           => 1,
                'diperbaharui_kapan'    => null,
                'diperbaharui_oleh'     => null
            ],
            [
                'nama' => 'Minuman',
                'waktu_dibuat'          => date('Y-m-d H:i:s'),
                'dibuat_oleh'           => 1,
                'diperbaharui_kapan'    => null,
                'diperbaharui_oleh'     => null
            ],
            [
                'nama' => 'ATK',
                'waktu_dibuat'          => date('Y-m-d H:i:s'),
                'dibuat_oleh'           => 1,
                'diperbaharui_kapan'    => null,
                'diperbaharui_oleh'     => null
            ]
        ]);
    }
}
