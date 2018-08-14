<?php
if (!defined('ACCESS')) exit; // direct access doesn't allowed

class User extends Database
{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function isLogin() : bool
    {
        if (!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])) {
            return false;
        } else {
            return true;
        }
    }

    public function checkLevel()
    {
        if (isset($_SESSION['level']) && !empty($_SESSION['level'])) {
            $level = filter_var($_SESSION['level'], FILTER_SANITIZE_STRING);
            return $level;
        } else {
            return false;
        }
    }

    public function logout()
    {
        echo "<script>alert('Success Logout')</script>";
        unset($_SESSION['user_id']);
        unset($_SESSION['level']);
        session_destroy();
        header("Location: login");
    }

    public function login(string $username, string $password)
    {
        $validated = false;

        $username = filter_input(INPUT_POST, $username, FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, $password, FILTER_SANITIZE_STRING);

        if (!isset($username, $password) || !(strlen($password) < 100)) {
            $message = "Please enter a valid username and password";
        } else {
            $validated = true;
        }

        if ($validated == true) {
            $query = "SELECT * FROM users WHERE username=:username OR email=:email";
            $qtmp = $this->pdo->prepare($query);

            $params = array(
                ":username" => $username,
                ":email" => $username
            );

            $qtmp->execute($params);
            $user = $qtmp->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['level'] = $user['level'];
                    $message = "Login Succeed";
                } else {
                    $message = "Wrong Password";
                }
            } else {
                $message = "This user doesn't exist!";
            }
        }

        echo "<script>alert('$message')</script>";

        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
                // $this->pdo->closeConnection();                
            header("Location:dashboard");
        }
    }

    // TODO: Make changes this function 
    // - Validation Registration
    // - Updating Account
    // - Showing Account Member
    public function register()
    {
        $validated = false;
        // FIXME: Fix the input process
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $passwordConfirm = filter_input(INPUT_POST, 'password_confirm', FILTER_SANITIZE_STRING);

        $level = 'U';
        if (!isset($username) && !isset($password) && !isset($passwordConfirm) && !isset($email) && !isset($level)) {
            $message = "Please enter a valid data";
        } else if (strlen($password) > 100 || strlen($password) < 4) {
            $message = 'Incorrect Length for Password';
        } else if (ctype_alnum($username) != true) {
            $message = "Username must be alpha numeric";
        } else if ($password != $passwordConfirm) {
            $message = "Password doesn't match";
        } 
        else 
        {
            $validated = true;
            if ($validated == true) 
            {
                $options = [
                    'cost' => 12,
                ];
                    // Hash the password and set the plaintext variable to a hashed version
                $password = password_hash($password, PASSWORD_BCRYPT, $options);

                $query = "SELECT * FROM users WHERE username = :username";
                $rquery = $this->pdo->prepare($query);

                $rquery->bindParam(':username', $username);
                $rquery->execute();

                if ($rquery->rowCount() > 0) {
                    $message = "This username already exist";
                } else {
                    try {
                        $query = "INSERT INTO users(id, username, password, email, level) VALUES (UUID_SHORT(), :username, :password, :email, :level)";
                        
                        $rquery = $this->pdo->prepare($query);
                        
                        $params = array(
                            ':username' => $username,
                            ':password' => $password,
                            ':email' => $email,
                            ':level' => $level
                        );

                        $rquery->execute($params);
                        $message = "Your account was successfully created";
                    } catch (PDOException $e) {
                        $message = "Error: ".$e->getMessage();
                    }
                }
            }
        }
        echo "<script>alert('$message');</script>";
    }
}