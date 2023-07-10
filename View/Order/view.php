<div class="card">
  <div class="card-body">
    <div class="container mb-5 mt-3">
      <div class="row d-flex align-items-baseline">
        <div class="col-xl-9">
          <p style="color: #7e8d9f;font-size: 20px;">Pedido >> <strong><?php echo $order['order_id']?></strong></p>
        </div>
        <div class="col-xl-3 float-end">
                 
        </div>
        <hr>
      </div>

      <div class="container">
        <div class="col-md-12">
          <div class="text-center">            
            <p class="pt-0">MERCADO</p>
          </div>

        </div>


        <div class="row">
          <div class="col-xl-8">
            <ul class="list-unstyled">
              <li class="text-muted">Cliente: <span style="color:#5d9fc5 ;"><?php echo $order['customer_name']?></span></li>
              <li class="text-muted"><?php echo $order['customer_address']?></li>
              <li class="text-muted"><?php echo $order['customer_address_city']?></li>
              <li class="text-muted"><i class="fas fa-id-card"></i> <?php echo $order['customer_document']?></li>
              <li class="text-muted"><i class="fas fa-phone"></i> <?php echo $order['customer_telephone']?></li>
            </ul>
          </div>
          <div class="col-xl-4">
            <p class="text-muted">Fatura</p>
            <ul class="list-unstyled">
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">ID:</span>#<?php echo $order['order_id']?></li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">Data: </span><?php echo date("d/m/Y",strtotime($order['date_add']))?></li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="me-1 fw-bold">Forma de Pagto:</span><span class="badge bg-warning text-black fw-bold">
                  <?php echo $order['payment_method']?></span></li>
            </ul>
          </div>
        </div>

        <div class="row my-2 mx-1 justify-content-center">
          <table class="table table-striped table-borderless">
            <thead style="background-color:#84B0CA ;" class="text-white">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Item</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Preço un.</th>
                <th scope="col">Imposto</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
               <?php foreach($products as $product):?>
                  <tr>
                     <th scope="row"><?php echo $product['ean']?></th>
                     <td><?php echo $product['name']?></td>
                     <td><?php echo $product['quantity']?></td>
                     <td>R$<?php echo number_format($product['price'],2,",",".")?></td>
                     <td>R$<?php echo number_format($product['tax'],2,",",".")?></td>
                     <td>R$<?php echo number_format($product['total'],2,",",".")?></td>
                  </tr>
               <?php endforeach;?>
              
            </tbody>

          </table>
        </div>
        <div class="row">
          <div class="col-xl-9">
            <p class="ms-3"></p>

          </div>
          <div class="col-xl-3">            
              <p class="text-muted ms-3 text-end"><span class="text-black me-4">SubTotal</span>R$ <?php echo number_format($order['cartsubtotal'],2,",",".")?></p>
              <p class="text-muted ms-3 mt-2 text-end"><span class="text-black me-4">Imposto</span>R$ <?php echo number_format($order['carttax'],2,",",".")?></p>
            
            <p class="text-black float-end"><span class="text-black me-3"> Total</span><span style="font-size: 25px;">R$<?php echo number_format($order['carttotal'],2,",",".")?></span></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-xl-10">
            <p>Obrigado pela sua compra, volte sempre.</p>
          </div>
          <div class="col-xl-2">
          </div>
        </div>
        <div class="row">
         <div class="col-sm-12 text-center d-print-none">
            <a onclick="window.print()" class="btn btn-light text-capitalize border-0" ><i class="fas fa-print text-primary"></i> Imprimir</a>   
         </div>
        </div>

      </div>
    </div>
  </div>
</div>