<!DOCTYPE html>
<? 

include $_SERVER['DOCUMENT_ROOT'] . "/inc/Controllers/ClientsController.php";
if (!isset($_SESSION['User'])) {
  header("Location: /");
  die();
}
$Interface = GetInterface('CLIENT_CONSULT');

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
<form action="/inc/Functions/CreateClient.php" id="clientform">
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
                  <input class="form-control Search" type="text" data-mask="" name="Phone" data-inputmask='"mask": "(999) 999-9999"'>
                </div>
              </div>
              <div class="box-body">

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              </div>
          </div>

        </div>
        <!--/.col (left) -->
        <!-- right column -->
 
        <!--/.col (right) -->
      </div>
    
  </div>
  </section>
<? include $PageFooter ?>
<script type="text/javascript">
	var Arr = {
		"Name" : {
			"title" : "Nombre"
		},
		"Phone" : {
			"title" : "Telefono"
		},
		"Mail" : {
			"title" : "Mail"
		},
		"Sex_Display" : {
			"title" : "Sexo",
		},
		"Referral_Display" : {
			"title" : "Referido por",
		},
		"DocumentType_Display" : {
			"title" : "Tipo de Documento",
		},
		"DocumentDesc" : {
			"title" : "Num. Documento",
		},
		"User_id_Display" : {
			"title" : "Añadido por",
		},
		"CreatedDate" : {
			"title" : "Dia de Creacion",
		}
	}
	JSONTable(".box-body","/inc/Functions/GetClients.php", Arr, "Clients")
	addSearch("#Clients", ".Search", "Hola");
</script>
