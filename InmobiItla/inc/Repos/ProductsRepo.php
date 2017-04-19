<?

function GetCategories() {
    global $pdo;
  $Categories = [];
  foreach($pdo->query('SELECT * FROM tipos_productos') as $Category) 
  {
       $Categories[$Category['tipo_producto_id']] = $Category;
  }
  return $Categories;
}

function GetActions() {
    global $pdo;
  $Categories = [];
  foreach($pdo->query('SELECT * FROM tipo_acciones') as $Category) 
  {
       $Categories[$Category['tipo_acciones_id']] = $Category;
  }
  return $Categories;
}

function addCategory($CategoryName) {
	if ($CategoryName !="") {
	$pdo->exec('INSERT INTO `tipos_productos`(`tipo_producto_display`) VALUES ("'.$CategoryName.'")');
	}
}

function GetProducts($criteria) {
  global $pdo;
  $Products = [];
  $sql = "";
  if ($criteria != "") {
    $sql = 'SELECT * FROM producto WHERE titulo LIKE "%'.$criteria.'%" OR direccion = "'.$criteria.'"';
  } else  {
    $sql = 'SELECT * FROM producto';
  }
  foreach($pdo->query($sql) as $Product) 
  {
      foreach ($Product as $key => $value) {
        if (AssociateID($value, $key)) {
        $Product[$key."_Display"] = AssociateID($value, $key);
        }
      }
       $Products[$Product['id']] = $Product;
  }

  return $Products;    
}

function GetProduct($id) {
global $pdo;
$UCompany = $_SESSION["User"]["company_id"];
$sql = 'SELECT * FROM producto WHERE id = "'.$id.'"';
foreach($pdo->query($sql) as $Product) 
  {
      foreach ($Product as $key => $value) {
        if (AssociateID($value, $key)) {
        $Product[$key."_Display"] = AssociateID($value, $key);
        }
      }
    return $Product;
  }  
}

function OutOfStock($pid, $q) {
  global $pdo;
	$UCompany = $_SESSION["User"]["company_id"];
	$pdo->exec('UPDATE producto SET cantidad = cantidad -'.$q.' WHERE id = "'.$pid.'"');
}
?>