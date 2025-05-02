<?php

namespace Museum\Object;

class FileUploader {
    private $target_dir;
    private $max_size = 40000000;
    private $allowed_file_types = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov', 'mkv'];
    private $uploadOk;
    public $error;

    public function __construct($target_dir = "uploads/") {
        $this->target_dir = $target_dir;
        $this->uploadOk = 1;
        $this->error = "";

        if (!is_dir($this->target_dir)) {
            mkdir($this->target_dir, 0777, true); 
        }
    }

    public function upload($file) {
        $this->error = "";
        $fileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $target_file = $this->target_dir . basename($file["name"]);

        if (!$this->checkFileSize($file)) {
            $this->error .= "Sorry, your file is too large. ";
        }

        if (!$this->checkFileType($fileType, $file)) {
            $this->error .= "Sorry, only JPG, JPEG, PNG, GIF, MP4, AVI, MOV, MKV files are allowed. ";
        }

        if ($this->uploadOk == 0) {
            return;
        }

        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        }
    }

    private function checkFileSize($file) {
        if ($file["size"] > $this->max_size) {
            return false;
        }
        return true;
    }

    private function checkFileType($fileType, $file) {
        if (in_array($fileType, $this->allowed_file_types)) {
            return true;
        }

        $fileMimeType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file["tmp_name"]);
        if ($this->isVideoMimeType($fileMimeType)) {
            return true;
        }

        return false;
    }

    private function isVideoMimeType($mimeType) {
        $videoMimeTypes = ['video/mp4', 'video/x-msvideo', 'video/x-matroska', 'video/quicktime'];
        return in_array($mimeType, $videoMimeTypes);
    }

    public function setMaxSize($size) {
        $this->max_size = $size;
    }

    public function getMaxSize() {
        return $this->max_size;
    }

    public function setAllowedFileTypes($types) {
        $this->allowed_file_types = $types;
    }

    public function getAllowedFileTypes() {
        return $this->allowed_file_types;
    }
}

?>
