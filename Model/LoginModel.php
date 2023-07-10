<?php

require_once 'Config/config.php';

class LoginModel extends Config{

   public function __construct(){

      $config = new Config();
      $this->db = $config->con();

   }

   public function loginUser($data){
      

      $email = $data['email'];
      $password = $data['password'];

      //$password = password_hash($password, PASSWORD_DEFAULT);         
      
      $sql = "SELECT * FROM users WHERE email = :email";
      
      $statement = $this->db->prepare($sql);
      $statement->bindValue(':email', $email);
      $statement->execute();
      $result = $statement->fetch();
      
      
      if($result){
         $user = $result;
      }else{
         $user = false;
      }
      return $user;      
   }

   public function updPass($data){

      $email = $data['email'];
      $password = $data['password'];
      $password = password_hash($password, PASSWORD_DEFAULT);
      $last_login = date('Y-m-d');
      $last_ip = $_SERVER['REMOTE_ADDR'];
      
      $sql = "UPDATE users SET password = :password, last_login = :last_login, last_ip = :last_ip WHERE email = :email";
      
      $statement = $this->db->prepare($sql);
      $statement->bindValue(':email', $email);
      $statement->bindValue(':password', $password);
      $statement->bindValue(':last_login', $last_login);
      $statement->bindValue(':last_ip', $last_ip);
      $result = $statement->execute();

   }
}