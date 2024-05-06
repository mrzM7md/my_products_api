<?php
    include "../connect.php";
    $user_id = filterGetRequest("user_id");
    $product_id = filterGetRequest("id");
    $image_name = filterGetRequest("image");

    $stmt = $con->prepare("DELETE FROM products WHERE id = ? and user_id=?");
    $stmt->execute(array($product_id, $user_id));
    
    $count = $stmt->rowCount();
    
    
    if ($count > 0) {
        if($image_name){
            if(file_exists("../assets/images/".$image_name)) {
                deleteFile("../assets/images", $image_name);
            }
        }
        echo json_encode(array("status" => "success", "message" => "deleted successfully"));
        return;
    }
    
    echo json_encode(array("status" => "fail", "message" => "fail !!"));
        
?>