<?php
    function filterPostRequest($requestName){  // for sql injection !!
        return htmlspecialchars(strip_tags($_POST[$requestName]));
    }

    function filterGetRequest($requestName){  // for sql injection !!
        return htmlspecialchars(strip_tags($_GET[$requestName]));
    }

    define('MB', 1048576);
    
    function imageupload($imageRequest) {
    
      global $msgError;

      if (!isset($_FILES[$imageRequest])) {
      return array("success", $imageRequest ?? "" /* image name */ ); // there is no file added
      }
      else {
        // Generate a random name for the image
        $imagename = rand(1000, 10000) . '-' . sprintf("%0.6f", microtime(true)) . $_FILES[$imageRequest]['name'];
      
        // Get the temporary file name
        $imagetmp = $_FILES[$imageRequest]['tmp_name'];
      
        // Get the file size
        $imagesize = $_FILES[$imageRequest]['size'];
      
        // Allowed extensions
        $allowExt = array("jpg", "png", "gif", "jpeg");
      
        // Get the extension of the file
        $strToArray = explode(".", $imagename);
        $ext = strtolower(end($strToArray));
      
        // Check if the extension is allowed
        if (!empty($imagename) && !in_array($ext, $allowExt)) {
          $msgError[] = "only images !";
        }
      
        // Check if the file size is too large
        if ($imagesize > 2 * MB) {
          $msgError[] = "size not avoid 2 MB";
        }
      
        // If there are no errors, upload the file
        if (empty($msgError)) {
          move_uploaded_file($imagetmp, "../assets/images/" . $imagename);
          return array($imagename);
        } else {
          return array("fail", $msgError[0]);
        }
      }
    }

    function deleteFile($dir, $imagename) {
        if (file_exists($dir. "/" . $imagename)){
              unlink($dir. "/" . $imagename);
        }
      }
    
?>