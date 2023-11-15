@extends('master/all')

@section('master_content')
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-info" href="{{ route('master_barang_create') }}"><i class="fa fa-solid fa-plus"></i> Tambah</a>
        </div>
    </div>

    <center><h1>Master Barang</h1></center>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Nomor</th>
                <th scope="col">Kode</th>
                <th scope="col">Nama</th>
                <th scope="col">Kategori</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Gambar</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp

            @foreach($barang AS $brg)
            <tr>

                <td>{{ $i++ }}</td>
                <td>{{ $brg->kode }}</td>
                <td>{{ $brg->nama }}</td>
                <td>{{ $brg->nama_kategori }}</td>
                <td>{{ $brg->deskripsi }}</td>
                <td><img class="img-responsive" width="100" height="78" src="{{ asset('assets/img/'.$brg->gambar) }}" /></td>
                <td> <a href="{{ route('master_barang_detail', ['id' => $brg->id]) }}"
                        class="btn btn-sm btn-info rounded-circle">
                        <i class="fa fa-solid fa-eye"></i>
                    </a></td>
                <td><a href="{{ route('master_barang_edit',['id'=>$brg->id]) }}" ><button class="btn btn-success btn btn-md rounded-circle fa fa-pencil"></button></a></td>
                <td><a onclick="return confirm('Yakin mau dihapus {{ $brg->kode }} ? ')" href="{{ route('master_barang_hapus',['id'=>$brg->id]) }}" ><button class="btn btn-danger btn btn-md rounded-circle fa fa-trash"></button></a></td>

            </tr>
            @endforeach
        </tbody>
    </table>

@endsection
