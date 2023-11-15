@extends('template/index')
@section('konten')

<h1>Stok Keluar</h1>
<hr>
<form action="{{ route('stok_out') }}" method="post">
    @csrf
    <div class="row mb-4">
        <div class="col-lg-6">
            <label class="form-label h5">Barang</label>
            <select class="form-select" name="form_barang">
                <option selected>Pilih barang</option>
                @foreach ($barang as $brg)
                    <option value="{{ $brg->kode }}">{{ $brg->kode }} | {{ $brg->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-2">
            <label class="form-label h5">Jumlah</label>
            <input type="number" name="form_jumlah_keluar" class="form-control">
            @if($errors->has('form_jumlah_keluar'))
                <div class="badge text-bg-danger p-2 m-2">{{ $errors->first('form_jumlah_keluar') }}</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-solid fa-save me-1"></i> Simpan
            </button>
        </div>
    </div>
</form>

@endsection
