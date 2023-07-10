<?php

$pg = $_GET['pg'];
$f = $_GET['f'];

if(!isset($pg)){
  $pg = "Login";
  $controller = "{$pg}Controller";
}else{
  $pg = ucfirst($pg);
  $controller = "{$pg}Controller";
}
if(!isset($f)){
  $f = "index";
}

require_once "Controller/{$controller}.php";

$returnpage = new $controller();

$returnpage->$f();