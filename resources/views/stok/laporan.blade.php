@extends('master/all')

@section('master_content')

    <center><h1 class="mb-4">Laporan</h1></center>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Nomor</th>
                <th scope="col">Kode</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Stok Masuk</th>
                <th scope="col">Stok Keluar</th>
                <th scope="col">Stok Sisa</th>
                <th scope="col">Tanggal Stok</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp

            @if(count($laporan)>0)
                @foreach($laporan AS $lp)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $lp->kode }}</td>
                    <td>{{ $lp->nama_barang }}</td>
                    <td>{{ $lp->stok_masuk }}</td>
                    <td>{{ $lp->stok_keluar }}</td>
                    <td>{{ $lp->stok_sisa }}</td>
                    <td>{{ \Carbon\Carbon::parse($lp->waktu_dibuat)->format('d M Y') }} at {{ \Carbon\Carbon::parse($lp->waktu_dibuat)->format('H:i:s')}}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7"><div class="alert alert-danger text-center">Laporan stok kosong</div></td>
                </tr>
            @endif
        </tbody>
    </table>

@endsection
