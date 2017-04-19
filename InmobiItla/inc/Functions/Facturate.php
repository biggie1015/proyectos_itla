<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/init.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/UserRepo.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/ProductsRepo.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/FacturationRepo.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/ClientsRepo.php";

$Parameters = "";
$Values = "";
$UpdateData = "";
$totalfacture = 0;
$discount = 0;
$updateKey = "producdt_id";
$updatecriteria = "";
$userid = "User_id";
$company = "company_id";
$table = "mbt_sells";
$useBalance = false;
$isUpdate = false;
$discount = 0;
$clientid = $_POST["f"][0]["value"];
$Facture = GetLastFactureSecuenc();

foreach ($_POST["f"] as $Var=>$Val) {
$Variable = $_POST["f"][$Var]["name"];
$Value = $_POST["f"][$Var]["value"];
if($Value != "" && $Value != " " && $Variable != $updateKey && $Variable != $company && $Variable != $userid ) {
$Parameters .=  "`".$Variable."`,";
if ($Value == "on") {
	$Values .= "'1',";
} else {
	$Values .= "'".$Value."',";
}
$UpdateData .= "`".$Variable."`"."="."'".$Value."',";
} 

if($Variable == "useBalance") {
	$useBalance = true;
	$Parameters .=  "`useBalance`,";
	$Values .= "'1',";
}
if($Variable == "discount") {
	$discount = $Value;
}
if ($Variable == $updateKey && $Value != "") {
$isUpdate=true;
$updatecriteria = $Value;
}
if ($Variable == $company) {
$Parameters .=  "`".$Variable."`,";
$Values .= "'".$UserData["company_id"]."',";
}
if ($Variable == $userid) {
$Parameters .=  "`".$Variable."`,";
$Values .= "'".$UserData["User_id"]."',";
}
}
$FullPrice = 0;
foreach ($_POST["p"] as $idd=>$VA) {
if ($_POST["p"][$idd]) {
$Product = GetProduct($idd);
$ProductQuantity = $_POST["p"][$idd]["QUANTITY"];
$FullPrice += $Product["sellprice"] * $ProductQuantity;
}
}
$TotalPrice = $FullPrice;
$FullPrice = $FullPrice - ($discount * $FullPrice / 100);
if ($useBalance) {
$bals = GetClient($clientid);
$ActualBalance = GetClient($clientid)["Balance"] - $FullPrice;
UpdateBalance($clientid, $ActualBalance);
$FullPrice -= $bals["Balance"];
if ($FullPrice <= 0) {
	$FullPrice = 0;
}

}
$Parameters .=  "`facture_id`,";
$Values .= "'".$Facture."',";
$Parameters .=  "`price`,";
$Values .= "'".$TotalPrice."',";
$Parameters .=  "`TotalPaid`,";
$Values .= "'".$FullPrice."',";


$UpdateData = rtrim($UpdateData, ",");
$Values = rtrim($Values, ",");
$Parameters = rtrim($Parameters, ",");



if ($isUpdate) {
echo $pdo->exec('UPDATE `'.$table.'` SET '.$UpdateData.' WHERE '.$updateKey.' = "'.$updatecriteria.'"');
} else {
echo $pdo->exec('INSERT INTO `'.$table.'`('.$Parameters.') VALUES ('.$Values.')');
}
$sell_id = $pdo->lastInsertId();
SetLastFactureSecuenc();
foreach ($_POST["p"] as $idd=>$VA) {
if($_POST["p"][$idd]) {
$Product = GetProduct($idd);
$ProductQuantity = $_POST["p"][$idd]["QUANTITY"];
$sqlproduct = "INSERT INTO `mbt_sellproducts`(`product_id`, `company_id`, `user_id`, `client_id`, `sell_id` , `quantity` ,`sellprice`, `finalprice`) VALUES ('".$idd."','".$UserData["company_id"]."','".$UserData["User_id"]."','".$clientid."','".$sell_id."','".$ProductQuantity."','".$Product["sellprice"]."','".$Product["sellprice"] * $ProductQuantity."')";
echo $pdo->exec($sqlproduct);
OutOfStock($idd, $ProductQuantity);
}
}
?>