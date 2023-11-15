@extends('template/index')

@section('konten')

<!-- Navs and tabs -->
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ (Request::segment(2) == 'barang') ? 'bg-warning' : '' }}" href="{{ route('master_barang') }}">Barang</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ (Request::segment(2) == 'kategori') ? 'bg-warning' : '' }}" href="{{ route('master_kategori') }}">Kategori</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ (Request::segment(2) == 'gudang') ? 'bg-warning' : '' }}" href="{{ route('master_gudang') }}">Gudang</a>
  </li>
</ul>

<div class="tab-content pt-3">
    @yield('master_content')
</div>

@endsection
