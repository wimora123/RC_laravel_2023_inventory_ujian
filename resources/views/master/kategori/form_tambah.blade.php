@extends('master/all')

@section('master_content')

<h2 class="mb-4">Form Tambah</h2>

<form method="post" action="{{ route('master_kategori_simpan') }}" enctype="multipart/form-data">
@csrf
  <div class="form-group p-2">
    <label>Kategori</label>
    <input type="text" name="kategori" class="form-control" autofocus value="{{ old('kategori') }}">
    @if($errors->has('kategori'))
        <div class="badge text-bg-danger p-2 m-2">{{ $errors->first('kategori') }}</div>
    @endif
  </div>

  <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>

@endsection
