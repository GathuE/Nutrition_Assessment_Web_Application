<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nutrivaluation";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT meal, foods_id, servings_id FROM patient_meals WHERE user_id= 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>ID</th><th>Name</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["meal"]."</td><td>".$row["foods_id"]." ".$row["servings_id"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}


$sql = "SELECT patient_meals.user_id,patient_meals.foods_id, patient_meals.amount,patient_meals.amount*servings.water as water, patient_meals.amount*servings.protein as protein, foods.name as meal, users.id, servings.name,servings.foods_id,servings.energy
FROM patient_meals  
INNER JOIN foods ON foods.id=patient_meals.foods_id
INNER JOIN users ON users.id=patient_meals.user_id
  INNER JOIN servings on servings.id = patient_meals.servings_id
where patient_meals.user_id = 5";
$result1 = $conn->query($sql);

if ($result1->num_rows > 0) {
  echo "<table>
  <tr>
  <th>Foods</th>
  <th>Name</th>
  <th>ID</th>
  <th>Name</th>
  <th>ID</th>
  <th>Name</th>
  <th>ID</th>
  <th>Name</th>
  <th>ID</th>
  </tr>";
  // output data of each row
  while($row = $result1->fetch_assoc()) {
    echo "<tr>
    <td>".$row["foods_id"]."</td>
    <td>".$row["amount"]."</td>
    <td> ".$row["meal"]."</td>
    <td>".$row["name"]."</td>
    <td> ".$row["energy"]."</td>
    <td>".$row["water"]."</td>
    <td>".$row["protein"]."</td>
    </tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
$conn->close();
?>
