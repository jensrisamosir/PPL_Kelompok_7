{{-- 
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Reset Password</title>
        <link rel="stylesheet" href={{ asset('css/login.css')}}>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
    </head>
    
    <body style="background-color: #9DB2BF">
        <div class="box">
            <form method="POST" action="{{ route('password.update') }}">
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


            <h2></h2>
                <div class="inputBox">

                    <input type="hidden" name="token" value="{{ request() -> token }}">
                    <input type="hidden" name="email" value="{{ request() -> email }}">

                    <div class="inputBox">
                        <input type="password" required="required" name="password" id="password">
                        <span>Password</span>
                        <i></i>    
                    </div>

                    <div class="inputBox">
                        <input type="password" required="required" name="password_confirmation" id="confirmation">
                        <span>Password Confirmation</span>
                        <i></i>
                    </div>

                </div>
                    <input type="submit" value="Update" class="mt-5">
              </div>
        </div>
    </body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Reset Password</title>
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
    <div class="alert alert-success alert-dismissible fade show mt-2">
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        
        {{ session()->get('status') }}
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
							<h4 class="card-title">Reset Password</h4>
							<form method="POST" action="{{ route('password.update') }}" class="my-login-validation" novalidate="">
                            @csrf
                                <input type="hidden" name="token" value="{{ request() -> token }}">
                                <input type="hidden" name="email" value="{{ request() -> email }}">

								<div class="form-group">
									<label for="new-password">New Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required autofocus data-eye>
                                    
                                    <label for="password-confirmation">Password Confirmation</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="confirmation" required autofocus data-eye>
							
                                    
									<div class="invalid-feedback">
										Password is required
									</div>
									<div class="form-text text-muted">
										Make sure your password is strong and easy to remember
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" value="Update" class="btn btn-primary btn-block">
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
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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