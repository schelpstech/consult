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


// Applicant info
$applicantId = $_SESSION['applicant_id'];
$email = $_SESSION['applicant_email'];
$amount = 20300; // ₦20,300
$callbackUrl = "http://localhost/atiba/app/applicant/verifypayment.php";

// Generate unique reference
$reference = strtoupper($utility->generateRandomString(8));

// Insert into applicants_transactions as pending
$model->insert("applicants_transactions", [
    "trans_applicant_id" => $applicantId,
    "reference" => $reference,
    "amount" => $amount,
    "currency" => "NGN",
    "status" => "pending",
    "payment_method" => "paystack"
]);

// Initialize Paystack
$response = $paystack->initializePayment($email, $amount * 100, $callbackUrl, $reference);

// Redirect applicant to Paystack payment page
header("Location: " . $response['data']['authorization_url']);
exit;
