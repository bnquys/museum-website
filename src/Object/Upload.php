<?php
    namespace Museum\Object;

    class Upload {
        public const LIMIT_SIZE = 40; // 40 MB
        public const ALLOW_TYPES = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov', 'avi', 'mkv'];

        public static function upload($file, $rename, $destination) {

            if (!is_dir($destination)) {
                if (!mkdir($destination, 0777, true)) {
                    return "Error: Unable to create destination directory: '$destination'";
                }
            }

            $fileExtension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

            if (!in_array($fileExtension, self::ALLOW_TYPES)) {
                return "Error: Invalid file type '$fileExtension'. Only JPG, JPEG, PNG, GIF, MP4, MOV, AVI, MKV are allowed.";
            }

            $target_file = rtrim($destination, '/') . '/' . $rename . '.' . $fileExtension;

            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($fileExtension, $imageExtensions)) {
                $check = getimagesize($file["tmp_name"]);
                if ($check === false) {
                    return "Error: The file is not a valid image.";
                }
            }

            if ($file["size"] > (self::LIMIT_SIZE * 1024 * 1024)) {
                return "Error: File size exceeds 100MB. Actual size: " . round($file["size"] / 1024 / 1024, 2) . "MB.";
            }

            if (!move_uploaded_file($file["tmp_name"], $target_file)) {
                return "Error: Failed to move uploaded file to destination. Check permissions or file path.";
            }

            return;
        }


    }
?>