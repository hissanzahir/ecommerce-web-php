<?php

$servername="localhost:3307";
$username="root";
$password="";
$dbname="malefashion";

$con=mysqli_connect("$servername","$username","$password","$dbname");

if($con){
    // echo "CONNECTION SUCCESSFUL";
}else{
    echo "CONNECTION FAILED";
}


?>