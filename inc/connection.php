<?php

    $db = mysqli_connect("localhost", "root", "", "movie");

    if($db){
        // echo "Database Connection Established !";
    } else {
        echo "Database Connection Established Failed !";
    }

    ob_start();

?>
