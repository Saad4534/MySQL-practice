<?php 

$server = "localhost";
$username = "root";
$password = "";
$db = "my_first_database";

// Connect to DB

$connection = mysqli_connect($server,$username,$password,$db);

// Check connection

if(!$connection){
    die("Connection failed: ".mysqli_connect_error());
}

//echo "Connected Successfully";

?>