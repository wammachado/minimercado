<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head> 

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">    
    <title>Login</title>


    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

        
    <!-- Custom styles for this template -->
    <link href="assets/dist/css/sign-in.css" rel="stylesheet">
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">   

    
    
<main class="form-signin w-100 m-auto">
  <form action="login.php" method="post">    
    <h1 class="h3 mb-3 fw-normal">Por favor, efetue login</h1>
    <?php 
    
    if(isset($_SESSION['error']) && $_SESSION['error'] != ''){
        echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>';
         unset($_SESSION['error']);
    }
    ?>
   <p ></p>
    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="nome@email.com" required>
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Senha" required>
      <label for="floatingPassword">Senha</label>
    </div>
    
    <button class="btn btn-primary w-100 py-2" type="submit">Logar</button>
    <p class="mt-5 mb-3 text-body-secondary">&copy; 2023</p>
  </form>
</main>
<script src="assets/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
