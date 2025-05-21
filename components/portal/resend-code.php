<?php
session_start();
require_once realpath(__DIR__ . "/../../vendor/autoload.php");

use Museum\Object\Account;
use Museum\Utils\Mailer;

if (!isset($_SESSION['register']['account']) || !isset($_SESSION['register']['user'])) {
    http_response_code(403);
    echo json_encode(["error" => "No account session found"]);
    exit;
}

// Tạo mã mới và cập nhật vào session
$newCode = Account::generateRandomNumbers(6);
$_SESSION['register']['account']['activateCode'] = $newCode;

// Lấy thông tin người dùng
$email = $_SESSION['register']['user']['email'];
$name = $_SESSION['register']['user']['name'];

// Gửi email
$subject = "Your confirmation code";
$body = "Your new confirmation code is: $newCode";

try {
    $mailer = new Mailer($email, $name);
	$mailer->setSubject($subject);

	$data = [
		'user_name' => $name,
		'activation_code' => $newCode
	];

	$mailer->setBodyFromTemplate(__DIR__.'/active_template.html', $data);
	$mailer->send();

    echo json_encode([
        "message" => "Verification code resent successfully.",
        "code" => $newCode
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to send email."]);
}