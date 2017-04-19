<!DOCTYPE html>
<?php

include $_SERVER['DOCUMENT_ROOT'] . "/inc/Controllers/DashboardController.php";
if (!isset($_SESSION['User'])) {
	header("Location: /");
	die();
}

if(!isset($_GET["C"])) {
$Products = GetProducts("");
} else {
$Products = GetProducts($_GET["C"]);
}
?>
<?php include $PageHeader ?>
<? ?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Bienvenido a Inmobi Itla!
			<small>Ultimas Ofertas</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Ofertas</a></li>
			<li class="active">Actuales</li>
		</ol>
	</section>
	<? foreach ($Products as $key => $P) { 
			echo ""
			?>

			<div class="col-md-3">
				<!-- general form elements -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><? echo $P["titulo"] ?></h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->

					<div class="box-body">

					<div class="photo" style='background-image:  url("/archivos/<? echo explode(",",$P["fotos"])[0] ?>"); background-size: cover; width: 300px; height: 300px; margin: 0 auto'> </div>
					</div>
					<a  class="btn btn-primary btn-block" href="/Modules/PM/View.php?i=<? echo $P['id'] ?>"> Ver </a>
			<div class="box-footer">
			<? echo $P["precio"] ?>
			</div>

			</div>
			</div>
	<? } 
	?> 
		
		
	<? ?>
	<section class="content">
	
		<!-- /.box-body -->

		</div>


</section>
</div>

<? include $PageFooter ?>
