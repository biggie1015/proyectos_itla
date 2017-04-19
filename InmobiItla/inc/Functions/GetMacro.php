<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/init.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/UserRepo.php";


function GetMacro($id) {
  global $pdo;
  foreach($pdo->query('SELECT * FROM mbt_process_macros WHERE Macro_id='.$pdo->quote($id).' LIMIT 1') as $Macro) 
  {
       return $Macro;
  }

}


echo json_encode(GetMacro($_GET["id"]));
?>