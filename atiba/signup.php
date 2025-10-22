<?php
include 'app/query.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Apply Now - Atiba University ODL</title>

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
								Join thousands of students learning anywhere, anytime. Start your journey today!
							</p>
						</div>
					</div>

					<!-- Right: Application Form -->
					<div class="col-12 col-lg-6 m-auto">
						<div class="row my-5">
							<div class="col-sm-10 col-xl-8 m-auto">

								<!-- Logo -->
								<div class="text-center mb-3">
									<img src="assets/images/logo/atibalogo.png" alt="Atiba University Logo" class="logo-img">
								</div>

								<h2 class="text-center">Apply Now</h2>
								<p class="lead mb-4 text-center">Fill in your details to begin your application.</p>
								<?php $utility->displayFlash(); ?>
								<!-- Application Form START -->
								<form id="applyForm" action="./app/applicant/applicantHandler.php" method="POST" novalidate autocomplete="off">

									<!-- First Name -->
									<div class="mb-3">
										<label class="form-label">First Name *</label>
										<input type="text" name="firstname" id="firstname" class="form-control border-0 bg-light rounded ps-3" required>
										<div class="invalid-feedback">Please enter your first name.</div>
									</div>

									<!-- Last Name -->
									<div class="mb-3">
										<label class="form-label">Last Name *</label>
										<input type="text" name="lastname" id="lastname" class="form-control border-0 bg-light rounded ps-3" required>
										<div class="invalid-feedback">Please enter your last name.</div>
									</div>

									<!-- Email -->
									<div class="mb-3">
										<label class="form-label">Email Address *</label>
										<input type="email" name="email" id="email" class="form-control border-0 bg-light rounded ps-3" required>
										<div class="invalid-feedback">Please enter a valid email address.</div>
									</div>

									<!-- Phone -->
									<div class="mb-3">
										<label class="form-label">Phone Number *</label>
										<input type="text" name="phone" id="phone" class="form-control border-0 bg-light rounded ps-3" required pattern="^[0-9]{10,15}$">
										<div class="invalid-feedback">Please enter a valid phone number (10–15 digits).</div>
									</div>

									<!-- Password -->
									<div class="mb-3">
										<label class="form-label">Password *</label>
										<div class="input-group">
											<input type="password" name="password" id="password" class="form-control border-0 bg-light rounded-start ps-3" minlength="6" required>
											<button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')"><i class="fas fa-eye"></i></button>
											<div class="invalid-feedback">Password must be at least 6 characters long.</div>
										</div>
									</div>

									<!-- Confirm Password -->
									<div class="mb-3">
										<label class="form-label">Confirm Password *</label>
										<div class="input-group">
											<input type="password" name="confirm_password" id="confirm_password" class="form-control border-0 bg-light rounded-start ps-3" required>
											<button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirm_password')"><i class="fas fa-eye"></i></button>
											<div class="invalid-feedback">Passwords do not match.</div>

										</div>
									</div>
									<input type="hidden" name="action" value="<?php echo $utility->inputEncode('submit_new_application') ?>">

									<!-- Submit -->
									<div class="d-grid">
										<button type="submit" class="btn btn-primary">Submit Application</button>
									</div>
								</form>
								<!-- Application Form END -->
								<!-- Sign in link -->
								<div class="mt-4 text-center">
									<span>Already registered? <a href="signin.php">Login here</a></span>
								</div>
                                <div class="mt-4 text-center">
                                    <span>Email Not Verified? <a href="resendverification.php">Resend here</a></span>
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