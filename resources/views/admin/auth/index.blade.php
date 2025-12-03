<!doctype html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login</title>
	
	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
	
	<style>
		:root {
			--primary-color: #3b5998;
			--primary-hover: #344e86;
			--accent-color: #4c70ba;
			--admin-accent: #8b0000;
			--admin-hover: #a00000;
		}
		
		body {
			background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
						url("{{ asset('img/Gedung_TI.JPG') }}");
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			background-attachment: fixed;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 15px;
			margin: 0;
		}
		
		.login-container {
			max-width: 420px;
			width: 100%;
			animation: fadeIn 0.5s ease-in-out;
		}
		
		.login-card {
			background: white;
			border-radius: 12px;
			box-shadow: 0 15px 35px rgba(139, 0, 0, 0.25);
			padding: 30px;
			overflow: hidden;
			position: relative;
			border: none;
		}
		
		.login-card::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 5px;
			background: linear-gradient(90deg, var(--admin-accent) 0%, #b22222 100%);
			border-radius: 12px 12px 0 0;
		}
		
		.card-title {
			font-size: 1.5rem;
			font-weight: 700;
			color: var(--admin-accent);
			margin-bottom: 8px;
			text-align: center;
		}
		
		.card-subtitle {
			font-size: 0.9rem;
			color: #6b7280;
			margin-bottom: 25px;
			text-align: center;
			line-height: 1.4;
		}
		
		.admin-badge {
			display: inline-flex;
			align-items: center;
			gap: 6px;
			background-color: rgba(139, 0, 0, 0.1);
			color: var(--admin-accent);
			padding: 4px 10px;
			border-radius: 20px;
			font-size: 0.8rem;
			font-weight: 600;
			margin-bottom: 10px;
		}
		
		.form-label {
			font-weight: 600;
			color: #374151;
			margin-bottom: 8px;
			font-size: 0.9rem;
		}
		
		.form-control {
			padding: 12px 14px;
			border-radius: 8px;
			margin-bottom: 15px;
			border: 1px solid #d1d5db;
			transition: all 0.3s;
			font-size: 0.9rem;
			background: white;
		}
		
		.form-control:focus {
			box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.15);
			border-color: var(--admin-accent);
			background: white;
		}
		
		.password-container {
			position: relative;
			margin-bottom: 5px;
		}
		
		.toggle-password {
			position: absolute;
			right: 14px;
			top: 50%;
			transform: translateY(-50%);
			background: none;
			border: none;
			color: #6b7280;
			cursor: pointer;
			width: 22px;
			height: 22px;
			display: flex;
			align-items: center;
			justify-content: center;
			border-radius: 4px;
			transition: all 0.2s;
			font-size: 0.9rem;
		}
		
		.toggle-password:hover {
			background-color: #f3f4f6;
			color: #4b5563;
		}
		
		.form-check {
			margin-bottom: 20px;
		}
		
		.form-check-input {
			width: 16px;
			height: 16px;
			margin-right: 8px;
			margin-top: 0.1em;
		}
		
		.form-check-input:checked {
			background-color: var(--admin-accent);
			border-color: var(--admin-accent);
		}
		
		.form-check-input:focus {
			box-shadow: 0 0 0 2px rgba(139, 0, 0, 0.25);
		}
		
		.form-check-label {
			font-size: 0.85rem;
			color: #4b5563;
			user-select: none;
		}
		
		.btn-login {
			background: linear-gradient(135deg, var(--admin-accent) 0%, #b22222 100%);
			border: none;
			padding: 12px;
			font-weight: 700;
			border-radius: 8px;
			color: white;
			width: 100%;
			transition: all 0.3s;
			margin-bottom: 20px;
			font-size: 1rem;
			letter-spacing: 0.5px;
		}
		
		.btn-login:hover {
			background: linear-gradient(135deg, var(--admin-hover) 0%, #c22e2e 100%);
			transform: translateY(-2px);
			box-shadow: 0 6px 12px rgba(139, 0, 0, 0.3);
		}
		
		.alert {
			border-radius: 8px;
			padding: 12px 15px;
			margin-bottom: 20px;
			border: none;
			font-size: 0.9rem;
		}
		
		.alert-danger {
			background-color: rgba(220, 53, 69, 0.1);
			color: #dc3545;
			border-left: 4px solid #dc3545;
		}
		
		.alert-success {
			background-color: rgba(25, 135, 84, 0.1);
			color: #198754;
			border-left: 4px solid #198754;
		}
		
		.alert ul {
			margin-bottom: 0;
			padding-left: 20px;
		}
		
		.alert li {
			margin-bottom: 5px;
		}
		
		.alert li:last-child {
			margin-bottom: 0;
		}
		
		.divider {
			display: flex;
			align-items: center;
			margin: 20px 0;
			color: #9ca3af;
			font-size: 0.85rem;
			font-weight: 500;
		}
		
		.divider::before,
		.divider::after {
			content: "";
			flex: 1;
			border-bottom: 1px solid #e5e7eb;
		}
		
		.divider::before {
			margin-right: 12px;
		}
		
		.divider::after {
			margin-left: 12px;
		}
		
		.back-link {
			text-align: center;
			margin-top: 15px;
			color: #6b7280;
			font-size: 0.85rem;
			padding-top: 15px;
			border-top: 1px solid #f3f4f6;
		}
		
		.back-link a {
			color: var(--primary-color);
			text-decoration: none;
			font-weight: 600;
			transition: all 0.2s;
		}
		
		.back-link a:hover {
			color: var(--primary-hover);
			text-decoration: underline;
		}
		
		/* Animations */
		@keyframes fadeIn {
			from { opacity: 0; transform: translateY(20px); }
			to { opacity: 1; transform: translateY(0); }
		}
		
		/* Fallback jika gambar tidak load */
		.no-background {
			background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
		}
		
		/* Responsive adjustments */
		@media (max-width: 576px) {
			.login-card {
				padding: 25px 20px;
			}
			
			.card-title {
				font-size: 1.3rem;
			}
			
			.card-subtitle {
				font-size: 0.85rem;
			}
			
			body {
				padding: 10px;
			}
		}
	</style>
</head>
<body>
	<div class="login-container">
		<div class="login-card">
			<!-- Header Section -->
			<div class="text-center mb-4">
				<div class="admin-badge">
					<i class="fas fa-shield-alt"></i>
					Akses Administrator
				</div>
				<h3 class="card-title">Login Admin</h3>
				<p class="card-subtitle">Masuk ke panel admin sistem peminjaman POLITALA</p>
			</div>

			<!-- Error/Success Messages -->
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

			<!-- Login Form -->
			<form method="POST" action="{{ route('admin.login.submit') }}">
				@csrf

				<div class="mb-3">
					<label for="email" class="form-label">Email Admin</label>
					<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="email@politala.ac.id">
				</div>

				<div class="mb-3">
					<label for="password" class="form-label">Password</label>
					<div class="password-container">
						<input id="password" type="password" class="form-control" name="password" required placeholder="Masukkan password admin">
						<button type="button" class="toggle-password" id="togglePassword">
							<i class="far fa-eye"></i>
						</button>
					</div>
				</div>

				<div class="mb-3 form-check">
					<input type="checkbox" class="form-check-input" id="remember" name="remember">
					<label class="form-check-label" for="remember">Ingat saya</label>
				</div>

				<div class="d-grid">
					<button type="submit" class="btn-login">
						<i class="fas fa-sign-in-alt me-2"></i>
						Masuk sebagai Admin
					</button>
				</div>
			</form>

			<!-- Divider -->
			<div class="divider">atau</div>

			<!-- Back Link -->
			<div class="back-link">
				<a href="{{ route('login') }}">
					<i class="fas fa-arrow-left me-1"></i>
					Login sebagai pengguna biasa
				</a>
			</div>
		</div>
	</div>

	<!-- Bootstrap JS Bundle -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const togglePassword = document.querySelector('#togglePassword');
			const password = document.querySelector('#password');
			
			// Toggle password visibility
			if (togglePassword && password) {
				togglePassword.addEventListener('click', function() {
					const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
					password.setAttribute('type', type);
					
					// Toggle icon
					if (type === 'password') {
						this.innerHTML = '<i class="far fa-eye"></i>';
					} else {
						this.innerHTML = '<i class="far fa-eye-slash"></i>';
					}
				});
			}
			
			// Form validation for admin email
			const form = document.querySelector('form');
			const emailInput = document.querySelector('#email');
			
			if (form && emailInput) {
				form.addEventListener('submit', function(e) {
					const email = emailInput.value;
					
					// Validasi email POLITALA untuk admin
					if (!email.endsWith('@politala.ac.id')) {
						e.preventDefault();
						alert('Email admin harus menggunakan domain @politala.ac.id');
					}
				});
			}
			
			// Fallback jika gambar tidak load
			const body = document.querySelector('body');
			const img = new Image();
			img.src = "{{ asset('img/Gedung_TI.JPG') }}";
			img.onerror = function() {
				body.classList.add('no-background');
				console.log('Background image failed to load, using fallback gradient');
			};
			img.onload = function() {
				console.log('Background image loaded successfully');
			};
		});
	</script>
</body>
</html>