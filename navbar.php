
<!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Nutrition Evaluation Tool">
        <meta name="description" content="Healthy Nutrition and Fitness">
        <meta name="keywords" content="weightmanagement, healthydiets, bodybuilding, fitness, healthymeals, nutrievaluator, wellness">
    
    
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
       
        <!--Custom CSS-->
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="sweetalert2.min.css">
    
        <link rel="icon" href="#" type="image/icon type">
        <title>Nutri Evaluator</title>
        
    </head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-info  static-top" style="max-height:50px;">
  <div class="container">
  <a class="navbar-brand" style="font-size: 12px;color:white;"><img style="max-width:20px;left-margin:-20px;"src="images/icon.png"> <strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong></a>
   
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="patients_list.php"class="btn btn-info" style="color:white;background-color:#057812;font-size: 10px;font-weight:600;border-radius:10px;text-align:center;">Client Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php"class="btn btn-warning" style="color:white;background-color:#057812;font-size: 10px;font-weight:600;border-radius:10px;text-align:center;">Log Out</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</body>
</html>