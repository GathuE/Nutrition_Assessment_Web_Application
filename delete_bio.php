<?php
error_reporting(E_ERROR);
// Include config file
require_once "config.php";
session_start();

$user_id = ($_SESSION["id"]);

//Check if Patients Bio Data Records Exist
$check = mysqli_query($mysqli,"SELECT * from patients where user_id=$user_id LIMIT 1") ;
$stmt = mysqli_num_rows($check);
if($stmt == 1){
// Attempt Delete query execution
    $sql = "DELETE FROM patients where user_id=$user_id LIMIT 1";
    if($mysqli->query($sql) === true){
        echo "Bio Data Deleted Successfully.";
        header("location: home.php");
    } else{
        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
    }
    }
    else {
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
    }

//Check if Patients Reference Data Records Exist
$check2 = mysqli_query($mysqli,"SELECT * from reference where user_id=$user_id LIMIT 1") ;
$stmt = mysqli_num_rows($check2);
if($stmt == 1){
// Attempt Delete query execution
    $sql2 = "DELETE FROM reference where user_id=$user_id LIMIT 1";
    if($mysqli->query($sql2) === true){
        echo "Reference Data Deleted Successfully.";
        header("location: home.php");
    } else{
        echo "ERROR: Could not able to execute $sql2. " . $mysqli->error;
    }
    }
    else {
    echo "ERROR: Could not able to execute $sql2. " . $mysqli->error;
    }

$mysqli->close();
?>