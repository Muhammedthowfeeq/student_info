<?php

// connect to database
// mysqli_connect(hostname, username, password, database)
$localhost = "localhost";
$username = "root";
$password = "";
$database = "schooldb";

$conn = mysqli_connect($localhost, $username, $password, $database);


// check for failed connection
if(!$conn){
    die("Connection Failed".mysqli_connect_error());
}


