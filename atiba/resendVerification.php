<?php
include 'app/query.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Resend Verification - Atiba University ODL</title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Atiba University Open and Distance Learning (ODL) - Application Portal">

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&family=Roboto:wght@400;500;700&display=swap">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<style>
		.logo-img {
			max-width: 200px;
			height: auto;
			display: block;
			margin: 0 auto;
		}
	</style>
</head>

<body>
	<!-- **************** MAIN CONTENT START **************** -->
	<main>
		<section class="p-0 d-flex align-items-center position-relative overflow-hidden">
			<div class="container-fluid">
				<div class="row">
					<!-- Left: ODL Intro -->
					<div class="col-12 col-lg-6 d-md-flex align-items-center justify-content-center bg-primary bg-opacity-10 vh-lg-100">
						<div class="p-3 p-lg-5 text-center">
							<h2 class="fw-bold">Welcome to Atiba University ODL</h2>
							<p class="mb-0 h6 fw-light">Flexible, Accredited, NUC-Approved Distance Learning</p>
							<img src="assets/images/flier/odl-flier.jpg" class="mt-4 img-fluid rounded shadow" alt="Atiba ODL Flier">
							<p class="mt-4">
								Didn’t get your email verification link? Request a new one below.
							</p>
						</div>
					</div>

					<!-- Right: Resend Verification Form -->
					<div class="col-12 col-lg-6 m-auto">
						<div class="row my-5">
							<div class="col-sm-10 col-xl-8 m-auto">

								<!-- Logo -->
								<div class="text-center mb-3">
									<img src="assets/images/logo/atibalogo.png" alt="Atiba University Logo" class="logo-img">
								</div>

								<h2 class="text-center">Resend Verification Code</h2>
								<p class="lead mb-4 text-center">Enter your registered email to receive a new verification link.</p>
								<?php $utility->displayFlash(); ?>
								<!-- Resend Verification Form START -->
								<form id="resendForm" action="./app/applicant/applicantHandler.php" method="POST" novalidate autocomplete="off">

									<!-- Email -->
									<div class="mb-3">
										<label class="form-label">Email Address *</label>
										<input type="email" name="email" id="email" class="form-control border-0 bg-light rounded ps-3" required>
										<div class="invalid-feedback">Please enter your registered email address.</div>
									</div>

									<!-- Hidden Action -->
									<input type="hidden" name="action" value="<?php echo $utility->inputEncode('send_me_another_verification_code') ?>">

									<!-- Submit -->
									<div class="d-grid">
										<button type="submit" class="btn btn-primary">Resend Verification</button>
									</div>
								</form>
								<!-- Resend Verification Form END -->

								<!-- Sign in link -->
								 <div class="mt-4 text-center">
                                    <span>Verified already? <a href="signin.php">Login here</a></span>
                                </div>
                                <div class="mt-4 text-center">
                                    <span>Not registered yet? <a href="signup.php">Sign up here</a></span>
                                </div>
							</div>
						</div>
					</div>
					<!-- End Right -->
				</div>
			</div>
		</section>
	</main>
	<!-- **************** MAIN CONTENT END **************** -->


	<!-- Back to top -->
	<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

	<!-- Bootstrap JS -->
	<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/functions.js"></script>
	<script src="assets/js/applynow.js"></script>

</body>

</html>