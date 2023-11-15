@extends('master/all')

@section('master_content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('master_barang_create') }}"><i class="fa fa-solid fa-plus"></i> Tambah</a>
        </div>
    </div>

    <center><h1 class="mb-4">Master Barang Nonaktif</h1></center>

    @if(count($barang) > 0)

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Nomor</th>
                <th scope="col">Kode</th>
                <th scope="col">Nama</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Gambar</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp

            <tr>
            @foreach($barang AS $brg)
                <td>{{ $i++ }}</td>
                <td>{{ $brg->kode }}</td>
                <td>{{ $brg->nama }}</td>
                <td>{{ $brg->deskripsi }}</td>
                <td><img class="img-responsive" width="100" height="78" src="{{ asset('assets/img/'.$brg->gambar) }}" /></td>
                <td> <a href="{{ route('master_barang_detail', ['id' => $brg->id]) }}"
                        class="btn btn-sm btn-success rounded-circle">
                        <i class="fa fa-solid fa-eye"></i>
                    </a></td>
                <td><a href="{{ route('master_barang_restore',['id'=>$brg->id]) }}" ><button class="btn btn-success btn btn-md rounded-circle fa fa-trash-restore"></button></a></td>
                <td><a onclick="return confirm('Yakin mau dihapus {{ $brg->kode }} secara permanent ? ')" href="{{ route('hapus_barang_permanent',['id'=>$brg->id]) }}" ><button class="btn btn-danger btn btn-md rounded-circle fa fa-trash"></button></a></td>

            </tr>
            @endforeach
        </tbody>
    </table>

    @else
        <div class="alert alert-danger text-center p-2">Barang nonaktif kosong sementara</div>
    @endif

@endsection
