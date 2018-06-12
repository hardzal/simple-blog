<?php
if(!defined('ACCESS')) exit; // direct access doesn't allowed

    class Database {
        private $dbHost = "localhost";
        private $dbUser = "root";
        private $dbPassword = "";
        private $dbName = "project_webitc";
        protected $pdo;

        protected function __construct() {
            try {
                date_default_timezone_get('Asia/Jakarta');
                $this->pdo = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName, $this->dbUser, $this->dbPassword);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Error: "> $e->getMessage();
                die();
            }
            return $this->pdo;
        }

        public function closeConnection() {
            $this->pdo = null;
        }
    }
