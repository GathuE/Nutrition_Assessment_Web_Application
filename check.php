<?php 
  $db = mysqli_connect('localhost', 'root', '', 'nutrivaluation');
  
  
  if (isset($_POST['patients'])) {
    $user_id = ($_SESSION["id"]);
  	
  	$sql_u = "SELECT * FROM patients WHERE user_id='$user_id'";
  	$res_u = mysqli_query($db, $sql_u);

  	if (mysqli_num_rows($res_u) > 0) {
        header("location: patients_data.php"); 	
  	}
  else{ header("location: welcome.php");}}
        ?>