<?
$isLogin = true;
include $_SERVER['DOCUMENT_ROOT'] . "/inc/init.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/UserRepo.php";
$Data = [];
function GetArrayAsPicker($Array, $Value, $Label) {
  $SelectOptions = [];
  $Index = 0;
  foreach ($Array as $Obj) {
    $SelectOptions[$Index]["label"] = $Obj[$Label];
  	$SelectOptions[$Index]["data"] =$Obj[$Value];
  	$Index = $Index+1;
  }
  return $SelectOptions;
}

$Data["CustomerKinds"] =  GetArrayAsPicker(GetCustomerKinds(), "CustomerKind_id", "CustomerKindDisplay");
$Data["DocumentTypes"] =  GetArrayAsPicker(GetDocumentTypes(), "DType_id", "DocumentDisplay");
$Data["Sex"] =  GetArrayAsPicker(GetGenres(), "genre_id", "GenreName");
$Data["InterestQuotes"] =  GetArrayAsPicker(GetInterestQuotes(), "InterestQuotes_id", "InterestQuotesDisplay");

echo json_encode($Data)
?>