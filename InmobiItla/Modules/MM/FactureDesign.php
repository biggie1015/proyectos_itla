<!DOCTYPE html>
<? 

include $_SERVER['DOCUMENT_ROOT'] . "/inc/Controllers/ClientsController.php";
if (!isset($_SESSION['User'])) {
  header("Location: /");
  die();
}
$Interface = GetInterface('FACTURE_MANAGER');
$Tab = GetTab($Interface["tab_id"]);
$Company = GetCompany($UserData["company_id"]);
?>
<? include $PageHeader ?>
<style type="text/css">
#FacturePage {
  width: 8.5in;
  height: 11in;
  background-color: #fff;
  zoom: 1;
  box-shadow: 0px 6px 3px rgba(0,0,0,0.2);
}
</style>
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
        <div class="col-md-4">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Herramientas</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              </div>
          </div>

        </div>
        <div class="col-md-8">
          <div id="FacturePage">
            
          </div>
        </div>
        <!--/.col (left) -->
        <!-- right column -->
 
        <!--/.col (right) -->
      </div>
    
  </div>
  </section>
<? include $PageFooter ?>
