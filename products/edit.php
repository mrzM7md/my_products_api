<?php

include "../connect.php";

$user_id = filterPostRequest('user_id');
$product_id = filterPostRequest('id');
$title = filterPostRequest('title');
$description = filterPostRequest('description');
$price = filterPostRequest('price');
$last_image_name = filterPostRequest('last_image_name');
$image_name = imageupload("image");

if($image_name[0] == "fail"){ // there input problem
    echo json_encode(array("status" => "file-fail", "message" => $image_name[1]));
    return;
}

if($image_name[0] == "success"){ // there is no image, but we have the image name in [1]
    $image_name[0] = $last_image_name;
}
else { // ther is new image, 1- delete last
    if(file_exists("../assets/images/".$last_image_name)) {
        deleteFile("../assets/images", $last_image_name);
    }
}

$statment = $con-> prepare('UPDATE `products` SET title=?, description=?, image=?, price=? WHERE id=? and user_id=?');

$statment->execute(array($title, $description, $image_name[0], $price, $product_id, $user_id));

$count = $statment->rowCount();

if($count > 0){
    echo json_encode(array("status" => "success", "message" => "edited successfully"));
}
else{
    echo json_encode(array("status" => "fail", "message" => "check info !"));
}

?>