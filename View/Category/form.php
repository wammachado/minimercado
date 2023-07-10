<h1 class="mt-5">Categoria</h1>
<small>(*)campos obrigatorios</small>
<hr>
<form action="" method="post">
   <div class="row">
      <div class="col-2">
         <div class="mb-3">
            <label for="category_id" class="form-label">Codigo:</label>
            <input type="text" class="form-control" id="category_id" name="" value="<?php echo $category_id??$category_id?>" disabled>
            <input type="hidden" name="category_id" value="<?php echo $category_id??$category_id?>">
         </div>
      </div>
      
   </div>
   <div class="row">
      <div class="col-sm-12">
         <div class="mb-3">
            <label for="category_name" class="form-label">*Categoria :</label>
            <input type="text" class="form-control" id="category_name" name="name" value="<?php echo $name??$name?>" required>
         </div>
      </div>      
      <div class="col-3">
         <div class="mb-3 mt-4">
            <div class="form-check">
               <label class="form-check-label h6" for="">
                  Ativo
               </label>
               <input class="form-check-input" type="checkbox" value="1" <?php echo $status == 1 ? "checked" : ""?> id="category_status" name="status">
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-6 text-start">
         <div class="mb-3">
            <a href="index.php?pg=category"  class="btn btn-secondary">Voltar</a>
         </div>
      </div>
      <div class="col-6 text-end">
         <div class="mb-3">
            <button type="submit" class="btn btn-primary">Salvar</button>
         </div>
      </div>
   </div>
</form>