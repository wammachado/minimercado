<?php
require_once 'Controller/HomeController.php';
?>
<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">
  <head>

     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="">     
     <title>Mercado</title>

     <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- <script src="assets/js/color-modes.js"></script> -->

    <!-- Custom styles for this template -->
    <link href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="assets/dist/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="assets/dist/css/general.css" rel="stylesheet">


   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>


  </head>
  <body class="d-flex flex-column h-100">

<header class="d-print-none">
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Mercado</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          
          <li class="nav-item">
            <a class="nav-link" href="index.php?pg=product">Produtos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?pg=producttype">Tipos de produtos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?pg=category">Categorias de produtos</a>
          </li>
        </ul>        
        <ul class="navbar-nav text-end mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link " href="/prova/login.php?pg=login&f=logout">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">
