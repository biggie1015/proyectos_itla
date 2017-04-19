<? 
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/inc/MySQL/connect.php";

$themeDefinition = "skin-green";


$Assocs = array(
    "tipo_usuario_id" => array(
         "id" => "tipo_usuario_id",
         "display" => "tipo_usuario_display",
         "table" => "tipos_usuarios"
    ),
    "tipo_producto_id" => array(
         "id" => "tipo_producto_id",
         "display" => "tipo_producto_display",
         "table" => "tipos_productos"
    ),
    "tipo_acciones_id" => array(
    "id" => "tipo_acciones_id",
    "display" => "tipo_acciones_display",
    "table" => "tipo_acciones"
    )
);

//Template Things 
$PageHeader = $_SERVER['DOCUMENT_ROOT'] . "/inc/Template/Header.php";
$PageFooter = $_SERVER['DOCUMENT_ROOT'] . "/inc/Template/Footer.php";

if (isset($_SESSION['User'])) {
	$UserData = $_SESSION["User"];
}

function SetSession($User) {
	$_SESSION["User"] = $User;
}

if (!isset($_SESSION['User']) && !$isLogin) {
  header("Location: /");
  die();
}

function GetArrayAsSelect($Array, $Value, $Label, $hasEmpty=false) {
  $SelectOptions = "";
  if ($hasEmpty) {
    $SelectOptions .= "<option value=''>-Nuevo-</option>";
  }
  foreach ($Array as $Obj) {
    $SelectOptions .= "<option value='".$Obj[$Value]."'>".$Obj[$Label]."</option>";
  }
  echo $SelectOptions;
}

function UnsetSession() {
  header("Location: /");
  session_unset(); 
  session_destroy();
}

function AssociateID($id, $name) {
  global $pdo, $Assocs;
  if (isset($Assocs[$name])) {
    $table = $Assocs[$name]["table"];
    $Base = $Assocs[$name]["id"];
    $display = $Assocs[$name]["display"];
    $val = "";
    foreach($pdo->query('SELECT * FROM '.$table.' WHERE '.$Base.'="'.$id.'" LIMIT 1') as $Assoc) 
    {
      
         $val = $Assoc[$display];
    }

    if ($val == "") {return " ";} else {return $val;};
  }
} 
?>