<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "ration";

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$db_select=mysqli_select_db($conn,$dbname);
?>