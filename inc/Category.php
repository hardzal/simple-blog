<?php

class Category extends Database
{

    private $table = 'categories';

    public function __construct()
    {
        parent::__construct();
    }

    public function selectCategory($idCategory)
    {
        try {
            $query = "SELECT * FROM $this->table WHERE id = ?";
            $prepare = $this->pdo->prepare($query);
            $prepare->bindParam(1, $idCategory);
            $prepare->execute();
            $prepare->setFetchMode(PDO::FETCH_ASSOC);
            $data = $prepare->fetch();
            return $data;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function showCategories()
    {
        try {
            $query = "SELECT * FROM $this->table";
            $prepare = $this->pdo->prepare($query);
            $prepare->execute();
            $fetch = $prepare->fetchAll();

            foreach ($fetch as $data) {
                $dataArray[] = $data;
            }

            $dataArray = isset($dataArray) ? $dataArray : "";
            return $dataArray;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    public function addCategory()
    {
        try {
            $nama = strip_tags(trim($_POST['nama']));
            $keterangan = strip_tags(trim($_POST['keterangan']));
            $query = "INSERT INTO $this->table SET nama = :nama, keterangan = :keterangan";
            $prepare = $this->pdo->prepare($query);

            $prepare->bindParam(':nama', $nama);
            $prepare->bindParam(':keterangan', $keterangan);

            $prepare->execute();
            $message = 'Category Added!';
        } catch (PDOException $e) {
            $message = 'Error: ' . $e->getMessage();
        }

        $this->setMessage($message);
        $_SESSION['message'] = $message;

        header("Location: dashboard&p=categories");
    }

    public function updateCategory()
    {
        try {
            $id =  strip_tags(trim($_POST['id']));
            $nama = strip_tags(trim($_POST['nama']));
            $keterangan = strip_tags(trim($_POST['keterangan']));
            $query = "UPDATE $this->table SET nama = :nama, keterangan = :keterangan WHERE id = :id";

            $prepare = $this->pdo->prepare($query);
            $prepare->bindParam(':nama', $nama);
            $prepare->bindParam(':keterangan', $keterangan);
            $prepare->bindParam(':id', $id);
            $prepare->execute();
            $message = 'Success update!';
        } catch (PDOException $e) {
            $message = 'Error : ' . $e->getMessage();
        }

        $this->setMessage($message);
        $_SESSION['message'] = $message;
        header("Location: dashboard&p=categories");
    }

    public function deleteCategory($idCategory)
    {
        try {
            $query = "DELETE FROM $this->table WHERE id = ?";
            $prepare = $this->pdo->prepare($query);
            $prepare->bindParam(1, $idCategory);
            $prepare->execute();
            $message = "Success delete!";
        } catch (PDOException $e) {
            $message = "Error : " . $e->getMessage();
        }

        $this->setMessage($message);
        $_SESSION['message'] = $message;
        header("Location: dashboard&p=categories");
    }
}
