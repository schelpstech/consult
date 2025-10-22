<?php
include("./inc/head.php");
?>

<body>

	<?php
	include("./inc/header.php");
	?>

	<!-- **************** MAIN CONTENT START **************** -->
	<main>
		<?php
		include("./inc/banner.php");
		?>


		<!-- =======================
Page content START -->
		<section class="pt-0">
			<div class="container">
				<div class="row">

					<?php
					include("./inc/sidebar.php");
					?>

					<!-- Main content START -->
					<div class="col-xl-9">
						<div class="card card-body bg-transparent border rounded-3">
							<!-- Application Overview START -->
							<div class="row g-4 text-center">
								<!-- Applicant Profile -->
								<div class="col-6 col-lg-3">
									<span>Applicant Profile</span>
									<h4 class="fw-bold <?php echo $progress['bio_data'] ? 'text-success' : 'text-danger'; ?>">
										<?php echo $progress['bio_data'] ? 'Completed' : 'Pending'; ?>
									</h4>
								</div>
								<!-- Payment Status -->
								<div class="col-6 col-lg-3">
									<span>Payment Status</span>
									<h4 class="fw-bold <?php echo $progress['admission_payment'] ? 'text-success' : 'text-danger'; ?>">
										<?php echo $progress['admission_payment'] ? 'Paid' : 'Not Paid'; ?>
									</h4>
								</div>
								<!-- Form Completion -->
								<div class="col-6 col-lg-3">
									<span>Form Completion</span>
									<h4 class="fw-bold <?php echo $completed == $total ? 'text-success' : 'text-danger'; ?>">
										<?php echo $completed == $total ? 'Completed' : 'Incomplete'; ?>
									</h4>
								</div>
								<!-- Application Status -->
								<div class="col-6 col-lg-3">
									<span>Application Status</span>
									<h4 class="fw-bold <?php echo !empty($progress['submission_status']) == 'submitted' ? 'text-success' : 'text-danger'; ?>">
										<?php echo !empty($progress['submission_status']) && $progress['submission_status'] == 'submitted' ? 'Submitted' : 'In Progress'; ?>
									</h4>
								</div>
							</div>
							<!-- Application Overview END -->

							<!-- Progress bar -->
							<div class="overflow-hidden my-4">
								<div class="d-flex justify-content-between">
									<h6 class="mb-0">Application Progress</h6>
									<h6 class="mb-0 <?php echo $percent == 100 ? 'text-success' : 'text-danger'; ?>">
										<?php echo $percent; ?>%
									</h6>
								</div>
								<div class="progress progress-sm bg-danger bg-opacity-10">
									<div class="progress-bar <?php echo $percent == 100 ? 'bg-success' : 'bg-danger'; ?>"
										role="progressbar"
										style="width: <?php echo $percent; ?>%"
										aria-valuenow="<?php echo $percent; ?>"
										aria-valuemin="0" aria-valuemax="100">
									</div>
								</div>
							</div>

							<!-- Next Actions -->
							<div class="d-sm-flex justify-content-sm-between align-items-center">
								<div>
									<p class="mb-0 small text-muted">
										Last updated: <?php echo date("M d, Y", strtotime($progress['updated_at'])); ?>
									</p>
								</div>
								<div class="mt-2 mt-sm-0">
									<?php if (!$progress['admission_payment']) { ?>
										<a href="../app/applicant/paymentHandler.php" class="btn btn-sm btn-primary mb-0">
											Pay Application Fee - ₦20,000
										</a>
									<?php } ?>
									<a href="support.php" class="btn btn-sm btn-outline-info mb-0">Get Support</a>
								</div>
							</div>

							<!-- Divider -->
							<hr>

							<!-- Application Steps -->
							<div class="row">
								<h6 class="mb-3 text-center">Your Admission Steps</h6>
								<div class="col-md-8 offset-md-2">
									<ul class="list-unstyled">
										<li class="mb-3 h6 fw-light">
											<i class="bi bi-patch-check-fill <?php echo $progress['admission_payment'] ? 'text-success' : 'text-muted'; ?> me-2"></i>
											Admission Form Payment
										</li>
										<li class="mb-3 h6 fw-light">
											<i class="bi bi-patch-check-fill <?php echo $progress['bio_data'] ? 'text-success' : 'text-muted'; ?> me-2"></i>
											Bio-data Submission
										</li>
										<li class="mb-3 h6 fw-light">
											<i class="bi bi-patch-check-fill <?php echo $progress['contact_details'] ? 'text-success' : 'text-muted'; ?> me-2"></i>
											Contact Details Submission
										</li>
										<li class="mb-3 h6 fw-light">
											<i class="bi bi-patch-check-fill <?php echo $progress['education_history'] ? 'text-success' : 'text-muted'; ?> me-2"></i>
											Education History Submission
										</li>
										<li class="mb-3 h6 fw-light">
											<i class="bi bi-patch-check-fill <?php echo $progress['programme_details'] ? 'text-success' : 'text-muted'; ?> me-2"></i>
											Programme Details Submission
										</li>
										<li class="mb-3 h6 fw-light">
											<i class="bi bi-patch-check-fill <?php echo $progress['supporting_docs'] ? 'text-success' : 'text-muted'; ?> me-2"></i>
											Supporting Documents Upload
										</li>
										<li class="mb-3 h6 fw-light">
											<i class="bi bi-patch-check-fill <?php echo $progress['submission_status'] == 'submitted' ? 'text-success' : 'text-muted'; ?> me-2"></i>
											Application Form Submission
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>

					<!-- Main content END -->

				</div> <!-- Row END -->
			</div>
		</section>
		<!-- =======================
Page content END -->

	</main>
	<!-- **************** MAIN CONTENT END **************** -->

	<?php
	include("./inc/footer.php");
	?>