<?php
require "../query.php";

// 1. Get raw POST body
$input = @file_get_contents("php://input");
$event = json_decode($input, true);

// 2. Verify signature (important for security!)
$signature = $_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] ?? '';
$secretKey = "sk_test_5cfd6d4ebaaa28e178ca697148bbee69e9d86e65"; // Your secret key

if ($signature !== hash_hmac('sha512', $input, $secretKey)) {
    http_response_code(401);
    exit("Invalid signature");
}

// 3. Handle event
if ($event && isset($event['event'])) {
    $reference = $event['data']['reference'] ?? null;

    switch ($event['event']) {
        case 'charge.success':
            // Payment successful
            $model->update("applicants_transactions", 
                ["status" => "success"], 
                ["reference" => $reference]
            );
            break;

        case 'charge.failed':
        case 'payment.failed':
            // Payment failed
            $model->update("applicants_transactions", 
                ["status" => "failed"], 
                ["reference" => $reference]
            );
            break;

        default:
            // For debugging / logging other events
            file_put_contents("paystack_webhook.log", $input.PHP_EOL, FILE_APPEND);
            break;
    }
}

// 4. Respond OK to Paystack
http_response_code(200);
echo "OK";
