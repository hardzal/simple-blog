<?php
if(!defined('ACCESS')) exit; // direct access doesn't allowed

    class User extends Database {

        public function __construct() {
            parent::__construct();
        }

        public function isLogin() {
            if(!isset($_SESSION['user_id'])&&empty($_SESSION['user_id'])) {
                return false;
            } else {
                return true;
            }
        }

        public function login($username, $password) {
            $validated = false;

            $username = filter_input(INPUT_POST, $username, FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, $password, FILTER_SANITIZE_STRING);
            
            if(!isset($username, $password) || !(strlen($password) < 100)) {
                $message = "Please enter a valid username and password";
            } else {
                $validated = true;
            }

            if ($validated == true) {
                $query = "SELECT * FROM users WHERE username=:username OR email=:email";
                $qtmp  = $this->pdo->prepare($query);
               
                $params = array(
                    ":username" => $username,
                    ":email" => $username
                );

                $qtmp->execute($params);
                $user = $qtmp->fetch(PDO::FETCH_ASSOC);

                if($user) {
                    if(sha1($password) == $user['password']) {
                        $_SESSION['user_id'] = $user['id'];
                        $message = "Login Succeed";
                    } else {
                        $message = "Wrong Password";
                    }
                } else {
                    $message = "This user doesn't exist!";
                }
            }

            echo "<script>alert('$message')</script>";            
            
            if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])) {
                // $this->pdo->closeConnection();                
                header("Location:dashboard");
            }        
        }

        public function register($username, $password, $email, $nama, $nim, $form_token) {
            $validated = false;
            
            if(!isset($username, $password, $email, $email, $nim, $form_token)) {
                $message = "Please enter a valid data";
            } else if ($form_token != $_SESSION['form_token']) {
                $message = "Invalid form submission";
            }  else if (strlen( $password) > 100 || strlen($password) < 4) {
                $message = 'Incorrect Length for Password';
            } else if (ctype_alnum($username) != true) {
                $message = "Username must be alpha numeric";
            } else {
                $validated = true;
            }

            if($validated == true) {

                $username = filter_input(INPUT_POST, $username, FILTER_SANITIZE_STRING);
                $email    = filter_input(INPUT_POST, $email, FILTER_VALIDATE_EMAIL);
                $nim      = filter_input(INPUT_POST, $nim, FILTER_SANITIZE_NUMBER_INT);
                $nama     = filter_input(INPUT_POST, $nama, FILTER_SANITIZE_STRING);

                $options = [
                    'cost' => 12,
                ];
        
                // Hash the password and set the plaintext variable to a hashed version
                $password = password_hash($password, PASSWORD_BCRYPT, $options);
                
                

            }

            echo "<script>alert('$message');</script>";
        }

        
    }