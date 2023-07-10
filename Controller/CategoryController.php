<?php
require_once 'Model/CategoryModel.php';

class CategoryController extends CategoryModel
{
   public function __construct(){
      parent::__construct();
      session_start();

      if(!isset($_SESSION['user'])){
         header('Location: login.php');
      }
   }

    public function index()
    {
        $categories = $this->getAllCategories();
        require_once 'View/inc/header.php';
        require_once 'View/Category/index.php';
        require_once 'View/inc/footer.php';
    }

    public function add()
    { 
      
      if($_POST){
         
         $category_id = $this->save();
         
         if($category_id){
            $_SESSION['success'] = "Categoria cadastrada com sucesso";
            header('Location: index.php?pg=category');
         }else{
            $_SESSION['error'] = "Erro ao cadastrar categoria";
            header('Location: index.php?pg=category');
            
         }
      }

      $category_id = "";
      $name = "";
      $status = "";

      require_once 'View/inc/header.php';
      require_once 'View/Category/form.php';
      require_once 'View/inc/footer.php';

    }

    

    public function edit()
    {

      $categoryModel = new CategoryModel();

      if($_POST){
         
         $category_id = $this->save();
         
         if($category_id){
            $_SESSION['success'] = "Categoria atualizada com sucesso";
            header('Location: index.php?pg=category');
         }else{
            $_SESSION['error'] = "Erro ao atualizar categoria";
            header('Location: index.php?pg=category');
            
         }
      }

         $category_id = $_GET['id'];
         $category = $categoryModel->getCategoryById($category_id);

         $name = $category['name'];
         $status = $category['status'];

         require_once 'View/inc/header.php';
         require_once 'View/Category/form.php';
         require_once 'View/inc/footer.php';


        
        
    }

    public function save()
    {

      $categoryModel = new CategoryModel();

        $name = $_POST['name'];
        $category_id = $_POST["category_id"];
        $status = !isset($_POST['status']) ? 0 : 1;
         
        $data = [
            'name' => $name,
            'status' => $status
        ];

        if(isset($_POST["category_id"]) && !empty($_POST["category_id"])){
            $data['category_id'] = $category_id;
            $data['date_update'] = date('Y-m-d');
            $category_id = $categoryModel->updateCategory($data);
         }else{
            $data['date_add'] = date('Y-m-d');
            $category_id = $categoryModel->addCategory($data);
         }

        
         if($category_id){
            return $category_id;
         }else{
            return false;
         }
    }
    

    public function delete()
    {
      $id = $_GET['id'] ?? $_GET['id'];

      if ($id) {

          $categoryModel = new CategoryModel();
          $delete = $categoryModel->deleteCategory($id);
          if ($delete) {

              $_SESSION['success'] = "Registro deletado com sucesso";
              header('Location: index.php?pg=producttype');
          } else {
              $_SESSION['error'] = "Erro ao deletar registro";
              header('Location: index.php?pg=category');
          }
          header('Location: index.php?pg=category');
      } else {
          header('Location: index.php?pg=category');
      }

  
    }
}