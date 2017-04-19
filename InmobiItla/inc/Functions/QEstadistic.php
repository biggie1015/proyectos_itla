<? 
header('Content-Type: application/json');
$isLogin = true;
include $_SERVER['DOCUMENT_ROOT'] . "/inc/init.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/UserRepo.php";
SetSession(GetUserByName("Guest"));
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/PersonTestRepo.php";
echo json_encode(GetQuestionEstadistic());


?>