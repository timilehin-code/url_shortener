<?php

declare(strict_types=1);

namespace App\Shortner;

use PDO;
use PDOException;

class Shorten
{
    public string $originalUrl;
    public PDO $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function checkUrl()
    {
        try {
            $sql = "SELECT long_url, short_code FROM urls WHERE long_url = ?";
            $prepare = $this->conn->prepare($sql);
            if (!$prepare) {
                throw new PDOException("Could not prepare statement.");
            }
            $prepare->execute([$this->originalUrl]);
            if ($prepare->rowCount() == 0) {
                return false;
            } elseif ($prepare->rowCount() == 1) {
                $row = $prepare->fetch(PDO::FETCH_ASSOC);
                $_SESSION['short_code'] = $row['short_code'];
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function isWebsiteUp(string $url): bool
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Website-Checker/1.0');

        curl_exec($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode >= 200 && $httpCode < 400;
    }
    public function InsertUrl()
    {
        try {
            $sql = "INSERT INTO urls (long_url, short_code) VALUES (?, ?)";
            $Prepare = $this->conn->prepare($sql);
            if (!$Prepare) {
                throw new PDOException("Failed to prepare statement");
            }
            $shortCode = substr(rtrim(strtr(base64_encode(random_bytes(5)), '+/=', ''), '='), 0, 6);

            $execute = $Prepare->execute([$this->originalUrl, $shortCode]);
            if ($execute) {
                $sql = "SELECT COUNT(*) FROM urls WHERE short_code = ?";
                $Prepare = $this->conn->prepare($sql);
                if (!$Prepare) {
                    throw new PDOException("Failed to prepare statement");
                }
                $Prepare->execute([$shortCode]);
                $count = $Prepare->fetchColumn();
                if ($count > 1) {
                    return $this->InsertUrl();
                } else {
                    return $shortCode;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getOriginalUrl($shortCode)
    {
        try {
            $sql = "SELECT long_url FROM urls WHERE short_code = ?";
            $Prepare = $this->conn->prepare($sql);
            if (!$Prepare) {
                throw new PDOException("Failed to prepare statement");
            }
            $Prepare->execute([$shortCode]);
            if ($Prepare->rowCount() == 1) {
                $row = $Prepare->fetch(PDO::FETCH_ASSOC);
                return $row['long_url'];
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
