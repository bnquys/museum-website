<?php
session_start();
use Museum\Object\Account;

if (!isset($_SESSION['register']['account'])) {
    http_response_code(403);
    echo json_encode(["error" => "No account session found"]);
    exit;
}

$newCode = Account::generateRandomNumbers(6);
$_SESSION['register']['account']['activateCode'] = $newCode;

sleep(1); 

echo json_encode([
    "message" => "Verification code resent successfully.",
    "code" => $newCode 
]);
