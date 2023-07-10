<form action="" method="post" id="formcheckout">
<h1 class="mt-5">Pedido</h1>
<hr>
   <div class="row">
      <div class="col-sm-9">         
         <span class="text-muted small text-info-emphasis">Busque por EAN ou nome</span>
            <div class="mb-3 form-floating">            
               <input type="text" autocomplete="off" class="form-control" id="searchproduct" name="name" placeholder="Buscar produto">
               <label for="searchproduct">Buscar produto</label>            
            </div>
            <div id="resultsearch" hidden></div>
      </div>      
   </div>
   <div class="row">
      <div class="col-sm-9">
         <hr>
         <div class="table-responsive">
            <table class="table table-striped " id="cartitems">
               <thead>
                  <tr>
                     <th>
                        Produto
                     </th>
                     <th>
                        Quantidade
                     </th>
                     <th>
                        Preço un.
                     </th>
                     <th>
                        Imposto
                     </th>
                     <th>
                        Preço total
                     </th>
                     <th>
                        #
                     </th>
                  </tr>
               </thead>
               <tbody>

               </tbody>
            </table>
         </div>
      </div>
      <div class="col-sm-3">
         <div class="card">
            <div class="card-header">
               Total do pedido
            </div>
            <div class="card-body">
            <ul class="list-group list-group-flush">
               <li class="list-group-item"><b>Qnt Itens:</b><input type="hidden" name="cartqnt_items" value=""><span class="float-end" id="cartqntitens">0</span></li>
               <li class="list-group-item"><b>Subtotal:</b><input type="hidden" name="cartsubtotal" value=""><span class="float-end" id="cartsubtotal">0</span></li>
               <li class="list-group-item"><b>Impostos:</b><input type="hidden" name="carttax" value=""><span class="float-end" id="carttax">0</span></li>
               <li class="list-group-item"><b>Total:</b><input type="hidden" name="carttotal" value=""><span class="float-end" id="carttotal">0</span></li>
            </ul>

            </div>
            <div class="card-footer d-grid gap-2">
            <a class="btn btn-primary btn-block" id="btnopenmodal"><i class="fas fa-cash-register"></i> Finalizar Pedido</a>
            </div>
         </div>
         
      </div>
   </div>
   <div class="row">
      <div class="col-6 text-start">
         <div class="mb-3">
            <a href="index.php"  class="btn btn-secondary">Voltar</a>
         </div>
      </div>
      <div class="col-6 text-end">
         <div class="mb-3">
        
         </div>
      </div>
   </div>

   <!-- Modal -->
<div class="modal fade modal-lg" id="modalcheckout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Finalizar Pedido</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div class="row">

            <div class="col-sm-12">
               <div class="mb-3 mt-4">
                  <div class="form-check form-switch">
                     <input class="form-check-input" type="checkbox" role="switch" id="checkclient">
                     <label class="form-check-label" for="checkclient">Informar dados do cliente</label>
                  </div>
               </div>
            </div>

         </div>
         <div class="row" id="clientdata" hidden>
               
               <div class="col-sm-8">
                  <div class="mb-3 form-floating">
                     <input type="text" class="form-control" id="clientname" name="customer_name" placeholder="Nome do cliente">
                     <label for="clientname" class="form-label">*Nome</label>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="mb-3 form-floating">
                     <input type="text" class="form-control cpf" id="clientdocument" name="customer_document" placeholder="CPF do cliente">
                     <label for="clientphone" class="form-label">*CPF</label>
                  </div>
               </div>
               <div class="col-sm-8">
                  <div class="mb-3 form-floating">
                     <input type="email" class="form-control" id="clientemail" name="customer_email" placeholder="E-mail do cliente">
                     <label for="clientemail" class="form-label">E-mail</label>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="mb-3 form-floating">
                     <input type="text" class="form-control phone_with_ddd" id="clientphone" name="customer_telephone" placeholder="Telefone do cliente">
                     <label for="clientphone" class="form-label">Telefone</label>
                  </div>
               </div>
               <div class="col-sm-3">
                  <div class="mb-3 form-floating">
                     <input type="text" class="form-control cep" id="clientzipcode" name="customer_address_zip" placeholder="CEP do cliente">
                     <label for="clientzipcode" class="form-label">CEP</label>
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="mb-3 form-floating">
                     <input type="text" class="form-control" id="clientaddress" name="customer_address" placeholder="Endereço do cliente">
                     <label for="clientaddress" class="form-label">Endereço</label>
                  </div>
               </div>
               <div class="col-sm-3">
                  <div class="mb-3 form-floating">
                     <input type="text" class="form-control number" id="clientnumber" name="customer_address_num" placeholder="Número do cliente">
                     <label for="clientnumber" class="form-label">Número</label>
                  </div>
               </div>
               <div class="col-sm-2">
                  <div class="mb-3 form-floating">
                     <input type="text" class="form-control" id="clientcomplement" name="customer_address_complement" placeholder="Complemento do cliente">
                     <label for="clientcomplement" class="form-label">Compl.</label>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="mb-3 form-floating">
                     <input type="text" class="form-control" id="clientdistrict" name="customer_address_district" placeholder="Bairro do cliente">
                     <label for="clientdistrict" class="form-label">Bairro</label>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="mb-3 form-floating">
                     <input type="text" class="form-control" id="clientcity" name="customer_address_city" placeholder="Cidade do cliente">
                     <label for="clientcity" class="form-label">Cidade</label>
                  </div>
               </div>
               <div class="col-sm-2">
                  <div class="mb-3 form-floating">
                     <input type="text" class="form-control" id="clientstate" name="customer_address_zone" placeholder="Estado do cliente">
                     <label for="clientstate" class="form-label">Estado</label>
                  </div>
               </div>

         </div>
         <div class="row">

            <div class="col-sm-12">
               <h3>Formas de pagamento:</h3>
               <hr>
               <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="payment_method" id="method_money" value="Dinheiro">
                  <label class="form-check-label" for="method_money">Dinheiro</label>
               </div>
               <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="payment_method" id="method_pix" value="PIX">
                  <label class="form-check-label" for="method_pix">PIX</label>
               </div>
               <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="payment_method" id="method_credit" value="Cartão de Crédito">
                  <label class="form-check-label" for="method_credit">Cartão (Crédito)</label>
               </div>
               <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="payment_method" id="method_debit" value="Cartão de Débito">
                  <label class="form-check-label" for="method_debit">Cartão (Débito)</label>
               </div>
            </div>
         </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <a type="button" id="saveorder" class="btn btn-primary">Salvar Pedido</a>
      </div>
    </div>
  </div>
</div>
</form>