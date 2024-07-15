<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-info static-top" style="max-height:50px;">
    <div class="container">
        <a class="navbar-brand" style="font-size: 12px;color:white;"><img style="max-width:20px;left-margin:-20px;"src="images/icon.png"> <strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong></a>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="patients_list.php"class="btn btn-info" style="color:white;background-color:purple;font-size: 10px;font-weight:600;border-radius:10px;text-align:center;">Client's Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"class="btn btn-warning" style="color:white;background-color:orange;font-size: 10px;font-weight:600;border-radius:10px;text-align:center;">Log Out</a>
                    </li>
                </ul>
                </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
