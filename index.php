<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}
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
    
        <!--Custom CSS-->
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    
        <link rel="icon" href="img/logo.jpeg" type="image/icon type">
        <title>Nutri Evaluator</title>
        
        
            
    </head>
    <body>

<div class="row" style="margin-left:auto;margin-right:auto;max-width:450px;">
    

    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" style="max-width:auto;">
                        <div class="card-header">
                            <h5 style="text-align:center;color:orange;">Nutri Evaluator App</h5>
                            <h5 style="text-align:center;color:purple;">Login</h5>
                        </div>
                            <div class="card-body">
                                <div class="container">
                                    <form id="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Enter Username" autofocus>
                                                <span class="help-block" style="color:orangered; font-size:14px;"><?php echo $username_err; ?></span>
                                            </div>    
                                            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                                <span class="help-block" style="color:orangered; font-size:14px;"><?php echo $password_err; ?></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn my-2" style="font-family:monospace;width:200px;margin-left:5px;background-color:purple;color:white;" value="Login">
                                            </div>
                                            
                                    </form>
                                    
                                </div>            
                            </div> 

                            <div class="card-footer">
                                <p style="font-size:12px;text-align:center;">Working with a new Client? <a href="register.php">Sign up.</a></p>
                            </div> 
                    </div>
    </div>

    
</div>
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="margin-left:auto;margin-right:auto;max-width:450px;">
        <div class="card" style="margin-left:auto;margin-right:auto;">
            <div class="card-header">
                <h6 style="color:orange;">Current Registered Clients</h6>
            </div>
        
            <?php
                    /* Attempt MySQL server connection. Assuming you are running MySQL
                            server with default setting (user 'root' with no password) */
                            $db = new mysqli("localhost", "root", "", "nutrivaluation");
                            
                            // Check connection
                            if($db === false){
                                die("ERROR: Could not connect. " . $mysqli->connect_error);
                            }

                            $user_results = mysqli_query($db, "SELECT patients.age, patients.gender,patients.height, patients.weight, patients.pregnant, 
                            patients.lactating,patients.work, users.id as users, users.name
                            FROM patients 
                            INNER JOIN users
                            ON patients.user_id = users.id"); 
                            
            ?>

            <?php if (mysqli_num_rows($user_results) > 0 ){ ?>

            <table style="font-size:14px;color:purple;">

            <?php
                    $i=0;
                    while ($row = mysqli_fetch_array($user_results)){ 
                    
            ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>

                </tr>

            <?php $i++;
                }
            ?>
            </table>
            <?php 
                    }
                    
                    else 
                    {
                    echo "<p style='font-size:14px;color:purple;'>You have no Clients at the Moment</p>";
                    } 
            
            ?>

        </div>

    </div>
</div>

    </body>
    </html>
                  