@extends('master/all')

@section('master_content')

<h2>Form Edit</h2>

<form method="post" action="{{ route('master_barang_update', $barang[0]->id) }}" enctype="multipart/form-data">
@csrf
  <div class="form-group p-2">
        <label for="kode" class="form-label">Kode</label>
        <input type="text" class="form-control w-50" id="kode" name="kode" value="{{ old('kode', $barang[0]->kode) }}" placeholder="Kode Barang" disabled>
        @if ($errors->has('kode'))
            <div class="badge text-bg-danger">{{ $errors->first('kode') }}</div>
        @endif
  </div>
  <div class="form-group p-2">
    <label>Barang</label>
    <input type="text" name="barang" class="form-control" value="{{ old('barang', $barang[0]->nama) }}">
    @if($errors->has('barang'))
        <div class="badge text-bg-danger p-2 m-2">{{ $errors->first('barang') }}</div>
    @endif
  </div>
  <div class="form-group p-2">
  <label>Kategori</label>
    <select name="kategori" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
        <option value="{{ $barang[0]->id_kategori }}">{{ $barang[0]->nama_kategori }}</option>
        @foreach($kategori AS $kat)
            @if ($barang[0]->id_kategori != $kat->id)
            <option value="{{ $kat->id }}" {{ old('kategori') == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
            @endif
        @endforeach
    </select>
    @if($errors->has('kategori'))
        <div class="badge text-bg-danger p-2 m-2">{{ $errors->first('kategori') }}</div>
    @endif
  </div>
  <div class="form-group">
    <label>Deskripsi</label>
    <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $barang[0]->deskripsi) }}</textarea>
    @if($errors->has('deskripsi'))
        <div class="badge text-bg-danger p-2 m-2">{{ $errors->first('deskripsi') }}</div>
    @endif
  </div>
  <div class="form-group">
    <label for="">Image</label>
    <input type="file" name="file" class="form-control" multiple>
    <img width="100" height="90" src="/assets/img/{{ old('file') == TRUE ? old('file') : $barang[0]->gambar }}" alt="" class="img-responsive py-2">
  </div>
  <button type="submit" class="btn btn-primary mb-3">Update</button>
</form>

@endsection
