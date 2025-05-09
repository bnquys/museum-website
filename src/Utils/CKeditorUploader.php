<?php
namespace Museum\Utils;

class CKeditorUploader
{
    public $error = '';
    public $allowedExtensions = ['jpg', 'jpeg', 'png'];

    public function upload($file, $uploadDir = 'uploads/')
    {
        $data = array();

        if (isset($file['name'])) {
            $file_name = basename($file['name']);
            $upload_dir = __DIR__ . '/'. $uploadDir;
            $file_path = $upload_dir . $file_name;
            $file_url = $uploadDir . $file_name; 
            $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if (in_array($file_extension, $this->allowedExtensions)) {
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }

                if (move_uploaded_file($file['tmp_name'], $file_path)) {
                    $data['file'] = $file_name;
                    $data['url'] = $file_url;
                    $data['uploaded'] = 1;
                } else {
                    $data['uploaded'] = 0;
                    $data['error']['message'] = 'Error! File not uploaded';
                }
            } else {
                $data['uploaded'] = 0;
                $data['error']['message'] = 'Invalid extension';
            }
        }

        return $data;
    }
}
