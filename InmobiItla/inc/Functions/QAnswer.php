<? 
header('Content-Type: application/json');
$isLogin = true;
include $_SERVER['DOCUMENT_ROOT'] . "/inc/init.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/UserRepo.php";
SetSession(GetUserByName("Guest"));
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/PersonTestRepo.php";

switch ($_POST['answer']) {
	case 'S':
		echo AnswerYes($_POST['id']);
		break;
	case 'N':
		echo AnswerNo($_POST['id']);
		break;
	default:
		# code...
		break;
}
?>