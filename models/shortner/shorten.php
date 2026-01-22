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
}
