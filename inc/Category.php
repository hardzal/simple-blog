<?php

class Category extends Database {
    
    private $table = 'categories';

    public function __construct()
    {
        parent::__construct();
    }

    public function selectCategory($idCategory) {

    }

    public function showCategories() {
        try {
            $query = "SELECT * FROM $this->table";
            $prepare = $this->pdo->prepare($query);
            $prepare->execute();
            $fetch = $prepare->fetchAll();

            foreach($fetch as $data) {
                $dataArray[] = $data;
            }

            $dataArray = isset($dataArray) ? $dataArray : "";
            return $dataArray;
        } catch(PDOException $e) {
            echo "Error : ". $e->getMessage();
        }
    }

    public function addCategory() {

    }

    public function updateCategory() {

    }

    public function deleteCategory() {

    }
}