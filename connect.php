<?php
    $dsn = "mysql:host=localhost;dbname=products_api";
    $user = "root";
    $pass = "";
    $option = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
    );

    try{
        $con = new PDO($dsn, $user, $pass ,$option);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        include "securityMethods.php";
    }catch(PDOException $ex){
        echo $ex->getMessage();
    }
?>