<?php

$pg = $_GET['pg'];
$f = $_GET['f'];

if(!isset($pg)){
  $pg = "Home";
  $controller = "{$pg}Controller";
}else{
  $pg = ucfirst($pg);
  $controller = "{$pg}Controller";
}
if(!isset($f)){
  $f = "index";
}

if(!file_exists("Controller/{$controller}.php")){
  $controller = "ErrorController";
  $f = "pageNotFound";
  
}

require_once "Controller/{$controller}.php";

$returnpage = new $controller();

if(!method_exists($returnpage, $f)){
  $f = "index";
}

$returnpage->$f();
