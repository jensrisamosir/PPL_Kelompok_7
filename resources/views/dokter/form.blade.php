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
            <li class="breadcrumb-item active">Rekam Medis</li>
            <li class="breadcrumb-item active">Rekam Medis Pasien</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <style>
            .card{
        /* font-weight: 10; */
        margin: 5px auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.1);
        width: 80%;
        max-width: 1800px;
        font-family: 'Montserrat', sans-serif;
        letter-spacing: 2px;
        }
  </style>
    <div class="card">

      <div class="title" style="text-align: center;"> 
        <h3>
          Hasil Pemeriksaan Kesehatan
          <div>(Medical Record)</div>
          <div class="border-top mt-2"></div>
          <div class="border-top mt-2"></div>
          <div class="mt-3">Data Pribadi</div>
        </h3>
      </div>
          
      <table class="table table-light table-striped">
        <tbody>
            @if(isset($medical[0]))
            <tr>
                <th scope="row">Nama</th>
                <td>: {{ $medical[0]->name }}</td>
                <td><strong>Id. Pasien</strong> </td>
                <td>: {{ $medical[0]->pasien_id }}</td>
            </tr>
            <tr>
                <th scope="row">Tanggal Lahir</th>
                <td>: {{ $medical[0]->tanggal_lahir }}</td>
                <td><strong> No. Telepon </strong></td>
                <td>: {{ $medical[0]->phone_number }}</td>
            </tr>
            <tr>
                <th scope="row">Umur</th>
                <td>: {{ \Carbon\Carbon::parse($medical[0]->tanggal_lahir)->diffInYears(\Carbon\Carbon::now()) }} Tahun </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">Jenis Kelamin</th>
                <td colspan="3">: {{ $medical[0]->gender }}</td>
            </tr>
            <tr>
                <th scope="row">Alamat</th>
                <td colspan="3">: {{ $medical[0]->address }}</td>
            </tr>
            @else
            <tr>
                <td colspan="4">Pasien tidak memiliki Rekam Medis.</td>
            </tr>
            @endif
        </tbody>
    </table><br/>

      @foreach ($medical as $report )
      <hr/>
      <div class="title" style="text-align: center;"> 
        <h3>
          PEMERIKSAAN<br/>
        </h3>
      </div>
      <table class="table table-light table-striped">
        <tbody>
            <tr>
                <th scope="row"></th>
                <td style="width: 550px"></td>
                <td>Tanggal</td>
                <td>: {{ $report->created_at }}</td>
            </tr>

            <tr>
                <th scope="row"></th>
                <td style="width: 550px"></td>
                <td>ID</td>
                <td>: KF230{{ $report->id }}</td>
            </tr>
        </tbody>
      </table>
      <table class="table table-light table-striped">
        <tbody>
              <tr>
                <th style="width: 500px" scope="row" colspan="3">Tinggi Badan</th>
                <td colspan="2">{{ $report->tinggi }} Cm</td>
              </tr>

              <tr>
                <th style="width: 500px" scope="row" colspan="3">Berat Badan</th>
                <td colspan="2">{{ $report->berat }} Kg</td>
              </tr>
          <tr>
            <th style="width: 500px" scope="row" colspan="3">Keluhan</th>
            <td colspan="2">{{ $report->keluhan }}</td>
          </tr>
          <tr>
            <th style="width: 500px" scope="row" colspan="3">Diagnosa</th>
            <td colspan="2">{{ $report->diagnosa }}</td>
          </tr>

          <tr>
            <th style="width: 500px" scope="row" colspan="3">Kategori</th>
            <td colspan="2">{{ $report->jenis_penyakit }}</td>
          </tr>
 
          </tbody>
          </table>

          <hr/>

              <div class="title mt-3" style="text-align: center;"> 
                <h3>
                  PEMBERIAN OBAT<br/>
                </h3>
              </div>
              <table class="table table-light table-striped">
                <tbody>
                  <tr>
                    <th scope="row" rowspan="">Nama Obat</th>
                    <td>Jumlah</td>
                    <td>Kemasan</td>
                    <td>Aturan</td>
                    <td>Keterangan</td>
                  </tr>
                  <tr>
                    <th scope="row" rowspan="">{{ $report->nama_obat1 }} {{ $report->ukuran1 }}  </th>
                    <td>{{ $report->jumlah_dipakai }}</td>
                    <td>{{ $report->kemasan1 }}</td>
                    <td>{{ $report->aturan }}</td>
                    <td>{{ $report->keterangan }}</td>
                  </tr>
                  <tr>
                    <th scope="row" rowspan="">{{ $report->nama_obat2 }} {{ $report->ukuran2 }}</th>
                    <td>{{ $report->jumlah_dipakai2 }}</td>
                    <td>{{ $report->kemasan2 }}</td>
                    <td>{{ $report->aturan2 }}</td>
                    <td>{{ $report->keterangan2 }}</td>
                  </tr>
                  <tr>
                    <th scope="row" rowspan="">{{ $report->nama_obat3 }} {{ $report->ukuran3 }}</th>
                    <td>{{ $report->jumlah_dipakai3 }}</td>
                    <td>{{ $report->kemasan3 }}</td>
                    <td>{{ $report->aturan3 }}</td>
                    <td>{{ $report->keterangan3 }}</td>
                  </tr>
                  <tr>
                    <th scope="row" rowspan="">{{ $report->nama_obat4 }} {{ $report->ukuran4 }}</th>
                    <td>{{ $report->jumlah_dipakai4 }}</td>
                    <td>{{ $report->kemasan4 }}</td>
                    <td>{{ $report->aturan4 }}</td>
                    <td>{{ $report->keterangan4 }}</td>
                  </tr>
                  <tr>
                    <th scope="row" rowspan="">{{ $report->nama_obat5 }} {{ $report->ukuran5 }}</th>
                    <td>{{ $report->jumlah_dipakai5 }}</td>
                    <td>{{ $report->kemasan5 }}</td>
                    <td>{{ $report->aturan5 }}</td>
                    <td>{{ $report->keterangan5 }}</td>
                  </tr>
                  </tbody>
                  </table>



                          <div class="border-top mt-2"></div>
                          <div class="border-top mt-2 mb-5"></div>
        @endforeach
                      
</div>

@endsection

                  {{-- <table class="table table-light table-striped">
                    <tbody>
                      <tr>
                        <th scope="row">Sistem</th>
                        <td>Mark</td>
                        <td>: Otto</td>
                      </tr>
                      <tr>
                        <th scope="row" rowspan="6">Kardiovaskular</th>
                        <td>Mark</td>
                        <td>: Otto</td>
                      </tr>
                      <tr>
                        <td>Mark</td>
                        <td>: Otto</td>
                      </tr>
                      <tr>
                        <td>Mark</td>
                        <td>: Otto</td>
                      </tr>
                      <tr>
                        <td>Mark</td>
                        <td>: Otto</td>
                      </tr>
                      <tr>
                        <td>Mark</td>
                        <td>: Otto</td>
                      </tr>
                      <tr>
                        <td>Mark</td>
                        <td>: Otto</td>
                      </tr>
                      </tbody>
                      </table><br/> --}}

                      {{-- <table class="table table-light table-striped">
                        <tbody>
                          <tr>
                            <th scope="row">Sistem</th>
                            <td>Mark</td>
                            <td>: Otto</td>
                          </tr>
                          <tr>
                            <th scope="row" rowspan="4">Pernafasan</th>
                            <td>Mark</td>
                            <td>: Otto</td>
                          </tr>
                          <tr>
                            <td>Mark</td>
                            <td>: Otto</td>
                          </tr>
                          <tr>
                            <td>Mark</td>
                            <td>: Otto</td>
                          </tr>
                          <tr>
                            <td>Mark</td>
                            <td>: Otto</td>
                          </tr>
                          </tbody>
                          </table><br/> --}}