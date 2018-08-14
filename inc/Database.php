<?php
if(!defined('ACCESS')) exit; // direct access doesn't allowed
require_once 'Config.php';
    class Database extends Config {
               
        protected function __construct() {
            try {
                date_default_timezone_get('Asia/Jakarta');
                $this->pdo = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName, $this->dbUser, $this->dbPassword);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                $this->message = "Error: "> $e->getMessage();
                echo "<script>alert('".$this->message."')</script>";
                die();
            }
            return $this->pdo;
        }

        protected function closeConnection() {
            $this->pdo = null;
        }
    }
