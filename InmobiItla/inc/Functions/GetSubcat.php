<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/init.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/ProductsRepo.php";
$VARIABLES = [];
foreach ($_GET as $key => $value) {
	$VARIABLES[$key] = $value;
}
if (isset($VARIABLES['id'])) {
echo json_encode(GetSubCategories($VARIABLES['id']));
}
?>