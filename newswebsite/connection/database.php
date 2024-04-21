<?php

    $host = 'localhost';
    $username = 'root';
    $password = 'root';
    $dbname = 'newswebsite';


    $conn = mysqli_connect($host, $username, $password, $dbname);

    if(!$conn)
    {
        die ('Database not connected.');
    }

?>

