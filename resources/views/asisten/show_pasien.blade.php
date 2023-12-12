@extends('layouts.mainAppAsisten')

@section('content')
<head>
    <link rel="stylesheet" href={{ asset('css/tabel_pasien.css')}}>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    {{-- <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous"> --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
</head>


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Tabel</li>
                            <li class="breadcrumb-item active">Tabel Pasien</li>
                        </ol>
                    </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    

    <div class="container">
        <div class="form-group pull-right">
            <input type="text" class="search form-control" placeholder="Search.....">
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-5">
    
        @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    {{ session('success') }}
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
    <table class="table table-hover results table-bordered table-sm">
      <thead >
        <tr class="table-info text-center" >
          <th>#</th>
          <th scope="col">Nama</th>
          <th scope="col">Tanggal Lahir</th>
          <th scope="col">Umur</th>
          <th scope="col">Jenis Kelamin</th>
          <th scope="col">Orang Tua/Wali</th>
          <th scope="col">No. Telepon</th>
          <th scope="col">Alamat</th>
          <th scope="col">Action</th>
        </tr>
        <tr class="warning no-result">
          <td colspan="4"><i class="fa fa-warning"></i> No result</td>
        </tr>
      </thead>
      <tbody class="text-center">
        @foreach ($data as $item)
        <tr >
            {{-- <th scope="row">{{ $item->id }}</th>
            <td>{{ $item->name }}</td>
            <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->isoFormat('D MMMM YYYY') }}</td>
            <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->diffInYears(\Carbon\Carbon::now()) }}</td>
            <td>{{ $item->gender }}</td>
            <td>{{ $item->wali }}</td>
            <td>{{ $item->phone_number }}</td>
            <td>{{ $item->address }}</td> --}}
            <th scope="row">{{ $item['id'] }}</th>
            <td>{{ $item['name'] }}</td>
            <td>{{ \Carbon\Carbon::parse($item['tanggal_lahir'])->isoFormat('D MMMM YYYY') }}</td>
            <td>{{ \Carbon\Carbon::parse($item['tanggal_lahir'])->diffInYears(\Carbon\Carbon::now()) }}</td>
            <td>{{ $item['gender'] }}</td>
            <td>{{ $item['wali'] }}</td>
            <td>{{ $item['phone_number'] }}</td>
            <td>{{ $item['address'] }}</td>
            <td>
                <div class="btn-group" role="group">

                    {{-- <a href={{route('patients.edit', $item['id'])}}> --}}
                        <a href="{{url('/patients/edit/'.$item['id'])}}" >
                    <button type="submit" rel="tooltip" class="btn btn-success btn-just-icon btn-sm mr-1" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                    </button>
                    </a>
                    
                    {{-- <form action="{{ route('delete.pasien', $item->id) }}" method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" rel="tooltip" class="btn btn-danger btn-just-icon btn-sm" id="delete">
                            <i class="material-icons">close</i>
                        </button>
                    </form> --}}
                </div>
            </td>
          </tr>
          @endforeach
      </tbody>
    </table>

        <nav class="pagination mb-3 justify-content-end">
            <ul class="pagination btn btn-sm"> {{ $data->withQueryString()->links() }} </ul>
        </nav>
</div>
@endsection
