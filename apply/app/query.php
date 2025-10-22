<?php
if (file_exists('../../controller/start.inc.php')) {
    include '../../controller/start.inc.php';
} elseif (file_exists('../controller/start.inc.php')) {
    include '../controller/start.inc.php';
} else {
    include './controller/start.inc.php';
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/./vendor/autoload.php';;


if (
    !empty($_SESSION['applicant_id']) || isset($_SESSION['applicant_id'])
    || !empty($_SESSION['applicant_name']) || isset($_SESSION['applicant_name'])
    || !empty($_SESSION['applicant_email']) || isset($_SESSION['applicant_email'])
) {

    $applicantId = $_SESSION['applicant_id'] ?? null;
    // Fetch applicant details
    if ($applicantId) {
        $applicant = $model->getRows("applicants", [
            "where" => ["email" => $_SESSION['applicant_email']],
            "return_type" => "single"
        ]);
    }

    //Fetch Applicant Biodata

    $applicantId = $_SESSION['applicant_id'] ?? null;
    $applicant_bio_data = [];
    if ($applicantId) {
        $bio = $model->getRows("applicant_biodata", [
            "where" => ["bio_applicant_id" => intval($applicantId)],
            "return_type" => "single"
        ]);

        if (!empty($bio)) {
            $applicant_bio_data = $bio; // assign first row
        }
    }
    //Fetch Applicant Contact Data
    $applicant_contact_data = [];
    if ($applicantId) {

        $contact = $model->getRows("applicant_contact", [
            "where" => ["contact_applicant_id" => intval($applicantId)],
            "return_type" => "single"
        ]);

        if (!empty($contact)) {
            $applicant_contact_data = $contact; // assign first row
        }
    }
    //fetch applicant education history
    $ssce_records = [];
    if ($applicantId) {
        $ssce_records = $model->getRows("applicant_exam", [
            "where" => ["exam_applicant_id" => $applicantId],
            "order_by" => "sitting_number ASC"
        ]);

        // attach subjects per sitting
        foreach ($ssce_records as &$rec) {
            $rec['subjects'] = $model->getRows("applicant_ssce_subjects", [
                "where" => ["grade_exam_id" => $rec['exam_id']]
            ]);
        }
    }
    // Load already uploaded documents
    $uploadedDocs = [];
    if ($applicantId) {
        $docs = $model->getRows("applicant_documents", [
             "where" => ["doc_applicant_id" => $applicantId],
        ]);
        foreach ($docs as $doc) {
            $uploadedDocs[$doc['doc_type']] = $doc['file_path'];
        }
    }
    // Number of sittings saved
    $num_sitting = count($ssce_records) > 0 ? count($ssce_records) : 1;
    //fetch applicant programme details
    if ($applicantId) {
        $programme = $model->getById("programme_details", "prog_applicant_id", $applicantId);
    }

    //dashboard data

    // Assume applicantId is stored in session after login

    // Fetch applicant progress
    if ($applicantId) {
        $progress = $model->getById("applicant_progress", "prog_applicant_id", $applicantId);

        if ($progress) {
            // Count total completed tasks
            $completed = $progress['admission_payment'] +
                $progress['bio_data'] +
                $progress['contact_details'] +
                $progress['education_history'] +
                $progress['programme_details'] +
                $progress['supporting_docs'];

            $total = 6;
            $percent = intval(($completed / $total) * 100);
        } else {
            $progress = [
                'admission_payment' => 0,
                'bio_data' => 0,
                'contact_details' => 0,
                'education_history' => 0,
                'programme_details' => 0,
                'supporting_docs' => 0,
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $completed = 0;
            $percent = 0;
            $total = 6;
        }
    }

    //Get Payment Status
    if ($applicantId) {
        $paymentMade = !empty($progress['admission_payment']) && $progress['admission_payment'] == 1;
    }
    //Fetch Transaction History
    if ($applicantId) {
        $transactionHistory = $model->getRows("applicants_transactions", [
            "where" => ["trans_applicant_id" => $applicantId]
        ]);
    }
}
