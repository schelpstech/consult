<?php

class Utility
{
    public function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function generateRandomText($length)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function generateRandomDigits($length)
    {
        $characters = '1234567890';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function dayinterval($start, $end)
    {
        $interval = date_diff($start, $end);
        return $interval->format('%R%a days');
    }
    public function money($amount)
    {
        $regex = "/\B(?=(\d{3})+(?!\d))/i";
        return "&#8358;" . preg_replace($regex, ",", $amount);
    }

    public function number($amount)
    {
        $regex = "/\B(?=(\d{3})+(?!\d))/i";
        return preg_replace($regex, ",", $amount);
    }


    public function RemoveSpecialChar($str)
    {
        $result = str_replace(array('\'', '"', ',', ';', '<', '>', '/'), '', $str);
        return $result;
    }

    public function inputEncode($input)
    {
        try {
            // Step 1: Check if $input is empty or null
            if (empty($input)) {
                throw new Exception("Input data cannot be empty or null.");
            }

            // Step 2: Base64 encode the input
            $base64Encoded = base64_encode($input);

            // Check if base64_encode failed
            if ($base64Encoded === false) {
                throw new Exception("Failed to base64 encode the input.");
            }

            // Step 3: Hexadecimal encoding of the Base64-encoded data
            $hexEncoded = bin2hex($base64Encoded);

            // Check if bin2hex failed
            if ($hexEncoded === false) {
                throw new Exception("Failed to convert Base64-encoded data to hexadecimal.");
            }

            return $hexEncoded;
        } catch (Exception $e) {
            // Handle exceptions, log the error message, and return an error response or null
            error_log($e->getMessage()); // Log the error message for debugging
            return null; // or return a custom error message or handle as needed
        }
    }


    public function inputDecode($encodedData)
    {
        try {
            // Step 1: Check if $encodedData is not empty or null before decoding
            if (empty($encodedData)) {
                throw new Exception("Encoded data cannot be empty or null.");
            }

            // Step 2: Hexadecimal to binary
            $binary = hex2bin($encodedData);

            // Check if hex2bin failed and returned false
            if ($binary === false) {
                throw new Exception("Invalid hexadecimal input provided.");
            }

            // Step 3: Base64 decoding of the binary data
            $decodedBase64 = base64_decode($binary, true); // true to prevent non-base64 chars

            // Check if base64_decode failed
            if ($decodedBase64 === false) {
                throw new Exception("Failed to base64 decode the binary data.");
            }

            return $decodedBase64;
        } catch (Exception $e) {
            // Handle exceptions, log the error message, and return an error response or null
            error_log($e->getMessage()); // Log the error message for debugging
            return null; // or return a custom error message or handle as needed
        }
    }

    public function encodePassword($input)
    {
        // Step 1: Base64 encode
        $base64Encoded = base64_encode($input);

        // Step 2: Hexadecimal encoding of the Base64-encoded data
        $hexEncoded = bin2hex($base64Encoded);

        // Step 3: Hash the password with bcrypt
        $hashedPassword = password_hash($hexEncoded, PASSWORD_BCRYPT);

        return $hashedPassword;
    }


    public function verifyPassword($inputPassword, $storedHashedPassword)
    {
        // Verify the password using bcrypt
        return password_verify($inputPassword, $storedHashedPassword);
    }



    public function notifier($notification_alert, $notification_message)
    {
        $result =
            '<div class="alert alert-' . $notification_alert . ' alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Response!</h5>
                            ' . $notification_message . '
                </div>';
        $_SESSION['msg'] = $result;
    }
    public function redirect($url)
    {
        // Perform the redirect
        header("Location: $url");
        exit();
    }

    public function redirectandencode($pageid)
    {
        // Build the URL dynamically using the inputEncode function
        $url = './router.php?pageid=' . $this->inputEncode($pageid);

        // Perform the redirect
        header("Location: $url");
        exit();
    }

    public function redirectWithNotification($notification_alert, $notification_message, $redirectUrl)
    {
        // Use the notifier to set the message in the session
        $this->notifier($notification_alert, $notification_message);

        // Perform the redirect
        $this->redirectandencode($redirectUrl);
        exit();
    }


    /**
     * Summary of handleUploadedFile
     * @param mixed $inputName
     * @param mixed $allowedTypes
     * @param mixed $maxFileSize
     * @param mixed $uploadPath
     * @return string
     */
    public function handleUploadedFile(string $inputName, array $allowedMimes, int $maxFileSize, string $uploadPath): array
    {
        try {
            // Basic checks
            if (!isset($_FILES[$inputName])) {
                return ['status' => 'error', 'message' => "No file uploaded for input: {$inputName}"];
            }

            $file = $_FILES[$inputName];

            // Handle common upload errors
            if (!isset($file['error'])) {
                return ['status' => 'error', 'message' => "Invalid upload data for {$inputName}"];
            }

            if ($file['error'] === UPLOAD_ERR_NO_FILE) {
                return ['status' => 'empty', 'message' => "No file selected for {$inputName}"];
            }

            if ($file['error'] !== UPLOAD_ERR_OK) {
                return ['status' => 'error', 'message' => $this->uploadErrorMessage($file['error'])];
            }

            // Size check
            if ($file['size'] > $maxFileSize) {
                return ['status' => 'error', 'message' => "File size exceeds limit ({$maxFileSize} bytes)."];
            }

            // Ensure upload directory exists
            if (!is_dir($uploadPath)) {
                if (!mkdir($uploadPath, 0755, true)) {
                    return ['status' => 'error', 'message' => "Failed to create upload directory."];
                }
            }

            // Use finfo to determine real MIME type
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            if (!$finfo) {
                return ['status' => 'error', 'message' => "Server error: cannot open file info."];
            }
            $mime = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);

            if ($mime === false) {
                return ['status' => 'error', 'message' => "Unable to detect file MIME type."];
            }

            // Validate MIME
            if (!in_array($mime, $allowedMimes, true)) {
                return ['status' => 'error', 'message' => "Invalid file type: {$mime}"];
            }

            // Build safe filename: random + cleaned basename + extension
            $originalName = $file['name'];
            $ext = pathinfo($originalName, PATHINFO_EXTENSION);
            $base = pathinfo($originalName, PATHINFO_FILENAME);

            // Sanitize base name (keep letters, numbers, underscores, dashes)
            $safeBase = preg_replace('/[^A-Za-z0-9_\-]/', '_', $base);
            $utility = new Utility();
            $random = $utility->generateRandomString(16);
            $saveFileName = $random . '_' . substr($safeBase, 0, 60) . ($ext ? '.' . strtolower($ext) : '');

            $destination = rtrim($uploadPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $saveFileName;

            // Move the uploaded file
            if (!move_uploaded_file($file['tmp_name'], $destination)) {
                error_log("handleUploadedFile: move_uploaded_file failed for {$destination}");
                return ['status' => 'error', 'message' => "Failed to move uploaded file."];
            }

            // Set safe permissions on the uploaded file
            @chmod($destination, 0644);

            // Return structured success info
            return [
                'status'   => 'success',
                'filename' => $saveFileName,
                'path'     => $destination,
                'mime'     => $mime,
                'size'     => $file['size']
            ];
        } catch (Exception $e) {
            error_log("handleUploadedFile Exception: " . $e->getMessage());
            return ['status' => 'error', 'message' => "Upload failed: " . $e->getMessage()];
        }
    }
    /**
     * Helper to convert PHP upload error code to readable message.
     */
    private function uploadErrorMessage(int $code): string
    {
        $errors = [
            UPLOAD_ERR_INI_SIZE   => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
            UPLOAD_ERR_FORM_SIZE  => 'The uploaded file exceeds the MAX_FILE_SIZE directive specified in the HTML form.',
            UPLOAD_ERR_PARTIAL    => 'The uploaded file was only partially uploaded.',
            UPLOAD_ERR_NO_FILE    => 'No file was uploaded.',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder.',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
            UPLOAD_ERR_EXTENSION  => 'A PHP extension stopped the file upload.',
        ];

        return $errors[$code] ?? 'Unknown upload error.';
    }


    /**
     * Summary of calculateAge
     * @param mixed $birthdate
     * @return int
     */
    public function calculateAge($birthdate)
    {
        // Create DateTime objects for the birthdate and current date
        $birthDateObj = new DateTime($birthdate);
        $currentDateObj = new DateTime();

        // Calculate the difference between the two dates
        $ageInterval = $currentDateObj->diff($birthDateObj);

        // Return the calculated age
        return $ageInterval->y;
    }

    public function setNotification($alertClass, $iconClass, $message)
    {
        $_SESSION['msg'] = '
        <div class="alert ' . $alertClass . ' alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="' . $iconClass . '"></i> Response!</h5>
            ' . $message . '
        </div>';
    }
    public function isPasswordStrong($password)
    {
        // Define password strength criteria
        $minLength = 8;
        $hasUppercase = preg_match('/[A-Z]/', $password); // At least one uppercase letter
        $hasLowercase = preg_match('/[a-z]/', $password); // At least one lowercase letter
        $hasNumber = preg_match('/[0-9]/', $password);    // At least one number
        $hasSpecialChar = preg_match('/[\W_]/', $password); // At least one special character

        // Check if password meets all criteria
        if (strlen($password) < $minLength) {
            return [
                'status' => false,
                'message' => 'Password must be at least ' . $minLength . ' characters long.'
            ];
        }

        if (!$hasUppercase) {
            return [
                'status' => false,
                'message' => 'Password must include at least one uppercase letter.'
            ];
        }

        if (!$hasLowercase) {
            return [
                'status' => false,
                'message' => 'Password must include at least one lowercase letter.'
            ];
        }

        if (!$hasNumber) {
            return [
                'status' => false,
                'message' => 'Password must include at least one number.'
            ];
        }

        if (!$hasSpecialChar) {
            return [
                'status' => false,
                'message' => 'Password must include at least one special character.'
            ];
        }

        // If all conditions are met, password is strong
        return [
            'status' => true,
            'message' => 'Password is strong.'
        ];
    }

    /**
     * Set a flash message
     */
    public function setFlash(string $type, string $message): void
    {
        $_SESSION['flash'] = [
            'type' => $type,   // success, danger, warning, info
            'message' => $message
        ];
    }

    /**
     * Display and clear flash message
     */
    public function displayFlash(): void
    {
        if (isset($_SESSION['flash'])) {
            $type = $_SESSION['flash']['type'];
            $message = $_SESSION['flash']['message'];

            echo '<div class="alert alert-' . htmlspecialchars($type) . ' alert-dismissible fade show" role="alert">';
            echo htmlspecialchars($message);
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';

            unset($_SESSION['flash']); // clear after showing
        }
    }

    function resetPasswordEmailTemplate($resetLink)
    {
        return '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Password Reset Request</title>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f6f6f6; margin:0; padding:0; }
            .container { max-width:600px; margin:20px auto; background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.1); }
            .header { background-color:#222; padding:20px; text-align:center; }
            .header img { max-width:150px; }
            .content { padding:30px; color:#333; }
            h2 { color:#222; }
            .button { display:inline-block; padding:12px 24px; margin-top:20px; background:#007bff; color:#fff !important; text-decoration:none; border-radius:5px; font-weight:bold; }
            .footer { margin-top:30px; font-size:12px; color:#888; text-align:center; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <img src="http://queenzy.assoec.org/view/index.html" alt="Your Store Logo">
            </div>
            <div class="content">
                <h2>Password Reset Request</h2>
                <p>Hello,</p>
                <p>We received a request to reset your password. If you made this request, please click the button below to set a new password.</p>
                <p style="text-align:center;">
                    <a href="' . htmlspecialchars($resetLink) . '" class="button">Reset My Password</a>
                </p>
                <p>If the button doesn\'t work, copy and paste this link into your browser:</p>
                <p><a href="' . htmlspecialchars($resetLink) . '">' . htmlspecialchars($resetLink) . '</a></p>
                <p>If you did not request a password reset, you can safely ignore this email.</p>
                <div class="footer">
                    <p>© ' . date("Y") . ' Queenzy Store. All rights reserved.</p>
                </div>
            </div>
        </div>
    </body>
    </html>';
    }
}
