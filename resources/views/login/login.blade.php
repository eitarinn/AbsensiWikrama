<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Muhamad Nauval Azhar">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100">
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
							<form method="POST" action = "/login" class="needs-validation" novalidate="" autocomplete="off">
                                @csrf
								@if(session()->has('loginError'))
									<div class="alert alert-danger alert-dismissible fade-show" role="alert">
									{{ session('loginError') }}
									</div>
								@endif
								<div class="mb-3">
                                    <label class="mb-2 text-muted" for="nama">Nama</label>
									<input id="nama" type="text" class="form-control" name="nama" required autofocus value="{{ old('nama') }}">
								    @error('nama')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>
                                
                                <div class="mb-3">
									<label class="mb-2 text-muted" for="username">Username</label>
									<input id="username" type="text" class="form-control" name="username" required autofocus value="{{ old('username') }}">
									@error('username')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>

								<div class="mb-3">
                                    <label class="mb-2 text-muted" for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required>
								    @error('password')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>

								<div class="d-flex align-items-center">
									<button type="submit" class="btn btn-primary ms-auto">
										Login
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="text-center mt-5 text-muted">
						Copyright &copy; 2017-2021 &mdash; Berliana Setyani 
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/login.js"></script>
</body>
</html>