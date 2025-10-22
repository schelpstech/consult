<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../app/vendor/autoload.php'; // PHPMailer autoload

class Mailer
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        // Server settings
        $this->mail->isSMTP();
        $this->mail->Host       = 'server163.web-hosting.com'; 
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = 'noreply@queenzy.assoec.org'; 
        $this->mail->Password   = 'UNYOpat2017@'; 
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $this->mail->Port       = 465;

        // Default sender
        $this->mail->setFrom('noreply@queenzy.assoec.org', 'ODL - ATIBA University, OYO ');
    }

    public function send($to, $subject, $htmlContent, $altContent = "")
    {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($to);

            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $htmlContent;
            $this->mail->AltBody = $altContent ?: strip_tags($htmlContent);

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Mailer Error: " . $this->mail->ErrorInfo);
            return false;
        }
    }

   
    public function sendTemplate($to, $subject, $templatePath, $placeholders = [])
    {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($to);

            // Load template
            $body = file_get_contents($templatePath);

            // Replace placeholders
            foreach ($placeholders as $key => $value) {
                $body = str_replace("{" . strtoupper($key) . "}", $value, $body);
            }

            // Always replace {YEAR}
            $body = str_replace("{YEAR}", date("Y"), $body);

            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;
            $this->mail->AltBody = strip_tags($body);

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Mailer Error: " . $this->mail->ErrorInfo);
            return false;
        }
    }
}


    

