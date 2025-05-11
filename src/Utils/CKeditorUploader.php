<?php
namespace Museum\Utils;

class CKeditorUploader
{
    private $allowedExtensions = ['jpg', 'jpeg', 'png']; // giữ giống fileupload.php

    public function upload(array $file, string $uploadDir = '../../assets/uploads/blog/'): array
    {
        $response = ['uploaded' => 0];

        if (!isset($file['name'])) {
            $response['error']['message'] = 'No file provided.';
            return $response;
        }

        $fileName = basename($file['name']);
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($extension, $this->allowedExtensions)) {
            $response['error']['message'] = 'Invalid extension';
            return $response;
        }

        $uploadPath = rtrim($uploadDir, '/') . '/';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $targetPath = $uploadPath . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $response['uploaded'] = 1;
            $response['file'] = $fileName;
            $response['url'] = $targetPath; // Giống fileupload.php
        } else {
            $response['error']['message'] = 'Error! File not uploaded';
        }

        return $response;
    }
}
