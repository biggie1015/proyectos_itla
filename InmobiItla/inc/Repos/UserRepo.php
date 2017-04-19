<? 
function GetUser($id) {
  global $pdo;
  foreach($pdo->query('SELECT * FROM usuario WHERE id="'.$id.'" LIMIT 1') as $User) 
  {
       return $User;
  }

}

function GetUserByName($name) {
  global $pdo;
  foreach($pdo->query('SELECT * FROM usuario WHERE nombre="'.$name.'" LIMIT 1') as $User) 
  {
       return $User;
  }
}

function GetUsers() {
  global $pdo;
   $Users = [];
  foreach($pdo->query('SELECT * FROM usuario') as $User) 
  {
       $Users[$User["id"]] = $User;
  }
  return $Users;

}

?>