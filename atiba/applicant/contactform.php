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

                                    <h3 class="text-center mb-4">Applicant Contact Form</h3>
                                    <hr>
                                    <form id="contactForm" action="../app/applicant/formhandler.php" method="POST" novalidate autocomplete="off">
                                        <div class="row">
                                            <!-- Address -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Address *</label>
                                                <input type="text" name="address" id="address"
                                                    value="<?= htmlspecialchars($applicant_contact_data['address'] ?? '') ?>"
                                                    class="form-control border-0 bg-light rounded ps-3" required>
                                                <div class="invalid-feedback">Please enter your address.</div>
                                            </div>

                                            <!-- City -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">City *</label>
                                                <input type="text" name="city" id="city"
                                                    value="<?= htmlspecialchars($applicant_contact_data['city'] ?? '') ?>"
                                                    class="form-control border-0 bg-light rounded ps-3" required>
                                                <div class="invalid-feedback">Please enter your city.</div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <!-- Country of Residence -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Country of Residence *</label>
                                                <select class="form-control border-0 bg-light rounded ps-3" id="country_residence" name="country_residence" required>
                                                    <option value="">-- Select Country --</option>
                                                    <option value="Nigeria" <?= ($applicant_contact_data['country'] ?? '') === 'Nigeria' ? 'selected' : '' ?>>Nigeria</option>
                                                    <option value="Non-Nigerian" <?= ($applicant_contact_data['country'] ?? '') === 'Non-Nigerian' ? 'selected' : '' ?>>Outside Nigeria</option>
                                                </select>
                                                <div class="invalid-feedback">Please select your country of residence.</div>
                                            </div>

                                            <!-- State of Residence -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">State of Residence *</label>
                                                <select class="form-control border-0 bg-light rounded ps-3" id="state_residence" name="state_residence" required>
                                                    <option value="">-- Select State --</option>
                                                    <?php
                                                    $states = ["Abia", "Adamawa", "Akwa Ibom", "Anambra", "Bauchi", "Bayelsa", "Benue", "Borno", "Cross River", "Delta", "Ebonyi", "Edo", "Ekiti", "Enugu", "FCT", "Gombe", "Imo", "Jigawa", "Kaduna", "Kano", "Katsina", "Kebbi", "Kogi", "Kwara", "Lagos", "Nasarawa", "Niger", "Ogun", "Ondo", "Osun", "Oyo", "Plateau", "Rivers", "Sokoto", "Taraba", "Yobe", "Zamfara", "Non-Nigerian"];
                                                    foreach ($states as $state): ?>
                                                        <option value="<?= $state ?>" <?= ($applicant_contact_data['state'] ?? '') === $state ? 'selected' : '' ?>><?= $state ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">Please select your state of residence.</div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="action" value="<?php echo $utility->inputEncode('FORM_submit_contact') ?>">
                                        <hr>

                                        <!-- Submit -->
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-outline-warning">Save Contact Info</button>
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