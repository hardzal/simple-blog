<?php
if(!defined('ACCESS')) exit; // direct access doesn't allowed

    class Post extends Database {
        public $dir_file_image = "./assets/img/";
        private $table = 'posts';

        public function __construct() {
            parent::__construct();
        }
        
        public function selectPost($idPost) {
            try {
                $query = $this->pdo->prepare("SELECT * FROM $this->table WHERE id = :idPost");
                $query->bindParam(':idPost', $idPost, PDO::PARAM_INT);
                $query->execute();
                $query->setFetchMode(PDO::FETCH_ASSOC);

                $data = $query->fetch();
                return $data;
            } catch (PDOException $e) {
                echo "Error: ".$e->getMessage();
            }
        }

        public function showPost($orderBy) {
            try {
                $query = $this->pdo->prepare("SELECT * FROM $this->table ORDER BY $orderBy DESC");
                $query->execute();
                $fetch = $query->fetchAll();

                foreach ( $fetch as $data ) {
                    $dataArray[] = $data;
                }

                $dataArray = isset($dataArray) ? $dataArray : "";
                
                return $dataArray;
            } catch(PDOException $e) {
                echo "Error: ". $e->getMessage();
            }
        }

        public function addPost() {
            if(isset($_FILES['img']) && !empty($_FILES['img'])) {
                $img_name = $_FILES['img']['name'];
                $img_size = $_FILES['img']['size'];
                $img_type = $_FILES['img']['type'];
                $img_tmp  = $_FILES['img']['tmp_name'];
                $judul = strip_tags(trim($_POST['judul']));
                $isi = strip_tags(trim($_POST['isi']));
                $author = strip_tags(trim($_SESSION['user_id']));

                if(move_uploaded_file($img_tmp, $this->dir_file_image.$img_name)) {
                    try {
                        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $this->pdo->beginTransaction();
                        $this->pdo->query("INSERT INTO `$this->table` VALUES('', '$author', '$judul', '$img_name', '$isi', now(), now())");
                        $this->pdo->commit();
                        $message = "Post Added!";
                    } catch(PDOException $e) {
                        $this->pdo->rollBack();
                        $message = "Error: ". $e->getMessage();
                    }
                } 
            }
            
            echo "<script>alert('$message')</script>";
        }

        public function updatePost() 
        {
            $judul = strip_tags(trim($_POST['judul']));
            $isi = trim($_POST['isi']);
            $value = $this->selectPost('posts', $_POST['id']);
            $img_name = isset($_FILES['img']) ? $_FILES['img']['name'] : $value['img'];
            $idPost = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            if(isset($img_name) && !empty($img_name)) {
                $img_name = $_FILES['img']['name'];
                $img_size = $_FILES['img']['size'];
                $img_type = $_FILES['img']['type'];
                $img_tmp  = $_FILES['img']['tmp_name'];

                if(is_file($this->dir_file_image.$value['img']) && file_exists($this->dir_file_image.$value['img'])) {
                    unlink($this->dir_file_image.$value['img']);
                }
                move_uploaded_file($img_tmp, $this->dir_file_image.$img_name);
            }

            try {
                $this->pdo->beginTransaction();    
                
                if(isset($img_name) && !empty($img_name)) {
                    $query = "UPDATE `$this->table` SET judul= :judul, img = :img_name, isi = :isi, updated_at=now() WHERE id = :idPost";
                    $params = array(
                        ':judul' => $judul,
                        ':img_name' => $img_name,
                        ':isi' => $isi,
                        ':idPost' => $idPost
                    );
                } else {
                    $query = "UPDATE `$this->table` SET judul= :judul, isi = :isi, updated_at=now() WHERE id = :idPost";
                    $params = array(
                        ':judul' => $judul,
                        ':isi' => $isi,
                        ':idPost' => $idPost
                    );
                }
                
                $query_m = $this->pdo->prepare($query);
                $query_m->execute($params);
                $this->pdo->commit();
                $message = "Post Updated!";
            } catch(PDOException $e) {
                $this->pdo->rollBack();
                $message = "Error: ". $e->getMessage();
            }
            
            echo "<script>alert('$message')</script>";
            header("Location: dashboard");
        }

        public function deletePost($idPost) {
            try {
                $idPost = filter_var($idPost, FILTER_SANITIZE_NUMBER_INT);
                $query = $this->pdo->prepare("DELETE FROM $this->table WHERE id = :idPost");
                $query->bindParam(':idPost', $idPost);
                
                $value = $this->selectPost('posts', $idPost);
                unlink($this->dir_file_image.$value['img']);
                
                $query->execute();

                $message = "Post Deleted!";
                header("Location: dashboard");
            } catch (PDOException $e) {
                $message = "Error: ". $e->getMessage();
            }

            echo "<script>alert('$message')</script>";
        }
    }

