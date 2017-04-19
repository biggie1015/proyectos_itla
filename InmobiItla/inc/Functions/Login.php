<?
$isLogin = true;

if (!isset($_SESSION['User'])) {
	include $_SERVER['DOCUMENT_ROOT'] . "/inc/Controllers/LoginController.php";
	$username = $_GET['username'];
	$password = $_GET['password'];
	echo json_encode(Login($username, $password));
} else {
	echo "{Error}";
}
?>