<?php
ini_set('display_errors', 0);

class Config {

   private $db_server = 'localhost';
   private $db_username = 'webnobre_userprova';
   private $db_password = 'Asdf@2023';
   private $db_name = 'webnobre_prova';
   private $db_port = '5432';

   public function __construct() {
       
   }
   
   public function con(){

       $db_server = $this->db_server;
       $db_username = $this->db_username;
       $db_password = $this->db_password;
       $db_name = $this->db_name;
       $db_port = $this->db_port;

      $conn =  new PDO("pgsql:host=$db_server;port=$db_port;dbname=$db_name", $db_username, $db_password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

      return $conn;


    }


}
