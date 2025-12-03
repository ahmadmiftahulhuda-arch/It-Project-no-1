<!doctype html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card mt-5">
				<div class="card-body">
					<h3 class="card-title mb-4">Login Admin</h3>

					@if($errors->any())
						<div class="alert alert-danger">
							<ul class="mb-0">
								@foreach($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					@if(session('success'))
						<div class="alert alert-success">{{ session('success') }}</div>
					@endif

					<form method="POST" action="{{ route('admin.login.submit') }}">
						@csrf

						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
						</div>

						<div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<input id="password" type="password" class="form-control" name="password" required>
						</div>

						<div class="mb-3 form-check">
							<input type="checkbox" class="form-check-input" id="remember" name="remember">
							<label class="form-check-label" for="remember">Ingat saya</label>
						</div>

						<div class="d-grid">
							<button type="submit" class="btn btn-primary">Masuk</button>
						</div>
					</form>

					<hr>
					<div class="text-center small">
						<a href="{{ route('login') }}">Login sebagai pengguna biasa</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
