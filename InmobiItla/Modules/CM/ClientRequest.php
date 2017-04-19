<!DOCTYPE html>
<? 

include $_SERVER['DOCUMENT_ROOT'] . "/inc/Controllers/ClientsController.php";
if (!isset($_SESSION['User'])) {
  header("Location: /");
  die();
}
$Interface = GetInterface('CLIENT_REQUEST');
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
        <li class="active"><? echo $Interface['InterfaceDisplay'] ?></li>Q
      </ol>
    </section>

    <section class="content">
<form action="/inc/Functions/CreateClient.php" id="clientform">
        <div class="row">
        <!-- left column -->
        <div class="col-md-6">
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
                  <input type="text" class="form-control" data-autocompletable="true" name="Name" id="client_name" placeholder="Nombre del Cliente" required="true">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Correo Electronico</label>
                  <input type="email" class="form-control" name="Mail" placeholder="Ingrese Correo Electronico" required="true">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Direccion</label>
                  <input type="text" class="form-control" name="address" placeholder="Escriba una direccion" required="true">
                </div>
              <div class="form-group">
                  <label>Tipo</label>
                  <select class="form-control" name="CustomerKind_id">
                  <? GetArrayAsSelect(GetCustomerKinds(), "CustomerKind_id", "CustomerKindDisplay"); ?>

                  </select>
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
              <h3 class="box-title">Informacion de Contacto</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
            <div class="form-group ">
            <div class="col-md-12">
                <label>Telefono:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input class="form-control" type="text" data-mask="" placeholder="Telefono" name="Phone" data-inputmask='"mask": "(999) 999-9999"'>
                </div>
              </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
              <div class="col-md-12">
                  <label>Sexo</label>
                  <select class="form-control" name="Sex">
                  <? GetArrayAsSelect(GetGenres(), "genre_id", "GenreName"); ?>

                  </select>
                  </div>
              </div>
                <div class="form-group">
                  <div class="col-md-4"> 
                  <label>Tipo de Documento</label>
                  <select class="form-control" name="DocumentType">
                  <? GetArrayAsSelect(GetDocumentTypes(), "DType_id", "DocumentDisplay"); ?>
                  </select>
                  </div>
                  <div class="col-md-8">       
                  <label for="Mail">Numero de Documento</label>
                  <input type="number" class="form-control" name="DocumentDesc" placeholder="Numero de Documento">
                </div>
                </div>
               
                <div class="form-group">
              <div class="col-md-12">
               <label>Ingresos Mensuales</label>
              <div class="input-group">
              
                <span class="input-group-addon">RD$</span>
                <input class="form-control" name="MontlyPayment" value="0" type="text">
                <span class="input-group-addon">.00</span>
              </div>
              </div>

                <div class="form-group">

                  <div class="col-md-8">       
                  <label for="Mail">Credito a Solicitar</label>
                <div class="input-group">
                  <span class="input-group-addon">RD$</span>
                  <input class="form-control" name="CreditAmount" value="0" type="text">
                  <span class="input-group-addon">.00</span>
                </div>
                </div>
                <div class="col-md-4"> 
                  <label>Cuotas</label>
                  <select class="form-control" name="InterestQuotes_id">
                  <? GetArrayAsSelect(GetInterestQuotes(), "InterestQuotes_id", "InterestQuotesDisplay"); ?>
                  </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
              <div class="col-md-12">
                  <label for="Mail">Numero de referido</label>
                  <input type="number" name="Referral" class="form-control" id="Mail" placeholder="Numero de Documento">
              </div>
              </div>
              </div>
              <!-- /.box-body -->
              <input type="hidden" name="User_id">
              <input type="hidden" name="company_id">
              
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Agregar Cliente</button>
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
