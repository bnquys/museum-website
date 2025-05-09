<?php
require_once realpath(__DIR__ . '/../../vendor/autoload.php');

use Museum\Utils\CkeditorUploader;
if (isset($_FILES['upload']['name'])) {
    $uploader = new CkeditorUploader();
    $response = $uploader->upload($_FILES['upload'], realpath(__DIR__."/../../assets/"));
}
echo json_encode($response);
?>