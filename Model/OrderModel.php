<?php

require_once 'Config/config.php';
require_once 'Model/ProductModel.php';

class OrderModel extends config
{
   public function __construct()
   {
      $config = new Config();
      $this->db = $config->con();
   }

   public function getAllOrders()
   {
      $sql = "SELECT orders.order_id,
                     orders.customer_name,
                     orders.customer_document,
                     orders.customer_email,
                     orders.customer_telephone,
                     orders.customer_address_zip,
                     orders.customer_address,
                     orders.customer_address_num,                     
                     orders.customer_address_district,
                     orders.customer_address_city,
                     orders.customer_address_zone,
                     orders.payment_method,
                     orders.qnt_items as cartqnt_items,
                     orders.subtotal as cartsubtotal,
                     orders.tax as carttax,
                     orders.total   as carttotal,
                     orders.date_add
                     FROM orders 
                   WHERE orders.date_delete IS NULL 
                   ORDER BY orders.date_add DESC";

      $result = $this->db->query($sql);

      $orders = [];
      while ($row = $result->fetch()) {
         $orders[] = $row;
      }
      return $orders;
   }

   public function getOrderById($id)
   {
      $sql = "SELECT 
               orders.order_id,
               orders.customer_name,
               orders.customer_document,
               orders.customer_email,
               orders.customer_telephone,
               orders.customer_address_zip,
               orders.customer_address,
               orders.customer_address_num,                     
               orders.customer_address_district,
               orders.customer_address_city,
               orders.customer_address_zone,
               orders.payment_method,
               orders.qnt_items as cartqnt_items,
               orders.subtotal as cartsubtotal,
               orders.tax as carttax,
               orders.total   as carttotal,
               orders.date_add
               FROM orders 
               WHERE orders.order_id = $id";

      $result = $this->db->query($sql);
      $order = $result->fetch();
      return $order;
   }

   public function getProductsByOrderId($id)
   {
      $sql = "SELECT * from order_products WHERE order_id = $id";

      $result = $this->db->query($sql);

      $products = [];
      while ($row = $result->fetch()) {
         $products[] = $row;
      }
      return $products;
   }

   public function addOrder($data){

      $customer_name = $data['customer_name'];
      $customer_document = $data['customer_document'];
      $customer_email = $data['customer_email'];
      $customer_telephone = $data['customer_telephone'];
      $customer_address_zip = $data['customer_address_zip'];
      $customer_address = $data['customer_address'];
      $customer_address_num = $data['customer_address_num'];
      $customer_address_complement = $data['customer_address_complement'];
      $customer_address_district = $data['customer_address_district'];
      $customer_address_city = $data['customer_address_city'];
      $customer_address_zone = $data['customer_address_zone'];
      $payment_method = $data['payment_method'];
      $date_add = date('Y-m-d');
      $qnt_items = $data['qnt_items'];
      
      $subtotal = $data['subtotal'];
      $subtotal = preg_replace('/[^0-9]/', '', $subtotal); 
      $subtotal = count(explode(",",$data['subtotal']))> 1 ? bcdiv($subtotal, 100, 2) : $subtotal;
      $subtotal = strtr($subtotal, ',', '.');
      

      $tax = $data['tax'];      
      $tax = preg_replace('/[^0-9]/', '', $tax); 
      $tax = count(explode(",",$data['tax']))> 1 ? bcdiv($tax, 100, 2) : $tax;
      $tax = strtr($tax, ',', '.');

      $total = $data['total'];
      $total = preg_replace('/[^0-9]/', '', $total); 
      $total = count(explode(",",$data['total']))> 1 ? bcdiv($total, 100, 2) : $total;
      $total = strtr($total, ',', '.');

      $status = 1;

      $products = $data['products'];

      $sql = "INSERT INTO orders 
               (customer_name, 
               customer_document, 
               customer_email, 
               customer_telephone, 
               customer_address_zip, 
               customer_address, 
               customer_address_num, 
               customer_address_district, 
               customer_address_city, 
               customer_address_zone, 
               payment_method, 
               date_add, 
               status,
               qnt_items,
               subtotal,
               tax,
               total)
               VALUES
               (:customer_name, 
               :customer_document, 
               :customer_email, 
               :customer_telephone, 
               :customer_address_zip, 
               :customer_address, 
               :customer_address_num, 
               :customer_address_district, 
               :customer_address_city, 
               :customer_address_zone, 
               :payment_method, 
               :date_add, 
               :status,
               :qnt_items,
               :subtotal,
               :tax,
               :total)";

      $statement = $this->db->prepare($sql);
      $statement->bindValue(':customer_name', $customer_name);
      $statement->bindValue(':customer_document', $customer_document);
      $statement->bindValue(':customer_email', $customer_email);
      $statement->bindValue(':customer_telephone', $customer_telephone);
      $statement->bindValue(':customer_address_zip', $customer_address_zip);
      $statement->bindValue(':customer_address', $customer_address);
      $statement->bindValue(':customer_address_num', $customer_address_num);      
      $statement->bindValue(':customer_address_district', $customer_address_district);
      $statement->bindValue(':customer_address_city', $customer_address_city);
      $statement->bindValue(':customer_address_zone', $customer_address_zone);
      $statement->bindValue(':payment_method', $payment_method);
      $statement->bindValue(':date_add', $date_add);
      $statement->bindValue(':status', $status);
      $statement->bindValue(':qnt_items', $qnt_items);
      $statement->bindValue(':subtotal', $subtotal);
      $statement->bindValue(':tax', $tax);
      $statement->bindValue(':total', $total);
      $statement->execute();

      $order_id = $this->db->lastInsertId();

      if($order_id){
         foreach ($products as $product) {
            $order_product_id = $this->addOrderProduct($product, $order_id);            
            if(!$order_product_id){
               $this->deleteOrder($order_id);
               $return = false;
            }else{
               $return = true;
            }
         }
      }

      if($return){
         return $order_id;
      }else{
         return false;
      }



   }
   private function addOrderProduct($data_product, $order_id){
      
      $productModel = new ProductModel();
      $product = $productModel->getProductById($data_product['product_id']);
      
      $product_id = $data_product['product_id'];
      $product_name = $product['name'];
      $ean = $product['ean'];
      $product_price = $data_product['price'];
      
      $product_price = preg_replace('/[^0-9]/', '', $product_price);      
      $product_price = count(explode(",",$data_product['price']))> 1 ? bcdiv($product_price, 100, 2) : $product_price;
      $product_price = strtr($product_price, ',', '.');
      $quantity = $data_product['quantity'];
      $tax = $data_product['tax'];      
      $tax = preg_replace('/[^0-9]/', '', $tax);
      $tax = count(explode(",",$data_product['tax']))> 1 ? bcdiv($tax, 100, 2) : $tax;
      $tax = strtr($tax, ',', '.');
      $total = ((float)$product_price * (int)$quantity) + (float)$tax;
      

      $sql = "INSERT INTO order_products 
               (order_id, 
               product_id, 
               name, 
               ean, 
               price, 
               quantity, 
               tax, 
               total)
               VALUES
               (:order_id, 
               :product_id, 
               :product_name, 
               :ean, 
               :price, 
               :quantity, 
               :tax, 
               :total)";

      $statement = $this->db->prepare($sql);
      $statement->bindValue(':order_id', $order_id);
      $statement->bindValue(':product_id', $product_id);
      $statement->bindValue(':product_name', $product_name);
      $statement->bindValue(':ean', $ean);
      $statement->bindValue(':price', $product_price);
      $statement->bindValue(':quantity', $quantity);
      $statement->bindValue(':tax', $tax);
      $statement->bindValue(':total', $total);
      $statement->execute();

      $order_product_id = $this->db->lastInsertId();

      return $order_product_id;

   }

   public function deleteOrder($id){

      $sql = "DELETE FROM orders WHERE order_id = :id";
      $statement = $this->db->prepare($sql);
      $statement->bindValue(':id', $id);
      $statement->execute();
   }
}