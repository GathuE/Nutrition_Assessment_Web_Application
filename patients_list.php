<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
	exit;	
}
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$db = new mysqli("localhost", "root", "", "nutrivaluation");
 
// Check connection
if($db === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
$user_id = ($_SESSION["id"]);

 $results = mysqli_query($db, "SELECT patients.age, patients.gender,patients.height, patients.weight, patients.pregnant, 
 patients.lactating,patients.work,patients.targetgoal, users.id as users, users.name
 FROM patients 
 INNER JOIN users
 ON patients.user_id = users.id
 WHERE user_id =$user_id LIMIT 1"); ?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Nutrition Evaluation Tool">
        <meta name="description" content="Healthy Nutrition and Fitness">
        <meta name="keywords" content="weightmanagement, healthydiets, bodybuilding, fitness, healthymeals, nutrievaluator, wellness">
    
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <!-- SweetAlert CSS -->
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    
        <!-- Jquery and JsPDF -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
        <!--Custom CSS-->
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="sweetalert2.min.css">
    
        <link rel="icon" href="#" type="image/icon type">
        <title>Nutri Evaluator</title>
        
    </head>

<body>

 <div class="container" id="container">
          <div class="row justify-content center">
                <div class="col-12 col-sm-12 col-md-12">
                    <div class="card" id="#" class="divs" style="position:relative;top:20px;border-radius:5px; cursor:pointer;">
                    <div class="card-body">
                      <div class="container-fluid">
                                    <table class="table" style="font-size:13px;max-width:auto;">
                                        <thead>
                                            <tr class="success" style="font-family:monospace;font-weight:900;color:blue;">
                                               
                                                <th>Name</th>
                                                <th>Gender</th>
                                                <th>Age(yrs)</th>
                                                <th>Height(cm)</th>
                                                <th>Weight(kg)</th>
                                                <th>P.A.L</th>
                                                <th>Goal</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <?php if ($row = mysqli_fetch_array($results)) { ?>
                                            <tr>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['gender']; ?></td>
                                                <td><?php echo $row['age'] ; ?> </td>
                                                <td><?php echo $row['height']; ?></td>
                                                <td><?php echo $row['weight']; ?></td>
                                                <td><?php echo $row['work']; ?></td>
                                                <td><?php echo $row['targetgoal']; ?></td>
                                                <!--td>
                                                    <a href="patient_report.php?user_id=<?php echo $row['user_id']; ?>" >View</a>
                                                </td-->
                                                <td>
                                                        <a href="pdfdownload.php?user_id=<?php echo $row['users']; ?>" class="btn btn-primary btn-xs pull-right" style="font-size:11px;" role="button">View Client's Report</a>
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <td colspan="9">
                                                        <a href="show_meals.php?user_id=<?php echo $row['users']; ?>" class="btn btn-info btn-xs pull-right" style="font-size:11px;color:white;float:left;" onClick="javascript:return confirm ('Are you Sure You Want to Change Meals?');" role="button">Change Client's Meals History</a> &nbsp; &nbsp;
                                                        <a href="delete_bio.php?user_id=<?php echo $row['users']; ?>" class="btn btn-warning btn-xs pull-right" style="font-size:11px;color:white;" onClick="javascript:return confirm ('Are you Sure You Want to Delete Client's Bio Data?');" role="button">Delete Client's Bio Data</a>
                                                </td>
                                                
                                            </tr>
                                           
                                            
                                       
                                    </table>
                                    <?php } else header("location: home.php");
                                        ?>
                      </div>
                    </div>
                </div>
        </div>
</div>

