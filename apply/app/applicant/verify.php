<?php
require "../query.php"; 

if (isset($_GET['token'])) {
    $token = htmlspecialchars($_GET['token']);

    try {
        $verified = $user->verifyAccount($token);

        if ($verified) {
            $utility->setFlash("success", "Your email has been successfully verified! You can now log in.");
            header("Location: ../../signin.php");
            exit;
        } else {
            $utility->setFlash("danger", "Invalid or expired verification link.");
            header("Location: ../../resendVerification.php");
            exit;
        }

    } catch (Exception $e) {
        error_log("Verification error: " . $e->getMessage());
        $utility->setFlash("danger", "Something went wrong during verification.");
        header("Location: ../../signin.php");
        exit;
    }
} else {
    $utility->setFlash("danger", "Invalid request.");
    header("Location: ../../signin.php");
    exit;
}
