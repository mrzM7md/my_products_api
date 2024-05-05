<?php
    include "securityMethods.php";
    $x = imageupload("file");
    print($x);
    $microtime = microtime(true);
    $timestamp = sprintf("%0.6f", $microtime);
    print($timestamp);
?>