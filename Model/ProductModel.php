<?php

require_once 'Config/config.php';

class ProductModel  extends Config{
   
      public function __construct() {

         $config = new Config();
         $this->db = $config->con();
  
      }

      public function getProductsBySearch($search){

         $sql = "SELECT 
                        products.product_id,
                        products.name, 
                        products.ean, 
                        products.quantity, 
                        products.price,
                        product_types.tax
                  FROM products 
                  LEFT JOIN product_types  ON products.type = product_types.product_type_id
                  WHERE products.status = 1 AND products.date_delete IS NULL AND
                  (products.name ILIKE '%$search%' 
                  OR products.ean LIKE '%$search%')
                  ORDER BY name DESC";

         $result = $this->db->query($sql);         
         $products = [];
         while ($row = $result->fetch()) {
               $products[] = $row;
         }
         return $products;
      }
   
      public function getAllProducts() {
         
         
         $sql = "SELECT products.product_id,
                        products.name,
                        products.ean,
                        products.un,
                        product_types.name as product_type_name,
                        categories.name as category_name,
                        products.category,
                        products.quantity,
                        products.price,
                        products.description,
                        products.status,
                        products.type
                  FROM products 
                  LEFT JOIN product_types  ON products.type = product_types.product_type_id
                  LEFT JOIN categories  ON products.category = categories.category_id
                  WHERE products.date_delete IS NULL
                  ORDER BY products.product_id DESC";

         $result = $this->db->query($sql);
         
         $products = [];
         while ($row = $result->fetch()) {
               $products[] = $row;
         }
         return $products;
      }
   
      public function getProductById($id) {

         $sql = "SELECT * FROM products WHERE product_id = $id";
         $result = $this->db->query($sql);
         $product = $result->fetch();
         return $product;
      }
   
      public function addProduct($data) {

         $name = $data['name'];
         $ean = $data['ean'];
         $un = $data['un'];
         $type = $data['type'];
         $category = $data['category'];
         $quantity = $data['quantity'];
         $price = $data['price'];
         $price = preg_replace('/[^0-9]/', '', $price);          
         $price = count(explode(",",$data['price']))> 1 ? bcdiv($price, 100, 2) : $price;
         $price = strtr($price, ',', '.');
         $description = $data['description'];
         $status = (int)$data['status'];
         $date_add = $data['date_add'];

         $validadeEan = $this->validadeEan($ean);

         if($validadeEan > 0){
            return false;
         }

         
         $sql = "INSERT INTO products
                  (name, ean, un, type, category, quantity, price, description, status, date_add)
                  VALUES
                  (:name, :ean, :un, :type, :category, :quantity, :price, :description, :status, :date_add);";
         
         $statement = $this->db->prepare($sql);
         $statement->bindValue(':name', $name);
         $statement->bindValue(':ean', $ean);
         $statement->bindValue(':un', $un);
         $statement->bindValue(':type', $type);
         $statement->bindValue(':category', $category);
         $statement->bindValue(':quantity', $quantity);
         $statement->bindValue(':price', $price);
         $statement->bindValue(':description', $description);
         $statement->bindValue(':status', $status);
         $statement->bindValue(':date_add', $date_add);
         $statement->execute();
         $return = $this->db->lastInsertId();

         
         return $return;
      }
   
      public function updateProduct($data) {

         $product_id = $data['product_id'];
         $name = $data['name'];
         $ean = $data['ean'];
         $un = $data['un'];
         $type = $data['type'];
         $category = $data['category'];
         $quantity = $data['quantity'];
         $price = $data['price'];
         $price = preg_replace('/[^0-9]/', '', $price); 
         $price = count(explode(",",$data['price']))> 1 ? bcdiv($price, 100, 2) : $price;
         $price = strtr($price, ',', '.');
         $description = $data['description'];
         $status = (int)$data['status'];
         $date_update = $data['date_update'];
         
         $sql = "UPDATE products 
                  SET name = :name,
                  ean = :ean,
                  un = :un,
                  type = :type,
                  category = :category,
                  quantity = :quantity,
                  price = :price,
                  description = :description,
                  status = :status,
                  date_update = :date_update
                  WHERE product_id = :product_id
                  ";
         
         $statement = $this->db->prepare($sql);
         $statement->bindValue(':product_id', $product_id);
         $statement->bindValue(':name', $name);
         $statement->bindValue(':ean', $ean);
         $statement->bindValue(':un', $un);
         $statement->bindValue(':type', $type);
         $statement->bindValue(':category', $category);
         $statement->bindValue(':quantity', $quantity);
         $statement->bindValue(':price', $price);
         $statement->bindValue(':description', $description);
         $statement->bindValue(':status', $status);
         $statement->bindValue(':date_update', $date_update);
         $statement->execute();

         
         
         return $statement;
      }

      private function validadeEan($ean){
         $sql = "SELECT count(ean) as total FROM products WHERE ean = '$ean' AND date_delete IS NULL";
         $result = $this->db->query($sql);
         $product = $result->fetch();
         return $product['total'];
      }
   
      public function deleteProduct($id) {
         $date_delete = date('Y-m-d');
         $status= 0;

         $sql = "UPDATE products SET status = :status, date_delete =:date_delete WHERE product_id = :product_id";

         $statement = $this->db->prepare($sql);
         $statement->bindValue(':product_id', $id);
         $statement->bindValue(':date_delete', $date_delete);
         $statement->bindValue(':status', $status);
         $statement->execute();
         return $statement;
      }
}