<?

include $_SERVER['DOCUMENT_ROOT'] . "/inc/init.php";

$VARIABLES = [];
foreach ($_GET as $key => $value) {
	$VARIABLES[$key] = $value;
}

if (isset($VARIABLES["base"]) && isset($VARIABLES["val"]) ) {

switch ($VARIABLES["base"]) {
	case 'mbt_brands':
	$pdo->exec("INSERT INTO `mbt_brands`(`company_id`, `BrandName`) VALUES ('".$UserData['company_id']."','".$VARIABLES['val']."')");
	echo $pdo->lastInsertId();
	break;
	case 'mbt_productcategories' :
	$pdo->exec("INSERT INTO `mbt_productcategories`(`company_id`, `CategoryDisplay`) VALUES ('".$UserData['company_id']."','".$VARIABLES['val']."')");
	echo $pdo->lastInsertId();
	break;
	case 'mbt_productsubcategories' :
	$pdo->exec("INSERT INTO `mbt_productsubcategories`(`pCat_id`, `SubCatDisplay`) VALUES ('".$VARIABLES['optional']."','".$VARIABLES['val']."')");
	echo $pdo->lastInsertId();
	break;
	default:
		# code...
	break;
}
}
?>