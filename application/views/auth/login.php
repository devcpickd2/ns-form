<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login to E-New Seasoning</title>
	<link rel="icon" href="<?= base_url('favicon.ico'); ?>" type="image/x-icon">

	<!-- Font Awesome -->
	<link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">

	<!-- SB Admin 2 & Custom CSS -->
	<link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
	<style>
		body {
			font-family: 'Nunito', sans-serif;
			background: transparent;
			height: 100vh;
			overflow: hidden;
		}

		#bg-animate {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			z-index: -1;
		}

		.login-container {
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100vh;
		}

		.card {
			background: rgba(255, 255, 255, 0.95);
			border-radius: 15px;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
		}

		.btn-login {
			background-color: #2F4F4F;
			border: none;
		}

		.btn-login:hover {
			background-color: #696969;
		}

		.form-control {
			border-radius: 10px;
		}

		.invalid-feedback {
			font-size: 0.85rem;
		}

		.logo-title {
			font-weight: 700;
			color: #4B0082;
		}
	</style>
</head>

<body>

	<div id="bg-animate"></div>

	<div class="container login-container">
		<div class="col-lg-6">
			<div class="card p-4">
				<div class="text-center mb-4">
					<img src="<?= base_url('uploads/foto/seasoning.png'); ?>" class="mb-3" width="200">
					<h2 class="logo-title">E-Form New Seasoning</h2>
				</div>

				<?php if ($this->session->flashdata('error_msg')): ?>
					<div class="alert alert-danger"><?= $this->session->flashdata('error_msg'); ?></div>
				<?php endif; ?>

				<?php if ($this->session->flashdata('error_msg')): ?>
					<div style="color:red;">
						<?= $this->session->flashdata('error_msg'); ?>
					</div>
				<?php endif; ?>

				<form class="user" method="post" action="">
					<div class="form-group">
						<input type="text" name="username"
							class="form-control <?= form_error('username') ? 'is-invalid' : ''; ?>"
							placeholder="Enter Username..." value="<?= set_value('username'); ?>">
						<div class="invalid-feedback"><?= form_error('username'); ?></div>
					</div>
					<div class="form-group">
						<input type="password" name="password"
							class="form-control <?= form_error('password') ? 'is-invalid' : ''; ?>"
							placeholder="Password">
						<div class="invalid-feedback"><?= form_error('password'); ?></div>
					</div>

					<button type="submit" class="btn btn-login btn-user btn-block text-white">Login</button>
				</form>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
	<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
	<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>

	<!-- Vanta JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.rings.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.net.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.dots.min.js"></script>

	<script>
		if (window.vantaEffect) window.vantaEffect.dots();

		VANTA.NET({
			el: "#bg-animate",
			mouseControls: true,
			touchControls: true,
			gyroControls: false,
			minHeight: 200.00,
			minWidth: 200.00,
			scale: 1.00,
			scaleMobile: 1.00,
			color: 0x4b0082,
			backgroundColor: 0xf5f5f5
		});
	</script>

</body>

</html>
