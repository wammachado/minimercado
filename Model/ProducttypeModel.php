<?php

require_once 'Config/config.php';

class ProducttypeModel extends Config {

   public function __construct() {

      $config = new Config();
      $this->db = $config->con();
   }

   public function getAllProductTypes() {
         
         $sql = "SELECT * FROM product_types WHERE date_delete IS NULL ORDER BY product_type_id DESC";
         $result = $this->db->query($sql);
   
         $productTypes = [];
         while ($row = $result->fetch()) {
            $productTypes[] = $row;
         }
         return $productTypes;
   }

   public function getProductTypeById($id) {

      $sql = "SELECT * FROM product_types WHERE product_type_id = $id";
      $result = $this->db->query($sql);
      $productType = $result->fetch();
      return $productType;
   }

   public function addProductType($data) {

      $name = $data['name'];
      $tax = $data['tax'];
      $tax = preg_replace('/[^0-9]/', '', $tax); 
      $tax = count(explode(",",$data['tax']))> 1 ? bcdiv($tax, 100, 2) : $tax;
      $tax = strtr($tax, ',', '.');
      $status = $data['status'];
      $date_add = $data['date_add'];
      
      
      
      $sql = "INSERT INTO product_types
               (name, tax, status, date_add)
               VALUES
               (:name, :tax, :status, :date_add);";
      
      $statement = $this->db->prepare($sql);
      $statement->bindValue(':name', $name);
      $statement->bindValue(':tax', $tax);
      $statement->bindValue(':status', $status);
      $statement->bindValue(':date_add', $date_add);

      $result = $statement->execute();      
      
      if($result){
         return $this->db->lastInsertId();
      }else{
         return false;
      }
   }

   public function updateProductType($data) {

      
      $product_type_id = $data['product_type_id'];
      $name = $data['name'];
      $tax = $data['tax'];
      $tax = preg_replace('/[^0-9]/', '', $tax); 
      $tax = count(explode(",",$data['tax']))> 1 ? bcdiv($tax, 100, 2) : $tax;
      $tax = strtr($tax, ',', '.');
      $status = $data['status'];
      $date_update = $data['date_update'];
      
      
      $sql = "UPDATE product_types SET
               name = :name,
               tax = :tax,
               status = :status,
               date_update = :date_update
               WHERE product_type_id = :product_type_id;";
      
      $statement = $this->db->prepare($sql);
      $statement->bindValue(':product_type_id', $product_type_id);
      $statement->bindValue(':name', $name);
      $statement->bindValue(':tax', $tax);
      $statement->bindValue(':status', $status);
      $statement->bindValue(':date_update', $date_update);
      
      $result = $statement->execute();
      
      if($result){
         return true;
      }else{
         return false;
      }
   }

   public function deleteProductType($id) {

      $date_delete = date('Y-m-d');
      $status= 0;

      $sql = "UPDATE product_types SET
               status = :status,
               date_delete = :date_delete
               WHERE product_type_id = :product_type_id;";

      $statement = $this->db->prepare($sql);
      $statement->bindValue(':product_type_id', $id);
      $statement->bindValue(':status', $status);
      $statement->bindValue(':date_delete', $date_delete);
      $statement->execute();
      
      return $statement;
   }
}