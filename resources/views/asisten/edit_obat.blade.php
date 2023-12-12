@extends('layouts.mainAppAsisten')

@section('content')

  <!--breadcrumb-->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1 class="m-0">Dashboard</h1> --}}
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Table</li>
            <li class="breadcrumb-item active">Tabel Obat</li>
            <li class="breadcrumb-item active">Edit Obat</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">

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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow">
                <div class="card-header shadow mb-3">{{ __('Edit Data Obat') }}</div>

                <div class="card-body">
                  <form action={{route('obat.update', ['obat' => $obat['id']])}} method="post" name='edit'>
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="nama_obat" class="col-md-4 col-form-label text-md-right">{{ __('Nama Obat') }}</label>

                            <div class="col-md-6 mb-3">
                              <input type="text" name='nama_obat' value = "{{$obat['nama_obat']}}" placeholder="Nama Baru..." id="nama_obat" class="form-control @error('nama_obat') is-invalid @enderror" required >

                                @error('nama_obat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="singkatan" class="col-md-4 col-form-label text-md-right">{{ __('Singkatan Obat') }}</label>

                            <div class="col-md-6 mb-3">
                              <input type="text" name='singkatan' value = "{{$obat['singkatan']}}" placeholder="Singkatan Baru..." id="singkatan" class="form-control @error('singkatan') is-invalid @enderror" required >

                                @error('singkatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="keterangan" class="col-md-4 col-form-label text-md-right" >{{ __('Keterangan') }}</label>

                            <div class="col-md-6 mb-3">
                                <input type="text" name="keterangan" value = "{{$obat['keterangan']}}" placeholder="Keterangan Baru..." id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" >

                                @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tanggal_masuk" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Masuk') }}</label>

                            <div class="col-md-6 mb-3">
                                <input id="tanggal_masuk" type="date" value="{{ $obat['tanggal_masuk']}}" name="tanggal_masuk" placeholder="Tanggal Baru..." class="form-control @error('tanggal_masuk') is-invalid @enderror" required autocomplete="address">

                                @error('tanggal_masuk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jumlah" class="col-md-4 col-form-label text-md-right">{{ __('Jumlah') }}</label>

                            <div class="col-md-6 mb-3">
                                <input id="jumlah" type="number" name="jumlah" value = "{{ $obat['jumlah']}}" placeholder="Jumlah Baru..." class="form-control @error('jumlah') is-invalid @enderror">

                                @error('jumlah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kemasan" class="col-md-4 col-form-label text-md-right" >{{ __('Kemasan') }}</label>
                            <div class="col-md-6 mb-3">
                                <div class="input-group custom-dropdown">
                                <select id="kemasan"  class="form-control @error('kemasan') is-invalid @enderror" name="kemasan" required>
                                  <option value="" {{ $obat['kemasan'] ? '' : 'selected' }} disabled>Pilih Kemasan</option>
                                  <option value="Tablet" {{ $obat['kemasan'] == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                                  <option value="Sirop" {{ $obat['kemasan'] == 'Sirop' ? 'selected' : '' }}>Sirop</option>
                                  <option value="Hirup" {{ $obat['kemasan'] == 'Hirup' ? 'selected' : '' }}>Hirup</option>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text" data-toggle="dropdown">
                                        <i class="fas fa-caret-down"></i>
                                    </span>
                                </div>
                            </div>

                                @error('kemasan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success" name="edit">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection