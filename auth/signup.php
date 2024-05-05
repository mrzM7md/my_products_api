<?php

include "../connect.php";

$name = filterPostRequest(requestName: "name");
$username = filterPostRequest(requestName: "username");
$email = filterPostRequest(requestName: "email");
$password = filterPostRequest(requestName: "password");

try{
    $statment = $con->
                    prepare('INSERT INTO `users` (`name`, `username`, `email`, `password`) 
                             VALUES (?, ?, ?, ?)');

$statment->execute(array($name, $username, $email, $password));

$count = $statment->rowCount();
if($count > 0){
    echo json_encode(array("status" => "success"));
}
else{
    echo json_encode(array("status" => "fail"));
}
}catch(Exception $e){
    echo json_encode(array("status" => "fail"));
}

?>