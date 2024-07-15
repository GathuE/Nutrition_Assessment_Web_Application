<?php

// Initialize the session
session_start();
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$mysqli = new mysqli("localhost", "root", "", "nutrivaluation");
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
// variables 
    $age = $mysqli ->real_escape_string($_POST['age']);
    $sex = $mysqli ->real_escape_string($_POST['sex']);
    $height = $mysqli ->real_escape_string($_POST['height']);
    $weight = $mysqli ->real_escape_string($_POST['weight']);
    $pregnant = $mysqli ->real_escape_string($_POST['pregnant']);
    $lactating = $mysqli ->real_escape_string($_POST['lactating']);
    $work = $mysqli ->real_escape_string($_POST['work']);
    $goal = $mysqli ->real_escape_string($_POST['goal']);
    $user_id = ($_SESSION["id"]);
//
$check = mysqli_query($mysqli,"SELECT * from patients where user_id=$user_id LIMIT 1") ;
$stmt = mysqli_num_rows($check);
if($stmt == 0){
    // Attempt insert query execution
    $sql = "INSERT IGNORE INTO patients (age, gender, height, weight, pregnant, lactating,  work, targetgoal, user_id) VALUES ('$age', '$sex', '$height', '$weight', '$pregnant', '$lactating',  '$work', '$goal', '$user_id')";
    if($mysqli->query($sql) === true){
        echo "Records inserted successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
    }
}
else {
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

// Close connection
$mysqli->close();
?>