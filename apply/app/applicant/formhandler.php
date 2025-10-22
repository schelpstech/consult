<?php
require "../query.php"; // starts session + loads $model

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['action']) && $utility->inputDecode($_POST['action']) == 'FORM_submit_biodata') {

        try {
            $applicantId = $_SESSION['applicant_id'] ?? null;
            if (!$applicantId) {
                $utility->setFlash("danger", "Applicant session expired. Please log in again.");
                header("Location: ../../signin.php");
                exit;
            }

            // Collect sanitized input
            $firstname      = trim($_POST['firstname']);
            $middlename     = trim($_POST['middlename'] ?? '');
            $lastname       = trim($_POST['lastname']);
            $gender         = trim($_POST['gender']);
            $dob            = trim($_POST['dob']);
            $religion       = trim($_POST['religion']);
            $marital_status = trim($_POST['marital_status']);
            $hometown       = trim($_POST['hometown']);
            $nationality    = trim($_POST['nationality']);
            $state_origin   = trim($_POST['state_origin']);

            // ✅ Check if biodata already exists for applicant
            $exists = $model->exists("applicant_biodata", "bio_applicant_id = " . $applicantId);

            if ($exists) {
                // Update record
                $model->update("applicant_biodata", [
                    "firstname"      => $firstname,
                    "middlename"     => $middlename,
                    "lastname"       => $lastname,
                    "gender"         => $gender,
                    "dob"            => $dob,
                    "religion"       => $religion,
                    "marital_status" => $marital_status,
                    "hometown"       => $hometown,
                    "nationality"    => $nationality,
                    "state_origin"   => $state_origin,
                ], "bio_applicant_id = " . $applicantId);
            } else {
                // Insert new record
                $model->insert("applicant_biodata", [
                    "bio_applicant_id"   => $applicantId,
                    "firstname"      => $firstname,
                    "middlename"     => $middlename,
                    "lastname"       => $lastname,
                    "gender"         => $gender,
                    "dob"            => $dob,
                    "religion"       => $religion,
                    "marital_status" => $marital_status,
                    "hometown"       => $hometown,
                    "nationality"    => $nationality,
                    "state_origin"   => $state_origin,
                ]);
            }

            // ✅ Update progress
            $model->update("applicant_progress", [
                "bio_data" => 1
            ], "prog_applicant_id = " . $applicantId);

            $utility->setFlash("success", "✅ Bio-Data saved successfully!");
            header("Location: ../../applicant/dashboard.php");
            exit;
        } catch (Exception $e) {
            $utility->setFlash("danger", "Error: " . $e->getMessage());
            header("Location: ../../applicant/biodataform.php");
            exit;
        }
    } elseif (!empty($_POST['action']) && $utility->inputDecode($_POST['action']) == 'FORM_submit_contact') {

        try {
            $applicantId = $_SESSION['applicant_id'] ?? null;
            if (!$applicantId) {
                $utility->setFlash("danger", "Applicant session expired. Please log in again.");
                header("Location: ../../signin.php");
                exit;
            }

            // Collect sanitized input
            $address        = trim($_POST['address']);
            $city          = trim($_POST['city']);
            $country_residence = trim($_POST['country_residence']);
            $state_residence   = trim($_POST['state_residence']);

            // ✅ Check if biodata already exists for applicant
            $exists = $model->exists("applicant_contact", "contact_applicant_id = " . $applicantId);

            if ($exists) {
                // Update record
                $model->update("applicant_contact", [
                    "address"      => $address,
                    "city"     => $city,
                    "state"       => $state_residence,
                    "country"         => $country_residence
                ], "contact_applicant_id = " . $applicantId);
            } else {
                // Insert new record
                $model->insert("applicant_contact", [
                    "contact_applicant_id"   => $applicantId,
                    "address"      => $address,
                    "city"     => $city,
                    "state"       => $state_residence,
                    "country"         => $country_residence,
                ]);
            }

            // ✅ Update progress
            $model->update("applicant_progress", [
                "contact_details" => 1
            ], "prog_applicant_id = " . $applicantId);

            $utility->setFlash("success", "✅ Applicant Contact Data have been saved successfully!");
            header("Location: ../../applicant/dashboard.php");
            exit;
        } catch (Exception $e) {
            $utility->setFlash("danger", "Error: " . $e->getMessage());
            header("Location: ../../applicant/contactform.php");
            exit;
        }
    } elseif (!empty($_POST['action']) && $utility->inputDecode($_POST['action']) == 'FORM_submit_ssce') {
        try {
            $user_id = $_SESSION['applicant_id'] ?? null;
            if (!$user_id) {
                $utility->setFlash("danger", "Applicant session expired. Please log in again.");
                header("Location: ../../signin.php");
                exit;
            }

            $num_sitting = (int) ($_POST['num_sitting'] ?? 1);
            $allErrors = [];

            // 🔥 Delete old SSCE records for this applicant
            $oldRecords = $model->getRows("applicant_exam", ["where" => "exam_applicant_id = $user_id"]);
            if (!empty($oldRecords)) {
                foreach ($oldRecords as $rec) {
                    $model->delete("applicant_ssce_subjects", "grade_exam_id = " . $rec['exam_id']);
                }
                $model->delete("applicant_exam", "exam_applicant_id = $user_id");
            }

            for ($sitting = 1; $sitting <= $num_sitting; $sitting++) {
                $school      = trim($_POST['school_name'][$sitting] ?? '');
                $exam_year   = $_POST['exam_year'][$sitting] ?? null;
                $exam_body   = $_POST['exam_body'][$sitting] ?? '';
                $exam_type   = $_POST['exam_type'][$sitting] ?? '';
                $exam_number = trim($_POST['exam_number'][$sitting] ?? '');

                $sittingErrors = [];

                // Required fields for sitting
                if ($school === '') $sittingErrors[] = "School name for sitting $sitting is required.";
                if (!$exam_year)    $sittingErrors[] = "Exam year for sitting $sitting is required.";
                if ($exam_number === '') $sittingErrors[] = "Exam number for sitting $sitting is required.";

                // Subjects & grades
                $subjects = $_POST['subject'][$sitting] ?? [];
                $grades   = $_POST['grade'][$sitting] ?? [];

                foreach ($subjects as $i => $subj) {
                    $subj = trim($subj);
                    $grade = $grades[$i] ?? '';

                    // Skip completely empty rows
                    if ($subj === '' && $grade === '') continue;

                    // If either subject or grade is missing
                    if ($subj === '' || $grade === '') {
                        $sittingErrors[] = "Subject and grade #" . ($i + 1) . " for sitting $sitting are required.";
                    }
                }

                // If there are errors for this sitting, merge to allErrors
                if (!empty($sittingErrors)) {
                    $allErrors = array_merge($allErrors, $sittingErrors);
                    continue; // Skip inserting this sitting if validation fails
                }

                // ✅ Insert sitting
                $ssce_id = $model->insert("applicant_exam", [
                    "exam_applicant_id" => $user_id,
                    "sitting_number"    => $sitting,
                    "school_name"       => $school,
                    "exam_year"         => $exam_year,
                    "exam_body"         => $exam_body,
                    "exam_type"         => $exam_type,
                    "exam_number"       => $exam_number,
                    "created_at"        => date("Y-m-d H:i:s"),
                    "updated_at"        => date("Y-m-d H:i:s")
                ]);

                // Insert subjects
                foreach ($subjects as $i => $subj) {
                    $subj = trim($subj);
                    $grade = $grades[$i] ?? '';
                    if ($subj === '' && $grade === '') continue;

                    $model->insert("applicant_ssce_subjects", [
                        "grade_exam_id" => $ssce_id,
                        "subject_name"  => $subj,
                        "grade"         => $grade,
                        "created_at"    => date("Y-m-d H:i:s"),
                        "updated_at"    => date("Y-m-d H:i:s")
                    ]);
                }
            }

            // If there were validation errors, show them
            if (!empty($allErrors)) {
                $utility->setFlash("danger", implode("<br>", $allErrors));
                header("Location: ../../applicant/educationhistform.php");
                exit;
            }

            // ✅ Update progress
            $model->update("applicant_progress", [
                "education_history" => 1
            ], "prog_applicant_id = " . $user_id);

            $utility->setFlash("success", "✅ Applicant SSCE Records have been saved successfully!");
            header("Location: ../../applicant/dashboard.php");
            exit;
        } catch (Exception $e) {
            $utility->setFlash("danger", "Error: " . $e->getMessage());
            header("Location: ../../applicant/educationhistform.php");
            exit;
        }
    } elseif (!empty($_POST['action']) && $utility->inputDecode($_POST['action']) == 'FORM_submit_programme') {
        try {
            // Validate required fields
            $course_id   = intval($_POST['course_id'] ?? 0);
            $centre_id   = intval($_POST['centre_id'] ?? 0);
            $study_mode  = trim($_POST['study_mode'] ?? '');
            $entry_level = trim($_POST['entry_level'] ?? '');
            $programme_type = trim($_POST['programme_type'] ?? '');
            $academic_session = trim($_POST['academic_session'] ?? '');

            if (!$course_id || !$centre_id || empty($study_mode) || empty($entry_level) || empty($programme_type)) {
                throw new Exception("All fields are required.");
            }

            // Assume applicant_id is stored in session
            $applicant_id = $_SESSION['applicant_id'] ?? null;
            if (!$applicant_id) {
                $utility->setFlash("danger", "Applicant session expired. Please log in again.");
                header("Location: ../../signin.php");
                exit;
            }

            // Prepare data
            $data = [
                "prog_applicant_id"    => $applicant_id,
                "prog_course_id"       => $course_id,
                "prog_centre_id"       => $centre_id,
                "study_mode"      => $study_mode,
                "entry_mode"     => $entry_level,
                "programme_type"  => $programme_type,
                "academic_session" => $academic_session,
                "created_at"      => date("Y-m-d H:i:s"),
            ];

            // Insert or Update (if applicant already has programme details)
            $exists = $model->exists("programme_details", ["prog_applicant_id" => $applicant_id]);

            if ($exists) {
                $model->update("programme_details", $data, ["prog_applicant_id" => $applicant_id]);
                $msg = "✅ Programme details updated successfully.";
            } else {
                $model->insert("programme_details", $data);
                $msg = "✅ Programme details saved successfully.";
            }


            // ✅ Update progress
            $model->update("applicant_progress", [
                "programme_details" => 1
            ], "prog_applicant_id = " . $applicant_id);

            $utility->setFlash("success", $msg);
            header("Location: ../../applicant/dashboard.php");
            exit;
        } catch (Exception $e) {
            $utility->setFlash("danger", "Error: " . $e->getMessage());
            header("Location: ../../applicant/programmedetails.php");
            exit;
        }
    } elseif (!empty($_POST['action']) && $utility->inputDecode($_POST['action']) == 'FORM_submit_docs') {

        try {
            $applicant_id = $_SESSION['applicant_id'] ?? null;
            if (!$applicant_id) throw new Exception("User not logged in.");

            // Per-applicant folder for uploads (relative to project root)
            $baseUploadDir = __DIR__ . "/../../applicant/storage/{$applicant_id}";
            if (!is_dir($baseUploadDir)) {
                if (!mkdir($baseUploadDir, 0755, true)) {
                    throw new Exception("Failed to create upload directory.");
                }
            }

            // Document definitions
            $documents = [
                "passport_photo"    => ["allowed" => ["image/jpeg", "image/jpg", "image/png"], "max" => 100 * 1024], // 100KB
                "olevel_result"     => ["allowed" => ["application/pdf"], "max" => 200 * 1024], // 200KB
                "birth_certificate" => ["allowed" => ["application/pdf"], "max" => 200 * 1024], // 200KB
                "identity_card"     => ["allowed" => ["application/pdf"], "max" => 200 * 1024], // 200KB
            ];


            $allErrors = [];

            foreach ($documents as $inputName => $rules) {
                // Basic presence check
                if (!isset($_FILES[$inputName]) || $_FILES[$inputName]['error'] === UPLOAD_ERR_NO_FILE) {
                    $allErrors[] = ucfirst(str_replace("_", " ", $inputName)) . " is required.";
                    continue;
                }

                // Call the new robust upload helper (returns array)
                $result = $utility->handleUploadedFile(
                    $inputName,
                    $rules['allowed'],
                    $rules['max'],
                    $baseUploadDir
                );

                // Handle possible result shapes (old string-style vs new array)
                $fileName = null;
                if (is_array($result)) {
                    if (($result['status'] ?? '') === 'success') {
                        $fileName = $result['filename'];
                    } elseif (($result['status'] ?? '') === 'empty') {
                        $allErrors[] = ucfirst(str_replace("_", " ", $inputName)) . " is required.";
                        continue;
                    } else {
                        $allErrors[] = ucfirst(str_replace("_", " ", $inputName)) . ": " . ($result['message'] ?? 'Upload error');
                        continue;
                    }
                } else {
                    // backward compatibility: if helper returned a string 'success' and set $_SESSION['fileName'
                    if ($result === 'success' && !empty($_SESSION['fileName'])) {
                        $fileName = $_SESSION['fileName'];
                        unset($_SESSION['fileName']);
                    } else {
                        $allErrors[] = ucfirst(str_replace("_", " ", $inputName)) . ": " . (is_string($result) ? $result : 'Upload failed');
                        continue;
                    }
                }

                if (!$fileName) {
                    $allErrors[] = ucfirst(str_replace("_", " ", $inputName)) . ": Could not determine uploaded filename.";
                    continue;
                }

                // Build relative path to store in DB (so it's portable)
                $relativePath = "applicant/storage/{$applicant_id}/" . $fileName;
                $fullPath = rtrim($baseUploadDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fileName;

                // If an existing document exists, remove old file and update row; otherwise insert
                $existing = $model->getRows("applicant_documents", [
                    "where" =>  [
                        "doc_applicant_id" => $applicant_id,
                        "doc_type" => $inputName
                    ],
                    "limit" => 1
                ]);

                if (!empty($existing)) {
                    $old = $existing[0];
                    // attempt to delete old file if it exists
                    if (!empty($old['file_path'])) {
                        $oldFull = __DIR__ . "/../../" . ltrim($old['file_path'], "/");
                        if (file_exists($oldFull)) {
                            @unlink($oldFull);
                        }
                    }
                    // update record
                    $model->update("applicant_documents", [
                        "file_path"   => $relativePath,
                        "uploaded_at" => date("Y-m-d H:i:s")
                    ], "doc_applicant_id = {$applicant_id} AND doc_type = '{$inputName}'");
                } else {
                    // insert new record
                    $model->insert("applicant_documents", [
                        "doc_applicant_id" => $applicant_id,
                        "doc_type"         => $inputName,
                        "file_path"        => $relativePath,
                        "uploaded_at"      => date("Y-m-d H:i:s")
                    ]);
                }
            }

            if (!empty($allErrors)) {
                $utility->setFlash("danger", implode("<br>", $allErrors));
            } else {
                // Mark progress (create row if needed)
                $model->update("applicant_progress", [
                    "supporting_docs" => 1
                ], "prog_applicant_id = " . $applicant_id);

                $utility->setFlash("success", "✅ Documents uploaded successfully!");
            }

            header("Location: ../../applicant/dashboard.php");
            exit;
        } catch (Exception $e) {
            error_log("FORM_submit_docs error: " . $e->getMessage());
            $utility->setFlash("danger", "Error: " . $e->getMessage());
            header("Location: ../../applicant/dashboard.php");
            exit;
        }
    } else {
        $utility->setFlash("danger", "Error: Invalid Action ");
        header("Location: ../../applicant/dashboard.php");
        exit;
    }
} else {
    $utility->setFlash("danger", "Error: Invalid permission ");
    header("Location: ../../applicant/dashboard.php");
    exit;
}
