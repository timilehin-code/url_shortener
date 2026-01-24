<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require '../../vendor/autoload.php';
require '../../config/conn.php';

use App\Shortner\Shorten;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $originalUrl = $_POST['original_url'] ?? '';

    if (!empty($originalUrl) || !filter_var($originalUrl, FILTER_VALIDATE_URL)) {
        $shorten = new Shorten($pdo);
        $shorten->originalUrl = $originalUrl;
        if (!$shorten->checkUrl()) {
            if (!$shorten->isWebsiteUp($originalUrl)) {
                $_SESSION['error'] = "The website is not reachable.";
                header("Location:$_SERVER[HTTP_REFERER]");
            }
            try {
                $shortCode = $shorten->InsertUrl();
                $_SESSION['short_code'] = $shortCode;
                header("Location:$_SERVER[HTTP_REFERER]");
                exit();
            } catch (PDOException $e) {
                error_log("Error inserting URL: " . $e->getMessage());
                $baseUrl = "Error shortening URL.";
            }
        } else {
            echo  $_SESSION['short_code'];
            header("Location:$_SERVER[HTTP_REFERER]");
            exit();
        }
    }
}
