<?php
	include 'config.php';
	$foodid=$_POST["foods_id"];
	$result = mysqli_query($conn,"SELECT * FROM servings where foods_id=$foodid");
?>
<option type="optgroup" value="">Choose Food</option>
<?php while($row = mysqli_fetch_array($result)):; ?>
<option type="optgroup" value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
<?php endwhile;?> 

<option value="">Select Serving Item....</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
	<option value="<?php echo $row["amounts"];?>"><?php echo $row["name"];?></option>
<?php
}
?>