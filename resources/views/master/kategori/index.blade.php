@extends('master/all')

@section('master_content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('master_kategori_create') }}" class="btn btn-info"><i class="fa fa-solid fa-plus"></i> Tambah</a>
        </div>
    </div>

    <center><h1 class="mb-4">Kategori</h1></center>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Nomor</th>
                <th scope="col">Kategori</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp

            <tr>
            @foreach($kategori AS $kat)
                <td>{{ $i++ }}</td>
                <td>{{ $kat->nama }}</td>
                <td><a href="{{ route('master_kategori_edit',['id'=>$kat->id]) }}" ><button class="btn btn-success btn btn-md rounded-circle fa fa-pencil"></button></a></td>
                <td><a onclick="return confirm('Yakin mau dihapus {{ $kat->id }} ? ')" href="{{ route('master_kategori_hapus',['id'=>$kat->id]) }}" ><button class="btn btn-danger btn btn-md rounded-circle fa fa-trash"></button></a></td>

            </tr>
            @endforeach
        </tbody>
    </table>

@endsection
