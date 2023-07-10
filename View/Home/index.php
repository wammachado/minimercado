
<h1 class="mt-5">Produtos</h1>
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
      <a href="?pg=product&f=add" class="btn btn-primary">Cadastrar</a>
   </div>
</div>

<div class="table-responsive">

   <table class="table table-striped datadable">
      <thead>
         <tr>
            <th>#</th>
            <th>EAN</th>
            <th>Produto</th>
            <th>Tipo</th>
            <th>Categoria</th>
            <th>Estoque</th>
            <th>Preço</th>
            <th>Status</th>
            <th>Ação</th>
         </tr>
      </thead>
      <tbody>
      <?php
      foreach($products as $product):
      ?>
         <tr>
            <td><?php echo $product['product_id']?></td>
            <td><?php echo $product['ean']?></td>
            <td><?php echo $product['name']?></td>
            <td><?php echo $product['type']?></td>
            <td><?php echo $product['category']?></td>
            <td><?php echo $product['quantity']?></td>
            <td><?php echo "R$ ".number_format($product['price'],2,",",".")?></td>
            <td>
            <?php 
            if($product['status'] == 1){
               echo '<span class="badge bg-success">Ativo</span>';
            }else{
               echo '<span class="badge bg-danger">Inativo</span>';
            }
            ?>
            </td>
            
            <td>
               <a href="index.php?pg=product&f=edit&id=<?php echo $product["product_id"]?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
               <a href="javascript:void(0)"  data-productid="<?php echo $product["product_id"]?>" class="btn btn-danger exclude_product"><i class="fas fa-trash"></i></a>
            </td>
         </tr>
      <?php
      endforeach;
      ?>
      </tbody>
   </table>
</div>