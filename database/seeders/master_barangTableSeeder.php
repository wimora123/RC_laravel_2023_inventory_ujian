<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class master_barangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Jangan lupa kita setting ke mysql. Tipe data harus diedit null khusus field id_kategori, id_gudang, diperbaharui_kapan dan diperbaharui_oleh
        // Lalu jalankan seeder dengan, php artisan db:seed
        DB::table('master_barang')->insert([
            [
                'kode'                  => 'TGO_KLG',
                'nama'                  => 'Tango Kaleng',
                'deskripsi'             => 'Wafer tango kemasan kaleng',
                'gambar'                => 'noimage.jpg',
                'id_kategori'           => 2,
                'id_gudang'             => null,
                'waktu_dibuat'          => date('Y-m-d H:i:s'),
                'dibuat_oleh'           => 1,
                'diperbaharui_kapan'    => null,
                'diperbaharui_oleh'     => null
            ],
            [
                'kode'                  => 'TGO_PLS',
                'nama'                  => 'Tango Plastik',
                'deskripsi'             => 'Wafer tango kemasan plastik',
                'gambar'                => 'noimage.jpg',
                'id_kategori'           => 2,
                'id_gudang'             => null,
                'waktu_dibuat'          => date('Y-m-d H:i:s'),
                'dibuat_oleh'           => 1,
                'diperbaharui_kapan'    => null,
                'diperbaharui_oleh'     => null
            ],
            [
                'kode'                  => 'ARG_PLS',
                'nama'                  => 'Antagen Saset',
                'deskripsi'             => 'Obat anti flu',
                'gambar'                => 'noimage.jpg',
                'id_kategori'           => 1,
                'id_gudang'             => null,
                'waktu_dibuat'          => date('Y-m-d H:i:s'),
                'dibuat_oleh'           => 1,
                'diperbaharui_kapan'    => null,
                'diperbaharui_oleh'     => null
            ]
        ]);
    }
}
