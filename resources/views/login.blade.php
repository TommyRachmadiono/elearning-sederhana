<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('template_login/images/icons/favicon.ico') }}"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('template_login/vendor/bootstrap/css/bootstrap.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('template_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('template_login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('template_login/vendor/animate/animate.css') }}">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('template_login/vendor/css-hamburgers/hamburgers.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('template_login/vendor/animsition/css/animsition.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('template_login/vendor/select2/select2.min.css') }}">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('template_login/vendor/daterangepicker/daterangepicker.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('template_login/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('template_login/css/main.css') }}">
	<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="login100-form validate-form" action="{{ route('cek_login') }}" method="POST">
					{{ csrf_field() }}

					<span class="login100-form-title p-b-33">
						<h3><b>Simple e-Learning</b></h3>
					</span>
					
					@if(session()->has('success'))
					<div class="alert alert-success">
						{{ session()->get('success') }}
					</div>
					@endif

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<button class="login100-form-btn">
							Sign in
						</button>
					</div>

					<div class="text-center mt-3">
						<span class="txt1">
							Create an account?
						</span>

						<a href="{{ route('register_page') }}" class="txt2 hov1">
							Register
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!--===============================================================================================-->
	<script src="{{ asset('template_login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('template_login/vendor/animsition/js/animsition.min.js') }}"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('template_login/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('template_login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('template_login/vendor/select2/select2.min.js') }}"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('template_login/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('template_login/vendor/daterangepicker/daterangepicker.js') }}"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('template_login/vendor/countdowntime/countdowntime.js') }}"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('template_login/js/main.js') }}"></script>

</body>
</html>