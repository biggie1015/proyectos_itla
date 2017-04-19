
<style type="text/css">
  div#image {
    height: 360px;
    width: 360px;
    margin: 0 auto;
    background-color: #EEE;
}

.imgbutt {
    /* padding: 12px; */
    height: 35px;
    width: 35px;
    text-align: center;
    line-height: 35px;
    border-radius: 5px;
    color: #fff;
    background-color: #00a65a;
    margin: 0 auto;
    display: inline-block;
    margin-left: 5px;
    margin-right: 5px;
    font-size: 16px;
}
div#imageselect {
    /* display: inline-flex; */
    /* margin: 0 auto; */
    /* width: auto; */
    /* position: relative; */
    text-align: center;
}
div#DescContainer {
    font-size: 20px;
    border-top: 1px solid #EEE;
    margin-top: 7px;
    padding-top: 11px;
}
.box-footer {
    text-align: right;
    font-size: 30px;
}

div#price {
    display: inline;
}
</style>
<!DOCTYPE html>

<? 
$isLogin=true;
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Controllers/ProductsController.php";
$Producto = GetProduct($_GET["i"]);

$Interface = [];
$Interface["InterfaceDisplay"] = $Producto["titulo"];
$Interface["InterfaceDesc"] = "Registrar Ventas";

include $PageHeader 

?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <? echo $Interface['InterfaceDisplay'] ?> <span class="label bg-green"> <? echo $Producto['tipo_acciones_id_Display'] ?> </span>
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <? echo "GENERAL" ?></a></li>
        <li class="active"><? echo $Interface['InterfaceDisplay'] ?></li>
      </ol>
    </section>


    <section class="content">
<form action="/inc/Functions/CreateProduct.php" method="POST" id="clientform">
        <div class="row">
        <!-- left column -->
        <div class="col-md-3">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Imagenes</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
              <div class="box-body">

              <div id="image"></div>
              
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
              <div id="imageselect"> </div>
              </div>
          </div>

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-9">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Informacion</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
              <div><b>Direccion : </b> <? echo $Producto["direccion"] ?></div>
              <div><b>Tipo : </b> <? echo $Producto["tipo_producto_id_Display"] ?></div>
              <div id="DescContainer"><? echo $Producto["descripcion"] ?> </div>
              <div> <b>Ubicacion : </b> <? echo $Producto["ubicacion"] ?> </div>
              </div>
              <div class="box-footer">
                Precio <div id="price"> <? echo $Producto["precio"] ?> </div>
              </div>
<?			  
         $linkEdit = base_url("/Modules/PM/View.php?i={$Producto->id}");
         $linkDelete = base_url("/Modules/PM/View.php/delete/?id={$Producto->id}");
			   
			 echo "<a href='{$linkEdit}' class='btn btn-info btn-sm'>Edit</a>
                 <a href='{$linkDelete}' onclik='return validarBorrar(); 'class='btn btn-danger btn-sm'>Del</a>"
  ?>             
			  <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
      
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
    </section>
  </div>
 
 
<? include $PageFooter ?>
<script type="text/javascript">
  var images = "<? echo $Producto['fotos'] ?>".split(",");


function setImage(index) {





  var img = "/archivos/"+images[index]; console.log(img)
  $("#image").css('background-image', 'url(' + img + ')');
  $("#image").css('background-size', "cover");
}

  $(document).ready(
    function() {
            Number.prototype.formatMoney = function (c, d, t) {
            var n = this,
                c = isNaN(c = Math.abs(c)) ? 2 : c,
                d = d == undefined ? "." : d,
                t = t == undefined ? "," : t,
                s = n < 0 ? "-" : "",
                i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
                j = (j = i.length) > 3 ? j % 3 : 0;
            return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
        };
              jQuery.fn.CurrencyFormat = function () {

            $.each($(this), function (i, v) {
                var d = parseFloat($(v).html());
                $(v).html(d.formatMoney())
                $(v).css("text-align", "right");
                ////console.log($(v).prop("class").replace("BODY", "HEAD"));
                $("."+$(v).prop("class").split(" ")[0].replace("BODY", "HEAD")).css("text-align", "right");
            })
        };
    var c = 0;
    for(var i in images) {
      c++;
      if(images[i] != "") {
        $("#imageselect").append("<div id='image"+i+"' onClick='setImage("+i+")'class='imgbutt'> "+ c +" </div>")
        setImage(i);
      }
    };

    $("#price").CurrencyFormat();
  })




</script>

