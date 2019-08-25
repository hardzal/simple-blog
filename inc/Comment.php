<?php

class Comment extends Database
{
    private $table = 'comments';

    public function __construct()
    {
        parent::__construct();
    }

    public function selectComment($id_comment)
    {
        try {
            $query = "SELECT c.id, c.user_id, c.post_id, c.body, c.created_at, u.nama_lengkap, u.username, p.judul 
            FROM " . $this->table . " c 
                LEFT JOIN users u ON c.user_id=u.id 
                LEFT JOIN posts p ON c.post_id=p.id
           WHERE c.id = :id_comment";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id_comment', $id_comment);

            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $data = $stmt->fetch();

            return $data;
        } catch (PDOException $err) {
            $message = "Error : " . $err->getMessage();
        }

        $this->setMessage($message);
        $_SESSION['message'] = $this->getMessage();
    }

    public function showComments()
    {
        try {
            $query = "SELECT c.id, c.user_id, c.post_id, c.body, c.created_at, u.nama_lengkap, u.username, p.judul 
            FROM comments c 
                LEFT JOIN users u ON c.user_id=u.id 
                LEFT JOIN posts p ON c.post_id=p.id
            ORDER BY c.created_at ASC";

            $stmt = $this->pdo->prepare($query);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $err) {
            $message = "Error : " . $err->getMessage();
        }

        $this->setMessage($message);
        $_SESSION['message'] = $this->getMessage();
    }

    public function addComment()
    {
        try {
            $query = "INSERT INTO comments (user_id, post_id, body, created_at) 
                        VALUES(:user_id, :post_id, :body, :created_at)";
            $stmt = $this->pdo->prepare($query);

            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
            $post_id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);
            $body    = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);

            $bind_param = array(
                ':user_id' => $user_id,
                ':post_id' => $post_id,
                ':body' => $body,
                ':created_at' => time()
            );

            $stmt->execute($bind_param);

            $stmt->closeCursor();
            return $stmt->rowCount();
        } catch (PDOException $err) {
            $message = "Error : " . $err->getMessage();
        }

        $this->setMessage($message);
        $_SESSION['message'] = $this->getMessage();
    }

    public function updateComment($data)
    {
        try {
            $query = "UPDATE comments SET body = :body, updated_at = :updated_at WHERE id = :id";
            $stmt = $this->pdo->prepare($query);

            $body = filter_var($data['body'], FILTER_SANITIZE_STRING);
            $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);

            $stmt->bindParam(':body', $body);
            $stmt->bindParam(':updated_at', time());
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            $stmt->closeCursor();
            return $stmt->rowCount();
        } catch (PDOException $err) {
            $message = "Error : " . $err->getMessage();
        }

        $this->setMessage($message);
        $_SESSION['message'] = $this->getMessage();
    }

    public function deleteComment($id)
    {
        try {
            $query = "DELETE FROM comments WHERE id = :id";
            $stmt = $this->pdo->prepare($query);

            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            $stmt->closeCursor();

            return $stmt->rowCount();
        } catch (PDOException $err) {
            $message = "Error : " . $err->getMessage();
        }

        $this->setMessage($message);
        $_SESSION['message'] = $this->getMessage();
    }
}
