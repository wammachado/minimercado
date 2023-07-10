<?php

require_once 'Model/LoginModel.php';

class LoginController extends LoginModel{

   public function __construct(){
      parent::__construct();
      session_start();
      
   }


   public function index(){
      

      if($_POST){         
         $this->login();
      }elseif(isset($_SESSION['user'])){
         header('Location: index.php');
      }else{
         require_once 'View/Login/index.php';
      }

      
   }

   private function login(){

      $loginModel = new LoginModel();
      

      if($_POST){
         $data=[
            "email"=>$_POST['email'],
            "password"=>$_POST['password']
         ];

         $user = $loginModel->loginUser($data);

         if(password_verify($data['password'], $user['password'])){
            $loginModel->updPass($data);
            $login = true;
         }else{
            $login = false;
         }
         
         

         if($login){
            
            $_SESSION['user'] = $user;
            header('Location: index.php');
         }else{            

            $_SESSION['error'] = "Email ou senha envalidos";
            
            header('Location: login.php');
         }
      }else{
         header('Location: login.php');
      }

   }

   public function logout(){

      session_destroy();
      header('Location: index.php');

   }

}