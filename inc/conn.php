<?php 
try {
    $dsn = "mysql:host=localhost;port=3307;dbname=todolist";
    $userName = "root" ;
    $pwd = "" ;
    $conn = new PDO($dsn,$userName,$pwd);
} catch (PDOException $e) {
    echo "Not Connected : ".$e->getMessage();
}



?>