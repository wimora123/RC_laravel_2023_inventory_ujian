@extends('master/all')

@section('master_content')

<h2>Form Tambah</h2>

<form method="post" action="{{ route('master_barang_simpan') }}" enctype="multipart/form-data">
@csrf
  <div class="form-group p-2">
    <label>Kode</label>
    <input type="text" name="kode" class="form-control" autofocus value="{{ old('kode') }}">
    @if($errors->has('kode'))
        <div class="badge text-bg-danger p-2 m-2">{{ $errors->first('kode') }}</div>
    @endif
  </div>
  <div class="form-group p-2">
    <label>Barang</label>
    <input type="text" name="barang" class="form-control" value="{{ old('barang') }}">
    @if($errors->has('barang'))
        <div class="badge text-bg-danger p-2 m-2">{{ $errors->first('barang') }}</div>
    @endif
  </div>
  <div class="form-group p-2">
    <label>Kategori</label>
    <select name="kategori" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategori AS $kat)
            <option value="{{ $kat->id }}" {{ old('kategori') == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
        @endforeach
    </select>
    @if($errors->has('kategori'))
        <div class="badge text-bg-danger p-2 m-2">{{ $errors->first('kategori') }}</div>
    @endif
  </div>
  <div class="form-group p-2">
    <label>Deskripsi</label>
    <textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
    @if($errors->has('deskripsi'))
        <div class="badge text-bg-danger p-2 m-2">{{ $errors->first('deskripsi') }}</div>
    @endif
  </div>
  <div class="form-group p-2">
    <label for="">Image</label>
    <input type="file" name="file" class="form-control" multiple>
  </div>
  <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>

@endsection
