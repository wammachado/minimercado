
<h1 class="mt-5">Pedidos</h1>
<hr>

<div class="row">

   <div class="col-8 text-start">
      <?php 
      if(isset($_SESSION['success'])){
         echo '<div class="alert alert-success" role="alert"><span class="small">'.$_SESSION['success'].'</span></div>';
         unset($_SESSION['success']);
      }
      if(isset($_SESSION['error'])){
         echo '<div class="alert alert-danger" role="alert"><span class="small">'.$_SESSION['error'].'</span></div>';
         unset($_SESSION['error']);
      }
      ?>
   </div>
   <div class="col-4 text-end mb-3">
      <a href="?pg=order&f=add" class="btn btn-primary"><i class="fas fa-cart-plus"></i> Novo Pedido</a>
   </div>
</div>

<div class="table-responsive">

   <table class="table table-striped datadable">
      <thead>
         <tr>            
            <th>Pedido</th>
            <th>Cliente</th>
            <th>Quantidade</th>
            <th>Subtotal</th>
            <th>Imposto</th>
            <th>Total</th>            
            <th>Forma Pagto</th>            
            <th>Data</th>
            <th>Ação</th>
         </tr>
      </thead>
      <tbody>
      <?php
      foreach($orders as $order):
      ?>
         <tr>
            <td><?php echo $order['order_id']?></td>
            <td><?php echo $order['customer_name']?></td>
            <td><?php echo $order['cartqnt_items']?></td>
            <td><?php echo "R$ ".number_format($order['cartsubtotal'],2,",",".")?></td>
            <td><?php echo "R$ ".number_format($order['carttax'],2,",",".")?></td>
            <td><?php echo "R$ ".number_format($order['carttotal'],2,",",".")?></td>
            <td><?php echo $order['payment_method']?></td>
            <td><?php echo date("d/m/Y", strtotime($order['date_add']))?></td>            
            
            
            <td>
               <a href="index.php?pg=order&f=view&id=<?php echo $order["order_id"]?>" class="btn btn-primary"><i class="fas fa-search"></i></a>               
            </td>
         </tr>
      <?php
      endforeach;
      ?>
      </tbody>
   </table>
</div>