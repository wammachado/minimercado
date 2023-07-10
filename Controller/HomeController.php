<?php

require_once 'Model/ProductModel.php';
require_once 'Model/OrderModel.php';

class HomeController extends ProductModel
{

    public function __construct()
   {
      parent::__construct();
      session_start();

      if(!isset($_SESSION['user'])){
         header('Location: login.php');
      }
   }

    public function index()
    {

        $ordersModel = new OrderModel();
        $orders = $ordersModel->getAllOrders();
        
        require_once 'View/inc/header.php';
        require_once 'View/Order/index.php';
        require_once 'View/inc/footer.php';
    }

    
}
