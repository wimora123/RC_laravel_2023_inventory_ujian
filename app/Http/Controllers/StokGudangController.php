<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterBarangModel;
use App\Models\StokBarangModel;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StokGudangController extends Controller
{
    public function form_stok_masuk(){
        $barang = MasterBarangModel::where('status', 1)->get();
        return view('stok/form_stok_masuk',[
            'barang' => $barang
        ]);
    }

    public function proses_stok_masuk(Request $request){
        $aturan = [
            'form_barang' => 'required',
            'form_jumlah_masuk' => 'required'
        ];
        $pesan_indo = [
            'required' => 'Wajib diisi bos!!',
            'min' => 'Minimal 1',
        ];
        $validator = Validator::make($request->all(), $aturan, $pesan_indo);

        try {
            //jika inputan user tidak sesuai dengan aturan validasi
            if ($validator->fails()) {
                return redirect()
                ->route('form_stok_masuk')
                ->withErrors($validator)->withInput();
            } else {
                //jika inputan user sesuai
                //simpan ke database

                // Mengambil data sisa stok terakhir di db
                // Berdasarkan kode barang yang dipilih di form
                $cek_sisa = StokBarangModel::where('kode', $request->form_barang)->orderBy('id', 'DESC')->first();
                // $stok_sisa = $cek_sisa['stok_sisa'] ?? 0;
                $stok_sisa = isset($cek_sisa['stok_sisa']) ? $cek_sisa['stok_sisa'] : 0;

                // Apa ada sisa yang ditemukan?
                if(isset($stok_sisa)){
                    // Stok sisa + stok masuk baru
                    $isi = $stok_sisa + $request->form_jumlah_masuk;
                }else{
                    $isi = $request->form_jumlah_masuk;
                }

                $insert = StokBarangModel::create([
                    'kode'                => strtoupper($request->form_barang),
                    'stok_masuk'          => $request->form_jumlah_masuk,
                    'stok_keluar'         => 0,
                    'stok_sisa'           => $isi,
                    'waktu_dibuat'        => date('Y-m-d H:i:s'),
                    'dibuat_oleh'         => Auth::user()->id,
                    'diperbaharui_kapan'  => null,
                    'diperbaharui_oleh'   => null,
                ]);
                //jika proses insert berhasil
                if ($insert) {
                    return redirect()
                    ->route('form_stok_masuk')
                    ->with('success', 'Berhasil menambahkan barang baru!');
                }
            }
        }
        catch (\Throwable $th) {
            return redirect()
            ->route('form_stok_masuk')
            ->with('danger', $th->getMessage());
        }
    }

    public function form_stok_keluar(){
        $barang = MasterBarangModel::where('status', 1)->get();
        return view('stok/form_stok_keluar',[
            'barang' => $barang
        ]);
    }

    public function proses_stok_keluar(Request $request){
        $aturan = [
            'form_barang' => 'required',
            'form_jumlah_keluar' => 'required'
        ];
        $pesan_indo = [
            'required' => 'Wajib diisi bos!!',
            'min' => 'Minimal 1',
        ];
        $validator = Validator::make($request->all(), $aturan, $pesan_indo);

        try {
            if ($validator->fails()) {
                return redirect()
                ->route('stok-keluar')
                ->withErrors($validator)->withInput();
            } else {
                //jika inputan user sesuai
                //simpan ke database

                //mengambil data sisa stok terakhir di database
                //berdasarkan kode barang yang dipilih di form
                $cek_sisa = StokBarangModel::where('kode', $request->form_barang)->orderBy('id','DESC')->first();
                $stok_sisa = isset($cek_sisa['stok_sisa']) ? $cek_sisa['stok_sisa'] : 0;

                if(isset($stok_sisa)){
                    //stok sisa + stok masuk baru
                    //jika yang dikeluarkan lebih besar dari stok yg ada
                    if($request->form_jumlah_keluar > $stok_sisa){
                        return redirect()
                        ->route('form_stok_keluar')
                        ->with('danger', 'Jumlah yang dikeluarkan melebihi stok yang ada');
                        die;

                        //jika yg dikeluarkan lebih kecil atau sama
                    }else{
                         //cek jika jumlah yg dikeluarkan adalah 0 dan minus
                         if($request->form_jumlah_keluar <= 0){
                            return redirect()
                            ->route('form_stok_keluar')
                            ->with('danger', 'Jumlah minimal barang yg bisa keluar adalah 1');
                            die;
                         }
                         //jumlah yg keluar 1 dst...
                         else{
                            $keluar = $stok_sisa - $request->form_jumlah_keluar;
                            $insert = StokBarangModel::create([
                                'kode'              => strtoupper($request->form_barang),
                                'stok_masuk'        => 0,
                                'stok_keluar'       => $request->form_jumlah_keluar,
                                'stok_sisa'         => $keluar,
                                'waktu_dibuat'      => date('Y-m-d H:i:s'),
                                'dibuat_oleh'       => Auth::user()->id,
                                'diperbarui_kapan'  => null,
                                'diperbarui_oleh'   => null,
                            ]);
                            //jika proses insert ke db berhasil
                            if ($insert) {
                                return redirect()
                                ->route('form_stok_keluar')
                                ->with('success', 'Berhasil mengeluarkan barang!');
                            }
                         }
                    }
                }else{
                    return redirect()
                    ->route('form_stok_keluar')
                    ->with('danger', 'Barang belum ada stok sama sekali');
                    die;
                }
            }
        }
        catch (\Throwable $th) {
            return redirect()
            ->route('form_stok_keluar')
            ->with('danger', $th->getMessage());
        }
    }

    public function laporan_stok(){
        $laporan = DB::select(
            "SELECT
            sb.*,
            mb.nama as nama_barang
        FROM stok_barang as sb
        LEFT JOIN master_barang AS mb ON sb.kode = mb.kode
        WHERE mb.status = 1
            "
        );

        return view('stok/laporan',[
            'laporan' => $laporan
        ]);
    }
}
