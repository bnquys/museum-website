<?php
    namespace Museum\Utils;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Mailer {
        private const SMTP_USERNAME = "2uy.9dragons@gmail.com";
        private const SMTP_PASSWORD = "wsrddulmrywnkkun";

        public static function sendMail($toAddress, $toName, $subject, $body) {
            $mail = new PHPMailer(true);

            try {
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;  //Enable verbose debug output

                //Server settings
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = self::SMTP_USERNAME;               //SMTP username
                $mail->Password   = self::SMTP_PASSWORD;                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom(self::SMTP_USERNAME, 'Our Museum');
                $mail->addAddress($toAddress, $toName);

                //Content
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $body;
                $mail->AltBody = strip_tags($body);

                $mail->send();
                return;
            } catch (Exception $e) {
                return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        public static function sendRenderedMailFromFile($toAddress, $toName, $subject, $templateFilePath, array $data = []) {
            if (!file_exists($templateFilePath)) {
                return "Template file not found: $templateFilePath";
            }

            $templateHTML = file_get_contents($templateFilePath);

            // Thay thế các placeholder dạng {key}
            foreach ($data as $key => $value) {
                $templateHTML = str_replace('{' . $key . '}', htmlspecialchars($value), $templateHTML);
            }

            return self::sendMail($toAddress, $toName, $subject, $templateHTML);
        }
    }
?>