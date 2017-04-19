<? 
$databasehost = "localhost"; 
$databasename = "inmobi-itla"; 
$databaseusername="root"; 
$databasepassword = "qwerty";


try {
    $pdo = new PDO("mysql:host=$databasehost;dbname=$databasename", 
        $databaseusername, $databasepassword,
        array(
            PDO::MYSQL_ATTR_LOCAL_INFILE => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
    );
} catch (PDOException $e) {
    die("database connection failed: ".$e->getMessage());
}


?>