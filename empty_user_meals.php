<?php
// add this at the start of the script
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// Include config file
require_once "config.php";

session_start();

$user_id = ($_SESSION["id"]);

//Check if Patients Reference Data Records Exist
$result = mysqli_query($mysqli,"SELECT * from patient_meals where user_id=$user_id");
$stmt = mysqli_num_rows($result);
if($stmt >1){
// Attempt Delete query execution
    $sql = "DELETE from patient_meals where user_id=$user_id";
    if($mysqli->query($sql) === true){
        header("location: breakfast_meal.php");
    } 
    else{
        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
        header("location: patients_list.php");
    }
}
   

$mysqli->close();
?>