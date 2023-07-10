<h1 class="mt-5">Tipo de Produto</h1>
<small>(*)campos obrigatorios</small>
<hr>
<form action="" method="post">
   <div class="row">
      <div class="col-2">
         <div class="mb-3">
            <label for="product_type_id" class="form-label">Codigo:</label>
            <input type="text" class="form-control" id="product_type_id" name="" value="<?php echo $product_type_id??$product_type_id?>" disabled>
            <input type="hidden" name="product_type_id" value="<?php echo $product_type_id??$product_type_id?>">
         </div>
      </div>
      
   </div>
   <div class="row">
      <div class="col-sm-9">
         <div class="mb-3">
            <label for="product_type_name" class="form-label">*Tipo :</label>
            <input type="text" class="form-control" id="product_type_name" name="name" value="<?php echo $name??$name?>" required>
         </div>
      </div>
      <div class="col-sm-3">
         <div class="mb-3">
            <label for="product_name" class="form-label">*Taxa(%):</label>
            <input type="text" class="form-control money2" id="product_type_tax" name="tax" value="<?php echo $tax??$tax?>" required>
         </div>
      </div>      
      <div class="col-3">
         <div class="mb-3 mt-4">
            <div class="form-check">
               <label class="form-check-label h6" for="">
                  Ativo
               </label>
               <input class="form-check-input" type="checkbox" value="1" <?php echo $status == 1 ? "checked" : ""?> id="product_type_status" name="status">
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-6 text-start">
         <div class="mb-3">
            <a href="index.php?pg=producttype"  class="btn btn-secondary">Voltar</a>
         </div>
      </div>
      <div class="col-6 text-end">
         <div class="mb-3">
            <button type="submit" class="btn btn-primary">Salvar</button>
         </div>
      </div>
   </div>
</form>