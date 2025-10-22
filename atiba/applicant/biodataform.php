<?php
include("./inc/head.php");
?>

<body>
    <?php
    include("./inc/header.php");
    ?>
    <!-- **************** MAIN CONTENT START **************** -->
    <main>
        <!-- =======================
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
                        <div class="cardd card-body bg-transparent border rounded-3">
                            <div class="row my-5">
                                <div class="col-sm-10 col-xl-8 m-auto">

                                    <h3 class="text-center mb-4">Applicant Bio-Data Form</h3>
                                    <hr>

                                    <form id="biodataForm" action="../app/applicant/formhandler.php" method="POST" novalidate autocomplete="off">

                                        <div class="row">
                                            <!-- First Name -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">First Name *</label>
                                                <input type="text" name="firstname" id="firstname" value="<?= htmlspecialchars($applicant_bio_data['firstname'] ?? '') ?>" class="form-control border-0 bg-light rounded ps-3" required>
                                                <div class="invalid-feedback">Please enter your first name.</div>
                                            </div>

                                            <!-- Middle Name -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Middle Name</label>
                                                <input type="text" name="middlename" id="middlename" value="<?= htmlspecialchars($applicant_bio_data['middlename'] ?? '') ?>" class="form-control border-0 bg-light rounded ps-3">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <!-- Last Name -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Last Name *</label>
                                                <input type="text" name="lastname" id="lastname" value="<?= htmlspecialchars($applicant_bio_data['lastname'] ?? '') ?>" class="form-control border-0 bg-light rounded ps-3" required>
                                                <div class="invalid-feedback">Please enter your last name.</div>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Gender *</label>
                                                <select name="gender" id="gender" class="form-control border-0 bg-light rounded ps-3" required>
                                                    <option value="">-- Select Gender --</option>
                                                    <option value="">-- Select Gender --</option>
                                                    <option value="male" <?= ($applicant_bio_data['gender'] ?? '') === 'male' ? 'selected' : '' ?>>Male</option>
                                                    <option value="female" <?= ($applicant_bio_data['gender'] ?? '') === 'female' ? 'selected' : '' ?>>Female</option>
                                                </select>
                                                <div class="invalid-feedback">Please select your gender.</div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <!-- Phone -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Date of Birth *</label>
                                                <input type="date" name="dob" id="dob" value="<?= htmlspecialchars($applicant_bio_data['dob'] ?? '') ?>" class="form-control border-0 bg-light rounded ps-3" required>
                                                <div class="invalid-feedback">Please enter your date of birth.</div>
                                            </div>

                                            <!-- Religion -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Religion *</label>
                                                <select name="religion" id="religion" class="form-control border-0 bg-light rounded ps-3" required>
                                                    <option value="">Select Religion</option>
                                                    <option value="Christianity" <?= ($applicant_bio_data['religion'] ?? '') === 'Christianity' ? 'selected' : '' ?>>Christianity</option>
                                                    <option value="Islam" <?= ($applicant_bio_data['religion'] ?? '') === 'Islam' ? 'selected' : '' ?>>Islam</option>
                                                    <option value="Traditional" <?= ($applicant_bio_data['religion'] ?? '') === 'Traditional' ? 'selected' : '' ?>>Traditional</option>
                                                    <option value="Other" <?= ($applicant_bio_data['religion'] ?? '') === 'Other' ? 'selected' : '' ?>>Other</option>
                                                </select>
                                                <div class="invalid-feedback">Please select your religion.</div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <!-- Marital Status -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Marital Status *</label>
                                                <select class="form-control" id="marital_status" name="marital_status" required>
                                                    <option value="">-- Select Marital Status --</option>
                                                    <option value="Single" <?= ($applicant_bio_data['marital_status'] ?? '') === 'Single' ? 'selected' : '' ?>>Single</option>
                                                    <option value="Married" <?= ($applicant_bio_data['marital_status'] ?? '') === 'Married' ? 'selected' : '' ?>>Married</option>
                                                    <option value="Divorced" <?= ($applicant_bio_data['marital_status'] ?? '') === 'Divorced' ? 'selected' : '' ?>>Divorced</option>
                                                    <option value="Widowed" <?= ($applicant_bio_data['marital_status'] ?? '') === 'Widowed' ? 'selected' : '' ?>>Widowed</option>
                                                </select>
                                                <div class="invalid-feedback">Please select your marital status.</div>
                                            </div>

                                            <!-- Hometown -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Hometown *</label>
                                                <input type="text" name="hometown" id="hometown" value="<?= htmlspecialchars($applicant_bio_data['hometown'] ?? '') ?>" class="form-control border-0 bg-light rounded ps-3" required>
                                                <div class="invalid-feedback">Please enter your hometown.</div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <!-- Nationality -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Nationality *</label>
                                                <select class="form-control" id="nationality" name="nationality" required>
                                                    <option value="">-- Select Nationality --</option>
                                                    <option value="Nigerian" <?= ($applicant_bio_data['nationality'] ?? '') === 'Nigerian' ? 'selected' : '' ?>>Nigerian</option>
                                                    <option value="Non-Nigerian" <?= ($applicant_bio_data['nationality'] ?? '') === 'Non-Nigerian' ? 'selected' : '' ?>>Non-Nigerian</option>
                                                </select>
                                                <div class="invalid-feedback">Please select your Nationality.</div>
                                            </div>

                                            <!-- State of Origin -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">State of Origin *</label>
                                                <select class="form-control" id="state_origin" name="state_origin" required>
                                                    <option value="">-- Select State --</option>
                                                    <option value="Abia" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Abia' ? 'selected' : '' ?>>Abia</option>
                                                    <option value="Adamawa" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Adamawa' ? 'selected' : '' ?>>Adamawa</option>
                                                    <option value="Akwa Ibom" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Akwa Ibom' ? 'selected' : '' ?>>Akwa Ibom</option>
                                                    <option value="Anambra" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Anambra' ? 'selected' : '' ?>>Anambra</option>
                                                    <option value="Bauchi" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Bauchi' ? 'selected' : '' ?>>Bauchi</option>
                                                    <option value="Bayelsa" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Bayelsa' ? 'selected' : '' ?>>Bayelsa</option>
                                                    <option value="Benue" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Benue' ? 'selected' : '' ?>>Benue</option>
                                                    <option value="Borno" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Borno' ? 'selected' : '' ?>>Borno</option>
                                                    <option value="Cross River" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Cross River' ? 'selected' : '' ?>>Cross River</option>
                                                    <option value="Delta" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Delta' ? 'selected' : '' ?>>Delta</option>
                                                    <option value="Ebonyi" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Ebonyi' ? 'selected' : '' ?>>Ebonyi</option>
                                                    <option value="Edo" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Edo' ? 'selected' : '' ?>>Edo</option>
                                                    <option value="Ekiti" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Ekiti' ? 'selected' : '' ?>>Ekiti</option>
                                                    <option value="Enugu" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Enugu' ? 'selected' : '' ?>>Enugu</option>
                                                    <option value="FCT" <?= ($applicant_bio_data['state_origin'] ?? '') === 'FCT' ? 'selected' : '' ?>>FCT (Abuja)</option>
                                                    <option value="Gombe" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Gombe' ? 'selected' : '' ?>>Gombe</option>
                                                    <option value="Imo" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Imo' ? 'selected' : '' ?>>Imo</option>
                                                    <option value="Jigawa" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Jigawa' ? 'selected' : '' ?>>Jigawa</option>
                                                    <option value="Kaduna" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Kaduna' ? 'selected' : '' ?>>Kaduna</option>
                                                    <option value="Kano" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Kano' ? 'selected' : '' ?>>Kano</option>
                                                    <option value="Katsina" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Katsina' ? 'selected' : '' ?>>Katsina</option>
                                                    <option value="Kebbi" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Kebbi' ? 'selected' : '' ?>>Kebbi</option>
                                                    <option value="Kogi" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Kogi' ? 'selected' : '' ?>>Kogi</option>
                                                    <option value="Kwara" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Kwara' ? 'selected' : '' ?>>Kwara</option>
                                                    <option value="Lagos" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Lagos' ? 'selected' : '' ?>>Lagos</option>
                                                    <option value="Nasarawa" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Nasarawa' ? 'selected' : '' ?>>Nasarawa</option>
                                                    <option value="Niger" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Niger' ? 'selected' : '' ?>>Niger</option>
                                                    <option value="Ogun" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Ogun' ? 'selected' : '' ?>>Ogun</option>
                                                    <option value="Ondo" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Ondo' ? 'selected' : '' ?>>Ondo</option>
                                                    <option value="Osun" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Osun' ? 'selected' : '' ?>>Osun</option>
                                                    <option value="Oyo" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Oyo' ? 'selected' : '' ?>>Oyo</option>
                                                    <option value="Plateau" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Plateau' ? 'selected' : '' ?>>Plateau</option>
                                                    <option value="Rivers" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Rivers' ? 'selected' : '' ?>>Rivers</option>
                                                    <option value="Sokoto" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Sokoto' ? 'selected' : '' ?>>Sokoto</option>
                                                    <option value="Taraba" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Taraba' ? 'selected' : '' ?>>Taraba</option>
                                                    <option value="Yobe" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Yobe' ? 'selected' : '' ?>>Yobe</option>
                                                    <option value="Zamfara" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Zamfara' ? 'selected' : '' ?>>Zamfara</option>
                                                    <option value="Non-Nigerian" <?= ($applicant_bio_data['state_origin'] ?? '') === 'Non-Nigerian' ? 'selected' : '' ?>>Non-Nigerian</option>
                                                </select>
                                                <div class="invalid-feedback">Please select your state of origin.</div>
                                            </div>

                                        </div>

                                        <input type="hidden" name="action" value="<?php echo $utility->inputEncode('FORM_submit_biodata') ?>">
                                        <hr>
                                        <!-- Submit -->
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-outline-success">Save Bio-Data</button>
                                        </div>
                                    </form>


                                    <!-- Application Form END -->
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