<?php
if(!defined('ACCESS')) exit; // direct access doesn't allowed

    class Post extends Database {
        public $dir_file_image = "./assets/img/";

        public function __construct() {
            parent::__construct();
        }
    
        public function showPost($table, $order_by) {
            try {
                $query = $this->pdo->prepare("SELECT * FROM $table ORDER BY $order_by DESC");
                $query->execute();
                $fetch = $query->fetchAll();

                foreach ( $fetch as $data ) {
                    $data_array[] = $data;
                }

                $data_array = isset($data_array) ? $data_array : "";
                
                return $data_array;
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
                $isi = trim($judul);

                if(move_uploaded_file($img_tmp, $this->dir_file_image.$img_name)) {
                    try {
                        $this->pdo->beginTransaction();
                        $this->pdo->query("INSERT INTO `post_masters` VALUES('', '$judul', now(), now(), '$img_name', '$isi')");
                        $this->pdo->query("INSERT INTO `post_details` VALUES('', '$this->pdo->lastInsertId()', '$author', '$category')");
                        $this->pdo->commit();
                        $message = "Post Added!";
                    } catch(PDOException $e) {
                        $this->pdo->rollBack();
                        $message = "Error: ". $e->getMessage();
                    }
                }
            } else {
                $message = "NOTHING!";
            }
            
            echo "<script>alert('$message')</script>";
        }

        public function updatePost() {

        }

        public function deletePost() {

        }

        public function pagePost() {

        }

        public function searchPost() {

        }

        public function sortPost() {
            
        }
    }

