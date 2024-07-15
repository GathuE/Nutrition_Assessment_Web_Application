<?php
 
 
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
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
    
        
        <title>Nutri Evaluator</title>
        <link rel="icon" href="#" type="image/icon type">
        
            <style>
                .wfiedls{
                    display: none;
                }
                .wfields{
                    display: none;
                }
            </style>
    </head>
    <body>

    <!-- Navigation Section -->
    <?php 
        include 'navbar.php';
    ?>


    <!-- Introduction Information Section -->
    <div class="container" id="container">
                    <div class="row justify-content center">
                            <div class="col-12 col-sm-12 col-md-12" id="infosection" style="position:relative;display:block;top:20px;border-radius:5px; cursor:pointer;">
                                    <div class="card" id="display">
                                        <div class="card-body">
                                            <div class="container-fluid">
                                                <!-- <a href="guide.php"  class="btn btn-info" style="color:white;font-size: 12px;font-weight:300;">Guide Book</a><br><br> -->
                                                    <button type="button"  class="btn btn-info" style="font-size:12px;" onclick="start();">Start Assessment</button>
                                                </p>
                                                
                                            </div>
                                        </div>
                                    
                                           
                                       
                                    </div>
                            </div>
                    </div>
            </div>

    <!-- Patient Data Capture Section -->
    
            <div class="container" id="container">
                    <div class="row justify-content center">
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="card" id="innercard" style="position:relative;display:none;top:10px;border-radius:5px; cursor:pointer;">
                                <div class="card-header" style="font-size: 22px;font-weight:900;text-align:center; font-family:'Patrick Hand', cursive;color:purple;">
                                Client Data <br>
                                <small style="color:orange; font-size:14px;"><b>Providing correct information improves the accuracy of the system's performance and effective use.</b></small>   
                            </div>
                            <div class="card-body">
                                <div class="container-fluid" id="biocapture">
    
                                    <form class="text-center p-3" style="font-family: monospace;font-size:12px;font-weight:500;color:blue;" id="patientform" name="dataform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                            <div class="row">
                                                <!-- Age -->
                                                <div class="col">
                                                    <label> Age :</label><br>
                                                        <input type="number" id="age" min="1" max="100" class="form-control mb-4"style="font-family: monospace;font-size:12px;font-weight:500;color:blue;" name="age"  placeholder=" Age(Yrs)" required >
                                                </div>
                                                <div class="col">
                                                    <!-- Gender -->
                                                    <label> Gender :</label><br>
                                                    <fieldset class="form-group">
                                                        <select class="form-control" style="font-family: monospace;font-size:12px;font-weight:500;color:blue;" id="sex" name="gender" placeholder="Gender">
                                                            <option type="optgroup"   value="" selected>Choose Gender...</option>
                                                            <option type="optgroup"  onclick="myFunction()"  value="Male" >Male</option>
                                                            <option type="optgroup"  onclick="myFunction()"  value="Female">Female</option>
                                                        </select>
                                                    </fieldset> 
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!--Further Gender Details -->
                                                <div class="col">
                                                    <fieldset class="form-group wfiedls" >
                                                        <label for="pregnant" ><small>Pregnant?</small> </label><br>
                                                        <div class="form-check-inline">
                                                        <select class="form-control-inline" id="pregnant" name="pregnant" placeholder="Pregnant">
                                                            <option type="optgroup"  onclick="myFunction()"  value="yes" >Yes</option>
                                                            <option type="optgroup"  onclick="myFunction()"  value="no" selected>No</option>
                                                    </select>
                                                        </div>
                                                </fieldset>
                                                </div>
                                                <div class="col">
                                                    <fieldset class="form-group wfiedls" >
                                                        <label for="lactating"><small>Lactating?</small> </label><br>
                                                        <div class="form-check-inline" >
                                                        <select class="form-control-inline" id="lactating" name="lactating" placeholder="Lactating">
                                                                <option type="optgroup"  onclick="myFunction()"  value="yes">Yes</option>
                                                                <option type="optgroup"  onclick="myFunction()"  value="no"selected>No</option>
                                                        </select>
                                                        </div>
                                                </fieldset>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <!-- Height -->
                                                    <label> Height :</label><br>
                                                        <input type="number" id="height" min="0" class="form-control mb-4" name="height" style="font-family: monospace;font-size:12px;font-weight:500;color:blue;"  placeholder="Height(cm)" required >
                                                </div>
                                                <div class="col">
                                                        <!-- Weight -->
                                                        <label> Weight :</label><br>
                                                        <input type="number" id="weight" min="15" class="form-control mb-4" name="weight" style="font-family: monospace;font-size:12px;font-weight:500;color:blue;"  placeholder="Weight(Kg)" required >            
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <!-- PAL -->
                                                    <label> Type of Work :</label><br>
                                                        <select name="work" id="work" class="form-control mb-4"  style="font-family: monospace;font-size:12px;font-weight:500;color:blue;" required>
                                                                <optgroup placeholder="Type of Work">
                                                                    <option value="" selected>Choose Physical Level of Activity...</option>
                                                                    <option value="1">Sedentary</option>
                                                                    <option value="2">Light</option>
                                                                    <option value="3">Moderate</option>
                                                                    <option value="4">Heavy</option>
                                                                </optgroup>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label> Target Goal :</label><br>
                                                        <select name="goal" id="goal" class="form-control mb-4"  style="font-family: monospace;font-size:12px;font-weight:500;color:blue;" required>
                                                                <optgroup placeholder="Goal">
                                                                    <option value="" selected>Choose Client Desired Goal...</option>
                                                                    <option value="Weight Management">Weight Management</option>
                                                                    <option value="Diabetes Management">Diabetes Management</option>
                                                                </optgroup>
                                                        </select>
                                                </div>
                                            </div>
                                            <input type="button"  class="btn btn-info" style="font-size:12px;" id="btn" value="Submit" onclick="divswap();EER();"><br>
                                          
                                    </form>
                                   
                                </div>
                            </div>

                            <div class="card-footer">
                                    <p style="font-size:16px;font-weight:500;color:orange;">I already know the Client's Nutrient Requirements.<br>
                                        <a  class="btn btn-info" style="font-size:12px;" href="breakfast_meal.php">Skip to Meal Intake</a>
                                    </p>
                                </div>
                        </div>
                    </div>

     
    
     <!-- EER Information Section -->
    
                    <div class="col-12 col-sm-12 col-md-12" style="position:relative;display:none;top:20px;" id="info">
                            <div class="card" id="display">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <span style="text-align:center;font-size:22px;font-weight:900;color:purple;" id="eer"></span>
                                        <p style="text-align:center;font-size:18px;font-weight:900;color:blue;" id="standardeer"></p>
                                        <p style="text-align:center;font-size:18px;font-weight:900;color:blue;" id="illustration"></p><br>
                                    </div>
                                </div>
                                <div class="card-footer">
                                <button  class="btn btn-info"style="text-align:center;width:100px;height:auto" id="proceed" style="color:white;" onclick="foodbreakdown();"></button>
                                </div>
                                    
                            </div>
                        </div>
            </div>
        </div>
    
    
    <!-- EER Food Composition Section -->
    <div class="container" id="container">
            <div class="row justify-content center">
                <div class="col-12 col-sm-12 col-md-12" id="food" style="position:relative;display:none;top:20px;border-radius:5px; cursor:pointer;">
                    <div class="card" id="display">
                        <div class="card-body">
                            <div class="container-fluid">
                            <form name="eercomposition" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                <table class="table table-striped table-sm text-center">
                                    <thead>
                                            <tr>
                                                <td colspan="5">
                                                <h6 style="font-size:17px;font-family: 'Patrick Hand', cursive;font-weight:600;color:purple;">Based on the Data You Provided, <br> YOUR CLIENT'S DIETARY REFERENCE INTAKES ARE :</h6>
                                                </td>
                                            </tr>
                                            <tr style="font-size:15px; text-align:center;font-family: 'Patrick Hand', cursive;font-weight:500;color:purple;">
                                                <th colspan="5" >MACRO NUTRIENTS</th>
                                            </tr>
                                            <tr style="font-size:11px;color:blue;background:lightblue;">
                                                <th>Protein</th>
                                                <th>Fats</th>
                                                <th>Carbohydrates</th>
                                                <th>Water</th>
                                                <th>Fibre</th>
                                            </tr>
                                            <tr style="text-align:center;font-size:10px;font-weight:900;color:purple;">
                                                <td><span id="protein"><input type="hidden" value="protein"></span></td>
                                                <td><span id="fat"><input type="hidden" value="fat"></span></td>
                                                <td><span id="carbohydrate"><input type="hidden" value="carbohydrate"></span></td>
                                                <td><span id="water"><input type="hidden" value="water"></span></td>
                                                <td><span id="fibre"><input type="hidden" value="fibre"></span></td>
                                            </tr>
                                            <tr style="font-size:16px; text-align:center;font-family: 'Patrick Hand', cursive;font-weight:500;color:purple;">
                                                <th colspan="5" >MICRO NUTRIENTS</th>
                                            </tr>
                                            <tr style="font-size:11px;color:blue;background:lightblue;">
                                                <th>Calcium (Ca)</th>
                                                <th>Iron (Fe)</th>
                                                <th>Magnesium (Mg)</th>
                                                <th>Phosphorous (P)</th>
                                                <th>Potassium (K)</th>
                                            </tr>
                                            <tr style="text-align:center;font-size:10px;font-weight:900;color:purple;">
                                                <td ><span id="calcium"><input type="hidden" value="calcium"></span></td>
                                                <td ><span id="iron"><input type="hidden" value="iron"></span></p></td>
                                                <td ><span id="magnesium"><input type="hidden" value="magnesium"></span></td>
                                                <td ><span id="phosphorous"><input type="hidden" value="phpsphorous"></span></td>
                                                <td ><span id="potassium"><input type="hidden" value="potassium"></span></td>
                                            </tr>
                                            <tr style="font-size:11px;color:blue;background:lightblue;">
                                                <th>Sodium (Na)</th>
                                                <th>Zinc (Zn)</th>
                                                <th> Sellenium (Se)</th>
                                                <th>Vit A-RAE</th>
                                                <th>Vit A-RE</th>
                                            </tr>
                                            <tr style="text-align:center;font-size:10px;font-weight:900;color:purple;">
                                                <td ><span id="sodium"><input type="hidden" value="sodium"></span></td>
                                                <td ><span id="zinc"><input type="hidden" value="zinc"></span></td>
                                                <td ><span id="sellenium"><input type="hidden" value="sellenium"></span></td>
                                                <td ><span id="vitarae"><input type="hidden" value="vitarae"></span></td>
                                                <td ><span id="vitare"><input type="hidden" value="vitare"></span></td>
                                            </tr>
                                            <tr style="font-size:11px;color:blue;background:lightblue;">
                                                <th>Retinol</th>
                                                <th>b-carotene</th>
                                                <th>Thiamin</th>
                                                <th>Riboflavin</th>
                                                <th>Niacin</th>
                                                
                                            </tr>
                                            <tr style="text-align:center;font-size:10px;font-weight:900;color:purple;">
                                                <td ><span id="retinol"><input type="hidden" value="retinol"></span></td>
                                                <td ><span id="bcarotene"><input type="hidden" value="bcarotene"></span></td>
                                                <td ><span id="thiamin"><input type="hidden" value="thiamin"></span></td>
                                                <td ><span id="riboflavin"><input type="hidden" value="riboflavin"></span></td>
                                                <td ><span id="niacin"><input type="hidden" value="niacin"></span></td>
                                                
                                            </tr>
                                            <tr style="font-size:11px;color:blue;background:lightblue;">
                                                <th>Dietary Folate</th>
                                                <th>Food Folate</th>
                                                <th>Vit B12</th>
                                                <th>Vit C</th>
                                                <th>Cholestrol</th>
                                               
                                            </tr>
                                            <tr style="text-align:center;font-size:10px;font-weight:900;color:purple;">
                                                <td ><span id="dietaryfolate"><input type="hidden" value="dietaryfolate"></span></td>
                                                <td ><span id="foodfolate"><input type="hidden" value="foodfolate"></span></td>
                                                <td ><span id="vitb12"><input type="hidden" value="vitb12"></span></td>
                                                <td ><span id="vitc"><input type="hidden" value="vitc"></span></td>
                                                <td ><span id="cholestrol"><input type="hidden" value="cholestrol"></span></td>
                                               
                                            </tr>
                                            <tr style="font-size:11px;color:blue;background:lightblue;">
                                               
                                                <th colspan="3">Oxalic Acid</th>
                                                <th colspan="2">Phytate</th>
                                                
                                            </tr>
                                            <tr style="text-align:center;font-size:10px;font-weight:900;color:purple;">
                                               
                                                <td colspan="3" ><span id="oxalicacid"><input type="hidden" value="oxalicacid"></span></td>
                                                <td colspan="2"><span id="phytate"><input type="hidden" value="phytate"></span></td>
                                               
                                            </tr>
                                            <tr>
                                                <td colspan="5"><p style="text-align:center;font-size:15px;font-weight:500;font-family: 'Patrick Hand', cursive; color:blue;" id="foodentryprompt"></p></td>
                                            </tr>
                                        </thead>
                                </table>
                                </form>   
                            </div>
                        </div>
                        <div class="card-footer">
                                <input type="button" id="savebtn" class="btn btn-primary my-2 btn-block"style="font-size: 14px;width: 150px;height: 35px;margin-left:auto;margin-right:auto;" onclick="this.disabled = true;meals();" value="Save and Proceed">
                        </div>       
                  </div>
                </div>   
              </div>
            </div>
            </div>
        </div>

        <!-- Food Information Section -->
        <div class="container" id="container">
                    <div class="row justify-content center">
                            <div class="col-12 col-sm-12 col-md-12" id="prompt" style="position:relative;display:none;top:20px;border-radius:5px; cursor:pointer;">
                                    <div class="card" id="display">
                                        <div class="card-body">
                                            <div class="container-fluid">
                                                <h3 style="color:purple;"> Great, You are almost Done</h3>
                                                        
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <a class="btn btn-info" style="font-size:12px;" href="breakfast_meal.php">Proceed to Record Meal History</a>
                                        </div>
                            
                                    </div>
                            </div>
                    </div>
            </div>
  

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- jsPDF library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <!-- Popper JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"></script>
    <!-- Latest Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    
    <script src="eer.js" defer></script>
    <script src="foods.js" defer></script>

    
    <script src="sweetalert2.min.js"></script>
    
    
    </body>
    </html>

    
    
