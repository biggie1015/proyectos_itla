<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/init.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/UserRepo.php";


function SendMessage($CID, $MSJ)
{
	global $pdo, $UserData;
	return $pdo->exec("INSERT INTO `mbt_conversations_messages` (`Conversation_ID`, `Sender_ID`, `Message`, `Date`, `Readed`, `Recieved`, `Type`) VALUES ('".$CID."', '".$UserData["User_id"]."', ".$pdo->quote($MSJ).", CURRENT_TIMESTAMP, '0', '0', '1')");
}

echo SendMessage($_GET["CID"], $_GET["MSJ"]);
?>