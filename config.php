<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $db_name = "med_app_db";
    $connection = mysqli_connect($host, $username, $password, $db_name);

    if (!$connection) {
        # code...
        echo "Error! Connection Failed";
    }
?>