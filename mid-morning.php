<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
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
    
        <link rel="icon" href="#" type="image/icon type">
        <title>Nutri Evaluator</title>
        
    </head>
<body>
     <!-- Navigation Section -->
     <?php 
        include 'navbarmain.php';
    ?>

<?php
    include 'database.php';
    $result = mysqli_query($conn,"SELECT * FROM foods");
?>
<div class="container" id="container">
          <div class="row justify-content center">
                <div class="col-12 col-sm-12 col-md-12">
                    <div class="card" id="breakfast" class="divs" style="position:relative;top:20px;border-radius:5px; cursor:pointer;">
                        <div class="card-header" style="font-size: 20px;font-weight:900;text-align:center; font-family:'Patrick Hand', cursive;color:purple;">Mid Morning Meal : <br>    
                    </div>
                    <div class="card-body">
                      <div class="container-fluid">
                          <form class="text-center p-3" style="font-family: monospace;font-size:12px;font-weight:500;color:blue;" action="insert_midmorning.php" method="post">
                                  <div class="row">
                                      <!-- Breakfast -->
                                      <div class="col">
                                          <!-- Food Choice -->
                                          <label> Did You Have a Mid Morning Meal? </label><br>
                                              <input type="radio" onclick="yesnoCheck();" name="yesno" id="yesCheck">
                                              <label>Yes</label>
                                              <input type="radio" onclick="yesnoCheck();" name="yesno" id="noCheck" checked>
                                              <label>No</label>
                                      </div>
                                  </div>
                                <div id="ifYes" style="display:none">
                                          <div class="form-group">
                                            <label>Choose Food taken :</label>
                                            <select name="foods_id" id="category_item" class="form-control input-lg" data-live-search="true" title="Select Category" required>
                                              <option type="optgroup" value="">Select Food Item..</option>
                                                <?php while($row = mysqli_fetch_array($result)):; ?>
                                                <option type="optgroup" value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                <?php endwhile;?> 
                                            </select>
                                          </div>
                                          <div class="form-group">
                                            <label>Serving Item :</label>
                                            <select name="servings_id" id="sub_category_item" class="form-control input-lg" data-live-search="true" title="Select Sub Category" required>
                                            </select>
                                          </div>
                                        <div class="form-group">
                                                  <label for="amount">No of Serving Item(s):</label>
                                                  <input type="number" min="0" class="form-control mb-4"style="font-family: monospace;font-size:12px;font-weight:500;color:blue;" name="amount" id="amount"  placeholder="Enter Amount e.g 0.5" required >
                                        </div>
                                        <div class="form-group">
                                              <input type="submit" id="breko"  class="btn btn-info" style="font-size:12px;width:150px;margin-right:auto;" value="Add to Mid Morning">
                                        </div>
                                        
                                </div> 
                                        <div class="card-footer">
                                              <a class="btn btn-info" style="font-size:12px;width:150px;float:left;" href="breakfast_meal.php">Previous Meal</a>
                                              <a class="btn btn-info" style="font-size:12px;width:150px;float:right;" href="lunch.php">Next Meal</a>
                                        </div>
                              </div>
                          </form>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

<script src="foods.js" defer></script>
</body>
</html>

<script>
$(document).ready(function(){

  $('#category_item').selectpicker();

  $('#sub_category_item').selectpicker();

  load_data('category_data');

  function load_data(type, category_id = '')
  {
    $.ajax({
      url:"load_data.php",
      method:"POST",
      data:{type:type, category_id:category_id},
      dataType:"json",
      success:function(data)
      {
        var html = '';
        for(var count = 0; count < data.length; count++)
        {
          html += '<option value="'+data[count].id+'">'+data[count].name+'</option>';
        }
        if(type == 'category_data')
        {
          $('#category_item').html(html);
          $('#category_item').selectpicker('refresh');
        }
        else
        {
          $('#sub_category_item').html(html);
          $('#sub_category_item').selectpicker('refresh');
        }
      }
    })
  }

  $(document).on('change', '#category_item', function(){
    var category_id = $('#category_item').val();
    load_data('sub_category_data', category_id);
  });
  
});
</script>



