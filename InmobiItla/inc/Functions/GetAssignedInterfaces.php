<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/init.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/CompanyRepo.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/UserRepo.php";

echo GetAssignedInterfaces($_SESSION['User']) ;
?>