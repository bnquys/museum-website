<?php
namespace Museum\Utils;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Class Mailer
 *
 * Utility class for sending emails using PHPMailer with template rendering support.
 */
class Mailer {
    private const SMTP_USERNAME = "2uy.9dragons@gmail.com";
    private const SMTP_PASSWORD = "wsrddulmrywnkkun";

    private string $toAddress;
    private ?string $toName = null;
    private string $subject = '';
    private string $body = '';
    private string $altBody = '';

    private string $placeholderPrefix = '{';
    private string $placeholderSuffix = '}';

    /**
     * Mailer constructor.
     *
     * @param string $toAddress Recipient email address.
     * @param string|null $toName Optional recipient name.
     */
    public function __construct(string $toAddress, ?string $toName = null) {
        $this->toAddress = $toAddress;
        $this->toName = $toName;
    }

    /**
     * Set the recipient name.
     *
     * @param string $name Recipient's name.
     * @return void
     */
    public function setRecipientName(string $name): void {
        $this->toName = $name;
    }

    /**
     * Set the email subject.
     *
     * @param string $subject Email subject line.
     * @return void
     */
    public function setSubject(string $subject): void {
        $this->subject = $subject;
    }

    /**
     * Set the HTML body of the email. Automatically generates a plain-text version.
     *
     * @param string $htmlBody The email content in HTML format.
     * @return void
     */
    public function setBody(string $htmlBody): void {
        $this->body = $htmlBody;
        $this->altBody = strip_tags($htmlBody);
    }

    /**
     * Set the placeholder delimiters used in templates.
     * For example: prefix = [[, suffix = ]] will replace [[key]].
     *
     * @param string $prefix Placeholder prefix.
     * @param string $suffix Placeholder suffix.
     * @return void
     */
    public function setTemplateDelimiters(string $prefix, string $suffix): void {
        $this->placeholderPrefix = $prefix;
        $this->placeholderSuffix = $suffix;
    }

    /**
     * Load and render an email body from a template file with dynamic data.
     *
     * @param string $templateFilePath Path to the template HTML file.
     * @param array $data Associative array of template variables.
     * @return bool|string Returns true on success, or error message on failure.
     */
    public function setBodyFromTemplate(string $templateFilePath, array $data = []): bool|string {
        if (!file_exists($templateFilePath)) {
            return "Template file not found: $templateFilePath";
        }

        $templateHTML = file_get_contents($templateFilePath);
        foreach ($data as $key => $value) {
            $search = $this->placeholderPrefix . $key . $this->placeholderSuffix;
            $templateHTML = str_replace($search, htmlspecialchars($value), $templateHTML);
        }

        $this->setBody($templateHTML);
        return true;
    }

    /**
     * Send the composed email using SMTP.
     *
     * @return bool|string Returns true if sent successfully, or error message on failure.
     */
    public function send(): bool|string {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = self::SMTP_USERNAME;
            $mail->Password   = self::SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom(self::SMTP_USERNAME, 'Our Museum');
            $mail->addAddress($this->toAddress, $this->toName ?? '');

            $mail->isHTML(true);
            $mail->Subject = $this->subject;
            $mail->Body    = $this->body;
            $mail->AltBody = $this->altBody;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}