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
        $path = rtrim(dirname($_SERVER['REQUEST_URI']), '/');
    
        $clean_filename = self::normalizePath($filename);
    
        return $protocol . '://' . $host . $path . '/' . $clean_filename;
    }
    
}
