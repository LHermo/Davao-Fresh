<?php
$dbname = "davao_fresh";
$dbuser = "root";
$dbpass = "";
$dbhost = "localhost";

try{
    $conn = new PDO("mysql:host=". $dbhost . ";dbname=".$dbname, $dbuser, $dbpass);
}catch(PDOException $err){
    echo "Problema: ". $err->getMessage();
    exit();
}
?>