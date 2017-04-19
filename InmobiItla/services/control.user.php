<?php 
header("content-type : application/json");
if(isset($_GET["user"])) {
if(strtoupper($_GET["user"]) == "ADMIN" && $_GET["pass"] == "admin") { 
echo '[{"id" : 1, "user" : "Admin", "pass" : "admin"}]';
} else {
echo '[]';
}
} else {
echo '[]';

}



?>