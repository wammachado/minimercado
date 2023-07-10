<?php

require_once 'Config/config.php';

class CategoryModel{

   public function __construct() {

      $config = new Config();
      $this->db = $config->con();

   }

   public function getAllCategories() {
      
      
      $sql = "SELECT * FROM categories WHERE date_delete IS NULL ORDER BY category_id DESC";

      $result = $this->db->query($sql);
      
      $categories = [];
      while ($row = $result->fetch()) {
            $categories[] = $row;
      }
      return $categories;
   }

   public function getCategoryById($id) {

      $sql = "SELECT * FROM categories WHERE category_id = $id";
      $result = $this->db->query($sql);
      $category = $result->fetch();
      return $category;
   }

   public function addCategory($data) {

      $name = $data['name'];
      $date_add = $data['date_add'];
      $status = $data['status'];

      $sql = "INSERT INTO categories
               (name, status, date_add)
               VALUES
               (:name, :status, :date_add);";
      
      $statement = $this->db->prepare($sql);
      $statement->bindValue(':name', $name);      
      $statement->bindValue(':status', $status);
      $statement->bindValue(':date_add', $date_add);

      $result = $statement->execute();            
      
      if($result){
         return $this->db->lastInsertId();
      }else{
         return false;
      }
   }

   public function updateCategory($data) {

      $category_id = $data['category_id'];
      $name = $data['name'];      
      $status = $data['status'];
      $date_update = $data['date_update'];
      
      
      $sql = "UPDATE categories SET
               name = :name,               
               status = :status,
               date_update = :date_update
               WHERE category_id = :category_id;";
      
      $statement = $this->db->prepare($sql);
      $statement->bindValue(':category_id', $category_id);
      $statement->bindValue(':name', $name);      
      $statement->bindValue(':status', $status);
      $statement->bindValue(':date_update', $date_update);
      
      $result = $statement->execute();
      
      if($result){
         return true;
      }else{
         return false;
      }
   }

   public function deleteCategory($id) {

      $date_delete = date('Y-m-d');
      $status = 0;

      $sql = "UPDATE categories SET
               status = :status,
               date_delete = :date_delete
               WHERE category_id = :category_id;";

      $statement = $this->db->prepare($sql);
      $statement->bindValue(':category_id', $id);
      $statement->bindValue(':status', $status);
      $statement->bindValue(':date_delete', $date_delete);
      $statement->execute();
      
      return $statement;
   }
}
