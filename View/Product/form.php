<h1 class="mt-5">Cadastro de Produto</h1>
<small>(*)campos obrigatorios</small>
<hr>
<form action="" method="post">
   <div class="row">
      <div class="col-sm-2">
         <div class="mb-3">
            <label for="product_id" class="form-label">Codigo:</label>
            <input type="text" class="form-control" id="product_code" name="" value="<?php echo $product_id??$product_id?>" disabled>
            <input type="hidden" name="product_id" value="<?php echo $product_id??$product_id?>">
         </div>
      </div>
      
   </div>
   <div class="row">
      <div class="col-sm-3">
         <div class="mb-3">
            <label for="product_ean" class="form-label">*EAN:</label>
            <input type="text" class="form-control ean" id="product_ean" name="ean" value="<?php echo $ean??$ean?>"  <?php echo !empty($ean)?"readonly ":""?> required>
         </div>
      </div>
      <div class="col-sm-9">
         <div class="mb-3">
            <label for="product_name" class="form-label">*Nome:</label>
            <input type="text" class="form-control" id="product_name" name="name" value="<?php echo $name??$name?>" required>
         </div>
      </div>
      <div class="col-sm-2">
         <div class="mb-3">
            <label for="product_un" class="form-label">*Un. Medida:</label>
            <select class="form-control" name="un" id="product_un">
               <option value="UN" <?php echo $un == "UN" ? "selected" : "" ?>>UN</option>
               <option value="KG" <?php echo $un == "KG" ? "selected" : "" ?>>KG</option>
               <option value="LT" <?php echo $un == "LT" ? "selected" : "" ?>>LT</option>
            </select>
            
         </div>
      </div>
      <div class="col-sm-3">
         <div class="mb-3">
            <label for="product_type" class="form-label">*Tipo:</label>
            <select class="form-control" name="type" id="product_type">

            <?php foreach($productTypes as $productType): ?>
               <?php if($productType["status"] == 1):  ?>
               <option value="<?php echo $productType["product_type_id"]?>" <?php echo $type == $productType["product_type_id"] ? "selected" : "" ?>><?php echo $productType["name"]?></option>
               <?php endif; ?>
            <?php endforeach; ?>
            
            </select>
            
         </div>
      </div>
      <div class="col-sm-3">
         <div class="mb-3">
            <label for="product_category" class="form-label">*Categoria:</label>
            <select class="form-control" name="category" id="product_category">
            <?php foreach($productCategories as $productCategory): ?>
               <?php if($productCategory["status"] == 1):?>
               <option value="<?php echo $productCategory["category_id"]?>" <?php echo $category == $productCategory["category_id"] ? "selected" : "" ?>><?php echo $productCategory["name"]?></option>
               <?php endif; ?>
            <?php endforeach; ?>
            </select>
            
         </div>
      </div>
      <div class="col-sm-2">
         <div class="mb-3">
            <label for="product_qnt" class="form-label">*Quantidade:</label>
            <input type="text" class="form-control number" id="product_qnt" name="quantity" value="<?php echo $quantity??$quantity?>"  required>
         </div>
      </div>
      <div class="col-sm-2">
         <div class="mb-3">
            <label for="product_price" class="form-label">*Preço(R$):</label>
            <input type="text" class="form-control money2" id="product_price" name="price" value="<?php echo $price??$price?>"  required>
         </div>
      </div>
      
      <div class="col-sm-12">
         <div class="mb-3">
            <label for="product_description" class="form-label">Descrição:</label>
            <textarea class="form-control" name="description" id="product_description" cols="30" rows="10"><?php echo $description??$description?></textarea>
         </div>
      </div>
      <div class="col-sm-3">
         <div class="mb-3 mt-4">
            <div class="form-check">
               <label class="form-check-label h6" for="">
                  Ativo
               </label>
               <input class="form-check-input" type="checkbox" value="1" <?php echo $status == 1 ? "checked" : ""?> id="product_status" name="status">
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-6 text-start">
         <div class="mb-3">
            <a href="index.php?pg=product"  class="btn btn-secondary">Voltar</a>
         </div>
      </div>
      <div class="col-6 text-end">
         <div class="mb-3">
            <button type="submit" class="btn btn-primary">Salvar</button>
         </div>
      </div>
   </div>
</form>