<?php
if (!defined('ACCESS')) exit; // direct access doesn't allowed

class User extends Database
{
    private $table = 'users';
    public function __construct()
    {
        parent::__construct();
    }

    public function isLogin(): bool
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

        $this->setMessage($message);
        $_SESSION['message'] = $this->getMessage();

        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
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
        } else {
            $validated = true;
            if ($validated == true) {
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
                        $message = "Error: " . $e->getMessage();
                    }
                }
            }
        }
        $this->setMessage($message);
        $_SESSION['message'] = $this->getMessage();
    }

    public function showData()
    {
        try {
            $query = "SELECT email, nama_lengkap, nim FROM `$this->table` WHERE id = ?";
            $run = $this->pdo->prepare($query);

            $run->bindParam(1, $_SESSION['user_id']);

            $run->execute();
            $run->setFetchMode(PDO::FETCH_ASSOC);

            return $run->fetch();
        } catch (PDOException $e) {
            $message =  "Error : " . $e->getMessage();
        }
        $this->setMessage($message);
        $_SESSION['message'] = $this->getMessage();
    }

    public function updateData()
    {
        try {
            $this->pdo->beginTransaction();
            $id_user = strip_tags(trim($_POST['id']));
            $nama = strip_tags(trim($_POST['nama']));
            $email = strip_tags(trim($_POST['email']));
            $nim = strip_tags(trim($_POST['nim']));

            $query = "UPDATE `$this->table` SET email = :email, nama_lengkap = :nama_lengkap, nim = :nim WHERE id = :id";
            $run = $this->pdo->prepare($query);

            $params = array(
                ":email" => $email,
                ":nama_lengkap" => $nama,
                ":nim" => $nim,
                ":id" => $id_user
            );

            $run->execute($params);
            $run->closeCursor();

            if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
                $query = "UPDATE `$this->table` SET password = :password WHERE id = :id";
                $run = $this->pdo->prepare($query);
                $password = strip_tags(trim(password_hash($_POST['confirm_password'], PASSWORD_BCRYPT, ['cost' => 12])));
                $run->bindParam(':password', $password);
                $run->bindParam(':id', $_SESSION['user_id']);

                $run->execute();
            }
            $run->closeCursor();
            $this->pdo->commit();
            $message = "Berhasil memperbaharui data!";
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            $message = "Error : " . $e->getMessage();
        }
        $this->setMessage($message);
        $_SESSION['message'] = $this->getMessage();
        header('Location: dashboard&p=members');
    }

    public function showMembers()
    {
        try {
            $query = "SELECT id, username, email, nama_lengkap, nim FROM users WHERE level='U'";

            $run = $this->pdo->prepare($query);

            $run->execute();
            $fetch = $run->fetchAll();
            foreach ($fetch as $data) {
                $dataArray[] = $data;
            }

            $dataArray = isset($dataArray) ? $dataArray : "";
            return $dataArray;
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
        $this->setMessage($message);
        $_SESSION['message'] = $this->getMessage();
    }

    public function selectMember($id)
    {
        try {
            $query = "SELECT * FROM users WHERE id = :id";
            $run = $this->pdo->prepare($query);

            $run->bindParam(':id', $id);

            $run->execute();
            $run->setFetchMode(PDO::FETCH_ASSOC);

            $data = $run->fetch();
            return $data;
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
        $this->setMessage($message);
        $_SESSION['message'] = $this->getMessage();
    }

    public function deleteMember($id)
    {
        try {
            $query = "DELETE FROM users WHERE id = :id";
            $run = $this->pdo->prepare($query);

            $run->bindParam(':id', $id);

            $run->execute();
            $message = "Post Deleted!";

            header("Location: dashboard");
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }

        $this->setMessage($message);
        $_SESSION['message'] = $this->getMessage();
    }
}
