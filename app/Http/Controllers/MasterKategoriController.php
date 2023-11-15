<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Auth;
use Illuminate\Support\Facades\Validator;

class MasterKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('master/kategori/index',[
            'kategori' => $kategori
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master/kategori/form_tambah');
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
            'kategori' => 'required|min:3|max:25|unique:kategori,nama'
        ];
        $pesan_indo = [
            'required' => 'Wajib diisi bos!!',
            'min' => 'Minimal :min karakter!!',
            'unique'    =>  'Kategori Barang Sudah Terpakai'
        ];
        $validator = Validator::make($request->all(), $aturan, $pesan_indo);
        try {
            //jika inputan user tidak sesuai dengan aturan validasi
            if ($validator->fails()) {
                return redirect()
                ->route('master_kategori_create')
                ->withErrors($validator)->withInput();
            } else {
                //jika inputan user sesuai
                //simpan ke database
                $insert = Kategori::create([
                    'nama'                  => $request->kategori,
                    'waktu_dibuat'          => date('Y-m-d H:i:s'),
                    'dibuat_oleh'           => Auth::user()->id,
                    'diperbaharui_kapan'    => null,
                    'diperbaharui_oleh'     => null,
                ]);

                //jika proses insert berhasil
                if ($insert) {
                    return redirect()
                    ->route('master_kategori')
                    ->with('success', 'Berhasil menambahkan kategori baru!');
                }
            }
        }
        catch (\Throwable $th) {
            return redirect()
            ->route('master_kategori_create')
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::where('id', $id)->first();
        return view('master/kategori/form_edit',[
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
            'kategori' => 'required|min:3|max:25|unique:kategori,nama'
        ];
        $pesan_indo = [
            'required' => 'Wajib diisi bos!!',
            'min' => 'Minimal :min karakter!!',
            'unique'    =>  'Kategori Barang Sudah Terpakai'
        ];
        $validator = Validator::make($request->all(), $aturan, $pesan_indo);
        try {
            //jika inputan user tidak sesuai dengan aturan validasi
            if ($validator->fails()) {
                return redirect()
                ->route('master_kategori_edit', $id)
                ->withErrors($validator)->withInput();
            } else {
                //jika inputan user sesuai
                //simpan ke database
                $update = Kategori::where('id', $id)->update([
                    'nama'                  => $request->kategori,
                    'waktu_dibuat'          => date('Y-m-d H:i:s'),
                    'dibuat_oleh'           => Auth::user()->id,
                    'diperbaharui_kapan'    => null,
                    'diperbaharui_oleh'     => null,
                ]);

                //jika proses insert berhasil
                if ($update) {
                    return redirect()
                    ->route('master_kategori')
                    ->with('success', 'Berhasil update kategori baru!');
                }
            }
        }
        catch (\Throwable $th) {
            return redirect()
            ->route('master_kategori_edit', $id)
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
            $hapus = Kategori::where(['id' => $id])->delete();

            if($hapus){
                return redirect()
                ->route('master_kategori')
                ->with('success', 'Data berhasil dihapus');
            }


        }
        catch (\Throwable $e) {

            return redirect()
            ->route('master_kategori')
            ->with('danger', $e->getMessage());
        }
    }
}
