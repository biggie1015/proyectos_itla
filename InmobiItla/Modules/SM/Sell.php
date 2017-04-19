<!DOCTYPE html>
<? 

include $_SERVER['DOCUMENT_ROOT'] . "/inc/Controllers/SellsController.php";
if (!isset($_SESSION['User'])) {
  header("Location: /");
  die();
}
$Interface = GetInterface('SELL_FACTURATE');
$Tab = GetTab($Interface["tab_id"]);
$Company = GetCompany($UserData["company_id"]);
?>
<? include $PageHeader ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <? echo $Interface['InterfaceDisplay'] ?>
        <small><? echo $Interface['InterfaceDesc'] ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <? echo $Tab["TabDisplay"] ?></a></li>
        <li class="active"><? echo $Interface['InterfaceDisplay'] ?></li>
      </ol>
    </section>

    <section class="content">
<form action="/inc/Functions/Facturate.php" id="clientform">
<div class="row">
          <div class="col-md-4">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos de Cliente</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
              <div class="box-body">
                <div class="form-group">
                <input type="hidden" name="client_id">
                  <label for="ClientName">Nombre del Cliente</label>
                  <input type="text" class="form-control" data-autocompletable="true" id="client_name" placeholder="Nombre del Cliente" required="true">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Correo Electronico</label>
                  <input type="email" class="form-control" disabled="true" name="Mail" placeholder="Enter email" required="true">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Direccion</label>
                  <input type="text" class="form-control" disabled="true" name="address" placeholder="Enter email" required="true">
                </div>
                            <div class="form-group ">
                <label>Telefono:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input class="form-control" type="text" disabled="true" data-mask="" name="Phone" data-inputmask='"mask": "(999) 999-9999"'>
              </div>
                <!-- /.input group -->
              </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              </div>
          </div>

        </div>
                  <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Informacion de Venta</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
              <div class="box-body">
               <div class="form-group">
               <label>Balance</label>
              <div class="input-group">
              
                <span class="input-group-addon">RD$</span>
                <input class="form-control" name="Balance" disabled="true" value="0" type="text">
                <span class="input-group-addon">.00</span>
              </div>
                  <div class="checkbox">
                    <label >
                      <input name="useBalance" type="checkbox">
                      ¿Contar con balance para la compra?
                    </label>
                  </div>
              </div>
                <div class="form-group">
                  <label>Metodo de Pago</label>
                  <select class="form-control" name="paymenttype_id">
                  <? GetArrayAsSelect(GetPaymentTypes(), "paymenttype_id", "PaymentDisplay"); ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Comentario</label>
                  <input type="textarea" name="comment">
                </div>
              </div>
              <!-- /.box-body -->
              <input type="hidden" name="User_id">
              <input type="hidden" name="company_id">
              

              <div class="box-footer">
              </div>
          </div>

        </div>
</div>
     <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Consulta</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
               <div class="col-md-6 center-block">
                <label>Busqueda :</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-search"></i>
                  </div>
                  <input class="form-control Search" type="text" id="products">
                </div>
              </div>
              <div class="box-body">
              <div class="tablebx table-responsive col-lg-12">
                
              </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              <div class="pull-right col-lg-4 col-md-6 col-xs-12">
              <div class="pull-right" style="display: block; width: 100%;"><label id="totallabel">Sub-total : </label> <div id="subTotal" style="display: inline-block; text-align: right;" class="pull-right">0</div></div>
              <div class="pull-right" style="display: block; width: 100%;"><label id="totallabel">Impuestos : </label> <div id="Taxes" style="display: inline-block; text-align: right;" class="pull-right">0</div></div>
              <div class="pull-right" style="display: block; width: 100%;"><label id="totallabel">Porcentaje de descuento : </label> <input type="text" CheckDown='true' class="pull-right" isPercent="true" maxlength="3" name="discount" onkeyup="DiscountCall()">%</div>
              <div id="BalanceUsed"class="pull-right" style="display: block; width: 100%;"><label id="totallabel">Balance a Utilizar : </label> <div id="Balance" style="display: inline-block; text-align: right;" class="pull-right">0</div></div>
              <div class="pull-right" style="display: block; width: 100%;"><label id="totallabel">Total : </label> <div id="Total" style="display: inline-block; text-align: right;" class="pull-right">0</div></div>

              </div>
              </div>
          </div>

        </div>
                        <button type="submit" class="btn btn-info pull-right">Agregar Producto</button>

        <!--/.col (left) -->
        <!-- right column -->
 
        <!--/.col (right) -->
      </div>
    
  </div>
  </section>
<? include $PageFooter ?>
<script type="text/javascript">
  var Productos = {};
	var Cliente;
  var Total = 0;
  var subTotal = 0;
  var Taxes = 0;
  var Discount = 0;
  var Balance = 0;
  var Arr = {
		"name" : {
			"title" : "Nombre",
		},
    "description" : {
      "title" : "Descripcion"
    },
    "MIN" : {
      "title" : "",
      "Format" : "<div onclick='removeOne({i})'>-</div>",
      "Body.style" : {
        "float" : "right",
        "text-align" : "right"
      }
    },
    "QUANTITY" : {
      "title" : "Cantidad",
      "Head.style" : {
        "text-align" : "center"
      },
      "Body.style" : {
        "text-align" : "center"
      }
    },
    "PLUS" : {
      "title" : "",
      "Format" : "<div onclick='addOne({i})'>+</div>",
      "Body.style" : {
        "float" : "left",
        "text-align" : "left"
      }
    },
    "sellprice" : {
      "title" : "Precio Unitario"
    },
    "TOTALPRICE" : {
      "title" : "Precio Total"
    }
	}
  $('[name="useBalance"]').on("change", function() { if ($(this).prop("checked")) {Balance = $('[name="Balance"]').val(); $('#BalanceUsed').show() } else { Balance = 0; $('#BalanceUsed').hide()} $('#Balance').html("-"+Balance); })
  function addOne(id) {
          if (Productos[id].stock > Productos[id].QUANTITY) {
              Productos[id].QUANTITY++;
              Productos[id]["TOTALPRICE"] = Number(Productos[id].sellprice) * Number(Productos[id].QUANTITY);
          } else {
            Notify("error", "No hay tantos "+ Productos[id].name +" en Stock.")
            return;
          }
          CalculateFacture()
  }
  function DiscountCall() {
    Discount = $('[name="discount"]').val() * Total / 100
    $('#Total').html(Math.floor(Total + Taxes - Discount - Balance, 2));
  }
  function CalculateFacture() {
    ARRAYTable(".tablebx",Productos, Arr, "Clients");
    Total = 0;
    subTotal = 0;
    Taxes = 0;
    $.each(Productos, function(index) {
      var Producto = Productos[index];
      Total += Producto.sellprice * Producto.QUANTITY; 
    })
    $('#subTotal').html(Total);
    $('#Taxes').html(Taxes);
    $('#Total').html(Math.floor(Total + Taxes - Discount - Balance, 2));

  }
  function removeOne(id) {
          if (Productos[id].QUANTITY > 0) {
              Productos[id].QUANTITY--;

              Productos[id]["TOTALPRICE"] = Number(Productos[id].sellprice) * Number(Productos[id].QUANTITY);
              if (Productos[id].QUANTITY <= 0) {
                Notify("success", Productos[id]["name"] +" se ha removido, de la lista de compras.")
              Productos[id] = null;
              }
          } else {
            
                        return;
    
          }
          CalculateFacture()
  }
      $( "#products" ).autocomplete({
      minLength: 0,
      source: function(request, response) {
        $.getJSON('/inc/Functions/GetProducts.php?criteria='+request.term, { q: request.term }, function(result) {
              response($.map(result, function(item) {
                return item;
            }));
        })},
      focus: function( event, ui ) {
        $( "#products" ).val( ui.item.name );
        return false;
      },
      select: function( event, ui ) { 
        if(!Productos[ui.item.product_id]) {
           ui.item["QUANTITY"] = 1;
           ui.item["TOTALPRICE"] = ui.item.sellprice * ui.item["QUANTITY"];
           if (ui.item.stock > 0) {
           Productos[ui.item.product_id] = ui.item;
            Notify("success", Productos[ui.item.product_id]["name"] +" se ha añadido a la lista de compras.")
           }
        } else {
          if (Productos[ui.item.product_id].stock > Productos[ui.item.product_id].QUANTITY) {
              Productos[ui.item.product_id].QUANTITY++;
              Productos[ui.item.product_id]["TOTALPRICE"] = Number(ui.item.sellprice) * Number(Productos[ui.item.product_id].QUANTITY);
              Notify("success", "Se ha sumado un " + Productos[ui.item.product_id]["name"] + " a la lista de compras.")
            }
        }

        CalculateFacture()

       // $( "#project-description" ).html( ui.item.desc );
        //$( "#project-icon" ).attr( "src", "images/" + ui.item.icon );
 
        //return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li class='completeresult'>" )
        .append( "" + item.name + "<span class='pull-right'>Cantidad  :  " + item.stock + "</span><br>"+ item.color)
        .appendTo( ul );
    };
    $('form').submit(function (event) { CalculateFacture() })
</script>
