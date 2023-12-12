<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <link rel="icon" type="image/png" href="{{ asset('img/logo.png')}}">
  <title>Dokter | Dashboard </title>

    <!-- Masukkan link ke library Bootstrap CSS di sini -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"> --}}

  
  <link rel="stylesheet" href="jQurery/select2.min.css">
  {{-- <link rel="stylesheet" href={{ asset('css/Fmedical.css')}}> --}}
  
  <!-- Google Font: Source Sans Pro -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('template/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('template/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('template/plugins/summernote/summernote-bs4.min.css') }}">
  <!-- css tabelAkun -->
  {{-- <link rel="stylesheet" href={{ asset('css/tabelAkun.css')}}> --}}

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
</head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

  <!-- Preloader -->
  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src={{ asset('img/logo.png')}} alt="AdminLTELogo" height="100" width="100">
  </div> --}}

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/dokter" class="nav-link">Home</a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}

      <div class="dropdown">
        <li class="nav-item">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" data-toggle="dropdown" aria-haspopup="true">
            <i class="fas fa-user"></i>
          </a>
          <div class="dropdown-menu">
  
            <form action="/logout" method="post">
              @csrf
              <button class="btn btn-sm btn-outline-secondary dropdown-item" type="submit" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Logout">
                Logout
              </button>
            </form>

          </form>
  
          </div>
        </li>
      </div>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src={{ asset('img/logo.png')}} alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Klinik FLora</span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src={{ asset('img/logo.png')}} class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Flora M. Panjaitan</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">

            <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Pendataan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ url('/createAsisten') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Akun Asisten</p>
                </a>
              </li>
              
            </ul>

          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Rekam Medis
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('mRecord.create.view') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rekam Medis Pasien</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="pages/search/enhanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Enhanced</p>
                </a>
              </li> --}}
            </ul>

            
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Table
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/patients/show/dokter" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tabel Pasien</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/showAkun" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tabel Akun Asisten</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/obat/show/dokter" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tabel Obat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/Medical/show" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tabel Rekam Medis</p>
                </a>
              </li>

            </ul>

            
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


    <!-- Main content -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="">Klinik Flora</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- Bootstrap 4 -->
<script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('template/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('template/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('template/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('template/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('template/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('template/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('template/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('template/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('template/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('template/dist/js/pages/dashboard.js') }}"></script>
<!-- showPassword -->
<script src="{{ asset('js/showPassword.js')}}"></script>
<!-- js search -->
<script src="{{ asset('js/tabelPasien.js')}}"></script>

<script src="{{ asset('js/app.js') }}"></script>


{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}
{{-- <script>
    $(document).ready(function() {
        // Inisialisasi Select2 pada elemen dengan id "obatSelect"
        $('#obatSelect').select2();

        // Pencarian live saat mengisi input teks "obatSearch"
        $('#obatSearch').on('keyup', function() {
            var keyword = $(this).val().toLowerCase();
            $('#obatSelect option').each(function() {
                var obat = $(this).text().toLowerCase();
                if (obat.includes(keyword)) {
                    $(this).prop('hidden', false);
                } else {
                    $(this).prop('hidden', true);
                }
            });

            // Perbarui tampilan Select2 setelah memfilter opsi obat
            $('#obatSelect').select2();
        });
    });
</script> --}}


{{-- <script>
  var selectedMedicines = [];

  document.getElementById("saveMedicine").addEventListener("click", function(event) {
      event.preventDefault();

      var obatSelect = document.getElementById("obatSelect");
      var jumlahInput = document.getElementById("jumlah");

      var obatId = obatSelect.value;
      var obatNama = obatSelect.options[obatSelect.selectedIndex].text;
      var jumlah = jumlahInput.value;

      var medicine = {
          obatId: obatId,
          obatNama: obatNama,
          jumlah: jumlah
      };

      selectedMedicines.push(medicine);

      // Tampilkan jumlah obat dan nama obat di samping tombol "Tambahkan"
      var medicineList = document.getElementById("medicineList");
      if (medicineList.textContent === "") {
          medicineList.innerHTML = "<li><strong>" + obatNama + "</strong>: " + jumlah + "</li>";
      } else {
          var listItem = document.createElement("li");
          listItem.innerHTML = "<strong>" + obatNama + "</strong>: " + jumlah;
          medicineList.appendChild(listItem);
      }

      // Reset nilai pilihan obat dan jumlah input
      obatSelect.value = "";
      jumlahInput.value = "";
  });

  document.getElementById("saveData").addEventListener("click", function(event) {
      event.preventDefault();

      // Kirim data ke server menggunakan permintaan HTTP (contoh dengan Fetch API)
      fetch('/simpan-data', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
          },
          body: JSON.stringify(selectedMedicines),
      })
      .then(response => response.json())
      .then(data => {
          // Proses respon dari server
          console.log(data);
          alert('Data berhasil disimpan');
          // Reset daftar obat yang dipilih
          selectedMedicines = [];
          // Reset tampilan daftar obat
          var medicineList = document.getElementById("medicineList");
          medicineList.innerHTML = "";
      })
      .catch(error => {
          console.error('Error:', error);
          alert('Terjadi kesalahan saat menyimpan data');
      });
  });
</script> --}}

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-button');
        const obatRows = document.querySelectorAll('.obat-row');

        filterButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const filter = button.dataset.filter;

                obatRows.forEach(function(row) {
                    const status = row.querySelector('.true, .false');

                    if (filter === 'habis' && status.classList.contains('false')) {
                        row.style.display = 'table-row';
                    } else if (filter === 'tersedia' && status.classList.contains('true')) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    });
</script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


@yield('scripts')


    </body>
</html> 
