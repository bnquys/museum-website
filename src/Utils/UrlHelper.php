<?php
namespace Museum\Utils;

class UrlHelper
{
    private static function normalizePath($path)
    {
        $parts = array(); // Array to build a new path from the good parts
        $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
        $segments = explode(DIRECTORY_SEPARATOR, $path);
        foreach ($segments as $segment) {
            if ($segment == '.' || $segment === '') continue;
            if ($segment == '..') {
                array_pop($parts);
            } else {
                $parts[] = $segment;
            }
        }
        return implode('/', $parts);
    }
    
    public static function browserpath(string $filename): string
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    
        // Đường dẫn tuyệt đối thực tế (ví dụ: /var/www/html/museum-website)
        $documentRoot = realpath($_SERVER['DOCUMENT_ROOT']);
        $absolutePath = realpath($filename);
    
        if ($documentRoot && $absolutePath && strpos($absolutePath, $documentRoot) === 0) {
            $relativePath = str_replace('\\', '/', substr($absolutePath, strlen($documentRoot)));
        } else {
            // fallback: chỉ dùng tên file
            $relativePath = basename($filename);
        }
    
        return $protocol . '://' . $host . $relativePath;
    }
    
}
