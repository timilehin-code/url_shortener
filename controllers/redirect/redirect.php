<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require 'vendor/autoload.php';
require 'config/conn.php';

use App\Shortner\Shorten;

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($path, '/');
$shortcode = ltrim(str_replace('url_shortener', '', $path), '/');
$shorten = new Shorten($pdo);
$shorten->originalUrl = $shortcode;
$originalUrl = $shorten->getOriginalUrl($shortcode);
if ($originalUrl) {
    header("Location: " . $originalUrl);
    exit();
} else {
    http_response_code(404);
    echo "404 - Shortcode not found";
}
