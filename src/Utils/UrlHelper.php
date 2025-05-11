<?php
namespace Museum\Utils;

class UrlHelper
{
    public static function browserpath(string $filename): string
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $path = rtrim(dirname($_SERVER['REQUEST_URI']), '/');

        return $protocol . '://' . $host . $path . '/' . ltrim($filename, '/');
    }
}
