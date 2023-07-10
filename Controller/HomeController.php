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

    public function add()
    {

        
        require_once 'View/Home/add.php';
    }

    public function save()
    {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $result = $this->addProduct($name, $price, $description);
        if ($result) {
            header('Location: index.php');
        } else {
            echo "Error";
        }
    }

    public function edit()
    {
        $id = $_GET['id'];
        $product = $this->getProductById($id);
        require_once 'View/Home/edit.php';
    }

    public function update()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $result = $this->updateProduct($id, $name, $price, $description);
        if ($result) {
            header('Location: index.php');
        } else {
            echo "Error";
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        $result = $this->deleteProduct($id);
        if ($result) {
            header('Location: index.php');
        } else {
            echo "Error";
        }
    }
}
