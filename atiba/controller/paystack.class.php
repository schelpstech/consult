<?php
class PaystackPayment
{
    private $secretKey;

    public function __construct()
    {
        $this->secretKey = 'sk_test_5cfd6d4ebaaa28e178ca697148bbee69e9d86e65'; // Replace with your Paystack secret key
    }

    public function initializePayment($email, $amount, $callbackUrl, $reference = null)
    {
        $url = "https://api.paystack.co/transaction/initialize";

        // Generate a unique reference if none is provided
        if (!$reference) {
            $reference = "TXN_" . uniqid() . time(); // Custom format
        }

        $data = [
            'email' => $email,
            'amount' => $amount,
            'callback_url' => $callbackUrl,
            'reference' => $reference
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$this->secretKey}",
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            throw new Exception("cURL Error: $error");
        }

        $decodedResponse = json_decode($response, true);

        if (!isset($decodedResponse['status']) || !$decodedResponse['status']) {
            throw new Exception("Paystack Initialization Failed: " . ($decodedResponse['message'] ?? 'Unknown error'));
        }

        return $decodedResponse;
    }

    public function verifyTransaction($reference)
    {
        $url = "https://api.paystack.co/transaction/verify/$reference";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$this->secretKey}"
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            throw new Exception("cURL Error: $error");
        }

        $decodedResponse = json_decode($response, true);

        if (!isset($decodedResponse['status']) || !$decodedResponse['status']) {
            throw new Exception("Paystack Verification Failed: " . ($decodedResponse['message'] ?? 'Unknown error'));
        }

        return $decodedResponse;
    }

    public function validatePaymentParameters($email, $amount, $callbackUrl)
    {
        if (!$email || !$amount || !$callbackUrl) {
            throw new Exception('Invalid payment parameters.');
        }
    }

    public function recordTransaction($model, $data)
    {
        $tblName = 'tbl_transaction';
        if (!$model->insert_data($tblName, $data)) {
            throw new Exception('Failed to record transaction.');
        }
    }

    public function startPayment($paystack, $email, $amount, $callbackUrl, $transactionReference)
    {
        $response = $paystack->initializePayment($email, $amount, $callbackUrl, $transactionReference);
        if (!$response || !isset($response['data']['authorization_url'])) {
            throw new Exception('Failed to initialize payment.');
        }
        return $response['data']['authorization_url'];
    }
}
