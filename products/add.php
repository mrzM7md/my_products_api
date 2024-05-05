<?php

include "../connect.php";

$user_id = filterPostRequest('user_id');
$title = filterPostRequest('title');
$description = filterPostRequest('description');
$price = filterPostRequest('price');
$image_name = imageupload("image");

if($image_name[0] == "fail"){ // there input problem
    echo json_encode(array("status" => "file-fail", "message" => $image_name[1]));
    return;
}

if($image_name[0] == "success"){ // there is no image
    $image_name[0] = "";
}

$statment = $con-> prepare('INSERT INTO `products`(title, description, price, image, user_id) VALUES (?, ?, ?, ?, ?)');

$statment->execute(array($title, $description, $price, $image_name[0], $user_id));

$count = $statment->rowCount();

if($count > 0){
    echo json_encode(array("status" => "success", "message" => "added successfully"));
}
else{
    echo json_encode(array("status" => "fail", "messgae" => "check info !"));
}


?>