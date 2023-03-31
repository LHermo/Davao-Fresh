<?php
$dbname = "davao_fresh";
$dbuser = "root";
$dbpass = "";
$dbhost = "localhost";

try{
    $pdo = new PDO("mysql:host=". $dbhost . ";dbname=".$dbname, $dbuser, $dbpass);
}catch(PDOException $err){
    echo "Problema: ". $err->getMessage();
    exit();
}
?>