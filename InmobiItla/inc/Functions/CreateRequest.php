<?
$isLogin = true;
include $_SERVER['DOCUMENT_ROOT'] . "/inc/init.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/UserRepo.php";
$Parameters = "";
$Values = "";
$UpdateData = "";

$updateKey = "CRequest_id";
$updatecriteria = "";
$userid = "User_id";
$company = "company_id";
$table = "mbt_clientrequest";

$isUpdate = false;

foreach ($_POST as $Variable=>$Value) {
if($Value != "" && $Value != " " && $Variable != $updateKey) {
$Parameters .=  "`".$Variable."`,";
$Values .= "'".$Value."',";
$UpdateData .= "`".$Variable."`"."="."'".$Value."',";
} 
if ($Variable == $updateKey && $Value != "") {
$isUpdate=true;
$updatecriteria = $Value;
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