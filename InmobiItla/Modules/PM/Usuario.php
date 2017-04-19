<!DOCTYPE html>
<? 
$isLogin = true;
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Controllers/ProductsController.php";


$Interface = [];
$Interface["InterfaceDisplay"] = "Registro";
$Interface["InterfaceDesc"] = "Registro de Usuario";

?>
<? include $PageHeader ?>
  <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

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
<form action="/inc/Functions/CreateUser.php" method="POST" id="clientform">
        <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Usuarios</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
              <div class="box-body">
 

        <div class="form-group input-group">
          <span class="input-group-addon">Cedula:</span>
          <input type="text" class="form-control"  name="cedula" placeholder="Cedula del Usuario " required="true" />
        </div>

        <div class="form-group input-group">
           <span class="input-group-addon">Correo:</span>
           <input type="text" class="form-control"  name="correo" placeholder="Correo Electronico del Usuario" required="true" />
        </div>

        <div class="form-group input-group">
           <span class="input-group-addon">Usuario:</span>
           <input type="text" class="form-control"  name="nombre" placeholder="Nombre Usuario" />
        </div>

        <div class="form-group input-group">
           <span class="input-group-addon">Primer Nombre:</span>
           <input type="text" class="form-control"  name="primernombre" required="true"/>
        </div>
		
		<div class="form-group input-group">
           <span class="input-group-addon">Apellido:</span>
           <input type="text" class="form-control"  name="apellido" required="true"/>
        </div>
		
		
					
              </div>
              <!-- /.box-body -->

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
              <h3 class="box-title">Datos Importantes</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="form-group input-group">
           <span class="input-group-addon">Telefono:</span>
           <input type="text" class="form-control"  name="telefono" required="true"/>
        </div>
		
		<div class="form-group input-group">
           <span class="input-group-addon">Celular:</span>
           <input type="text" class="form-control"  name="celular" required="true"/>
        </div>
		
		
		<div class="form-group input-group">
           <span class="input-group-addon">Fax:</span>
           <input type="text" class="form-control"  name="fax" />
        </div>
		
		<div class="form-group input-group">
           <span class="input-group-addon">Clave:</span>
           <input type="text" class="form-control"  name="clave" required="true"/>
        </div>
		
                <div class="form-group">
                  <label for="exampleInputEmail1">Mas Informacion</label>
                  <div class="pull-right box-tools">

              </div>
                <textarea class="textarea" name="mas_informacion" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
         
                </div>
                <div class="form-group">

              </div>
              </div>
              
              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Agregar Usuario	</button>
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