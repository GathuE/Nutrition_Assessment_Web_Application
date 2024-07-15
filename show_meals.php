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
 patients.lactating,patients.work, users.id as users, users.name
 FROM patients 
 INNER JOIN users
 ON patients.user_id = users.id
 WHERE user_id =$user_id LIMIT 1"); 
 
 ?>

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
<!-- Navigation -->
<?php 
    include 'navbar.php';


?>

<div class="container-fluid" style="margin-bottom:20px;">
    
    <table class="table responsive">
                <tr>
                        <td>

                            <!-- Breakfast Show Meals Input SQL -->
                                <?php 
                                $user_id = ($_SESSION["id"]);

                                $select_breakfast= mysqli_query($db, "SELECT patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
                                users.id, users.name
                                FROM patient_meals  
                                INNER JOIN foods ON foods.id=patient_meals.foods_id  
                                INNER JOIN servings ON servings.id=patient_meals.servings_id
                                INNER JOIN users ON users.id = patient_meals.user_id
                                WHERE user_id=$user_id AND meal='Breakfast'");
                                
                                
                                ?>
                            <!-- Breakfast Table -->
                            <div class="container" id="container">
                                    <div class="row justify-content center">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="position:relative;display:block;top:20px;border-radius:5px; cursor:pointer;">
                                                    <div class="card">
                                                        <div class="card-header" style="font-size: 16px;font-weight:900;text-align:center; font-family:'Patrick Hand', cursive;color:purple;">Breakfast Meals : <br> </div>
                                                        <div class="card-body">
                                                            <div class="container-fluid">


                                                            <?php if (mysqli_num_rows($select_breakfast) > 0 ){ ?>
        
                                                                    <table class="table" style="font-size:12px;">
                                                                        <thead>
                                                                            <tr class="success" style="font-family:monospace;font-weight:900;color:blue;">
                                                                                
                                                                                <!-- <th>ID</th> --->
                                                                                <th>Food(s)</th>
                                                                                <th>Serving Amount(s)</th>
                                                                                <th colspan="2">Action</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <?php
                                                                                $i=0;
                                                                               while ($row = mysqli_fetch_array($select_breakfast)){ 
                                                                                
                                                                        ?>
                                                                            <tr>
                                                                                
                                                                                <input type="hidden" <?php echo $row['mealid'] ?>>
                                                                                <td><?php echo $row['food']; ?></td>
                                                                                <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                                                                <td>
                                                                                                <!-- <a href="#?mealid=<?php echo $row["mealid"]; ?>" class="btn btn-info btn-xs"  style="font-size:12px;color:white;" role="button">Edit</a> --->
                                                                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" class="btn btn-warning btn-xs" style="font-size:12px;color:white;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');" role="button">Delete</a>
                                                                                 </td>
                                                                                 
                                                                            </tr>
                                                                        
                                                                            <?php $i++;
                                                                            }
                                                                            ?>
                                                                    </table>

                                                            <?php 
                                                                }
                                                            
                                                            else 
                                                            {
                                                            echo "You Have No Meal Entries Under this Category";
                                                            } 
                                                    
                                                            ?>
                                                                        
                                                            </div>
                                                        </div>
                                            
                                                    </div>
                                            </div>
                                    </div>
                            </div>

                        </td>
                        <td>


                         <!-- Mid Morning Show Meals Input SQL -->
                         <?php 
                                $user_id = ($_SESSION["id"]);

                                $select_midmorning= mysqli_query($db, "SELECT patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
                                users.id, users.name
                                FROM patient_meals  
                                INNER JOIN foods ON foods.id=patient_meals.foods_id  
                                INNER JOIN servings ON servings.id=patient_meals.servings_id
                                INNER JOIN users ON users.id = patient_meals.user_id
                                WHERE user_id=$user_id AND meal='mid-morning'");

                          

                        ?>
                            <!-- Mid Morning Table -->
                            <div class="container" id="container">
                                        <div class="row justify-content center">
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="position:relative;display:block;top:20px;border-radius:5px; cursor:pointer;">
                                                        <div class="card">
                                                        <div class="card-header" style="font-size: 16px;font-weight:900;text-align:center; font-family:'Patrick Hand', cursive;color:purple;">Mid Morning Meals : <br> </div>
                                                            <div class="card-body">
                                                                <div class="container-fluid">

                                                                         <?php if (mysqli_num_rows($select_midmorning) > 0 ){ ?>
        
                                                                                <table class="table" style="font-size:12px;">
                                                                                    <thead>
                                                                                        <tr class="success" style="font-family:monospace;font-weight:900;color:blue;">
                                                                                            <!-- <th>ID</th> --->
                                                                                            <th>Food(s)</th>
                                                                                            <th>Serving Amount(s)</th>
                                                                                            <th colspan="2">Action</th>
                                                                                        </tr>
                                                                                    </thead>

                                                                                    <?php
                                                                                            $i=0;
                                                                                            while ($row = mysqli_fetch_array($select_midmorning)){ 
                                                                                                
                                                                                    ?>
                                                                                        <tr>

                                                                                             <input type="hidden" <?php echo $row['mealid'] ?>>
                                                                                            <td><?php echo $row['food']; ?></td>
                                                                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                                                                            <td>
                                                                                                <!-- <a href="#?mealid=<?php echo $row["mealid"]; ?>" class="btn btn-info btn-xs"  style="font-size:12px;color:white;" role="button">Edit</a> --->
                                                                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" class="btn btn-warning btn-xs" style="font-size:12px;color:white;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');" role="button">Delete</a>
                                                                                            </td>
                                                                                        
                                                                                        </tr>
                                                                                        
                                                                                        <?php $i++;
                                                                                        }
                                                                                        ?>
                                                                                </table>

                                                                        <?php 
                                                                            }
                                                                        else 
                                                                        {
                                                                        echo "You Have No Meal Entries Under this Category";
                                                                        } 

                                                                        ?>
                                                                    
                                                                            
                                                                </div>
                                                            </div>
                                                
                                                        </div>
                                                </div>
                                        </div>
                            </div>

                        </td>

                </tr>
                <tr>

                        <td>
                        <!-- Lunch Show Meals Input SQL -->
                        <?php 
                                $user_id = ($_SESSION["id"]);

                                $select_lunch= mysqli_query($db, "SELECT patient_meals.id, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
                                users.id, users.name
                                FROM patient_meals  
                                INNER JOIN foods ON foods.id=patient_meals.foods_id  
                                INNER JOIN servings ON servings.id=patient_meals.servings_id
                                INNER JOIN users ON users.id = patient_meals.user_id
                                WHERE user_id=$user_id AND meal='Lunch'");
                                
                                

                        ?>
                            <!-- Lunch Table -->
                            <div class="container" id="container">
                                    <div class="row justify-content center">
                                            <div class="col-12 col-sm-12 col-md-12" style="position:relative;display:block;top:20px;border-radius:5px; cursor:pointer;">
                                                    <div class="card">
                                                    <div class="card-header" style="font-size: 16px;font-weight:900;text-align:center; font-family:'Patrick Hand', cursive;color:purple;">Lunch Meals : <br> </div>
                                                        <div class="card-body">
                                                            <div class="container-fluid">
                                                                

                                                                    <?php if (mysqli_num_rows($select_lunch) > 0) { ?>
                                                                        
                                                                            <table class="table" style="font-size:12px;">
                                                                                <thead>
                                                                                    <tr class="success" style="font-family:monospace;font-weight:900;color:blue;">
                                                                                        
                                                                                        <!-- <th>ID</th> --->
                                                                                        <th>Food(s)</th>
                                                                                        <th>Serving Amount(s)</th>
                                                                                        <th colspan="2">Action</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <?php
                                                                                        $i=0;
                                                                                        while ($row = mysqli_fetch_array($select_lunch)){ 
                                                                                           
                                                                                ?>
                                                                                    <tr>

                                                                                         <input type="hidden" <?php echo $row['mealid'] ?>>
                                                                                        <td><?php echo $row['food']; ?></td>
                                                                                        <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                                                                        <td>
                                                                                                <!-- <a href="#?mealid=<?php echo $row["mealid"]; ?>" class="btn btn-info btn-xs"  style="font-size:12px;color:white;" role="button">Edit</a> --->
                                                                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" class="btn btn-warning btn-xs" style="font-size:12px;color:white;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');" role="button">Delete</a>
                                                                                        </td>
                                                                                    
                                                                                    </tr>
                                                                                    
                                                                                    <?php $i++;
                                                                                    }

                                                                            
                                                                                    ?>
                                                                            </table>

                                                                    <?php 
                                                                    }
                                                                    else 
                                                                    {
                                                                    echo "You Have No Meal Entries Under this Category";
                                                                    } 

                                                                    ?>
                                                                        
                                                            </div>
                                                        </div>
                                            
                                                    </div>
                                            </div>
                                    </div>
                            </div>

                        </td>
                        <td>
                        <!-- Mid Afternoon Show Meals Input SQL -->
                        <?php 
                                $user_id = ($_SESSION["id"]);

                                $select_midafternoon= mysqli_query($db, "SELECT patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
                                users.id, users.name
                                FROM patient_meals  
                                INNER JOIN foods ON foods.id=patient_meals.foods_id  
                                INNER JOIN servings ON servings.id=patient_meals.servings_id
                                INNER JOIN users ON users.id = patient_meals.user_id
                                WHERE user_id=$user_id AND meal='midafternoon'");

                               

                        ?>
                                <!-- Mid Afternoon Table -->
                            <div class="container" id="container">
                                    <div class="row justify-content center">
                                            <div class="col-12 col-sm-12 col-md-12" style="position:relative;display:block;top:20px;border-radius:5px; cursor:pointer;">
                                                    <div class="card">
                                                    <div class="card-header" style="font-size: 16px;font-weight:900;text-align:center; font-family:'Patrick Hand', cursive;color:purple;">Mid Afternoon Meals : <br> </div>
                                                        <div class="card-body">
                                                            <div class="container-fluid">
                                                                

                                                                     <?php if (mysqli_num_rows($select_midafternoon) > 0  ){ ?>
        
                                                                            <table class="table" style="font-size:12px;">
                                                                                <thead>
                                                                                    <tr class="success" style="font-family:monospace;font-weight:900;color:blue;">
                                                                                        
                                                                                        <!-- <th>ID</th> --->
                                                                                        <th>Food(s)</th>
                                                                                        <th>Serving Amount(s)</th>
                                                                                        <th colspan="2">Action</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <?php
                                                                                        $i=0;
                                                                                        while ($row = mysqli_fetch_array($select_midafternoon)){ 
                                                                                           
                                                                                ?>
                                                                                    <tr>
                                                                                         <input type="hidden" <?php echo $row['mealid'] ?>>    
                                                                                        <td><?php echo $row['food']; ?></td>
                                                                                        <td><b><?php echo $row['amount'] ; ?></b> <?php echo $row['serving'  ] ; ?></td>
                                                                                        <td>
                                                                                                <!-- <a href="#?mealid=<?php echo $row["mealid"]; ?>" class="btn btn-info btn-xs"  style="font-size:12px;color:white;" role="button">Edit</a> --->
                                                                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" class="btn btn-warning btn-xs" style="font-size:12px;color:white;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');" role="button">Delete</a>
                                                                                        </td>
                                                                                    
                                                                                    </tr>
                                                                                    
                                                                                    <?php $i++;
                                                                                    }
                                                                                    ?>
                                                                            </table>

                                                                    <?php 
                                                                        }
                                                                    
                                                                    else 
                                                                    {
                                                                    echo "You Have No Meal Entries Under this Category";
                                                                    } 

                                                                    ?>
                                                                        
                                                            </div>
                                                        </div>
                                            
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                        </td>
                </tr>
                <tr>

                    <td>
                    <!-- Supper Show Meals Input SQL -->
                    <?php 
                                $user_id = ($_SESSION["id"]);

                                $select_supper= mysqli_query($db, "SELECT patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
                                users.id, users.name
                                FROM patient_meals  
                                INNER JOIN foods ON foods.id=patient_meals.foods_id  
                                INNER JOIN servings ON servings.id=patient_meals.servings_id
                                INNER JOIN users ON users.id = patient_meals.user_id
                                WHERE user_id=$user_id AND meal='supper'");

                                

                        ?>
                            <!-- Supper Table -->
                            <div class="container" id="container">
                                    <div class="row justify-content center">
                                            <div class="col-12 col-sm-12 col-md-12" style="position:relative;display:block;top:20px;border-radius:5px; cursor:pointer;">
                                                    <div class="card">
                                                    <div class="card-header" style="font-size: 16px;font-weight:900;text-align:center; font-family:'Patrick Hand', cursive;color:purple;">Supper Meals : <br> </div>
                                                        <div class="card-body">
                                                            <div class="container-fluid">


                                                                    <?php if (mysqli_num_rows($select_supper) > 0 ){ ?>
        
                                                                            <table class="table" style="font-size:12px;">
                                                                                <thead>
                                                                                    <tr class="success" style="font-family:monospace;font-weight:900;color:blue;">
                                                                                        
                                                                                        <!-- <th>ID</th> --->
                                                                                        <th>Food(s)</th>
                                                                                        <th>Serving Amount(s)</th>
                                                                                        <th colspan="2">Action</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <?php
                                                                                        $i=0;
                                                                                        while ($row = mysqli_fetch_array($select_supper)){
                                                                                          
                                                                                ?>
                                                                                    <tr>
                                                                                         <input type="hidden" <?php echo $row['mealid'] ?>>
                                                                                        <td><?php echo $row['food']; ?></td>
                                                                                        <td><b><?php echo $row['amount'] ; ?></b> <?php echo $row['serving'] ; ?></td>
                                                                                        <td>
                                                                                                <!-- <a href="#?mealid=<?php echo $row["mealid"]; ?>" class="btn btn-info btn-xs"  style="font-size:12px;color:white;" role="button">Edit</a> --->
                                                                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" class="btn btn-warning btn-xs" style="font-size:12px;color:white;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');" role="button">Delete</a>
                                                                                        </td>
                                                                                    
                                                                                    </tr>
                                                                                    
                                                                                    <?php $i++;
                                                                                    }
                                                                                    ?>
                                                                            </table>

                                                                    <?php 
                                                                        }
                                                                    
                                                                    else 
                                                                    {
                                                                    echo "You Have No Meal Entries Under this Category";
                                                                    } 

                                                                    ?>
                                                                
                                                                        
                                                            </div>
                                                        </div>
                                            
                                                    </div>
                                            </div>
                                    </div>
                            </div>

                    </td>
                    <td>
                         <!-- Late Supper Show Meals Input SQL -->
                        <?php 
                                $user_id = ($_SESSION["id"]);

                                $select_latesupper= mysqli_query($db, "SELECT patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
                                users.id, users.name
                                FROM patient_meals  
                                INNER JOIN foods ON foods.id=patient_meals.foods_id  
                                INNER JOIN servings ON servings.id=patient_meals.servings_id
                                INNER JOIN users ON users.id = patient_meals.user_id
                                WHERE user_id=$user_id AND meal='latesupper'");

                                

                        ?>
                        <!-- Late Supper Table -->
                            <div class="container" id="container">
                                    <div class="row justify-content center">
                                            <div class="col-12 col-sm-12 col-md-12" style="position:relative;display:block;top:20px;border-radius:5px; cursor:pointer;">
                                                    <div class="card">
                                                    <div class="card-header" style="font-size: 16px;font-weight:900;text-align:center; font-family:'Patrick Hand', cursive;color:purple;">Late Supper Meals : <br> </div>
                                                        <div class="card-body">
                                                            <div class="container-fluid">

                                                                    <?php if (mysqli_num_rows($select_latesupper) > 0 ){ ?>
        
                                                                            <table class="table" style="font-size:12px;">
                                                                                <thead>
                                                                                    <tr class="success" style="font-family:monospace;font-weight:900;color:blue;">
                                                                                        
                                                                                        <!-- <th>ID</th> --->
                                                                                        <th>Food(s)</th>
                                                                                        <th>Serving Amount(s)</th>
                                                                                        <th colspan="2">Action</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <?php
                                                                                        $i=0;
                                                                                        while ($row = mysqli_fetch_array($select_latesupper)){ 
                                                                                            
                                                                                ?>
                                                                                    <tr>
                                                                                         <input type="hidden" <?php echo $row['mealid'] ?>>
                                                                                        <td><?php echo $row['food']; ?></td>
                                                                                        <td><b><?php echo $row['amount'] ; ?></b> <?php echo $row['serving'] ; ?></td>
                                                                                       
                                                                                                
                                                                                       
                                                                                        <td>
                                                                                                <!-- <a href="#?mealid=<?php echo $row["mealid"]; ?>" class="btn btn-info btn-xs"  style="font-size:12px;color:white;" role="button">Edit</a> --->
                                                                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" class="btn btn-warning btn-xs" style="font-size:12px;color:white;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');" role="button">Delete</a>
                                                                                        </td>
                                                                                    
                                                                                    </tr>
                                                                                    
                                                                                    <?php $i++;
                                                                                    }
                                                                                    ?>
                                                                            </table>

                                                                    <?php 
                                                                        }
                                                                    
                                                                    else 
                                                                    {
                                                                    echo "You Have No Meal Entries Under this Category";
                                                                    } 

                                                                    ?>
                                                                
                                                                        
                                                            </div>
                                                        </div>
                                            
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </td>
                </tr>
        </table>

</div>
<br>

<div class="container" id="container">
          <div class="row justify-content center">
                <div class="col-12 col-sm-12 col-md-12">
                    <div class="card" id="#" class="divs" style="position:relative;top:20px;border-radius:5px; cursor:pointer;">
                    <div class="card-body">
                      <div class="container-fluid">
                         <a href="breakfast_meal.php" class="btn btn-warning btn-xs " style="font-size:11px;color:white;"  onClick="javascript:return confirm ('Are you Sure You Want to go Back to Meal's Form?');" role="button">Add Meals</a><BR> <br>
                         <a href="patients_list.php" style="font-family:monospace;font-size:14px;font-weight:bold;text-align:center;"  class="btn btn-info">Proceed</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

</body>
</html>




		


