<?php
    $servername="localhost";
    $username="root";
    $password="";
    $db="careconnect";
    $conn=mysqli_connect($servername,$username,$password,$db);
    if(!$conn){
        echo "Connection failed".mysqli_error();
    }
?>