@extends('master/all')

@section('master_content')

<h2 class="mb-4">Form Update</h2>

<form method="post" action="{{ route('master_kategori_update', $kategori->id) }}" enctype="multipart/form-data">
@csrf
  <div class="form-group p-2">
    <label>Kategori</label>
    <input type="text" name="kategori" class="form-control" autofocus value="{{ old('kategori') == TRUE ? old('kategori') : $kategori->nama }}">
    @if($errors->has('kategori'))
        <div class="badge text-bg-danger p-2 m-2">{{ $errors->first('kategori') }}</div>
    @endif
  </div>

  <button type="submit" class="btn btn-primary mt-3">Update</button>
</form>

@endsection
