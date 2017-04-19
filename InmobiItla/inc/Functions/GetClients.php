<? 
header('Content-Type: application/json');
include $_SERVER['DOCUMENT_ROOT'] . "/inc/init.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/ClientsRepo.php";
if(isset($_GET['criteria'])) {
	echo json_encode(GetClients($_GET['criteria']));
} else {
	echo json_encode(GetClients(""));
}

?>