<?php

class ErrorController{

   public function pageNotFound(){

      require 'View/inc/header.php';
      require 'View/Error/404.php';
      require 'View/inc/footer.php';
      
   }
}