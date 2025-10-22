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
                                <div class="col-sm-10 col-xl-10 m-auto">

                                    <h3 class="text-center mb-4">Applicant Bio-Data Form</h3>
                                    <hr>

                                    <div class="container my-4">
                                        <!-- Biodata -->
                                        <div class="card mb-3">
                                            <div class="card-header bg-success text-white">Biodata</div>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>First Name</th>
                                                        <td><?= htmlspecialchars($applicant_bio_data['firstname'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Middle Name</th>
                                                        <td><?= htmlspecialchars($applicant_bio_data['middlename'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Last Name</th>
                                                        <td><?= htmlspecialchars($applicant_bio_data['lastname'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Gender</th>
                                                        <td><?= htmlspecialchars($applicant_bio_data['gender'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Date of Birth</th>
                                                        <td><?= htmlspecialchars($applicant_bio_data['dob'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Religion</th>
                                                        <td><?= htmlspecialchars($applicant_bio_data['religion'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Marital Status</th>
                                                        <td><?= htmlspecialchars($applicant_bio_data['marital_status'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Hometown</th>
                                                        <td><?= htmlspecialchars($applicant_bio_data['hometown'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nationality</th>
                                                        <td><?= htmlspecialchars($applicant_bio_data['nationality'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>State of Origin</th>
                                                        <td><?= htmlspecialchars($applicant_bio_data['state_origin'] ?? '-') ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Contact -->
                                        <div class="card mb-3">
                                            <div class="card-header bg-success text-white">Contact Information</div>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Email</th>
                                                        <td><?= htmlspecialchars($applicant_contact_data['email'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Phone</th>
                                                        <td><?= htmlspecialchars($applicant_contact_data['phone'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address</th>
                                                        <td><?= htmlspecialchars($applicant_contact_data['address'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>City</th>
                                                        <td><?= htmlspecialchars($applicant_contact_data['city'] ?? '-') ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Program -->
                                        <div class="card mb-3">
                                            <div class="card-header bg-success text-white">Programme Details</div>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Course</th>
                                                        <td><?php $course = $model->getRows("courses", [
                                                                "where" => "course_id = " . $programme['prog_course_id'],
                                                                "return_type" => "single"
                                                            ]);

                                                            echo  htmlspecialchars($course['course_name'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Preferred Study Centre</th>
                                                        <td><?php $centre = $model->getRows("study_centre", [
                                                                "where" => "centre_id = " . $programme['prog_centre_id'],
                                                                "return_type" => "single"
                                                            ]);

                                                            echo  htmlspecialchars($centre['centre_name'] ?? '-') ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Mode of Study</th>
                                                        <td><?= htmlspecialchars($programme['study_mode'] ?? '-') ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Education -->
                                        <div class="card mb-3">
                                            <div class="card-header bg-success text-white">Educational Background</div>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>School Name</th>
                                                        <td><?= htmlspecialchars($ssce_records['school_name'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Qualification</th>
                                                        <td><?= htmlspecialchars($ssce_records['qualification'] ?? '-') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Year of Graduation</th>
                                                        <td><?= htmlspecialchars($ssce_records['graduation_year'] ?? '-') ?></td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <!-- Sitting 1 -->
                                            <div id="sitting1" class="sitting-form border p-3 rounded mb-4">
                                                <div id="sitting1" class="sitting-block">
                                                    <h5 class="mt-3">Sitting 1</h5>
                                                    <div class="row mb-3">
                                                        <div class="col-md-8">
                                                            <label>Secondary School Name</label>
                                                            <input type="text" name="school_name[1]" class="form-control"
                                                                value="<?= htmlspecialchars($ssce_records[0]['school_name'] ?? '') ?>">
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label>Exam Number</label>
                                                            <input type="text" name="exam_number[1]" class="form-control"
                                                                value="<?= htmlspecialchars($ssce_records[0]['exam_number'] ?? '') ?>">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <label>Examination Body</label>
                                                            <select name="exam_body[1]" class="form-control">
                                                                <option value="">-- Select --</option>
                                                                <option value="WAEC" <?= (isset($ssce_records[0]['exam_body']) && $ssce_records[0]['exam_body'] == "WAEC") ? "selected" : "" ?>>WAEC</option>
                                                                <option value="NECO" <?= (isset($ssce_records[0]['exam_body']) && $ssce_records[0]['exam_body'] == "NECO") ? "selected" : "" ?>>NECO</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Examination Type</label>
                                                            <select name="exam_type[1]" class="form-control">
                                                                <option value="">-- Select --</option>
                                                                <option value="School" <?= (isset($ssce_records[0]['exam_type']) && $ssce_records[0]['exam_type'] == "School") ? "selected" : "" ?>>School</option>
                                                                <option value="Private" <?= (isset($ssce_records[0]['exam_type']) && $ssce_records[0]['exam_type'] == "Private") ? "selected" : "" ?>>Private</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Examination Year</label>
                                                            <input type="number" name="exam_year[1]" class="form-control" min="1980" max="2099"
                                                                value="<?= htmlspecialchars($ssce_records[0]['exam_year'] ?? '') ?>">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <h6>Subjects & Grades</h6>
                                                    <?php
                                                    $grades = ["A1", "B2", "B3", "C4", "C5", "C6", "D7", "E8", "F9", "A/R", "N/A"];
                                                    for ($i = 0; $i < 9; $i++):
                                                        $subjVal = $ssce_records[0]['subjects'][$i]['subject_name'] ?? '';
                                                        $gradeVal = $ssce_records[0]['subjects'][$i]['grade'] ?? '';
                                                    ?>
                                                        <div class="row mb-2">
                                                            <div class="col-md-8">
                                                                <select name="subject[1][]" class="form-control">
                                                                    <option value="">-- Select Subject --</option>
                                                                    <?php
                                                                    $subjects = [
                                                                        "AGRICULTURAL SCIENCE",
                                                                        "ANIMAL HUSBANDRY",
                                                                        "ARABIC",
                                                                        "BIOLOGY",
                                                                        "BOOK KEEPING",
                                                                        "BUSINESS MANAGEMENT",
                                                                        "CHEMISTRY",
                                                                        "CHRISTIAN RELIGIOUS STUDIES",
                                                                        "CIVIC EDUCATION",
                                                                        "COMMERCE",
                                                                        "COMPUTER STUDIES",
                                                                        "DATA PROCESSING",
                                                                        "ECONOMICS",
                                                                        "ENGLISH LANGUAGE",
                                                                        "FINANCIAL ACCOUNTING",
                                                                        "FISHERIES",
                                                                        "FRENCH",
                                                                        "FURTHER MATHEMATICS",
                                                                        "GENERAL MATHEMATICS",
                                                                        "GEOGRAPHY",
                                                                        "GOVERNMENT",
                                                                        "HAUSA LANGUAGE",
                                                                        "HEALTH SCIENCE/EDUCATION",
                                                                        "HISTORY",
                                                                        "IGBO LANGUAGE",
                                                                        "INSURANCE",
                                                                        "ISLAMIC STUDIES",
                                                                        "LITERATURE IN ENGLISH",
                                                                        "MARKETING",
                                                                        "OFFICE PRACTICE",
                                                                        "PHYSICS",
                                                                        "STORE MANAGEMENT",
                                                                        "TOURISM",
                                                                        "YORUBA LANGUAGE"
                                                                    ];
                                                                    foreach ($subjects as $s):
                                                                    ?>
                                                                        <option value="<?= $s ?>" <?= ($subjVal === $s ? 'selected' : '') ?>>
                                                                            <?= $s ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <select name="grade[1][]" class="form-control">
                                                                    <option value="">-- Grade --</option>
                                                                    <?php foreach ($grades as $g): ?>
                                                                        <option value="<?= $g ?>" <?= $gradeVal === $g ? 'selected' : '' ?>><?= $g ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php endfor; ?>
                                                </div>

                                            </div>

                                            <!-- Sitting 2 (hidden unless selected) -->
                                            <div id="sitting2" class="sitting-form border p-3 rounded mb-4" style="display:none;">
                                                <h4>Sitting 2</h4>
                                                <!-- same structure as sitting 1 but with [2] as index -->
                                                <div class="row mb-3">
                                                    <div class="col-md-8">
                                                        <label>Secondary School Name</label>
                                                        <input type="text" name="school_name[2]" class="form-control"
                                                            value="<?= htmlspecialchars($ssce_records[1]['school_name'] ?? '') ?>">
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>Exam Number</label>
                                                        <input type="text" name="exam_number[2]" class="form-control"
                                                            value="<?= htmlspecialchars($ssce_records[1]['exam_number'] ?? '') ?>">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <label>Examination Body</label>
                                                        <select name="exam_body[2]" class="form-control">
                                                            <option value="">-- Select --</option>
                                                            <option value="WAEC" <?= (isset($ssce_records[1]['exam_body']) && $ssce_records[1]['exam_body'] == "WAEC") ? "selected" : "" ?>>WAEC</option>
                                                            <option value="NECO" <?= (isset($ssce_records[1]['exam_body']) && $ssce_records[1]['exam_body'] == "NECO") ? "selected" : "" ?>>NECO</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Examination Type</label>
                                                        <select name="exam_type[2]" class="form-control">
                                                            <option value="">-- Select --</option>
                                                            <option value="School" <?= (isset($ssce_records[1]['exam_type']) && $ssce_records[1]['exam_type'] == "School") ? "selected" : "" ?>>School</option>
                                                            <option value="Private" <?= (isset($ssce_records[1]['exam_type']) && $ssce_records[1]['exam_type'] == "Private") ? "selected" : "" ?>>Private</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Examination Year</label>
                                                        <input type="number" name="exam_year[2]" class="form-control" min="1980" max="2099"
                                                            value="<?= htmlspecialchars($ssce_records[1]['exam_year'] ?? '') ?>">
                                                    </div>
                                                </div>
                                                <hr>
                                                <h6>Subjects & Grades</h6>
                                                <?php
                                                $grades = ["A1", "B2", "B3", "C4", "C5", "C6", "D7", "E8", "F9", "A/R", "N/A"];
                                                for ($i = 0; $i < 9; $i++):
                                                    $subjVal = $ssce_records[1]['subjects'][$i]['subject_name'] ?? '';
                                                    $gradeVal = $ssce_records[1]['subjects'][$i]['grade'] ?? '';
                                                ?>
                                                    <div class="row mb-2">
                                                        <div class="col-md-8">
                                                            <div class="col-md-8">
                                                                <select name="subject[2][]" class="form-control">
                                                                    <option value="">-- Select Subject --</option>
                                                                    <?php
                                                                    $subjects = [
                                                                        "AGRICULTURAL SCIENCE",
                                                                        "ANIMAL HUSBANDRY",
                                                                        "ARABIC",
                                                                        "BIOLOGY",
                                                                        "BOOK KEEPING",
                                                                        "BUSINESS MANAGEMENT",
                                                                        "CHEMISTRY",
                                                                        "CHRISTIAN RELIGIOUS STUDIES",
                                                                        "CIVIC EDUCATION",
                                                                        "COMMERCE",
                                                                        "COMPUTER STUDIES",
                                                                        "DATA PROCESSING",
                                                                        "ECONOMICS",
                                                                        "ENGLISH LANGUAGE",
                                                                        "FINANCIAL ACCOUNTING",
                                                                        "FISHERIES",
                                                                        "FRENCH",
                                                                        "FURTHER MATHEMATICS",
                                                                        "GENERAL MATHEMATICS",
                                                                        "GEOGRAPHY",
                                                                        "GOVERNMENT",
                                                                        "HAUSA LANGUAGE",
                                                                        "HEALTH SCIENCE/EDUCATION",
                                                                        "HISTORY",
                                                                        "IGBO LANGUAGE",
                                                                        "INSURANCE",
                                                                        "ISLAMIC STUDIES",
                                                                        "LITERATURE IN ENGLISH",
                                                                        "MARKETING",
                                                                        "OFFICE PRACTICE",
                                                                        "PHYSICS",
                                                                        "STORE MANAGEMENT",
                                                                        "TOURISM",
                                                                        "YORUBA LANGUAGE"
                                                                    ];
                                                                    foreach ($subjects as $s):
                                                                    ?>
                                                                        <option value="<?= $s ?>" <?= ($subjVal === $s ? 'selected' : '') ?>>
                                                                            <?= $s ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-4">
                                                            <select name="grade[2][]" class="form-control">
                                                                <option value="">-- Grade --</option>
                                                                <?php foreach ($grades as $g): ?>
                                                                    <option value="<?= $g ?>" <?= $gradeVal === $g ? 'selected' : '' ?>><?= $g ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                <?php endfor; ?>
                                            </div>
                                        </div>

                                        <!-- Documents -->
                                        <div class="card mb-3">
                                            <div class="card-header bg-success text-white">Uploaded Documents</div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3 text-center">
                                                        <p><strong>Passport</strong></p>
                                                        <?php if (!empty($uploadedDocs['passport_photo'])): ?>
                                                            <img src="../<?= htmlspecialchars($uploadedDocs['passport_photo']) ?>" class="img-fluid rounded border" style="max-height:150px;">
                                                        <?php else: ?>
                                                            <p>No Passport Uploaded</p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-md-3 text-center">
                                                        <p><strong>O'Level Result</strong></p>
                                                        <?php if (!empty($uploadedDocs['olevel_result'])): ?>
                                                            <iframe src="../<?= htmlspecialchars($uploadedDocs['olevel_result']) ?>" width="100%" height="200"></iframe>
                                                        <?php else: ?>
                                                            <p>No O'Level Uploaded</p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-md-3 text-center">
                                                        <p><strong>Birth Certificate</strong></p>
                                                        <?php if (!empty($uploadedDocs['birth_certificate'])): ?>
                                                            <iframe src="../<?= htmlspecialchars($uploadedDocs['birth_certificate']) ?>" width="100%" height="200"></iframe>
                                                        <?php else: ?>
                                                            <p>No Birth Certificate Uploaded</p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-md-3 text-center">
                                                        <p><strong>Identity Card</strong></p>
                                                        <?php if (!empty($uploadedDocs['identity_card'])): ?>
                                                            <iframe src="../<?= htmlspecialchars($uploadedDocs['identity_card']) ?>" width="100%" height="200"></iframe>
                                                        <?php else: ?>
                                                            <p>No ID Uploaded</p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="d-flex justify-content-between mt-4">
                                            <a href="dashboard.php" class="btn btn-secondary">Back</a>
                                            <button type="submit" class="btn btn-success">Submit Application</button>
                                        </div>

                                    </div>


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