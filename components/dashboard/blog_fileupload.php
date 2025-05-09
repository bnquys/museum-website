<?php
require_once realpath(__DIR__ . '/../../vendor/autoload.php');

use Museum\Utils\CkeditorUploader;

$response = array();
if (isset($_FILES['upload']['name'])) {
    $uploader = new CkeditorUploader();
    $response = $uploader->upload($_FILES['upload'], "../../assets/uploads/blog/");
}
echo json_encode($response);
?>