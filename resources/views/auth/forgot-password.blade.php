{{-- <!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  
  <style>
      body{
          background: #d3d3d3;
      }
      .main {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .form {
          background: #fff;
          padding: 50px 30px;
      }
  </style>

  <body>
    <div class="main">
        <div class="form">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $errors)
                        <li>
                            {{ $errors }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('status'))
                <div class="alert alert-sucess">
                    {{ session()->get('status') }}
                </div>
            @endif

            <h2>Forgot Your Password?</h2>
            <p>please enter you e-mail</p>
            <form action="{{ route('password.email') }}" method="post">
                @csrf
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email">
                <input type="submit" value="Request Password Reset" class="btn btn-primary w-100 mt-3">
            </form>
        </div>
    </div>
  </body>

</html> --}}

{{-- <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Halaman Login</title>
        <link rel="stylesheet" href={{ asset('css/login.css')}}>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
    </head>
    
    <body style="background-color: #9DB2BF">
        <div class="box">
            <form action="{{ route('password.email') }}" method="post">
              @csrf
              <div class="form">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert" >
                    @foreach ($errors->all() as $errors )

                    <i class="fas fa-times-circle me-3">
                        {{ $errors }}
                    </i>
                    
                    @endforeach
                </div>
            @endif

            @if(session()->has('status'))

                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert" >
                    <i class="fas fa-times-circle me-3">
                        {{ session()->get('status') }}
                    </i>
                </div>
            @endif


              <h2>Forgot Your Password</h2>
              
              <div class="inputBox">    
                <input type="email" required="required" name="email" id="email">
                <span>Email</span>
                <i></i>
            </div>
            <input type="submit" value="Send" class="mt-5">
              </div>
        </div>
    </body>
</html> --}}

{{-- <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Halaman Forgot Password  </title>
        <link rel="stylesheet" href={{ asset('css/login.css')}}>
        <!-- Link CSS Bootstrap -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
            
        <!-- Link CSS Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    </body>
    <form action="{{ route('password.email') }}" method="post">
        @csrf
        <div class="wrapper">
            <div class="logo">
                <img src="{{ asset('img/logo.png')}}" alt="">
            </div>
            <div class="text-center mt-4 name">
                Masukkan Email
            </div>
            <form class="p-3 mt-3">
                <div class="form-field d-flex align-items-center mt-2">
                    <span class="far fa-user"></span>
                    <input type="email" required="required" name="email" id="email" placeholder="Email">
                </div>
                <button type="submit" value="Send" class="btn mt-3">Login</button>
            </form>
        </div>
    </form>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Forgot Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href={{ asset('css/login.css')}}>
</head>

@if ($errors->any())
    <div class="position-fixed top-0 end-0 mt-2 me-2">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    </div>
@endif

@if(session()->has('status'))

    <div class="position-fixed top-0 end-0 mt-2 me-2">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            {{ session()->get('status') }}
        </div>
    </div>
@endif

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center align-items-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src={{ asset('img/logo.png') }} alt="bootstrap 4 login page">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Forgot Password</h4>
							<form action="{{ route('password.email') }}" method="post" class="my-login-validation" novalidate="">
                                @csrf
								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus placeholder="e-mail">
									<div class="invalid-feedback">
										Email is invalid
									</div>
									<div class="form-text text-muted">
										By clicking "Reset Password" we will send a password reset link
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" value="Send" class="btn btn-primary btn-block">
										Reset Password
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2017 &mdash; Klinik Flora
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="{{ asset('js/login.js')}}"></script>
</body>

<script>
    // Menangani aksi penutupan alert
    document.addEventListener('DOMContentLoaded', function() {
        var closeButtons = document.querySelectorAll('[data-dismiss="alert"]');
        closeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var alert = button.closest('.alert');
                alert.remove();
            });
        });
    });
</script>
</html>