@extends('layouts.mainApp')

@section('content')
<head>
    <link rel="stylesheet" href={{ asset('css/tabel_pasien.css')}}>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
</head>

    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Tabel</li>
                <li class="breadcrumb-item active">Tabel Obat</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>

    @if ($data->isEmpty())
        <p class="font-monospace fw-bolder fs-1 text-center text-muted">Belum Ada Data Obat</p>
    @else
    
    <div class="container">
        <div class="form-group pull-right">
            <input type="text" class="search form-control" placeholder="Search.....">
        </div>
    </div>  

    <div class="container">
        <div class="row">
            <div class="col-md-5">
    
        @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert" >
                    <i class="fas fa-times-circle me-3">
                        {{ session('success') }}
                    </i>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        @endif
            </div>
        </div>
    </div>

    <div class="container card">

        <div class="container mt-1">
            <p>showing <strong>{{ $data->firstItem() }} - {{ $data->lastItem() }} </strong> dari <strong> {{ $data->total() }} </strong>  item</p>
        </div>

    <span class="counter pull-right"></span>

    <div class="dropdown mb-1">
        <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Filter
        </button>
        <div class="dropdown-menu" aria-labelledby="filterDropdown">
            <a class="dropdown-item" href="{{ route('obat.show.dokter') }}">Semua</a>
            <a class="dropdown-item" href="{{ route('obat.show.dokter', ['filter' => 'tersedia']) }}">Tersedia</a>
            <a class="dropdown-item" href="{{ route('obat.show.dokter', ['filter' => 'habis']) }}">Habis</a>
        </div>
    </div>

    <table class="table table-hover table-bordered results table-sm">
      <thead>
        <tr class="table-info text-center" >
          <th>#</th>
          <th scope="col">Nama Obat</th>
          <th scope="col">Keterangan</th>
          <th scope="col">Tanggal Masuk</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Kemasan</th>
          <th scope="col">Status</th>
          {{-- <th scope="col">Action</th> --}}
        </tr>
        <tr class="warning no-result">
          <td colspan="4"><i class="fa fa-warning"></i> No result</td>
        </tr>
      </thead>
      <tbody class="text-center">
        @foreach ($data as $obat)
        <tr >
            <th scope="row">{{ $obat['id'] }}</th>
            <td>{{ $obat['nama_obat'] }}</td>
            <td>{{ $obat['keterangan'] }}</td>
            <td>{{ $obat['tanggal_masuk'] }}</td>
            <td>{{ $obat['jumlah'] }}</td>
            <td>{{ $obat['kemasan'] }}</td>
            <td class="">
                @if ($obat['jumlah'] <= 0)
                    <span class="false text-white">{{ __('Habis') }}</span>
                @else
                    <span class="true text-white">{{ __('Tersedia') }}</span>
                @endif
            </td>
          </tr>
          @endforeach
      </tbody>
    </table>
    @endif

    <nav class="pagination mb-3 justify-content-end">
        <ul class="pagination btn btn-sm"> {{ $data->withQueryString()->links() }} </ul>
    </nav>
    
</div>

@endsection 


