<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterBarangModel;
use App\Models\Kategori;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MasterBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Proses ambil barang
        $barang = DB::select(
            "SELECT
                mba.*,
                u1.name as dibuat_nama, u1.email as dibuat_email,
                u2.name as diperbarui_nama, u2.email as diperbarui_email,
                kat.nama AS nama_kategori
            FROM master_barang as mba
            LEFT JOIN users as u1 ON mba.dibuat_oleh = u1.id
            LEFT JOIN users as u2 ON mba.diperbaharui_oleh = u2.id
            LEFT JOIN kategori AS kat ON mba.id_kategori = kat.id
            "
        );

        return view('master/barang/index',[
            'barang' => $barang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('master/barang/form_tambah',[
            'kategori' => $kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aturan = [
            'kode' => 'required|min:3|max:7|alpha_dash|unique:master_barang,kode',
            'barang' => 'required|min:10|max:25',
            'deskripsi' => 'required|max:255',
        ];
        $pesan_indo = [
            'required' => 'Wajib diisi bos!!',
            'min' => 'Minimal :min karakter!!',
            'unique'    =>  'Kode Barang Sudah Terpakai'
        ];
        $validator = Validator::make($request->all(), $aturan, $pesan_indo);
        try {
            //jika inputan user tidak sesuai dengan aturan validasi
            if ($validator->fails()) {
                return redirect()
                ->route('master_barang_create')
                ->withErrors($validator)->withInput();
            } else {
                if($request->hasFile('file')){

                    $filename = $request->file('file')->getClientOriginalName();
                    $request->file('file')->storeAs('assets/img/', $filename);

                    //jika inputan user sesuai
                    //simpan ke database
                    $insert = MasterBarangModel::create([
                        'kode'              => strtoupper($request->kode),
                        'nama'              => $request->barang,
                        'kategori'          => $request->kategori,
                        'deskripsi'         => $request->deskripsi,
                        'gambar'            => $filename,
                        'id_kategori'       => $request->kategori,
                        'id_gudang'         => null,
                        'waktu_dibuat'      => date('Y-m-d H:i:s'),
                        'dibuat_oleh'       => Auth::user()->id,
                        'diperbaharui_kapan'  => null,
                        'diperbaharui_oleh'   => null,
                    ]);

                    //jika proses insert berhasil
                    if ($insert) {
                        return redirect()
                        ->route('master_barang')
                        ->with('success', 'Berhasil menambahkan barang baru!');
                    }

                }else{
                    //jika inputan user sesuai
                    //simpan ke database
                    $insert = MasterBarangModel::create([
                        'kode'              => strtoupper($request->kode),
                        'nama'              => $request->barang,
                        'deskripsi'         => $request->deskripsi,
                        'gambar'            => 'noimage.jpg',
                        'id_kategori'       => $request->kategori,
                        'id_gudang'         => null,
                        'waktu_dibuat'      => date('Y-m-d H:i:s'),
                        'dibuat_oleh'       => Auth::user()->id,
                        'diperbaharui_kapan'  => null,
                        'diperbaharui_oleh'   => null,
                    ]);

                    //jika proses insert berhasil
                    if ($insert) {
                        return redirect()
                        ->route('master_barang')
                        ->with('success', 'Berhasil menambahkan barang baru!');
                    }
                }


            }
        }
        catch (\Throwable $th) {
            return redirect()
            ->route('master_barang_create')
            ->with('danger', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $barang = MasterBarangModel::where('id', $id)->first();
        $barang = DB::select(
            "SELECT
                mba.*,
                u1.name as dibuat_nama, u1.email as dibuat_email,
                u2.name as diperbarui_nama, u2.email as diperbarui_email,
                kat.nama AS nama_kategori
            FROM master_barang as mba
            LEFT JOIN users as u1 ON mba.dibuat_oleh = u1.id
            LEFT JOIN users as u2 ON mba.diperbaharui_oleh = u2.id
            LEFT JOIN kategori AS kat ON mba.id_kategori = kat.id
            WHERE mba.id = ?;",
            [$id]
        );
        return view('master/barang/detail', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = DB::select(
            "SELECT
                mba.*,
                u1.name as dibuat_nama, u1.email as dibuat_email,
                u2.name as diperbarui_nama, u2.email as diperbarui_email,
                kat.nama AS nama_kategori
            FROM master_barang as mba
            LEFT JOIN users as u1 ON mba.dibuat_oleh = u1.id
            LEFT JOIN users as u2 ON mba.diperbaharui_oleh = u2.id
            LEFT JOIN kategori AS kat ON mba.id_kategori = kat.id
            WHERE mba.id = ?;",
            [$id]
        );

        $kategori = Kategori::all();

        return view('master/barang/form_edit',[
            'barang' => $barang,
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aturan = [
            'barang' => 'required|min:10|max:25',
            'deskripsi' => 'required|max:255',
            'unique'    =>  'Kode Barang Sudah Terpakai'
        ];
        $pesan_indo = [
            'required' => 'Wajib diisi bos!!',
            'min' => 'Minimal :min karakter!!',
        ];
        $validator = Validator::make($request->all(), $aturan, $pesan_indo);
        try {
            //jika inputan user tidak sesuai dengan aturan validasi
            if ($validator->fails()) {
                return redirect()
                ->route('master_barang_edit',$id)
                ->withErrors($validator)->withInput();
            } else {
                if($request->hasFile('file')){
                    $filename = $request->file('file')->getClientOriginalName();
                    $request->file('file')->storeAs('assets/img/', $filename);

                    //jika inputan user sesuai
                    //update ke database
                    $update = MasterBarangModel::where('id', $id)->update([
                        'nama'                  => $request->barang,
                        'deskripsi'             => $request->deskripsi,
                        'gambar'                => $filename,
                        'id_kategori'           => $request->kategori,
                        'diperbaharui_kapan'    => date('Y-m-d H:i:s'),
                        'diperbaharui_oleh'     => Auth::user()->id,
                    ]);
                    //jika proses update berhasil
                    if ($update) {
                        return redirect()
                        ->route('master_barang')
                        ->with('success', 'Berhasil update barang!');
                    }
                }else{
                    //jika inputan user sesuai
                    //update ke database
                    $update = MasterBarangModel::where('id',$id)->update([
                        'nama'              => $request->barang,
                        'deskripsi'         => $request->deskripsi,
                        'id_kategori'          => $request->kategori,
                        'diperbaharui_kapan'  => date('Y-m-d H:i:s'),
                        'diperbaharui_oleh'   => Auth::user()->id,
                    ]);
                    //jika proses update berhasil
                    if ($update) {
                        return redirect()
                        ->route('master_barang')
                        ->with('success', 'Berhasil update barang!');
                    }
                }
            }
        }
        catch (\Throwable $th) {
            return redirect()
            ->route('master_barang_edit',$id)
            ->with('danger', $th->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            $update = MasterBarangModel::where(['id' => $id])->update([
                'status' => 0
            ]);

            if($update){
                return redirect()
                ->route('master_barang')
                ->with('success', 'Data berhasil dihapus');
            }


        }
        catch (\Throwable $e) {


            return redirect()
            ->route('master_barang')
            ->with('danger', $e->getMessage());
        }
    }

    public function barang_nonaktif(){
        // Proses ambil barang
        $barang = MasterBarangModel::where('status', 0)->get();
        return view('master/barang/barang_nonaktif',[
            'barang' => $barang
        ]);
    }

    public function restore($id)
    {
        try{

            $update = MasterBarangModel::where(['id' => $id])->update([
                'status' => 1
            ]);

            if($update){
                return redirect()
                ->route('barang_nonaktif')
                ->with('success', 'Data berhasil direstore');
            }


        }
        catch (\Throwable $e) {


            return redirect()
            ->route('barang_nonaktif')
            ->with('danger', $e->getMessage());
        }
    }

    public function hapus_permanent($id)
    {
        try{

            $hapus = MasterBarangModel::where(['id' => $id])->delete();

            if($hapus){
                return redirect()
                ->route('barang_nonaktif')
                ->with('success', 'Data berhasil dihapus');
            }


        }
        catch (\Throwable $e) {


            return redirect()
            ->route('barang_nonaktif')
            ->with('danger', $e->getMessage());
        }
    }
}
