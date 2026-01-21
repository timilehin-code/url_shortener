<?php
namespace App\Config;
use PDO;
use PDOException;
class Conn
{
    private $host;
    private $user;
    private $password;
    private $dbName;
    private $pdo = null;

    public function __construct($host, $user, $password, $dbName)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->dbName = $dbName;
    }

    private function connect()
    {
        if ($this->pdo !== null) {
            return $this->pdo;
        }

        try {
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->user, $this->password);
            $this->pdo = $pdo;
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            error_log("Database connection successful");
            return $this->pdo;
        } catch (PDOException $e) {
            $errorMessage = "Database connection failed: " . $e->getMessage() . " (Code: " . $e->getCode() . ")";
            error_log($errorMessage);
            throw new PDOException("Unable to connect to the database.");
        }
    }

    public function getConn()
    {
        return $this->connect();
    }
}