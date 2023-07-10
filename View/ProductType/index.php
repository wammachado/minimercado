
<h1 class="mt-5">Tipos de Produto</h1>
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
      <a href="?pg=producttype&f=add" class="btn btn-primary">Cadastrar</a>
   </div>
</div>

<div class="table-responsive">

   <table class="table table-striped datadable">
      <thead>
         <tr>
            <th>#</th>            
            <th>Tipo</th>
            <th>Taxa</th>            
            <th>Status</th>
            <th>Ação</th>
         </tr>
      </thead>
      <tbody>
      <?php
      foreach($productTypes as $productType):
      ?>
         <tr>
            <td><?php echo $productType['product_type_id']?></td>            
            <td><?php echo $productType['name']?></td>            
            <td><?php echo number_format($productType['tax'],2,",","")."%"?></td>
            <td>
            <?php 
            if($productType['status'] == 1){
               echo '<span class="badge bg-success">Ativo</span>';
            }else{
               echo '<span class="badge bg-danger">Inativo</span>';
            }
            ?>
            </td>
            
            <td>
               <a href="index.php?pg=producttype&f=edit&id=<?php echo $productType["product_type_id"]?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
               <a href="javascript:void(0)"  data-producttypeid="<?php echo $productType["product_type_id"]?>" class="btn btn-danger exclude_product_type"><i class="fas fa-trash"></i></a>
            </td>
         </tr>
      <?php
      endforeach;
      ?>
      </tbody>
   </table>
</div>