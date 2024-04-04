<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = 'Gagandeep';
$database = 'Gagandeep';
$con = mysqli_connect($host, $username, $password, $dbname);

if (!$con)
{
    die("Connection failed!" . mysqli_connect_error());
}

?>
