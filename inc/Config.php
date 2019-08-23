<?php

class Config
{
    protected static $userData = [
        'username',
        'password',
        'password_confirm',
        'email',
    ];

    protected $dbHost = "localhost";
    protected $dbUser = "root";
    protected $dbPassword = "";
    protected $dbName = "project_webitc";
    protected $pdo;
    protected $message;

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
