<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/init.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/UserRepo.php";
$Parameters = "";
$Values = "";
$UpdateData = "";

$updateKey = "Macro_id";
$updatecriteria = "";
$userid = "User_id";
$company = "company_id";
$table = "mbt_process_macros";

$isUpdate = false;

foreach ($_POST as $Variable=>$Value) {
if($Value != "" && $Value != " " && $Variable != $updateKey) {
$Parameters .=  "`".$Variable."`,";
if ($Value == "on") {
	$Values .= "'1',";
} else {
	$Values .= "".$pdo->quote($Value).",";
}
$UpdateData .= "`".$Variable."`"."="."'".$Value."',";
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
$UpdateData = rtrim($UpdateData, ",");
$Values = rtrim($Values, ",");
$Parameters = rtrim($Parameters, ",");

if ($isUpdate) {
	echo $pdo->exec('UPDATE `'.$table.'` SET '.$UpdateData.' WHERE '.$updateKey.' = "'.$updatecriteria.'"');
} else {
    echo $pdo->exec('INSERT INTO `'.$table.'`('.$Parameters.') VALUES ('.$Values.')');
}
?>