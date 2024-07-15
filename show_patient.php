<?php
include "navbar.php";
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
	exit;
	
	
}
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$db = new mysqli("localhost", "root", "adit/005", "nutrivaluation");
 
// Check connection
if($db === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
$result = mysqli_query ("SELECT * FROM patients WHERE id = 1");
if ($result) {
  if (mysqli_num_rows($result) > 0) {
    echo 'found!';
  } else {
    echo 'not found';
  }
} else {
  echo 'Error: '.mysqli_error();
}