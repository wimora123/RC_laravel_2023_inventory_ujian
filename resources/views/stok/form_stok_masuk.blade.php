@extends('template/index')

@section('konten')
<h1>Stok masuk</h1>

<form method="post" action="{{ route('stok_in') }}">
@csrf
    <div class="row mb-4">
        <div class="col-lg-6">
            <label for="" class="form-label">Barang</label>
            <select id="" class="form-select" name="form_barang">
                <option selected>Pilih Barang</option>
                @foreach($barang AS $brg)
                <option value="{{ $brg->kode }}">{{ $brg->kode }} - {{ $brg->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-3">
            <label for="" class="form-label">Jumlah</label>
            <input type="number" name="form_jumlah_masuk" class="form-control">
            @if($errors->has('form_jumlah_masuk'))
                <div class="badge text-bg-danger p-2 m-2">{{ $errors->first('form_jumlah_masuk') }}</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>

@endsection
