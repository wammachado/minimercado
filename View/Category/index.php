
<h1 class="mt-5">Categorias</h1>
<hr>

<div class="row">

   <div class="col-8 text-start">
      <?php 
      if(isset($_SESSION['success'])){
         echo '<div class="alert alert-success" role="alert">'.$_SESSION['success'].'</div>';
         unset($_SESSION['success']);
      }
      if(isset($_SESSION['error'])){
         echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>';
         unset($_SESSION['error']);
      }
      ?>
   </div>
   <div class="col-4 text-end mb-3">
      <a href="?pg=category&f=add" class="btn btn-primary">Cadastrar</a>
   </div>
</div>

<div class="table-responsive">

   <table class="table table-striped datadable">
      <thead>
         <tr>
            <th>#</th>                        
            <th>Categoria</th>            
            <th>Status</th>
            <th>Ação</th>
         </tr>
      </thead>
      <tbody>
      <?php
      foreach($categories as $category):
      ?>
         <tr>
            <td><?php echo $category['category_id']?></td>            
            <td><?php echo $category['name']?></td>                        
            <td>
            <?php 
            if($category['status'] == 1){
               echo '<span class="badge bg-success">Ativo</span>';
            }else{
               echo '<span class="badge bg-danger">Inativo</span>';
            }
            ?>
            </td>
            
            <td>
               <a href="index.php?pg=category&f=edit&id=<?php echo $category["category_id"]?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
               <a href="javascript:void(0)"  data-categoryid="<?php echo $category["category_id"]?>" class="btn btn-danger exclude_category"><i class="fas fa-trash"></i></a>
            </td>
         </tr>
      <?php
      endforeach;
      ?>
      </tbody>
   </table>
</div>