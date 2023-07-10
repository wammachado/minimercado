<?php

require_once 'Model/ProductModel.php';
require_once 'Model/ProducttypeModel.php';
require_once 'Model/CategoryModel.php';

class ProductController extends ProductModel
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
        $productModel = new ProductModel();
        $products = $productModel->getAllProducts();        

        require_once 'View/inc/header.php';
        require_once 'View/Product/index.php';
        require_once 'View/inc/footer.php';
    }

    public function ajaxSearch(){

        $search = $_POST['search'];

        $productModel = new ProductModel();
        $products = $productModel->getProductsBySearch($search);

        if($products){
            $data = [
                'status' => true,
                'products' => $products
            ];
            
        }else{
            $data = [
                'status' => false,
                'products' => []
            ];            
            
        }

        print_r(json_encode($data));
        
     }

    public function add()
    {

        
        $productTypesModel = new ProducttypeModel();
        $categoryModel = new CategoryModel();

        if ($_POST) {

            $product_id = $this->save();

            if ($product_id) {
                $_SESSION['success'] = "Produto cadastrado com sucesso";
                header('Location: index.php?pg=product');
            } else {
                $_SESSION['error'] = "Erro ao cadastrar produto, verifique os campos obrigatórios ou se o EAN já está cadastrado";
                header('Location: index.php?pg=product');

            }
        }

        $product_id = "";
        $name = "";
        $ean = "";
        $un = "";
        $type = "";
        $category = "";
        $quantity = "";
        $price = "";
        $description = "";
        $status = "";

        $productTypes = $productTypesModel->getAllProductTypes();
        $productCategories = $categoryModel->getAllCategories();

        require_once 'View/inc/header.php';
        require_once 'View/Product/form.php';
        require_once 'View/inc/footer.php';
    }
    public function edit()
    {

      $productTypesModel = new ProducttypeModel();
      $categoryModel = new CategoryModel();

        $id = $_GET['id'] ?? $_GET['id'];

        if ($_POST) {

            $product_id = $this->save();

            if ($product_id) {
                $_SESSION['success'] = "Produto editado com sucesso";
                header('Location: index.php?pg=product');
            } else {
                $_SESSION['error'] = "Erro ao editar produto";
                header('Location: index.php?pg=product');

            }
        }

        if ($id) {
            $productModel = new ProductModel();
            $product = $productModel->getProductById($id);
            $product_id = $product['product_id'];
            $name = $product['name'];
            $ean = $product['ean'];
            $un = $product['un'];
            $type = $product['type'];
            $category = $product['category'];
            $quantity = $product['quantity'];
            $price = number_format($product['price'], 2, ',', '.');
            $description = $product['description'];
            $status = $product['status'];
        }

        $productTypes = $productTypesModel->getAllProductTypes();
        $productCategories = $categoryModel->getAllCategories();

        require_once 'View/inc/header.php';
        require_once 'View/Product/form.php';
        require_once 'View/inc/footer.php';

    }

    private function save()
    {
        
        $data = [
            "name" => $_POST['name'],
            "ean" => $_POST['ean'],
            "un" => $_POST['un'],
            "type" => $_POST['type'],
            "category" => $_POST['category'],
            "quantity" => $_POST['quantity'],
            "price" => $_POST['price'],
            "description" => $_POST['description'],
            "status" => !isset($_POST['status']) ? 0 : 1,
        ];

        $product_id = false;
        $productModel = new ProductModel();

        if (isset($_POST['product_id']) && $_POST['product_id'] != "") {
            
            $data['product_id'] = $_POST['product_id'];
            $data['date_update'] = date('Y-m-d');
            $product_id = $productModel->updateProduct($data);
         } else {
           
            $data['date_add'] = date('Y-m-d');
            $product_id = $productModel->addProduct($data);
        }

        if ($product_id) {
            return $product_id;
        } else {
            return false;
        }

    }
    public function delete()
    {

        $id = $_GET['id'] ?? $_GET['id'];

        if ($id) {

            $productModel = new ProductModel();
            $delete = $productModel->deleteProduct($id);
            if ($delete) {

                $_SESSION['success'] = "Produto deletado com sucesso";
                header('Location: index.php');
            } else {
                $_SESSION['error'] = "Erro ao deletar produto";
                header('Location: index.php');
            }
            header('Location: index.php');
        } else {
            header('Location: index.php');
        }

    }

}
