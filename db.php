<?php
    //Makes DB connection
    ini_set('display_errors', 1);
    $servername = "sql1.njit.edu";
    $username = "ny79";
    $password = "Not1\$ecure?!bad";
    $dbname = "ny79";
    $con = mysqli_connect($servername,$username,$password,$dbname);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    //Not1$ecure?!bad
?>