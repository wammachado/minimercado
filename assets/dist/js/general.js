$(document).ready(function(){

   $(".exclude_product").on("click", function(){
      if(confirm("Deseja realmente excluir registro?")){
         $url = "index.php?pg=product&f=delete&id="+$(this).data("productid");
         window.location.href = $url;
      }else{
         return false;
      }
   })
   $(".exclude_product_type").on("click", function(){
      if(confirm("Deseja realmente excluir este registro?")){
         $url = "index.php?pg=producttype&f=delete&id="+$(this).data("producttypeid");
         window.location.href = $url;
      }else{
         return false;
      }
   })
   $(".exclude_category").on("click", function(){
      if(confirm("Deseja realmente excluir este registro?")){
         $url = "index.php?pg=category&f=delete&id="+$(this).data("categoryid");
         window.location.href = $url;
      }else{
         return false;
      }
   })

   $(".alert").delay(3000).fadeOut("slow");

   $('.datadable').DataTable(
      {      
         language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.5/i18n/pt-BR.json',
      },
      }
   );

   $("#searchproduct").on("keyup", function() {
      var search = $(this).val();
      $("#resultsearch").removeAttr("hidden");
      $("#resultsearch").html("Buscando...");
      if(search.length >= 3 ){
         $.ajax({
            url: "index.php?pg=product&f=ajaxSearch",
            type: "POST",
            data: {search:search},
            dataType: "json",
            success: function(data){
               
               if(data.status){
                  console.log(data);                  
                  html = "";
                  html += "<ul>";
                  
                  $.each(data.products, function(key, value){
                     html += "<li onclick='addcartitem(this)' data-id='"+value.product_id+"' data-name='"+value.name+"' data-qnt='"+value.quantity+"'  data-price='"+value.price+"' data-tax='"+value.tax+"'>"+value.product_id+" - "+value.ean+" - "+value.name+"<span class='float-end badge text-bg-success text-small'><i class='fas fa-plus'></i>Add Item</span></li>";
                  })
                  html += "</ul>";
                  $("#resultsearch").removeAttr("hidden");
                  $("#resultsearch").html(html);
               }else{
                  $("#resultsearch").html("Nenhum item Encontrado");
               }
            }
         })
      }else{
         $("#resultsearch").html("");
         $("#resultsearch").attr("hidden", "hidden");
      }
      
   })

   $("#btnopenmodal").on("click", function(){

      if($("#cartitems tbody tr").length > 0){
         $("#modalcheckout").modal("show");
      }else{
         alert("Adicione itens ao carrinho");
      }
   });

   $("#checkclient").on("click", function(){
      if($(this).is(":checked")){
         $("#clientdata").removeAttr("hidden");
      }else{
         $("#clientdata").attr("hidden", "hidden");
      }
   });

   $("#saveorder").on("click", function(){
      
      if($("#checkclient").is(":checked")){
         if($("#clientname").val() == "" || 
         $("#clientdocument").val() == ""){
            alert("Preencha os campos obrigatórios");
            return false;
         }
      }

      var payment_method = $("input[name='payment_method']:checked").val();
      
      if(payment_method == undefined){
         alert("Selecione uma forma de pagamento");
         return false;
      }

     var formdata = $("#formcheckout").serialize();

       $.ajax({
         url: "index.php?pg=order&f=add",
         type: "POST",
         data: formdata,
         dataType: "json",
         success: function(data){
            if(data.status = "success"){
               alert(data.message);
               window.location.href = "index.php?pg=order&f=detail&id="+data.order_id;
            }else{
               alert(data.message);
               
            }
         }
      })
      
   })
})

function addcartitem(item){
   var id = $(item).data("id");
   var name = $(item).data("name");
   var qnt = parseInt($(item).data("qnt"));
   var price = parseFloat($(item).data("price")).toFixed(2).replace('.', ',');
   var tax = parseFloat($(item).data("tax")).toFixed(2).replace('.', '.');
   console.log(tax)
   var calctax = (parseFloat(price) * parseFloat(tax)) / 100;
   calctax = calctax.toFixed(2).replace('.', ',');
   var pricetotal = (parseFloat(price) + parseFloat(calctax));
   pricetotal = pricetotal.toFixed(2).replace('.', ',');
   
   if($("input[name='product_id["+id+"]']").length > 0 ){
      alert("Item já adicionado ao carrinho");
      return false;
   }

   html = "";
   html += "<tr>";
   html += "<td>"+name+"</td>";
   html += "<td><input type='number' onchange='altcartitem(this)' data-tax='"+tax+"' style='max-width:100px' class='form-control qntitens' value='1' max='"+qnt+"' min='1'></td>";
   html += "<td>R$ "+price+"</td>";
   html += "<td>R$ "+calctax+"</td>";
   html += "<td>R$ "+pricetotal+"</td>";
   html += "<td>";   
   html += "<input type='hidden' name='product_id["+id+"]' value='"+id+"'>";
   html += "<input type='hidden' name='qnt["+id+"]' value='1'>";
   html += "<input type='hidden' name='price["+id+"]' value='"+price+"'>";
   html += "<input type='hidden' name='tax["+id+"]' value='"+calctax+"'>";
   html += "<button type='button' class='btn btn-danger' onclick='removecartitem(this)'><i class='fa fa-trash'></i></button>";
   html += "</td>";
   html += "</tr>";

   $("#cartitems tbody").append(html);
   $("#resultsearch").html("");
   $("#resultsearch").attr("hidden", "hidden");
   $("#searchproduct").val("");
   carttotal();
}

function altcartitem(item){
   var qnt = parseInt($(item).val());
   var max = parseInt($(item).attr("max"));
   var taxorg = parseFloat($(item).data("tax"));

   if(qnt > max){
      $(item).val(max);
   }else if(qnt < 1){
      $(item).val(1);
   }
   
   var price = parseFloat($(item).parent().next().html().replace("R$ ", "").replace(",", "."));
   
   var calctaxorig = (parseFloat(price) * parseFloat(taxorg)) / 100;
   $(item).parent().next().next().html("R$ "+(calctaxorig*parseInt($(item).val())).toFixed(2).replace('.', ','));

   var tax = parseFloat($(item).parent().next().next().html().replace("R$ ", "").replace(",", "."));
   var pricetotal = (parseFloat(price) * parseInt($(item).val()) + parseFloat(tax));

   pricetotal = pricetotal.toFixed(2).replace('.', ',');   

   $(item).parent().next().next().next().html("R$ "+pricetotal);

   //altera os valores dos inputs hidden
   var id = $(item).parent().next().next().next().next().find("input").val();
   console.log(id);

   $("input[name='qnt["+id+"]']").val(qnt);
   $("input[name='price["+id+"]']").val(price);
   $("input[name='tax["+id+"]']").val(tax);

   $(item).parent().next().next().next().next().next().find("input").val(pricetotal);

   carttotal();
}

function carttotal(){
   var total = 0;
   var qntitens = 0;
   var subtotal = 0;
   var totaltax = 0;
   $("#cartitems tbody tr").each(function(){
      
      var qnt = parseFloat($(this).find("td:eq(1)").find("input").val());
      var price = parseFloat($(this).find("td:eq(2)").html().replace("R$ ", "").replace(",", "."));
      var tax = parseFloat($(this).find("td:eq(3)").html().replace("R$ ", "").replace(",", "."));
      var pricetotal = parseFloat($(this).find("td:eq(4)").html().replace("R$ ", "").replace(",", "."));
      
      qntitens += qnt;
      totaltax += tax;
      subtotal += (price*qnt);
   })
   total = (subtotal + totaltax);
   
   $("#cartqntitens").html(qntitens);
   $("input[name='cartqnt_items']").val(qntitens)

   $("#cartsubtotal").html("R$ "+subtotal.toFixed(2).replace('.', ','));
   $("input[name='cartsubtotal']").val(subtotal.toFixed(2).replace('.', ','))
   
   $("#carttax").html("R$ "+totaltax.toFixed(2).replace('.', ','));
   $("input[name='carttax']").val(totaltax.toFixed(2).replace('.', ','))
   
   $("#carttotal").html("R$ "+total.toFixed(2).replace('.', ','));
   $("input[name='carttotal']").val(total.toFixed(2).replace('.', ','))
}

function removecartitem(item){
   $(item).parent().parent().remove();
   carttotal();
}