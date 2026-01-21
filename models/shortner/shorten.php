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
    public function InsertUrl()
    {
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
            }else {
                return $shortCode;
            }
        }
    }
}
