<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/init.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/Repos/UserRepo.php";

$ConversationData = [];
$RUser_ID = $_GET["UID"];

function GetConv($RUser_ID) {
global $pdo, $UserData;
$Conversation_ID = "0";
  foreach($pdo->query('SELECT * FROM mbt_conversations WHERE User_ID = "'.$UserData["User_id"].'" AND RUser_ID = "'.$RUser_ID.'" OR RUser_ID = "'.$UserData["User_id"].'" AND User_ID = "'.$RUser_ID.'"') as $Conver) 
  {
       $Conversation_ID = $Conver["Conversation_ID"];
  }
  return $Conversation_ID;
}

$CID = GetConv($_GET["UID"]);

if( $CID == "0") {
$pdo->exec("INSERT INTO `mbt_conversations`(`User_ID`, `RUser_ID`) VALUES ('".$UserData["User_id"]."','".$_GET["UID"]."')");
GetConv($RUser_ID);
} 

function GetMessages($Conversation_ID) {
global $pdo, $UserData;
$Messages = [];
  foreach($pdo->query('SELECT * FROM mbt_conversations_messages WHERE Conversation_ID = "'.$Conversation_ID.'" ORDER BY Date ASC') as $Message) 
  {
  	$Message["UserName"] = AssociateID($Message["Sender_ID"], "User_id");
  	   if ($Message["Sender_ID"] == $UserData["User_id"]) {
  	   		$Message["Sender_ID"] = "1";
  	   }
       $Messages[$Message["Msj_ID"]] = $Message;

  }
  return $Messages;
}
$ConversationData["CID"] = $CID;
$ConversationData["Messages"] = GetMessages($CID);
echo json_encode($ConversationData);
?>