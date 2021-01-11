<?php
/**Propojeni s databazi */
$dsn = "mysql:host=".DB_SERVER.";dbname=".DB_NAME.";";

try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    return $pdo;
}catch(Exception $e) {
    throw new Exception("Chyba při spojení s databází.");
}

?>