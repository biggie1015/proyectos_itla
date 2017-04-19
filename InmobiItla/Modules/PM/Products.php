<!DOCTYPE html>
<? 

include $_SERVER['DOCUMENT_ROOT'] . "/inc/Controllers/ProductsController.php";
if (!isset($_SESSION['User'])) {
  header("Location: /");
  die();
}

$Interface = [];
$Interface["InterfaceDisplay"] = "Vender";
$Interface["InterfaceDesc"] = "Registrar Ventas";

?>
  <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<? include $PageHeader ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <? echo $Interface['InterfaceDisplay'] ?>
        <small><? echo $Interface['InterfaceDesc'] ?></small>
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
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Producto</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
              <div class="box-body">
 
        <input type="hidden" name="product_id">
		

        <div class="form-group input-group">
          <span class="input-group-addon">Titulo:</span>
          <input type="text" class="form-control"  name="titulo" placeholder="Titulo del Producto" required="true" />
        </div>

        <div class="form-group input-group">
          <span class="input-group-addon">Direccion:</span>
          <input type="text" class="form-control"  name="direccion" placeholder="Direccion del Vendedor " required="true" />
        </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Descripcion</label>
                                <div class="pull-right box-tools">

              </div>
                <textarea class="textarea" name="descripcion" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
         
                </div>


        <div class="form-group input-group">
           <span class="input-group-addon">Ubicacion:</span>
           <input type="text" class="form-control"  name="ubicacion" />
        </div>

        <div class="form-group input-group">
           <span class="input-group-addon">Fotos:</span>
           <input type="file" class="form-control"  name="fotos[]"  multiple="multiple"/>
        </div>
			   <!--<div class="form-group">
                <input type="hidden" name="product_id">
                  <label for="ClientName">Nombre del Producto</label>
                  <input type="text" class="form-control" data-autocompletable="true" name="name" placeholder="Nombre del Cliente" required="true">
                </div>
                
				<div class="form-group">
                  <label for="exampleInputEmail1">Descripcion</label>
                  <input type="textarea" class="form-control" name="description" placeholder="Ingrese una descripcion.">
                </div>
-->
	
				
              </div>
              <!-- /.box-body -->

              <div class="col-md-12">
               <label>Precio de Venta</label>
              <div class="input-group">
              
                <span class="input-group-addon">RD$</span>
                <input class="form-control" name="precio" value="0" CheckDown='true' type="text">
                <span class="input-group-addon">.00</span>
              </div>
              </div>
              <div class="col-md-12">
               <label>Cantidad</label>
              <div class="input-group">
              
                <span class="input-group-addon">Cant.</span>
                <input class="form-control" name="cantidad" value="0" CheckDown='true' type="text">
                <span class="input-group-addon">Unit.</span>
              </div>
              </div>
              <div class="box-footer">
              </div>
          </div>

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Detalles de Producto</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                <div class="form-group">
                  <label>Categoria</label>
                  <select class="form-control" name="tipo_producto_id"> 
					<? GetArrayAsSelect(GetCategories(), "tipo_producto_id", "tipo_producto_display", true); ?>
                  </select>
                  </div>
               
			   <div class="form-group">
                  <label>Accion</label>
                  <select class="form-control" name="tipo_acciones_id"> 
					<? GetArrayAsSelect(GetActions(), "tipo_acciones_id", "tipo_acciones_display", true); ?>
                  </select>
                  </div>
               
                <div class="form-group">

              </div>
              </div>
              <!-- /.box-body -->
              <input type="hidden" name="usuario_id">
              <input type="hidden" name="company_id">
              
              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Agregar Producto</button>
              </div>
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
<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    $(".textarea").wysihtml5();
        $("[name='_wysihtml5_mode']").remove()

  });
</script>