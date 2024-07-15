<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter client's username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_name= trim($_POST["name"]);
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $name = $mysqli->real_escape_string($_REQUEST['name']);
        $sql = "INSERT INTO users (name, username, password) VALUES ('$name', ?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Something went wrong. Please try again later.";
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

<div class="row">
    <div class="col-lg-4">

    </div>

    <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 style="text-align:center;color:orange;">Nutri Evaluator App</h5>
                            <h5 style="text-align:center;color:purple;">New Client Registration</h5>
                        </div>
                            <div class="card-body">
                                <div class="container">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                                <input type="text" name="name" class="form-control"  placeholder="Client's Full Name e.g Jane Mutito" required>
                                            </div> 
                                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                                <input type="text" name="username" class="form-control" value="<?php echo $username;?>" placeholder="Username e.g Jane">
                                                <span class="help-block" style="color:orange; font-size:12px;"><?php echo $username_err; ?></span>
                                            </div>    
                                            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Password">
                                                <span class="help-block"  style="color:orange; font-size:12px;"><?php echo $password_err; ?></span>
                                            </div>
                                            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" placeholder="Confirm Password">
                                                <span class="help-block"  style="color:orange; font-size:12px;"><?php echo $confirm_password_err; ?></span>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="submit" class="btn my-2 btn-block" style="background-color:purple;color:white;" value="Register">
                                                    </div>
                                                    <div class="col">
                                                        <input type="reset" class="btn btn-warning my-2 btn-block" style="color:white" value="Clear">
                                                    </div>
                                                </div>
                                                
                                               
                                            </div>
                                                
                                    </form>
                                    
                                </div>            
                            </div> 

                            <div class="card-footer">
                                <p style="font-size:12px;text-align:center;">Already own an account? <a href="index.php">Login Here.</a></p>
                            </div> 
                    </div>
    </div>

    <div class="col-lg-4">

    </div>
</div>

    </body>
    </html>
               