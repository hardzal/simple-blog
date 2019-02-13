<?php
if(!defined('ACCESS')) exit; // direct access doesn't allowed

    class Post extends Database {
        public $dir_file_image = "./assets/img/";

        public function __construct() {
            parent::__construct();
        }
        
        public function selectPost($table, $idPost) {
            try {
                $query = $this->pdo->prepare("SELECT * FROM $table WHERE id = :idPost");
                $query->bindParam(':idPost', $idPost, PDO::PARAM_INT);
                $query->execute();
                $query->setFetchMode(PDO::FETCH_ASSOC);

                $data = $query->fetch();
                return $data;
            } catch (PDOException $e) {
                echo "Error: ".$e->getMessage();
            }
        }

        public function showPost($table, $orderBy) {
            try {
                $query = $this->pdo->prepare("SELECT * FROM $table ORDER BY $orderBy DESC");
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

        public function addPost($judul, $isi, $img, $category, $author) {
            if(isset($img) && !empty($img)) {
                $img_name = $_FILES['img']['name'];
                $img_size = $_FILES['img']['size'];
                $img_type = $_FILES['img']['type'];
                $img_tmp  = $_FILES['img']['tmp_name'];
                $judul = strip_tags(trim($judul));
                $isi = trim($isi);

                if(move_uploaded_file($img_tmp, $this->dir_file_image.$img_name)) {
                    try {
                        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $this->pdo->beginTransaction();
                        $this->pdo->query("INSERT INTO `posts` VALUES('', '$judul', now(), now(), '$img_name', '$isi')");
                        $this->pdo->commit();
                        $message = "Post Added!";
                    } catch(PDOException $e) {
                        $this->pdo->rollBack();
                        $message = "Error: ". $e->getMessage();
                    }
                    print_r($_POST);
                    var_dump($_FILES);
                } 
            }
            
            echo "<script>alert('$message')</script>";
        }

        public function updatePost($judul, $isi, $img, $category, $author, $table, $idPost) 
        {
            $judul = strip_tags(trim($judul));
            $isi = trim($isi);
            $value = $this->selectPost('post_masters', $idPost);
            $img_name = isset($_FILES['img']) ? $_FILES['img']['name'] : $value['img'];
            if(isset($img) && !empty($img)) {
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
                
                $query_m = $this->pdo->prepare("UPDATE `post_masters` SET judul= :judul, updated_at=now(), img = :img_name, isi = :isi WHERE id = :idPost");
                $params = array(
                    ':judul' => $judul,
                    ':img_name' => $img_name,
                    ':isi' => $isi,
                    ':idPost' => $idPost
                );

                $query_m->execute($params);
                
                $query_d = $this->pdo->prepare("UPDATE `post_details` SET id_user = :id_user, id_category = :id_category");
                
                $query_d->bindParam(':id_user', $author);
                $query_d->bindParam(':id_category', $categoy);
                $query_d->execute();

                $this->pdo->commit();
                $message = "Post Updated!";
                header("Location: dashboard");
            } catch(PDOException $e) {
                $this->pdo->rollBack();
                $message = "Error: ". $e->getMessage();
            }
            
            echo "<script>alert('$message')</script>";
        }

        public function deletePost($table, $idPost) {
            try {
                $idPost = filter_var($idPost, FILTER_SANITIZE_NUMBER_INT);
                $query = $this->pdo->prepare("DELETE FROM $table WHERE id = :idPost");
                $query->bindParam(':idPost', $idPost);
                $query->execute();

                $message = "Post Deleted!";
                header("Location: dashboard");
            } catch (PDOException $e) {
                $message = "Error: ". $e->getMessage();
            }

            echo "<script>alert('$message')</script>";
        }

        public function pagePost() {

        }

        public function searchPost() {

        }

        public function sortPost() {
            
        }
    }

