<?php
require "../query.php";


//Check if applicant is logged in
if (
    empty($_SESSION['applicant_id']) || !isset($_SESSION['applicant_id'])
    || empty($_SESSION['applicant_name']) || !isset($_SESSION['applicant_name'])
    || empty($_SESSION['applicant_email']) || !isset($_SESSION['applicant_email'])
) {
    $utility->setFlash("danger", "❌ Please log in to access the dashboard.");
    header("Location: ../signin.php");
    exit;
}

if (isset($_GET['reference'])) {
    $reference = $_GET['reference'];

    try {
        $verification = $paystack->verifyTransaction($reference);
        $status = $verification['data']['status']; // success | failed | abandoned

        if ($status === 'success') {
            $model->update(
                "applicants_transactions",
                ["status" => "success"],
                ["reference" => $reference]
            );

            // When a new applicant is created, initialize progress
            $model->insert("applicant_progress", [
                "prog_applicant_id"   => $_SESSION['applicant_id'],
                "admission_payment"   => 1,
                "bio_data"            => 0,
                "contact_details"     => 0,
                "education_history"   => 0,
                "programme_details"   => 0,
                "supporting_docs"     => 0
            ]);

            $utility->setFlash("success", "Payment Successful! You may now continue your application.");
            header("Location: ../../applicant/dashboard.php");
        } else {
            $model->update(
                "applicants_transactions",
                ["status" => "failed"],
                ["reference" => $reference]
            );
            $utility->setFlash("danger", "Payment Failed. Please try again.");
            header("Location: ../../applicant/dashboard.php");
        }
    } catch (Exception $e) {
        $utility->setFlash("danger", "Error verifying transaction: " . $e->getMessage());
        header("Location: ../../applicant/dashboard.php");
    }
} else {
    $utility->setFlash("danger", "Invalid payment verification request.");
    header("Location: ../../applicant/dashboard.php");
}
