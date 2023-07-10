<?php

require_once 'Model/OrderModel.php';

class OrderController extends OrderModel
{

   public function __construct()
   {
      parent::__construct();
      session_start();

      if (!isset($_SESSION['user'])) {
         header('Location: login.php');
      }
   }

   public function index()
   {
      $orderModel = new OrderModel();
      $orders = $orderModel->getAllOrders();

      require_once 'View/inc/header.php';
      require_once 'View/Order/index.php';
      require_once 'View/inc/footer.php';
   }

   

   public function add(){

      if ($_POST) {

         $data = [
            'customer_name' => $_POST['customer_name'],
            'customer_document' => $_POST['customer_document'],
            'customer_email' => $_POST['customer_email'],
            'customer_telephone' => $_POST['customer_telephone'],
            'customer_address_zip' => $_POST['customer_address_zip'],
            'customer_address' => $_POST['customer_address'],
            'customer_address_num' => $_POST['customer_address_num'],
            'customer_address_complement' => $_POST['customer_address_complement'],
            'customer_address_district' => $_POST['customer_address_district'],
            'customer_address_city' => $_POST['customer_address_city'],
            'customer_address_zone' => $_POST['customer_address_zone'],
            'payment_method' => $_POST['payment_method'],
            'qnt_items' => $_POST['cartqnt_items'],
            'subtotal' => $_POST['cartsubtotal'],
            'tax' => $_POST['carttax'],
            'total' => $_POST['carttotal'],

         ];
         foreach($_POST["product_id"] as $id){
            $data['products'][] =[
               'product_id' => $id,
               'quantity'=> $_POST['qnt'][$id],
               'price' => $_POST['price'][$id],
               'tax'=> $_POST['tax'][$id],
               
            ];
         }         
         

         $order_id = $this->save($data);
         $data =[];

         if ($order_id) {
             $_SESSION['success'] = "Pedido cadastrado com sucesso";
             $data =[
               "status"=>"success",
               "message"=>"Pedido cadastrado com sucesso",
               "order_id"=>$order_id

             ];
         } else {
               $_SESSION['error'] = "Erro ao cadastrar pedido, verifique os campos obrigatórios ou se o EAN já está cadastrado";
               $data =[
                  "status"=>"error",
                  "message"=>"Pedido cadastrado com sucesso"
                  
               ];
               
               
         }

         print_r(json_encode($data));
         exit;

      }
      require_once 'View/inc/header.php';
      require_once 'View/Order/form.php';
      require_once 'View/inc/footer.php';

   }
   public function view(){
         
         $order_id = $_GET['id'];
         $orderModel = new OrderModel();
         $order = $orderModel->getOrderById($order_id);
         $products = $orderModel->getProductsByOrderId($order_id);
   
         require_once 'View/inc/header.php';
         require_once 'View/Order/view.php';
         require_once 'View/inc/footer.php';
   
   }
   private function save($data){

      $orderModel = new OrderModel();
      $order_id = $orderModel->addOrder($data);

      return $order_id;

      

   }

}