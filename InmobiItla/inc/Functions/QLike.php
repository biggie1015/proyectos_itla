<? 
header('Content-Type: application/json');
$isLogin = true;
include $_SERVER['DOCUMENT_ROOT'] . "/inc/init.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/UserRepo.php";
SetSession(GetUserByName("Guest"));
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/PersonTestRepo.php";

switch ($_POST['kind']) {
	case '1':
		echo Like($_POST['id']);
		break;
	case '2':
		echo Dislike($_POST['id']);
		break;
	case '3':
		echo rLike($_POST['id']);
		break;
	case '4':
		echo rDislike($_POST['id']);
		break;

	default:
		# code...
		break;
}
?>