<?
echo "Sub";
$temp = $_SERVER['DOCUMENT_ROOT'] . '/Music/tmp/';
foreach ($_POST as $key => $value) {
	echo $key;
}
foreach ($_GET as $key => $value) {
	echo $key;
}
foreach ($_FILES as $S => $FILE) {
	echo $S;
	$filename = $S.'.slf';
	move_uploaded_file($_FILES[$S]["tmp_name"], $temp.$filename);
	
}


?>