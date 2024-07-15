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
    $user_id = ($_SESSION["id"]);
    $eer = $mysqli ->real_escape_string($_POST['eer']);
    $protein = $mysqli ->real_escape_string($_POST['protein']);
    $fat = $mysqli ->real_escape_string($_POST['fat']);
    $carbohydrate = $mysqli ->real_escape_string($_POST['carbohydrate']);
    $water = $mysqli ->real_escape_string($_POST['water']);
    $fibre = $mysqli ->real_escape_string($_POST['fibre']);
    $calcium = $mysqli ->real_escape_string($_POST['calcium']);
    $iron = $mysqli ->real_escape_string($_POST['iron']);
    $magnesium = $mysqli ->real_escape_string($_POST['magnesium']);
    $phosphorous = $mysqli ->real_escape_string($_POST['phosphorous']);
    $potassium = $mysqli ->real_escape_string($_POST['potassium']);
    $sodium = $mysqli ->real_escape_string($_POST['sodium']);
    $zinc = $mysqli ->real_escape_string($_POST['zinc']);
    $sellenium = $mysqli ->real_escape_string($_POST['sellenium']);
    $vitarae = $mysqli ->real_escape_string($_POST['vitarae']);
    $vitare = $mysqli ->real_escape_string($_POST['vitare']);
    $retinol = $mysqli ->real_escape_string($_POST['retinol']);
    $bcarotene = $mysqli ->real_escape_string($_POST['bcarotene']);
    $thiamin = $mysqli ->real_escape_string($_POST['thiamin']);
    $riboflavin = $mysqli ->real_escape_string($_POST['riboflavin']);
    $niacin = $mysqli ->real_escape_string($_POST['niacin']);
    $dietaryfolate = $mysqli ->real_escape_string($_POST['dietaryfolate']);
    $foodfolate = $mysqli ->real_escape_string($_POST['foodfolate']);
    $vitb12 = $mysqli ->real_escape_string($_POST['vitb12']);
    $vitc = $mysqli ->real_escape_string($_POST['vitc']);
    $cholestrol = $mysqli ->real_escape_string($_POST['cholestrol']);
    $oxalicacid = $mysqli ->real_escape_string($_POST['oxalicacid']);
    $phytate = $mysqli ->real_escape_string($_POST['phytate']);

//
$rule = mysqli_query($mysqli,"SELECT * from reference where user_id=$user_id LIMIT 1") ;
$stmt = mysqli_num_rows($rule);
if($stmt == 0){

// Attempt insert query execution
$sql = "INSERT IGNORE INTO reference ( user_id, eer, protein, fat, carbohydrate, water, fibre, calcium, iron, magnesium, phosphorous, potassium, sodium, zinc, sellenium, vitarae, vitare, retinol, bcarotene, thiamin, riboflavin, niacin, dietaryfolate, foodfolate, vitb12, vitc, cholestrol, oxalicacid, phytate) VALUES ('$user_id', '$eer', '$protein', '$fat', '$carbohydrate', '$water', '$fibre', '$calcium', '$iron', '$magnesium', '$phosphorous', '$potassium', '$sodium', '$zinc', '$sellenium', '$vitarae', '$vitare', '$retinol', '$bcarotene', '$thiamin', '$riboflavin', '$niacin', '$dietaryfolate', '$foodfolate', '$vitb12', '$vitc', '$cholestrol', '$oxalicacid', '$phytate')";

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