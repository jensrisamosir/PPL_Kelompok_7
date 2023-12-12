@extends('layouts.mainApp')

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
            <li class="breadcrumb-item active">Tabel Pasien</li>
            <li class="breadcrumb-item active">Edit Pasien</li>
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
                <div class="card-header shadow mb-3">{{ __('Edit Data Pasien') }}</div>

                <div class="card-body">
                  <form action={{route('dokter.patients.update', ['patient' => $patient['id']])}} method="post" name='edit'>
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Pasien') }}</label>

                            <div class="col-md-6 mb-3">
                              <input type="text" name='name' value = "{{$patient['name']}}" placeholder="Nama Baru..." id="name" class="form-control @error('name') is-invalid @enderror" required >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tanggal_lahir" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>

                            <div class="col-md-6 mb-3">
                              <input type="date" name='tanggal_lahir' value = "{{$patient['tanggal_lahir']}}" placeholder="Tanggal Lahir Baru..." id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" required autocomplete="tanggal_lahir" >

                                @error('tanggal_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right" >{{ __('Jenis_Kelamin') }}</label>

                            <div class="col-md-6 mb-3">
                                <select id="gender"  class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                  <option value="" {{ $patient['gender'] ? '' : 'selected' }} disabled>Jenis Kelamin</option>
                                  <option value="Laki-laki" {{ $patient['gender'] == 'Laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                                  <option value="Perempuan" {{ $patient['gender'] == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

                            <div class="col-md-6 mb-3">
                                <input id="address" type="text" value="{{ $patient['address']}}" name="address" placeholder="Alamat Baru..." class="form-control @error('address') is-invalid @enderror" required autocomplete="address">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Nomor Telepon') }}</label>

                            <div class="col-md-6 mb-3">
                                <input id="phone_number" type="text" name="phone_number" value = "{{ $patient['phone_number']}}" placeholder="Nomor Baru..." class="form-control @error('phone_number') is-invalid @enderror">
                                @error('phone_number')
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