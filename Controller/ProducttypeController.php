<?php

require_once 'Model/ProducttypeModel.php';

class ProducttypeController extends ProducttypeModel{

   public function __construct()
   {
      parent::__construct();
      session_start();

      if(!isset($_SESSION['user'])){
         header('Location: login.php');
      }
   }

   public function index(){
      $productTypeModel = new ProducttypeModel();
      $productTypes = $productTypeModel->getAllProductTypes();
      
      require_once 'View/inc/header.php';
      require_once 'View/ProductType/index.php';
      require_once 'View/inc/footer.php';
   }

   public function add(){
         
         
   
         if($_POST){
            
            $product_type_id = $this->save();
            
            if($product_type_id){
               $_SESSION['success'] = "Tipo de produto cadastrado com sucesso";
               header('Location: index.php?pg=producttype');
            }else{
               $_SESSION['error'] = "Erro ao cadastrar tipo de produto";
               header('Location: index.php?pg=producttype');
               
            }
         }
   
         $product_type_id = "";
         $name = "";
         $tax = "";
         $status = "";
   
         require_once 'View/inc/header.php';
         require_once 'View/ProductType/form.php';
         require_once 'View/inc/footer.php';
   }

   public function edit(){
      $productTypeModel = new ProducttypeModel();

      if($_POST){
         
         $product_type_id = $this->save();
         
         if($product_type_id){
            $_SESSION['success'] = "Tipo de produto atualizado com sucesso";
            header('Location: index.php?pg=producttype');
         }else{
            $_SESSION['error'] = "Erro ao atualizar tipo de produto";
            header('Location: index.php?pg=producttype');
            
         }
      }

      $product_type_id = $_GET['id'];
      $productType = $productTypeModel->getProductTypeById($product_type_id);

      $name = $productType['name'];
      $tax = number_format($productType['tax'], 2, ',', '.');
      $status = $productType['status'];

      require_once 'View/inc/header.php';
      require_once 'View/ProductType/form.php';
      require_once 'View/inc/footer.php';
   }

   public function save(){
      $productTypeModel = new ProducttypeModel();

      $product_type_id = $_POST['product_type_id'];
      $name = $_POST['name'];
      $tax = $_POST['tax'];
      $status = !isset($_POST['status']) ? 0 : 1;

      $data = [
         'name' => $name,
         'tax' => $tax,
         'status' => $status,
         
      ];
      if(isset($_POST['product_type_id']) && !empty($_POST['product_type_id'])){
         
         $data['product_type_id'] = $_POST['product_type_id'];
         $data['date_update'] = date('Y-m-d');
         $product_type_id = $productTypeModel->updateProductType($data);
      }else{
         $data['date_add'] = date('Y-m-d');
         $product_type_id = $productTypeModel->addProductType($data);
      }

      if($product_type_id){
         return $product_type_id;
      }else{
         return false;
      }
      
   }

   public function delete(){
         $id = $_GET['id'] ?? $_GET['id'];

        if ($id) {

            $productTypeModel = new ProducttypeModel();
            $delete = $productTypeModel->deleteProductType($id);
            if ($delete) {

                $_SESSION['success'] = "Registro deletado com sucesso";
                header('Location: index.php?pg=producttype');
            } else {
                $_SESSION['error'] = "Erro ao deletar registro";
                header('Location: index.php?pg=producttype');
            }
            header('Location: index.php?pg=producttype');
        } else {
            header('Location: index.php?pg=producttype');
        }

    }
   
}

