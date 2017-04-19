<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/init.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/ClientsRepo.php";

if(isset($_GET["status"])) {
	echo json_encode(GetRequest($_GET["status"]));
} else {
	echo json_encode(GetRequest());
}


?>