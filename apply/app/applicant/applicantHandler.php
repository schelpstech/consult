<?php
require "../query.php"; // starts session + loads $model

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['action']) && $utility->inputDecode($_POST['action']) == 'submit_new_application') {
        // Proceed with form processing
        $firstname = trim($_POST['firstname']);
        $lastname  = trim($_POST['lastname']);
        $email     = trim($_POST['email']);
        $phone     = trim($_POST['phone']);
        $password  = $_POST['password'];

        // Check if email already exists
        if ($model->exists("applicants", ["email" => $email])) {
            $utility->setFlash("danger", "❌ Email already registered.");
            header("Location: ../../signup.php");
            exit;
        }

        // Generate verification token
        $token = bin2hex(random_bytes(32));

        // Insert applicant
        $insertId = $model->insert("applicants", [
            "firstname" => $firstname,
            "lastname"  => $lastname,
            "email"     => $email,
            "phone"     => $phone,
            "password"  => password_hash($password, PASSWORD_DEFAULT),
            "verification_token" => $token
        ]);

        if ($insertId) {
            // Send verification email

            $verifyLink = "http://localhost/app/applicant/verify.php?token=$token";

            $sendLink = $mailer->sendTemplate(
                $email,
                "Verify your Atiba ODL account",
                __DIR__ . "/../mail_templates/verification_email.html",
                [
                    "name" => $firstname,
                    "link" => $verifyLink
                ]
            );
            if ($sendLink) {
                $utility->setFlash("success", "✅ Registration successful. Please check your email to verify your account.");
                header("Location: ../../signin.php");
                exit;
            } else {
                $utility->setFlash("danger", "❌ Could not send verification email. Contact support.");
                header("Location: ../../signup.php");
                exit;
            }
        } else {
            $utility->setFlash("danger", "❌ Something went wrong. Try again.");
            header("Location: ../../signup.php");
            exit;
        }

        //Resend Verification Code
    } elseif (!empty($_POST['action']) && $utility->inputDecode($_POST['action']) == 'send_me_another_verification_code') {
        // Proceed with form processing
        $email     = trim($_POST['email']);

        // Check if email already exists
        if ($model->exists("applicants", ["email" => $email])) {

            // Generate verification token
            $token = bin2hex(random_bytes(32));

            // Fetch applicant details
            $applicant = $model->getRows("applicants", [
                "where" => [
                    "email" => $email,
                    "is_verified" => 0
                ],
                "return_type" => "single"
            ]);

            if (!$applicant) {
                $utility->setFlash("danger", "❌ This account is already verified. Please log in.");
                header("Location: ../../signin.php");
                exit;
            }
            // Set new token for applicant
            $UpdateCode = $model->update(
                "applicants",
                ["verification_token" => $token],
                ["email" => $email, "is_verified" => 0]
            );

            if ($UpdateCode) {
                // Send verification email
                $verifyLink = "http://localhost/atiba/app/applicant/verify.php?token=$token";
                $sendLink = $mailer->sendTemplate(
                    $email,
                    "Verify your Atiba ODL account",
                    __DIR__ . "/../mail_templates/verification_email.html",
                    [
                        "name" => $applicant["firstname"],
                        "link" => $verifyLink
                    ]
                );
                if ($sendLink) {
                    $utility->setFlash("success", "✅ Verification email sent successfully. Please check your email to verify your account.");
                    header("Location: ../../signin.php");
                    exit;
                } else {
                    $utility->setFlash("danger", "❌ Could not resend verification email. Contact support.");
                    header("Location: ../../resendverification.php");
                    exit;
                }
            } else {
                $utility->setFlash("danger", "❌ Server is unable to proceed with your request.");
                header("Location: ../../resendverification.php");
                exit;
            }
        } else {
            $utility->setFlash("danger", "❌ Email not registered with any account on our system.");
            header("Location: ../../resendverification.php");
            exit;
        }
    }
    //Login Applicant
    elseif (!empty($_POST['action']) && $utility->inputDecode($_POST['action']) == 'sign_me_in_form') {
        // Proceed with form processing
        $email     = trim($_POST['email']);
        $password  = $_POST['password'];

        // Check if email already exists
        if ($model->exists("applicants", ["email" => $email])) {


            // Fetch applicant details
            $applicant = $model->getRows("applicants", [
                "where" => ["email" => $email],
                "return_type" => "single"
            ]);

            if ($applicant) {
                // Verify password
                if (password_verify($password, $applicant["password"])) {
                    // Successful login
                    $_SESSION["applicant_id"] = $applicant["applicant_id"];
                    $_SESSION['applicant_name'] = $applicant['firstname'];
                    $_SESSION['applicant_email'] = $applicant['email'];
                    $utility->setFlash("success", "✅ Login successful.");
                    header("Location: ../../applicant/dashboard.php");
                    exit;
                } else {
                    $utility->setFlash("danger", "❌ Invalid Login Credentials.");
                    header("Location: ../../signin.php");
                    exit;
                }
            } else {
                $utility->setFlash("danger", "❌ Invalid Login Credentials.");
                header("Location: ../../signin.php");
                exit;
            }
        } else {
            $utility->setFlash("danger", "❌ Invalid Login Credentials.");
            header("Location: ../../signin.php");
            exit;
        }
    } elseif (!empty($_POST['action']) && $utility->inputDecode($_POST['action']) == 'FORM_submit_sign_me_out') {
        $logout = $user->logout();
        if ($logout) {
            $utility->setFlash("success", "You have been logged out successfully.");
            // Redirect to login
            header("Location: ../../signin.php");
            exit;
        } else {
            $_SESSION = [];

            if (session_id() !== "" || isset($_COOKIE[session_name()])) {
                setcookie(session_name(), '', time() - 42000, '/');
            }
            session_destroy();
            // Redirect to login
            header("Location: ../../signin.php");
            exit;
        }
    } else {
        $utility->setFlash("danger", "❌ Invalid form submission.");
        header("Location: ../../signup.php");
        exit;
    }
} else {
    $utility->setFlash("danger", "❌ Not a valid request.");
    header("Location: ../../signup.php");
    exit;
}
