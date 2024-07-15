<?php

$connect = new PDO("mysql:host=localhost;dbname=nutrivaluation", "root", "");

if(isset($_POST["type"]))
{
 if($_POST["type"] == "category_data")
 {
  $query = "
  SELECT * FROM foods 
  ORDER BY name ASC
  ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $data = $statement->fetchAll();
  foreach($data as $row)
  {
   $output[] = array(
    'id'  => $row["id"],
    'name'  => $row["name"]
   );
  }
  echo json_encode($output);
 }
 else
 {
  $query = "
  SELECT * FROM servings 
  WHERE foods_id = '".$_POST["category_id"]."' 
  ORDER BY name ASC
  ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $data = $statement->fetchAll();
  foreach($data as $row)
  {
   $output[] = array(
    'id'  => $row["id"],
    'name'  => $row["name"]
   );
  }
  echo json_encode($output);
 }
}

?>
