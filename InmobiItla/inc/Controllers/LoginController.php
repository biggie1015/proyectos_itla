<? 
include $_SERVER['DOCUMENT_ROOT'] . "/inc/init.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/UserRepo.php";

function Login($User, $Password) {
$User = GetUserByName($User);
$Info = [];
$PassHash = md5($Password);
	if ($User["habilitado"] > 0 && $User["clave"] == $PassHash) {
			SetSession($User);
 			$Info["Status"] = 1;
 			$Info["Msj"] = "Iniciando Sesion.";
			return $Info;	
 	} else {
 			$Info["Status"] = 0;
 			$Info["Msj"] = "Informacion incorrecta."; 
			return $Info;
 		}
}


function LogOut() {
	UnsetSession();
}
?>