<!DOCTYPE html>
<? 

include $_SERVER['DOCUMENT_ROOT'] . "/inc/Controllers/ClientsController.php";
if (!isset($_SESSION['User'])) {
  header("Location: /");
  die();
}
$Interface = GetInterface('CLIENT_MANAGE');

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
        <div class="row">
        <div class="col-md-3">
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Estatus</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li id="stat0"><a href="#" onclick="setStatus(0)"><i class="fa fa-circle-o text-grey"></i>  Pendientes</a></li>
                <li id="stat1"><a href="#" onclick="setStatus(1)"><i class="fa fa-circle-o text-red"></i> Rechazadas</a></li>
                <li id="stat2"><a href="#" onclick="setStatus(2)"><i class="fa fa-circle-o text-light-blue"></i> Autorizadas</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Solicitudes</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" id="Searcher"class="form-control input-sm" placeholder="Busqueda...">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div id="rquest" class="table-responsive mailbox-messages">

                
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">

            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

<? include $PageFooter ?>
  <script type="text/javascript">
  var Arr = {
    "Name" : {
      "title" : "Nombre"
    },
    "DocumentType_id_Display" : {
      "title" : "Tipo de Documento",
    },
    "DocumentDesc" : {
      "title" : "Num. Documento",
    },
    "Sex_id_Display" : {
      "title" : "Sexo",
    },
    "CustomerKind_id_Display" : {
      "title" : "Tipo",
    },
    "see" : {
      "title" : "",
      "Format" : "<button type='button' class='btn btn-block btn-info btn-xs'>Ver</button>"
    }
  }
  var uri = "/inc/Functions/GetRequests.php";
  var actNum = 0;
  JSONTable("#rquest",uri, Arr, "Requests")
  function setStatus(num) {
    actNume = num;
    uri = "/inc/Functions/GetRequests.php?status="+num;
    JSONTable("#rquest",uri, Arr, "Requests")
  }
  setInterval(function() {
      JSONTable("#rquest",uri, Arr, "Requests")
  }, 3000)
  addSearch("#Requests", "#Searcher", "Hola");

  </script>
