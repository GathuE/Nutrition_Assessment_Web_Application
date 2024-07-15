<?php
// Include config file
require_once "config.php";
session_start();

//$meal = $mysqli->real_escape_string($_REQUEST['meal']);
$foods_id = $mysqli->real_escape_string($_REQUEST['foods_id']);
$servings_id = $mysqli->real_escape_string($_REQUEST['servings_id']);
$amount = $mysqli->real_escape_string($_REQUEST['amount']);
$user_id = ($_SESSION["id"]);

//Insert Query
$sql = "INSERT INTO patient_meals ". "(meal,foods_id, servings_id, amount,user_id
               ) ". "VALUES('latesupper','$foods_id','$servings_id','$amount', '$user_id')";

               if($mysqli->query($sql) === true){
                echo "Records inserted successfully.";
                header("location: late_supper.php");
            } else{
                echo "Something went wrong. Please try again.";
            }
            $mysqli->close();
?>