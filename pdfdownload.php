<?php


// add this at the start of the script
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

//Deny all overcoming errors
error_reporting (E_ALL ^ E_NOTICE);

session_start();

// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

// Database Connection 
$conn = new mysqli('localhost', 'root', '', 'nutrivaluation');
//Check for connection error
if($conn->connect_error){
  die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);    
}

// Select User Bio

// Select Bio Data from MySQL database
$select = "SELECT name, age, gender, height, weight, work, user_id FROM patients
INNER JOIN users ON users.id=patients.user_id
WHERE user_id=$_GET[user_id]";

$result = $conn->query($select);
$data = array();
while($row = $result->fetch_object()){
  $data .='<th style="width:50%;border:0px;text-align:left;color:purple;"><br><p>'.$row->name.'</p> <br> <p>'.$row->age.'</p> <br> <p>'.$row->gender.'</p> <br> <p>'.$row->height.'</p> <br> <p>'.$row->weight.'</p> <br> <p>'.$row->work.'</p> </th>';
  
}

// SHOW USER EER

// Select EER from database
$select2 = "SELECT eer FROM reference WHERE user_id=$_GET[user_id]";
$result = $conn->query($select2);
$data57 = array();
while($row = $result->fetch_object()){
  $data57 .='<th style="color:purple;border:2px;">'.$row->eer.'</th>' ;
}

//SHOW USER GOAL 

// Select User Goal From Database
$select97 = "SELECT targetgoal FROM patients WHERE user_id=$_GET[user_id]";
$result = $conn->query($select97);
$data97 = array();
while($row = $result->fetch_object()){
  $data97 .='<th style="color:purple;border:2px;">'.$row->targetgoal.'</th>' ;
}

//Reference table
$select = "SELECT * From reference WHERE user_id=$_GET[user_id]";
$result4 = $conn->query($select);
$data4 = array();
	while($row4 = $result4->fetch_object()){	
		$data4 .= '<tr><td>Energy (Kcals)</td><td>'.$row4->eer.'</td>'
		.'<tr><td>Water (mls) </td><td>'.$row4->water.'</td>'
		.'<tr><td>Protein (g)</td><td>'.$row4->protein.'</td>'
		.'<tr><td>Fat (g)</td><td>'.$row4->fat.'</td>'
		.'<tr><td>Fibre (g)</td><td>'.$row4->fibre.'</td>'
		.'<tr><td>Carbohydrate (g)</td><td>'.$row4->carbohydrate.'</td>'
		.'<tr><td>Calcium (mg)</td><td>'.$row4->calcium.'</td>'
		.'<tr><td>Iron (mg)</td><td>'.$row4->iron.'</td>'
		.'<tr><td>Magnesium (mg)</td><td>'.$row4->magnesium.'</td>'
		.'<tr><td>Phosphorous (mg)</td><td>'.$row4->phosphorous.'</td>'
		.'<tr><td>Potassium (mg)</td><td>'.$row4->potassium.'</td>'
		.'<tr><td>Sodium (mg)</td><td>'.$row4->sodium.'</td>'
		.'<tr><td>Zinc (mg)</td><td>'.$row4->zinc.'</td>'
		.'<tr><td>Sellenium (mcg)</td><td>'.$row4->sellenium.'</td>'
		.'<tr><td>Vit_A_RAE (mcg)</td><td>'.$row4->vitarae.'</td>'
		.'<tr><td>Vit_A_RE (mcg)</td><td>'.$row4->vitare.'</td>'
		.'<tr><td>Retinol (mcg)</td><td>'.$row4->retinol.'</td>'
		.'<tr><td>B_Carotene (mcg)</td><td>'.$row4->bcarotene.'</td>'
		.'<tr><td>Thiamin (mg)</td><td>'.$row4->thiamin.'</td>'
		.'<tr><td>Riboflavin (mg)</td><td>'.$row4->riboflavin.'</td>'
		.'<tr><td>Niacin (mg)</td><td>'.$row4->niacin.'</td>'
		.'<tr><td>Dietary Folate (mcg)</td><td>'.$row4->dietaryfolate.'</td>'
		.'<tr><td>Food Folate (mcg)</td><td>'.$row4->foodfolate.'</td>'
		.'<tr><td>Vit_B_12 (mcg)</td><td>'.$row4->vitb12.'</td>'
		.'<tr><td>Vit_C (mg)</td><td>'.$row4->vitc.'</td>'
		.'<tr><td>Cholestrol (mg)</td><td>'.$row4->cholestrol.'</td>'
		.'<tr><td>Oxalic_Acid_OXALAC (mg)</td><td>'.$row4->oxalicacid.'</td>'
		.'<tr><td>Phytate (mg)</td><td>'.$row4->phytate.'</td>';
		
			}

$select1 = "SELECT patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
round(servings.energy*patient_meals.amount,2) as energy,
round(servings.water*patient_meals.amount, 2) as water,
round(servings.protein*patient_meals.amount, 2) as protein,
round(servings.fat*patient_meals.amount, 2) as fat,
round(servings.cho*patient_meals.amount, 2) as carbohydrate,
round(servings.fiber*patient_meals.amount, 2) as fiber,
round(servings.ca*patient_meals.amount, 2) as ca,
round(servings.fe*patient_meals.amount, 2) as fe,
round(servings.mg*patient_meals.amount, 2) as mg,
round(servings.p*patient_meals.amount, 2) as p,
round(servings.k*patient_meals.amount, 2) as k,
round(servings.na*patient_meals.amount, 2) as na,
round(servings.zn*patient_meals.amount, 2) as zn,
round(servings.se*patient_meals.amount, 2) as se,
round(servings.Vit_A_RAE*patient_meals.amount, 2) as Vit_A_RAE,
round(servings.Vit_A_RE*patient_meals.amount, 2) as Vit_A_RE,
round(servings.retinol*patient_meals.amount, 2) as retinol,
round(servings.b_carotene_equivalent*patient_meals.amount, 2) as b_carotene_equivalent,
round(servings.thiamin*patient_meals.amount, 2) as thiamin,
round(servings.riboflavin*patient_meals.amount, 2) as riboflavin,
round(servings.niacin*patient_meals.amount, 2) as niacin,
round(servings.dietary_folate_eq*patient_meals.amount, 2) as dietary_folate_eq,
round(servings.food_folate*patient_meals.amount, 2) as food_folate,
round(servings.vit_B_12*patient_meals.amount, 2) as vit_B_12,
round(servings.vit_c*patient_meals.amount, 2) as vit_c,
round(servings.cholesterol*patient_meals.amount, 2) as cholesterol,
round(servings.Oxalic_acid_OXALAC*patient_meals.amount, 2) as Oxalic_acid_OXALAC,
round(servings.phytate*patient_meals.amount, 2) as phytate,

 users.id, users.name
FROM patient_meals  
INNER JOIN foods ON foods.id=patient_meals.foods_id  
INNER JOIN servings ON servings.id=patient_meals.servings_id
INNER JOIN users ON users.id = patient_meals.user_id

WHERE user_id=$_GET[user_id]";

//Show Meals
//Breakfast
$result = $conn->query($select1);
$breakfast= array();
while($row2 = $result->fetch_object()){
	if($row2->meal == 'Breakfast'){
	$breakfast.='<tr>'.'<td>'.$row2->food.'</td>'
		  .'<td>'.$row2->amount.' '.$row2->serving.'</td></tr>';
	}
}

//Mid Morning
$result1 = $conn->query($select1);
$midmorning= array();
while($row4 = $result1->fetch_object()){
	if($row4->meal =='mid-morning'){
	$midmorning.='<tr>'. '<td>'.$row4->food.'</td>'
		  .'<td>'.$row4->amount.' '.$row4->serving.'</td></tr>';
	}
}

//Lunch
$result1 = $conn->query($select1);
$lunch= array();
while($row7 = $result1->fetch_object()){
	if($row7->meal =='Lunch'){
	$lunch.= '<tr>'.'<td>'.$row7->food.'</td>'
		  .'<td>'.$row7->amount.' '.$row7->serving.'</td></tr>';
	}
}

//Mid Afternoon
$result1 = $conn->query($select1);
$midafternoon= array();
while($row9 = $result1->fetch_object()){
	if($row9->meal =='midafternoon'){
	$midafternoon.='<tr>'.'<td>'.$row9->food.'</td>'
		  .'<td>'.$row9->amount.' '.$row9->serving.'</td></tr>';
	}
}
//Supper
$result1 = $conn->query($select1);
$supper= array();
while($row8 = $result1->fetch_object()){
	if($row8->meal =='supper'){
	$supper.= '<tr>'.'<td>'.$row8->food.'</td>'
		  .'<td>'.$row8->amount.' '.$row8->serving.'</td></tr>';
	}
}
//Late Supper
$result1 = $conn->query($select1);
$latesupper= array();
while($row17 = $result1->fetch_object()){
	if($row17->meal =='latesupper'){
	$latesupper.= '<tr>'.'<td>'.$row17->food.'</td>'
		  .'<td>'.$row17->amount.' '.$row17->serving.'</td></tr>';
	}
}







//show Macro Nutrient by Order of Meals



//Breakfast
$result1 = $conn->query($select1);
$data6 = array();
while($row6 = $result1->fetch_object()){
	if($row6->meal == 'Breakfast'){
		$data6 .= '<tr>'
		  .'<td>'.$row6->food.'</td>'
		  .'<td>'.$row6->amount.' '.$row6->serving.'</td>'
          .'<td>'.$row6->energy.'</td>'
          .'<td>'.$row6->water.'</td>'
          .'<td>'.$row6->protein.'</td>'
		  .'<td>'.$row6->fat.'</td>'
		  .'<td>'.$row6->carbohydrate.'</td>'
		  .'<td>'.$row6->fiber.'</td>';

	}
}
//Mid Morning
$result1 = $conn->query($select1);
$data11 = array();
while($row11 = $result1->fetch_object()){
	if($row11->meal == 'mid-morning'){
		$data11 .= '<tr>'
		  .'<td>'.$row11->food.'</td>'
		  .'<td>'.$row11->amount.' '.$row11->serving.'</td>'
          .'<td>'.$row11->energy.'</td>'
          .'<td>'.$row11->water.'</td>'
          .'<td>'.$row11->protein.'</td>'
		  .'<td>'.$row11->fat.'</td>'
		  .'<td>'.$row11->carbohydrate.'</td>'
		  .'<td>'.$row11->fiber.'</td>';

	}
}

//Lunch
$result1 = $conn->query($select1);
$data1 = array();
while($row1 = $result1->fetch_object()){
	if($row1->meal == 'Lunch'){
		$data1 .= '<tr>'
		  .'<td>'.$row1->food.'</td>'
		  .'<td>'.$row1->amount.' '.$row1->serving.'</td>'
          .'<td>'.$row1->energy.'</td>'
          .'<td>'.$row1->water.'</td>'
          .'<td>'.$row1->protein.'</td>'
		  .'<td>'.$row1->fat.'</td>'
		  .'<td>'.$row1->carbohydrate.'</td>'
		  .'<td>'.$row1->fiber.'</td>';

	}
}
//Mid Afternoon
$result1 = $conn->query($select1);
$data2 = array();
while($row9 = $result1->fetch_object()){
	if($row9->meal == 'midafternoon'){
		$data2 .= '<tr>'
		  .'<td>'.$row9->food.'</td>'
		  .'<td>'.$row9->amount.' '.$row9->serving.'</td>'
          .'<td>'.$row9->energy.'</td>'
          .'<td>'.$row9->water.'</td>'
          .'<td>'.$row9->protein.'</td>'
		  .'<td>'.$row9->fat.'</td>'
		  .'<td>'.$row9->carbohydrate.'</td>'
		  .'<td>'.$row9->fiber.'</td>';

	}
}
//Supper
$result1 = $conn->query($select1);
$data22 = array();
while($row22 = $result1->fetch_object()){
	if($row22->meal == 'supper'){
		$data22 .= '<tr>'
		  .'<td>'.$row22->food.'</td>'
		  .'<td>'.$row22->amount.' '.$row22->serving.'</td>'
          .'<td>'.$row22->energy.'</td>'
          .'<td>'.$row22->water.'</td>'
          .'<td>'.$row22->protein.'</td>'
		  .'<td>'.$row22->fat.'</td>'
		  .'<td>'.$row22->carbohydrate.'</td>'
		  .'<td>'.$row22->fiber.'</td>';

	}
}
//Late Supper
$result1 = $conn->query($select1);
$data23 = array();
while($row23 = $result1->fetch_object()){
	if($row23->meal == 'latesupper'){
		$data23 .= '<tr>'
		.'<td>'.$row23->food.'</td>'
		  .'<td>'.$row23->amount.' '.$row23->serving.'</td>'
          .'<td>'.$row23->energy.'</td>'
          .'<td>'.$row23->water.'</td>'
          .'<td>'.$row23->protein.'</td>'
		  .'<td>'.$row23->fat.'</td>'
		  .'<td>'.$row23->carbohydrate.'</td>'
		  .'<td>'.$row23->fiber.'</td>';

	}
}
//All Totals Macro Nutrients
$result1 = $conn->query($select1);
$data20 = array();
while($row6 = $result1->fetch_object()){
		$data20 .= '<tr>'
		  .'<td>'.$row6->food.'</td>'
		  .'<td>'.$row6->amount.' '.$row6->serving.'</td>'
          .'<td>'.$row6->energy.'</td>'
          .'<td>'.$row6->water.'</td>'
          .'<td>'.$row6->protein.'</td>'
		  .'<td>'.$row6->fat.'</td>'
		  .'<td>'.$row6->carbohydrate.'</td>'
		  .'<td>'.$row6->fiber.'</td>';

}



//show Micro Nutrient by Order of Meals



//Breakfast
$result1 = $conn->query($select1);
$data3 = array();
while($row23 = $result1->fetch_object()){
	if($row23->meal == 'Breakfast'){
		$data3 .= '<tr>'
		  .'<td>'.$row23->food.'</td>'
		  .'<td>'.$row23->amount.' '.$row23->serving.'</td>'
          .'<td>'.$row23->ca.'</td>'
          .'<td>'.$row23->fe.'</td>'
          .'<td>'.$row23->mg.'</td>'
		  .'<td>'.$row23->p.'</td>'
		  .'<td>'.$row23->k.'</td>'
		  .'<td>'.$row23->na.'</td>'
		  .'<td>'.$row23->zn.'</td>'
		  .'<td>'.$row23->se.'</td>';

	}
}

//Mid Morning
$result1 = $conn->query($select1);
$data25 = array();
while($row23 = $result1->fetch_object()){
	if($row23->meal == 'mid-morning'){
		$data25 .= '<tr>'
		  .'<td>'.$row23->food.'</td>'
		  .'<td>'.$row23->amount.' '.$row23->serving.'</td>'
          .'<td>'.$row23->ca.'</td>'
          .'<td>'.$row23->fe.'</td>'
          .'<td>'.$row23->mg.'</td>'
		  .'<td>'.$row23->p.'</td>'
		  .'<td>'.$row23->k.'</td>'
		  .'<td>'.$row23->na.'</td>'
		  .'<td>'.$row23->zn.'</td>'
		  .'<td>'.$row23->se.'</td>';

	}
}

//Lunch
$result1 = $conn->query($select1);
$data7 = array();
while($row23 = $result1->fetch_object()){
	if($row23->meal == 'Lunch'){
		$data7 .= '<tr>'
		  .'<td>'.$row23->food.'</td>'
		  .'<td>'.$row23->amount.' '.$row23->serving.'</td>'
          .'<td>'.$row23->ca.'</td>'
          .'<td>'.$row23->fe.'</td>'
          .'<td>'.$row23->mg.'</td>'
		  .'<td>'.$row23->p.'</td>'
		  .'<td>'.$row23->k.'</td>'
		  .'<td>'.$row23->na.'</td>'
		  .'<td>'.$row23->zn.'</td>'
		  .'<td>'.$row23->se.'</td>';

	}
}

//Mid Afternoon
$result1 = $conn->query($select1);
$data8 = array();
while($row23 = $result1->fetch_object()){
	if($row23->meal == 'midafternoon'){
		$data8 .= '<tr>'
		  .'<td>'.$row23->food.'</td>'
		  .'<td>'.$row23->amount.' '.$row23->serving.'</td>'
          .'<td>'.$row23->ca.'</td>'
          .'<td>'.$row23->fe.'</td>'
          .'<td>'.$row23->mg.'</td>'
		  .'<td>'.$row23->p.'</td>'
		  .'<td>'.$row23->k.'</td>'
		  .'<td>'.$row23->na.'</td>'
		  .'<td>'.$row23->zn.'</td>'
		  .'<td>'.$row23->se.'</td>';

	}
}
//Supper
$result1 = $conn->query($select1);
$data10 = array();
while($row23 = $result1->fetch_object()){
	if($row23->meal == 'supper'){
		$data10 .= '<tr>'
		  .'<td>'.$row23->food.'</td>'
		  .'<td>'.$row23->amount.' '.$row23->serving.'</td>'
          .'<td>'.$row23->ca.'</td>'
          .'<td>'.$row23->fe.'</td>'
          .'<td>'.$row23->mg.'</td>'
		  .'<td>'.$row23->p.'</td>'
		  .'<td>'.$row23->k.'</td>'
		  .'<td>'.$row23->na.'</td>'
		  .'<td>'.$row23->zn.'</td>'
		  .'<td>'.$row23->se.'</td>';

	}
}
//Late Supper
$result1 = $conn->query($select1);
$data12 = array();
while($row23 = $result1->fetch_object()){
	if($row23->meal == 'latesupper'){
		$data12 .= '<tr>'
		  .'<td>'.$row23->food.'</td>'
		  .'<td>'.$row23->amount.' '.$row23->serving.'</td>'
          .'<td>'.$row23->ca.'</td>'
          .'<td>'.$row23->fe.'</td>'
          .'<td>'.$row23->mg.'</td>'
		  .'<td>'.$row23->p.'</td>'
		  .'<td>'.$row23->k.'</td>'
		  .'<td>'.$row23->na.'</td>'
		  .'<td>'.$row23->zn.'</td>'
		  .'<td>'.$row23->se.'</td>';

	}
}

//show Vitamins by Order of Meals

//Breakfast
$result1 = $conn->query($select1);
$data71 = array();
while($row23 = $result1->fetch_object()){
	if($row23->meal == 'Breakfast'){
		$data71 .= '<tr>'
		  .'<td>'.$row23->food.'</td>'
		  .'<td>'.$row23->amount.' '.$row23->serving.'</td>'
          .'<td>'.$row23->Vit_A_RAE.'</td>'
          .'<td>'.$row23->Vit_A_RE.'</td>'
          .'<td>'.$row23->retinol.'</td>'
		  .'<td>'.$row23->b_carotene_equivalent.'</td>'
		  .'<td>'.$row23->thiamin.'</td>'
		  .'<td>'.$row23->riboflavin.'</td>'
		  .'<td>'.$row23->niacin.'</td>'
		  .'<td>'.$row23->dietary_folate_eq.'</td>'
		  .'<td>'.$row23->food_folate.'</td>'
		  .'<td>'.$row23->vit_B_12.'</td>'
		  .'<td>'.$row23->vit_c.'</td>'
		  .'<td>'.$row23->cholesterol.'</td>'
		  .'<td>'.$row23->Oxalic_acid_OXALAC.'</td>'
		  .'<td>'.$row23->phytate.'</td>';

	}
}

//Mid Morning
$result1 = $conn->query($select1);
$data72 = array();
while($row23 = $result1->fetch_object()){
	if($row23->meal == 'mid-morning'){
		$data72 .= '<tr>'
		  .'<td>'.$row23->food.'</td>'
		  .'<td>'.$row23->amount.' '.$row23->serving.'</td>'
          .'<td>'.$row23->Vit_A_RAE.'</td>'
          .'<td>'.$row23->Vit_A_RE.'</td>'
          .'<td>'.$row23->retinol.'</td>'
		  .'<td>'.$row23->b_carotene_equivalent.'</td>'
		  .'<td>'.$row23->thiamin.'</td>'
		  .'<td>'.$row23->riboflavin.'</td>'
		  .'<td>'.$row23->niacin.'</td>'
		  .'<td>'.$row23->dietary_folate_eq.'</td>'
		  .'<td>'.$row23->food_folate.'</td>'
		  .'<td>'.$row23->vit_B_12.'</td>'
		  .'<td>'.$row23->vit_c.'</td>'
		  .'<td>'.$row23->cholesterol.'</td>'
		  .'<td>'.$row23->Oxalic_acid_OXALAC.'</td>'
		  .'<td>'.$row23->phytate.'</td>';

	}
}

//Lunch
$result1 = $conn->query($select1);
$data73 = array();
while($row23 = $result1->fetch_object()){
	if($row23->meal == 'Lunch'){
		$data73 .= '<tr>'
		  .'<td>'.$row23->food.'</td>'
		  .'<td>'.$row23->amount.' '.$row23->serving.'</td>'
          .'<td>'.$row23->Vit_A_RAE.'</td>'
          .'<td>'.$row23->Vit_A_RE.'</td>'
          .'<td>'.$row23->retinol.'</td>'
		  .'<td>'.$row23->b_carotene_equivalent.'</td>'
		  .'<td>'.$row23->thiamin.'</td>'
		  .'<td>'.$row23->riboflavin.'</td>'
		  .'<td>'.$row23->niacin.'</td>'
		  .'<td>'.$row23->dietary_folate_eq.'</td>'
		  .'<td>'.$row23->food_folate.'</td>'
		  .'<td>'.$row23->vit_B_12.'</td>'
		  .'<td>'.$row23->vit_c.'</td>'
		  .'<td>'.$row23->cholesterol.'</td>'
		  .'<td>'.$row23->Oxalic_acid_OXALAC.'</td>'
		  .'<td>'.$row23->phytate.'</td>';

	}
}

//Mid Afternoon
$result1 = $conn->query($select1);
$data74 = array();
while($row23 = $result1->fetch_object()){
	if($row23->meal == 'midafternoon'){
		$data74 .= '<tr>'
		  .'<td>'.$row23->food.'</td>'
		  .'<td>'.$row23->amount.' '.$row23->serving.'</td>'
          .'<td>'.$row23->Vit_A_RAE.'</td>'
          .'<td>'.$row23->Vit_A_RE.'</td>'
          .'<td>'.$row23->retinol.'</td>'
		  .'<td>'.$row23->b_carotene_equivalent.'</td>'
		  .'<td>'.$row23->thiamin.'</td>'
		  .'<td>'.$row23->riboflavin.'</td>'
		  .'<td>'.$row23->niacin.'</td>'
		  .'<td>'.$row23->dietary_folate_eq.'</td>'
		  .'<td>'.$row23->food_folate.'</td>'
		  .'<td>'.$row23->vit_B_12.'</td>'
		  .'<td>'.$row23->vit_c.'</td>'
		  .'<td>'.$row23->cholesterol.'</td>'
		  .'<td>'.$row23->Oxalic_acid_OXALAC.'</td>'
		  .'<td>'.$row23->phytate.'</td>';

	}
}

//Supper
$result1 = $conn->query($select1);
$data75 = array();
while($row23 = $result1->fetch_object()){
	if($row23->meal == 'supper'){
		$data75 .= '<tr>'
		  .'<td>'.$row23->food.'</td>'
		  .'<td>'.$row23->amount.' '.$row23->serving.'</td>'
          .'<td>'.$row23->Vit_A_RAE.'</td>'
          .'<td>'.$row23->Vit_A_RE.'</td>'
          .'<td>'.$row23->retinol.'</td>'
		  .'<td>'.$row23->b_carotene_equivalent.'</td>'
		  .'<td>'.$row23->thiamin.'</td>'
		  .'<td>'.$row23->riboflavin.'</td>'
		  .'<td>'.$row23->niacin.'</td>'
		  .'<td>'.$row23->dietary_folate_eq.'</td>'
		  .'<td>'.$row23->food_folate.'</td>'
		  .'<td>'.$row23->vit_B_12.'</td>'
		  .'<td>'.$row23->vit_c.'</td>'
		  .'<td>'.$row23->cholesterol.'</td>'
		  .'<td>'.$row23->Oxalic_acid_OXALAC.'</td>'
		  .'<td>'.$row23->phytate.'</td></tr>';

	}
}
//Late Supper
$result1 = $conn->query($select1);
$data76 = array();
while($row23 = $result1->fetch_object()){
	if($row23->meal == 'latesupper'){
		$data76 .= '<tr>'
		  .'<td>'.$row23->food.'</td>'
		  .'<td>'.$row23->amount.' '.$row23->serving.'</td>'
          .'<td>'.$row23->Vit_A_RAE.'</td>'
          .'<td>'.$row23->Vit_A_RE.'</td>'
          .'<td>'.$row23->retinol.'</td>'
		  .'<td>'.$row23->b_carotene_equivalent.'</td>'
		  .'<td>'.$row23->thiamin.'</td>'
		  .'<td>'.$row23->riboflavin.'</td>'
		  .'<td>'.$row23->niacin.'</td>'
		  .'<td>'.$row23->dietary_folate_eq.'</td>'
		  .'<td>'.$row23->food_folate.'</td>'
		  .'<td>'.$row23->vit_B_12.'</td>'
		  .'<td>'.$row23->vit_c.'</td>'
		  .'<td>'.$row23->cholesterol.'</td>'
		  .'<td>'.$row23->Oxalic_acid_OXALAC.'</td>'
		  .'<td>'.$row23->phytate.'</td>';

	}
}





$select_total= "SELECT patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
sum(round(servings.energy*patient_meals.amount,2)) as totalenergy,
sum(round(servings.water*patient_meals.amount, 2)) as totalwater,
sum(round(servings.protein*patient_meals.amount, 2)) as totalprotein,
sum(round(servings.fat*patient_meals.amount, 2)) as totalfat,
sum(round(servings.cho*patient_meals.amount, 2)) as totalcho,
sum(round(servings.fiber*patient_meals.amount, 2)) as totalfiber,
sum(round(servings.ca*patient_meals.amount, 2)) as totalca,
sum(round(servings.fe*patient_meals.amount, 2)) as totalfe,
sum(round(servings.mg*patient_meals.amount, 2)) as totalmg,
sum(round(servings.p*patient_meals.amount, 2)) as totalp,
sum(round(servings.k*patient_meals.amount, 2)) as totalk,
sum(round(servings.na*patient_meals.amount, 2)) as totalna,
sum(round(servings.zn*patient_meals.amount, 2)) as totalzn,
sum(round(servings.se*patient_meals.amount, 2)) as totalse,
sum(round(servings.Vit_A_RAE*patient_meals.amount, 2)) as totalVit_A_RAE,
sum(round(servings.Vit_A_RE*patient_meals.amount, 2)) as totalVit_A_RE,
sum(round(servings.retinol*patient_meals.amount, 2)) as totalretinol,
sum(round(servings.b_carotene_equivalent*patient_meals.amount, 2)) as totalb_carotene_equivalent,
sum(round(servings.thiamin*patient_meals.amount, 2)) as totalthiamin,
sum(round(servings.riboflavin*patient_meals.amount, 2)) as totalriboflavin,
sum(round(servings.niacin*patient_meals.amount, 2)) as totalniacin,
sum(round(servings.dietary_folate_eq*patient_meals.amount, 2)) as totaldietary_folate_eq,
sum(round(servings.food_folate*patient_meals.amount, 2)) as totalfood_folate,
sum(round(servings.vit_B_12*patient_meals.amount, 2)) as totalvit_B_12,
sum(round(servings.vit_c*patient_meals.amount, 2)) as totalvit_c,
sum(round(servings.cholesterol*patient_meals.amount, 2)) as totalcholesterol,
sum(round(servings.Oxalic_acid_OXALAC*patient_meals.amount, 2)) as totalOxalic_acid_OXALAC,
sum(round(servings.phytate*patient_meals.amount, 2)) as totalphytate,
 users.id, users.name
FROM patient_meals  
INNER JOIN foods ON foods.id=patient_meals.foods_id  
INNER JOIN servings ON servings.id=patient_meals.servings_id
INNER JOIN users ON users.id = patient_meals.user_id

WHERE user_id=$_GET[user_id]";


//Macro Nutrients Totals
//Breakfast
$total_result20 = $conn->query($select_total);
$total20 = array();
while($row_total = $total_result20->fetch_object()){
	if($row_total->meal == 'Breakfast'){
	$total20 .= 
          '<td>'.$row_total->totalenergy.'</td>'
		  .'<td>'.$row_total->totalwater.'</td>'
          .'<td>'.$row_total->totalprotein.'</td>'
          .'<td>'.$row_total->totalfat.'</td>'
		  .'<td>'.$row_total->totalcho.'</td>'
          .'<td>'.$row_total->totalfiber.'</td></tr>';
	}
}
//Mid Morning 
$total_result19 = $conn->query($select_total);
$total19 = array();
while($row_total = $total_result19->fetch_object()){
	if($row_total->meal == 'mid-morning'){
	$total19 .= 
          '<td>'.$row_total->totalenergy.'</td>'
		  .'<td>'.$row_total->totalwater.'</td>'
          .'<td>'.$row_total->totalprotein.'</td>'
          .'<td>'.$row_total->totalfat.'</td>'
		  .'<td>'.$row_total->totalcho.'</td>'
          .'<td>'.$row_total->totalfiber.'</td></tr>';
	}
}
//Lunch 
$total_result29 = $conn->query($select_total);
$total29 = array();
while($row_total = $total_result29->fetch_object()){
	if($row_total->meal == 'Lunch'){
	$total29 .= 
          '<td>'.$row_total->totalenergy.'</td>'
		  .'<td>'.$row_total->totalwater.'</td>'
          .'<td>'.$row_total->totalprotein.'</td>'
          .'<td>'.$row_total->totalfat.'</td>'
		  .'<td>'.$row_total->totalcho.'</td>'
          .'<td>'.$row_total->totalfiber.'</td></tr>';
	}
}
//Mid Afternoon 
$total_result31 = $conn->query($select_total);
$total31 = array();
while($row_total = $total_result31->fetch_object()){
	if($row_total->meal == 'midafternoon'){
	$total31 .= 
          '<td>'.$row_total->totalenergy.'</td>'
		  .'<td>'.$row_total->totalwater.'</td>'
          .'<td>'.$row_total->totalprotein.'</td>'
          .'<td>'.$row_total->totalfat.'</td>'
		  .'<td>'.$row_total->totalcho.'</td>'
          .'<td>'.$row_total->totalfiber.'</td></tr>';
	}
}
//Supper 
$total_result33 = $conn->query($select_total);
$total33 = array();
while($row_total = $total_result33->fetch_object()){
	if($row_total->meal == 'supper'){
	$total33 .= 
          '<td>'.$row_total->totalenergy.'</td>'
		  .'<td>'.$row_total->totalwater.'</td>'
          .'<td>'.$row_total->totalprotein.'</td>'
          .'<td>'.$row_total->totalfat.'</td>'
		  .'<td>'.$row_total->totalcho.'</td>'
          .'<td>'.$row_total->totalfiber.'</td></tr>';
	}
}
//Late Supper 
$total_result35 = $conn->query($select_total);
$total35 = array();
while($row_total = $total_result35->fetch_object()){
	if($row_total->meal == 'latesupper'){
	$total35 .= 
          '<td>'.$row_total->totalenergy.'</td>'
		  .'<td>'.$row_total->totalwater.'</td>'
          .'<td>'.$row_total->totalprotein.'</td>'
          .'<td>'.$row_total->totalfat.'</td>'
		  .'<td>'.$row_total->totalcho.'</td>'
          .'<td>'.$row_total->totalfiber.'</td></tr>';
	}
}
//Totals  Macro Nutrients
$total_result = $conn->query($select_total);
$total37 = array();
while($row_total = $total_result->fetch_object()){
	$total37 .= 
          '<td>'.$row_total->totalenergy.'</td>'
		  .'<td>'.$row_total->totalwater.'</td>'
          .'<td>'.$row_total->totalprotein.'</td>'
          .'<td>'.$row_total->totalfat.'</td>'
		  .'<td>'.$row_total->totalcho.'</td>'
          .'<td>'.$row_total->totalfiber.'</td></tr>';
}

//Totals Micro Nutrients
$total_result = $conn->query($select_total);
$total1 = array();
while($row_total = $total_result->fetch_object()){
	$total1.= 
          '<td>'.$row_total->totalca.'</td>'
		  .'<td>'.$row_total->totalfe.'</td>'
          .'<td>'.$row_total->totalmg.'</td>'
          .'<td>'.$row_total->totalp.'</td>'
		  .'<td>'.$row_total->totalk.'</td>'
		  .'<td>'.$row_total->totalna.'</td>'
          .'<td>'.$row_total->totalzn.'</td>'
          .'<td>'.$row_total->totalse.'</td>
		  </tr>';
}
//Totals Vitamins
$total_result = $conn->query($select_total);
$total7 = array();
while($row_total = $total_result->fetch_object()){
	$total7.= 
          '<td>'.$row_total->totalVit_A_RAE.'</td>'
		  .'<td>'.$row_total->totalVit_A_RE.'</td>'
          .'<td>'.$row_total->totalretinol.'</td>'
		  .'<td>'.$row_total->totalb_carotene_equivalent.'</td>'
		  .'<td>'.$row_total->totalthiamin.'</td>'
		  .'<td>'.$row_total->totalriboflavin.'</td>'
		  .'<td>'.$row_total->totalniacin.'</td>'
		  .'<td>'.$row_total->totaldietary_folate_eq.'</td>'
		  .'<td>'.$row_total->totalfood_folate.'</td>'
          .'<td>'.$row_total->totalvit_B_12.'</td>'
		  .'<td>'.$row_total->totalvit_c.'</td>'
		  .'<td>'.$row_total->totalcholesterol.'</td>'
          .'<td>'.$row_total->totalOxalic_acid_OXALAC.'</td>'
          .'<td>'.$row_total->totalphytate.'</td>
		  </tr>';
}






$total_result = $conn->query($select_total);
$total2 = array();
while($row_total = $total_result->fetch_object()){
	$total2.= '<tr><td>'.$row_total->totalenergy.'</td>'
	.'<tr><td>'.$row_total->totalwater.'</td>'
	.'<tr><td>'.$row_total->totalprotein.'</td>'
	.'<tr><td>'.$row_total->totalfat.'</td>'
	.'<tr><td>'.$row_total->totalfiber.'</td>'
	.'<tr><td>'.$row_total->totalcho.'</td>'
	.'<tr><td>'.$row_total->totalca.'</td>'
	.'<tr><td>'.$row_total->totalfe.'</td>'
	.'<tr><td>'.$row_total->totalmg.'</td>'
	.'<tr><td>'.$row_total->totalp.'</td>'
	.'<tr><td>'.$row_total->totalk.'</td>'
	.'<tr><td>'.$row_total->totalna.'</td>'
	.'<tr><td>'.$row_total->totalzn.'</td>'
	.'<tr><td>'.$row_total->totalse.'</td>'
	.'<tr><td>'.$row_total->totalVit_A_RAE.'</td>'
	.'<tr><td>'.$row_total->totalVit_A_RE.'</td>'
	.'<tr><td>'.$row_total->totalretinol.'</td>'
	.'<tr><td>'.$row_total->totalb_carotene_equivalent.'</td>'
	.'<tr><td>'.$row_total->totalthiamin.'</td>'
	.'<tr><td>'.$row_total->totalriboflavin.'</td>'
	.'<tr><td>'.$row_total->totalniacin.'</td>'
	.'<tr><td>'.$row_total->totaldietary_folate_eq.'</td>'
	.'<tr><td>'.$row_total->totalfood_folate.'</td>'
	.'<tr><td>'.$row_total->totalvit_B_12.'</td>'
	.'<tr><td>'.$row_total->totalvit_c.'</td>'
	.'<tr><td>'.$row_total->totalcholesterol.'</td>'
	.'<tr><td>'.$row_total->totalOxalic_acid_OXALAC.'</td>'
	.'<tr><td>'.$row_total->totalphytate.'</td>';
}



$selecta = "SELECT name, id FROM users WHERE id=$_GET[user_id]";
$result = $conn->query($selecta);
$data119 = array();
while($row = $result->fetch_object()){
  $data119 .=
  '<td style="border:0px; color:purple; font-weight: bold;"align="right"> For : '.$row->name.'</td>';
}

// Define the Header/Footer before writing anything so they appear on the first page
$mpdf->SetHTMLHeader('
<div style="text-align: right; font-weight: bold; color:purple;">
    Company Name
</div>');


$mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="33%" style="color: purple; border:0px; font-weight: bold;">This analysis was done on : {DATE j-m-Y} <br> Nutritionist : .......................................... </td>
        <td width="33%" align="center" style="color: purple; border:0px; font-weight: bold;">{PAGENO}</td>
	'.$data119.'
</table>');

// Take PDF contents in a variable
$pdfcontenta = '
<style>
table {
  font-size: 9px;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 0.5px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: white;
}
</style>
<table style="width:100%;margin-top:-10px;">
<tr>
<td style="width:35%;border:0px;"><img src="images/logo.png" style="max-width:200px;max-height:100px;">
</td>
<td style="width:30%;border:0px;"><p style="font-size:14px;text-align:center;color:purple;">DIET ANALYSIS REPORT</p>
</td>
<td style="width:35%;border:0px;text-align:right;color:purple;">
	<p style="font-size:10px;"><strong style="font-size:13px;color:purple;">Contact Us :</strong> <br> Phone : 0711530740 <br> Email : gathuimmanuel@gmail.com <br> Website : www.yoururl.com </p>
</td>
</tr>
</table>
<hr style="width:800px;margin-top:-10px;">
<hr style="width:800px;margin-top:-10px;">

<table style="width:100%;margin-top:-10px;">
  <tr>
    <td style=" border:0px;text-align:left;">
      <table style="width:100%;">
        <tr>
                  <td style=" border:0px;text-align:left;color:purple;"> 
                      <h2 style= "margin-top:-5px;text-align:left;">Personal Profile </h2>
                      <hr style="width:90%;margin-top:1px;text-align:left;color:orange;">
                      <hr style="width:90%;margin-top:-6px;text-align:left;color:orange;">
                        
                      <p> Name : </p> 
                        <br> 
                      <p> Age <strong> (Yrs) </strong> : </p>
                        <br>
                      <p> Gender : </p> 
                        <br> 
                      <p> Height <strong> (Cm) </strong>: </p>
                        <br>
                      <p> Weight <strong> (Kgs) </strong>  : </p> 
                        <br> 
                      <p> Physical Activity Level <strong> (P.A.L) </strong>  :</p>
                  </td>
        </tr>
                '.$data.'
      </table>
    </td>
    
    <td>
      <table style="width:100%;border:0px;">
        <tr>
                  <td style="border:0px;text-align:left;width:70%;color:purple;"> 
                      
                      <p> Your EER (Estimated Energy Requirement) in <strong> Kcals</strong> is : </p> 
                      
                  </td>
        </tr>
				'.$data57.'
        <tr>
                <td style=" border:0px;text-align:left;color:purple;"> 
                    
                    <p> Your Nutritional Goal is : </p> 
                    
                </td>
      </tr>
	  			'.$data97.'
              
      </table>
    </td>
  </tr>
</table>

<hr style="width:800px;margin-top:-2px;">
<hr style="width:800px;margin-top:-4px;">

<h4 style="text-align:center;color:purple;">Diet History Report</h4>
<hr style="width:30%;margin-top:-15px;">
		<table style="width:100%;">
			<tr>
				
			</tr>
			<tr>
				<td>
					<table style="border:0px;">
					
					<tr>
							<tr> 
								<th style="color: purple;text-align:center;" colspan="2">Breakfast</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">Amount of Serving(s)</td>
							</tr>
					</tr>
					'.$breakfast.'
					</table>
				</td>
		
				<td>
					<table>
					<tr>
							<tr> 
								<th style="color: purple;text-align:center;" colspan="2">Mid Morning</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">Amount of Serving(s)</td>
							</tr>
					</tr>
					'.$midmorning.'
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table>
					<tr>
							<tr> 
								<th style="color: purple;text-align:center;" colspan="2">Lunch</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">Amount of Serving(s)</td>
							</tr>
					</tr>
					'.$lunch.'
					</table>
				</td>
				<td>
					<table>
					<tr>
							<tr> 
								<th style="color: purple;text-align:center;" colspan="2">Mid Afternoon</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">Amount of Serving(s)</td>
							</tr>
					</tr>
					'.$midafternoon.'
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table>
					<tr>
							<tr> 
								<th style="color: purple;text-align:center;" colspan="2">Supper</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">Amount of Serving(s)</td>
							</tr>
					</tr>
					'.$supper.'
					</table>
				</td>
				<td>
					<table>
					<tr>
							<tr> 
								<th style="color: purple;text-align:center;" colspan="2">Late Supper</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">Amount of Serving(s)</td>
							</tr>
					</tr>
					'.$latesupper.'
					</table>
				</td>
			</tr>
		</table>';
$pdfcontent2 = '
<style>
table {
  font-size: 9px;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 0.5px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: white;
}
</style>
<table style="width:100%;margin-top:-10px;">
<tr>
<td style="width:35%;border:0px;"><img src="images/logo.png" style="max-width:200px;max-height:100px;">
</td>
<td style="width:30%;border:0px;"><p style="font-size:14px;text-align:center;color:purple;">DIET ANALYSIS REPORT</p>
</td>
<td style="width:35%;border:0px;text-align:right;color:purple;"><p style="font-size:10px;"><strong style="font-size:13px;color:purple;">Contact Us :</strong> <br> Phone : 0711530740 <br> Email : gathuimmanuel@gmail.com <br> Website : www.yoururl.com </p>
</td>
</tr>
</table>

<hr style="width:800px;">
		<hr style="width:800px;margin-top:-10px;">
        <h4 style="text-align:center;">Macro Nutrients Analysis</h4>
		<hr style="width:30%;margin-top:-15px;">
		<table>
			<tr>
				<td>
					<table>
							<tr> 
								<th style="color: purple;;text-align:center;" colspan="8">Breakfast</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">No of Serving Item(s)</td>
								<td style="color: purple;">Energy (ml/g)</td>
								<td style="color: purple;">Water (ml)</td>
								<td style="color: purple;">protein (g)</td>
								<td style="color: purple;">Fat (g)</td>
								<td style="color: purple;">Carbohydrate (g)</td>
								<td style="color: purple;">Fiber (g)</td>
							</tr>
							'.$data6.'
							<tr>
								<td style="color: purple;" colspan="2">Total</td>
							
							</tr>
					</table>
				</td>
			</tr>
		</table>
		<br>
		<table>
			<tr>
				<td>
					<table>

							<tr> 
								<th style="color: purple;;text-align:center;" colspan="8">Mid Morning</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">No of Serving Item(s)</td>
								<td style="color: purple;">Energy (ml/g)</td>
								<td style="color: purple;">Water (ml)</td>
								<td style="color: purple;">protein (g)</td>
								<td style="color: purple;">Fat (g)</td>
								<td style="color: purple;">Carbohydrate (g)</td>
								<td style="color: purple;">Fiber (g)</td>
							</tr>
							'.$data11.'
							<tr>
								<td style="color: purple;" colspan="2">Total</td>
							
							</tr>
					</table>
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td>
					<table>

							<tr> 
								<th style="color: purple;;text-align:center;" colspan="8">Lunch</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">No of Serving Item(s)</td>
								<td style="color: purple;">Energy (ml/g)</td>
								<td style="color: purple;">Water (ml)</td>
								<td style="color: purple;">protein (g)</td>
								<td style="color: purple;">Fat (g)</td>
								<td style="color: purple;">Carbohydrate (g)</td>
								<td style="color: purple;">Fiber (g)</td>
							</tr>
							'.$data1.'
							<tr>
								<td style="color: purple;" colspan="2">Total</td>
							
							</tr>
					</table>
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td>
					<table>

							<tr> 
								<th style="color: purple;;text-align:center;" colspan="8">Mid Afternoon</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">No of Serving Item(s)</td>
								<td style="color: purple;">Energy (ml/g)</td>
								<td style="color: purple;">Water (ml)</td>
								<td style="color: purple;">protein (g)</td>
								<td style="color: purple;">Fat (g)</td>
								<td style="color: purple;">Carbohydrate (g)</td>
								<td style="color: purple;">Fiber (g)</td>
							</tr>
							'.$data2.'
							<tr>
								<td style="color: purple;" colspan="2">Total</td>
							
							</tr>
					</table>
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td>
					<table>

							<tr> 
								<th style="color: purple;;text-align:center;" colspan="8">Supper</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">No of Serving Item(s)</td>
								<td style="color: purple;">Energy (ml/g)</td>
								<td style="color: purple;">Water (ml)</td>
								<td style="color: purple;">protein (g)</td>
								<td style="color: purple;">Fat (g)</td>
								<td style="color: purple;">Carbohydrate (g)</td>
								<td style="color: purple;">Fiber (g)</td>
							</tr>
							'.$data22.'
							<tr>
								<td style="color: purple;" colspan="2">Total</td>
							
							</tr>
					</table>
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td>
					<table>

							<tr> 
								<th style="color: purple;;text-align:center;" colspan="8">Late Supper</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">No of Serving Item(s)</td>
								<td style="color: purple;">Energy (ml/g)</td>
								<td style="color: purple;">Water (ml)</td>
								<td style="color: purple;">protein (g)</td>
								<td style="color: purple;">Fat (g)</td>
								<td style="color: purple;">Carbohydrate (g)</td>
								<td style="color: purple;">Fiber (g)</td>
							</tr>
							'.$data23.'
							<tr>
								<td style="color: purple;" colspan="2">Total</td>
							
							</tr>
					</table>
				</td>
			</tr>
		</table>
		<br>
		<table>
			<tr>
				<td>
					<table>
							<tr>
							
								<td style="color: purple;" colspan="7"><strong>Total Macro Nutrients </strong></td>
								<td style="color: purple;">Energy (ml/g)</td>
								<td style="color: purple;">Water (ml)</td>
								<td style="color: purple;">protein (g)</td>
								<td style="color: purple;">Fat (g)</td>
								<td style="color: purple;">Carbohydrate (g)</td>
								<td style="color: purple;">Fiber (g)</td>
							</tr>
							
							<tr>
								<td style="color: purple;" colspan="7"><strong>Total</strong></td>
							'.$total37.'
							</tr>
					</table>
				</td>
			</tr>
		</table>

';

// Take PDF contents in a variable
$pdfcontent3 = '
<style>
table {
  font-size: 9px;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 0.5px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: white;
}
</style>
<table style="width:100%;margin-top:-10px;">
<tr>
<td style="width:35%;border:0px;"><img src="images/logo.png" style="max-width:200px;max-height:100px;">
</td>
<td style="width:30%;border:0px;"><p style="font-size:14px;text-align:center;color:purple;">DIET ANALYSIS REPORT</p>
</td>
<td style="width:35%;border:0px;text-align:right;color:purple;"><p style="font-size:10px;"><strong style="font-size:13px;color:purple;">Contact Us :</strong> <br> Phone : 0711530740 <br> Email : gathuimmanuel@gmail.com <br> Website : www.yoururl.com </p>
</td>
</tr>
</table>

<h4 style="text-align:center;">Minerals Analysis</h4>
		<hr style="width:30%;margin-top:-15px;">
		<table>
			<tr>
				<td>
					<table>

							<tr> 
								<th style="color: purple;;text-align:center;" colspan="11">Breakfast</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">No of Serving Item(s)</td>
								<td style="color: purple;">Ca (mg)</td>
								<td style="color: purple;">Fe (mg)</td>
								<td style="color: purple;">Mg (mg)</td>
								<td style="color: purple;">P (mg)</td>
								<td style="color: purple;">K (mg)</td>
								<td style="color: purple;">Na (mg)</td>
								<td style="color: purple;">Zn (mg)</td>
								<td style="color: purple;">Se (mcg)</td>
							</tr>
							'.$data3.'
							<tr>
								<td style="color: purple;" colspan="11">Total</td>
							
							</tr>
					</table>
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td>
					<table>

							<tr> 
								<th style="color: purple;;text-align:center;" colspan="11">Mid Morning</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">No of Serving Item(s)</td>
								<td style="color: purple;">Ca (mg)</td>
								<td style="color: purple;">Fe (mg)</td>
								<td style="color: purple;">Mg (mg)</td>
								<td style="color: purple;">P (mg)</td>
								<td style="color: purple;">K (mg)</td>
								<td style="color: purple;">Na (mg)</td>
								<td style="color: purple;">Zn (mg)</td>
								<td style="color: purple;">Se (mcg)</td>
							</tr>
							'.$data25.'
							<tr>
								<td style="color: purple;" colspan="11">Total</td>
							
							</tr>
					</table>
				</td>
			</tr>
		</table>

		<table>
			<tr>
				<td>
					<table>
							<tr> 
								<th style="color: purple;;text-align:center;" colspan="11">Lunch</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">No of Serving Item(s)</td>
								<td style="color: purple;">Ca (mg)</td>
								<td style="color: purple;">Fe (mg)</td>
								<td style="color: purple;">Mg (mg)</td>
								<td style="color: purple;">P (mg)</td>
								<td style="color: purple;">K (mg)</td>
								<td style="color: purple;">Na (mg)</td>
								<td style="color: purple;">Zn (mg)</td>
								<td style="color: purple;">Se (mcg)</td>
							</tr>
							'.$data7.'
							<tr>
								<td style="color: purple;" colspan="11">Total</td>
							
							</tr>
					</table>
				</td>
			</tr>
		</table>

		<table>
			<tr>
				<td>
					<table>
							<tr> 
								<th style="color: purple;;text-align:center;" colspan="11">Mid Afternoon</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">No of Serving Item(s)</td>
								<td style="color: purple;">Ca (mg)</td>
								<td style="color: purple;">Fe (mg)</td>
								<td style="color: purple;">Mg (mg)</td>
								<td style="color: purple;">P (mg)</td>
								<td style="color: purple;">K (mg)</td>
								<td style="color: purple;">Na (mg)</td>
								<td style="color: purple;">Zn (mg)</td>
								<td style="color: purple;">Se (mcg)</td>
							</tr>
							'.$data8.'
							<tr>
								<td style="color: purple;" colspan="11">Total</td>
						
							</tr>
					</table>
				</td>
			</tr>
		</table>

		<table>
			<tr>
				<td>
					<table>

							<tr> 
								<th style="color: purple;;text-align:center;" colspan="11">Supper</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">No of Serving Item(s)</td>
								<td style="color: purple;">Ca (mg)</td>
								<td style="color: purple;">Fe (mg)</td>
								<td style="color: purple;">Mg (mg)</td>
								<td style="color: purple;">P (mg)</td>
								<td style="color: purple;">K (mg)</td>
								<td style="color: purple;">Na (mg)</td>
								<td style="color: purple;">Zn (mg)</td>
								<td style="color: purple;">Se (mcg)</td>
							</tr>
							'.$data10.'
							<tr>
								<td style="color: purple;" colspan="11">Total</td>
							
							</tr>
					</table>
				</td>
			</tr>
		</table>

		<table>
			<tr>
				<td>
					<table>

							<tr> 
								<th style="color: purple;;text-align:center;" colspan="11">Late Supper</th>
							</tr>
							<tr>
								<td style="color: purple;">Food</td>
								<td style="color: purple;">No of Serving Item(s)</td>
								<td style="color: purple;">Ca (mg)</td>
								<td style="color: purple;">Fe (mg)</td>
								<td style="color: purple;">Mg (mg)</td>
								<td style="color: purple;">P (mg)</td>
								<td style="color: purple;">K (mg)</td>
								<td style="color: purple;">Na (mg)</td>
								<td style="color: purple;">Zn (mg)</td>
								<td style="color: purple;">Se (mcg)</td>
							</tr>
							'.$data12.'
							<tr>
								<td style="color: purple;" colspan="11">Total</td>
							
							</tr>
					</table>
				</td>
			</tr>
		</table>
		<br>
		<table>
			<tr>
				<td>
					<table>
							<tr>
							
								<td style="color: purple;" colspan="9"><strong>Total Micro Nutrients</strong></td>
								<td style="color: purple;">Calcium (mg)</td>
								<td style="color: purple;">Iron(Fe) (mg)</td>
								<td style="color: purple;">Magnesium(Mg) (mg)</td>
								<td style="color: purple;">Phosphorous(P)(mg)</td>
								<td style="color: purple;">Potassium(K)(mg)</td>
								<td style="color: purple;">Sodium(Na)(mg)</td>
								<td style="color: purple;">Zinc(Zn) (mg)</td>
								<td style="color: purple;">Selenium(Se) (mcg)</td>
							</tr>
							
							<tr>
								<td style="color: purple;" colspan="9"><strong>Total</strong></td>
							'.$total1.'
							</tr>
					</table>
				</td>
			</tr>
		</table>
	
';

//Take PDF contents in a variable
$pdfcontent4 ='
<style>
table {
  font-size: 9px;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 0.5px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: white;
}
</style>
<table style="width:100%;margin-top:-10px;">
<tr>
<td style="width:35%;border:0px;"><img src="images/logo.png" style="max-width:200px;max-height:100px;">
</td>
<td style="width:30%;border:0px;"><p style="font-size:14px;text-align:center;color:purple;">DIET ANALYSIS REPORT</p>
</td>
<td style="width:35%;border:0px;text-align:right;color:purple;"><p style="font-size:10px;"><strong style="font-size:13px;color:purple;">Contact Us :</strong> <br> Phone : 0711530740 <br> Email : gathuimmanuel@gmail.com <br> Website : www.yoururl.com </p>
</td>
</tr>
</table>

<h4 style="text-align:center;">Vitamins Analysis</h4>
<hr style="width:30%;margin-top:-15px;">
<table>
	<tr>
		<td>
			<table>
					<tr> 
						<th style="color: purple;;text-align:center;" colspan="16">Breakfast</th>
					</tr>
					<tr>
						<td style="color: purple;">Food</td>
						<td style="color: purple;">No of Serving Item(s)</td>
						<td style="color: purple;">Vit_A_RAE (mcg)</td>
						<td style="color: purple;">Vit_A_RE (mcg)</td>
						<td style="color: purple;">Retinol (mcg)</td>
						<td style="color: purple;">B_Carotene (mcg)</td>
						<td style="color: purple;">Thiamin (mg)</td>
						<td style="color: purple;">Riboflavin (mg)</td>
						<td style="color: purple;">Niacin (mg)</td>
						<td style="color: purple;">Dietary Folate (mcg)</td>
						<td style="color: purple;">Food Folate (mcg)</td>
						<td style="color: purple;">Vit_B_12 (mcg)</td>
						<td style="color: purple;">Vit_C (mg)</td>
						<td style="color: purple;">Cholestrol (mg)</td>
						<td style="color: purple;">Oxalic Acid (mg)</td>
						<td style="color: purple;">Phytate (mg)</td>
					</tr>
					'.$data71.'
					<tr>
						<td style="color: purple;" colspan="16">Total</td>
					
					</tr>
			</table>
		</td>
	</tr>
</table>
<table>
	<tr>
		<td>
			<table>
					<tr> 
						<th style="color: purple;;text-align:center;" colspan="16">Mid Morning</th>
					</tr>
					<tr>
							<td style="color: purple;">Food</td>
							<td style="color: purple;">No of Serving Item(s)</td>
							<td style="color: purple;">Vit_A_RAE (mcg)</td>
							<td style="color: purple;">Vit_A_RE (mcg)</td>
							<td style="color: purple;">Retinol (mcg)</td>
							<td style="color: purple;">B_Carotene (mcg)</td>
							<td style="color: purple;">Thiamin (mg)</td>
							<td style="color: purple;">Riboflavin (mg)</td>
							<td style="color: purple;">Niacin (mg)</td>
							<td style="color: purple;">Dietary Folate (mcg)</td>
							<td style="color: purple;">Food Folate (mcg)</td>
							<td style="color: purple;">Vit_B_12 (mcg)</td>
							<td style="color: purple;">Vit_C (mg)</td>
							<td style="color: purple;">Cholestrol (mg)</td>
							<td style="color: purple;">Oxalic Acid (mg)</td>
							<td style="color: purple;">Phytate (mg)</td>
					</tr>
					'.$data72.'
					<tr>
						<td style="color: purple;" colspan="16">Total</td>
					
					</tr>
			</table>
		</td>
	</tr>
</table>

<table>
	<tr>
		<td>
			<table>

					<tr> 
						<th style="color: purple;;text-align:center;" colspan="16">Lunch</th>
					</tr>
					<tr>
							<td style="color: purple;">Food</td>
							<td style="color: purple;">No of Serving Item(s)</td>
							<td style="color: purple;">Vit_A_RAE (mcg)</td>
							<td style="color: purple;">Vit_A_RE (mcg)</td>
							<td style="color: purple;">Retinol (mcg)</td>
							<td style="color: purple;">B_Carotene (mcg)</td>
							<td style="color: purple;">Thiamin (mg)</td>
							<td style="color: purple;">Riboflavin (mg)</td>
							<td style="color: purple;">Niacin (mg)</td>
							<td style="color: purple;">Dietary Folate (mcg)</td>
							<td style="color: purple;">Food Folate (mcg)</td>
							<td style="color: purple;">Vit_B_12 (mcg)</td>
							<td style="color: purple;">Vit_C (mg)</td>
							<td style="color: purple;">Cholestrol (mg)</td>
							<td style="color: purple;">Oxalic Acid (mg)</td>
							<td style="color: purple;">Phytate (mg)</td>
					</tr>
					'.$data73.'
					<tr>
						<td style="color: purple;" colspan="16">Total</td>
					
					</tr>
			</table>
		</td>
	</tr>
</table>

<table>
	<tr>
		<td>
			<table>
					<tr> 
						<th style="color: purple;;text-align:center;" colspan="16">Mid Afternoon</th>
					</tr>
					<tr>
							<td style="color: purple;">Food</td>
							<td style="color: purple;">No of Serving Item(s)</td>
							<td style="color: purple;">Vit_A_RAE (mcg)</td>
							<td style="color: purple;">Vit_A_RE (mcg)</td>
							<td style="color: purple;">Retinol (mcg)</td>
							<td style="color: purple;">B_Carotene (mcg)</td>
							<td style="color: purple;">Thiamin (mg)</td>
							<td style="color: purple;">Riboflavin (mg)</td>
							<td style="color: purple;">Niacin (mg)</td>
							<td style="color: purple;">Dietary Folate (mcg)</td>
							<td style="color: purple;">Food Folate (mcg)</td>
							<td style="color: purple;">Vit_B_12 (mcg)</td>
							<td style="color: purple;">Vit_C (mg)</td>
							<td style="color: purple;">Cholestrol (mg)</td>
							<td style="color: purple;">Oxalic Acid (mg)</td>
							<td style="color: purple;">Phytate (mg)</td>
					</tr>
					'.$data74.'
					<tr>
						<td style="color: purple;" colspan="16">Total</td>
				
					</tr>
			</table>
		</td>
	</tr>
</table>

<table>
	<tr>
		<td>
			<table>

					<tr> 
						<th style="color: purple;;text-align:center;" colspan="16">Supper</th>
					</tr>
					<tr>
							<td style="color: purple;">Food</td>
							<td style="color: purple;">No of Serving Item(s)</td>
							<td style="color: purple;">Vit_A_RAE (mcg)</td>
							<td style="color: purple;">Vit_A_RE (mcg)</td>
							<td style="color: purple;">Retinol (mcg)</td>
							<td style="color: purple;">B_Carotene (mcg)</td>
							<td style="color: purple;">Thiamin (mg)</td>
							<td style="color: purple;">Riboflavin (mg)</td>
							<td style="color: purple;">Niacin (mg)</td>
							<td style="color: purple;">Dietary Folate (mcg)</td>
							<td style="color: purple;">Food Folate (mcg)</td>
							<td style="color: purple;">Vit_B_12 (mcg)</td>
							<td style="color: purple;">Vit_C (mg)</td>
							<td style="color: purple;">Cholestrol (mg)</td>
							<td style="color: purple;">Oxalic Acid (mg)</td>
							<td style="color: purple;">Phytate (mg)</td>
					</tr>
					'.$data75.'
					<tr>
						<td style="color: purple;" colspan="16">Total</td>
					
					</tr>
			</table>
		</td>
	</tr>
</table>

<table>
	<tr>
		<td>
			<table>
					<tr> 
						<th style="color: purple;;text-align:center;" colspan="16">Late Supper</th>
					</tr>
					<tr>
						<td style="color: purple;">Food</td>
						<td style="color: purple;">No of Serving Item(s)</td>
						<td style="color: purple;">Vit_A_RAE (mcg)</td>
						<td style="color: purple;">Vit_A_RE (mcg)</td>
						<td style="color: purple;">Retinol (mcg)</td>
						<td style="color: purple;">B_Carotene (mcg)</td>
						<td style="color: purple;">Thiamin (mg)</td>
						<td style="color: purple;">Riboflavin (mg)</td>
						<td style="color: purple;">Niacin (mg)</td>
						<td style="color: purple;">Dietary Folate (mcg)</td>
						<td style="color: purple;">Food Folate (mcg)</td>
						<td style="color: purple;">Vit_B_12 (mcg)</td>
						<td style="color: purple;">Vit_C (mg)</td>
						<td style="color: purple;">Cholestrol (mg)</td>
						<td style="color: purple;">Oxalic Acid (mg)</td>
						<td style="color: purple;">Phytate (mg)</td>
					</tr>
					'.$data76.'
					<tr>
						<td style="color: purple;" colspan="16">Total</td>
					
					</tr>
			</table>
		</td>
	</tr>
</table>
<br>
<table>
	<tr>
		<td>
			<table>
					<tr>
					
						<td style="color: purple;"><strong>Total Vitamins </strong></td>
						<td style="color: purple;">Vit_A_RAE (mcg)</td>
						<td style="color: purple;">Vit_A_RE (mcg)</td>
						<td style="color: purple;">Retinol (mcg)</td>
						<td style="color: purple;">B_Carotene (mcg)</td>
						<td style="color: purple;">Thiamin (mg)</td>
						<td style="color: purple;">Riboflavin (mg)</td>
						<td style="color: purple;">Niacin (mg)</td>
						<td style="color: purple;">Dietary Folate (mcg)</td>
						<td style="color: purple;">Food Folate (mcg)</td>
						<td style="color: purple;">Vit_B_12 (mcg)</td>
						<td style="color: purple;">Vit_C (mg)</td>
						<td style="color: purple;">Cholestrol (mg)</td>
						<td style="color: purple;">Oxalic Acid (mg)</td>
						<td style="color: purple;">Phytate (mg)</td>
					</tr>
					
					<tr>
						<td style="color: purple;"><strong>Total</strong></td>
					'.$total7.'
					</tr>
			</table>
		</td>
	</tr>
</table>
';
// Take PDF contents in a variable
$pdfcontent5 = '
<style>
table {
  font-size: 9px;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 0.5px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: white;
}
</style>
<table style="width:100%;margin-top:-10px;">
<tr>
<td style="width:35%;border:0px;"><img src="images/logo.png" style="max-width:200px;max-height:100px;">
</td>
<td style="width:30%;border:0px;"><p style="font-size:14px;text-align:center;color:purple;">DIET ANALYSIS REPORT</p>
</td>
<td style="width:35%;border:0px;text-align:right;color:purple;"><p style="font-size:10px;"><strong style="font-size:13px;color:purple;">Contact Us :</strong> <br> Phone : 0711530740 <br> Email : gathuimmanuel@gmail.com <br> Website : www.yoururl.com </p>
</td>
</tr>
</table>

		<table style="width:100%;">
				<tr>
					<td style="text-align:center;">
								<h3>ANALYSIS RESULTS</h3>
					</td>
				</tr>
			<tr>
				<td>
							<table style="width:100%;">
								<tr>
									<td>

										<table style="width:100%;">
												<tr>
													
															<th style="color: purple;">Nutrients</th>
															<th style="color: purple;">Reference </th>
													
												</tr>

												'.$data4 .'
										</table>
										
									</td>
									<td>
											<table style="width:100%;">

												<tr>
												
															<th style="color: purple;">Your Intake Results</th>	
												
												</tr>
												
												'.$total2 .'
											</table>
									</td>
									<td>
											<table style="width:100%;">

												<tr>
												
														<th style="color: purple;">Comment</th>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																<tr>
																	<td>...</td>
																</tr>
																
												</tr>
												
											</table>
									</td>
									
								</tr>
							</table>
				</td>
				
			</tr>
		</table>	
 ';
	
 $pdfcontent6 = '
 
 <style>
table {
  font-size: 9px;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 0.5px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: white;
}
</style>
<table style="width:100%;margin-top:-10px;">
<tr>
<td style="width:35%;border:0px;"><img src="images/logo.png" style="max-width:200px;max-height:100px;">
</td>
<td style="width:30%;border:0px;"><p style="font-size:14px;text-align:center;color:purple;">DIET ANALYSIS REPORT</p>
</td>
<td style="width:35%;border:0px;text-align:right;color:purple;"><p style="font-size:10px;"><strong style="font-size:13px;color:purple;">Contact Us :</strong> <br> Phone : 0711530740 <br> Email : gathuimmanuel@gmail.com <br> Website : www.yoururl.com </p>
</td>
</tr>
</table>

<table style="border:6px;">
			<tr>
				<td>
						<h4 style="font-size:18px;color:purple;"><strong>Nutritionist Report :</strong></h4>
				</td>
			</tr>
			<tr>
				<td>
				<br>
				<br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br><br><br>
					...................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
				</td>
			</tr>
		</table>


 
 ';
 // Write some HTML code:

$mpdf->WriteHTML($pdfcontenta);


//Page One
$mpdf->AddPage();

// Write some HTML code:
$mpdf->WriteHTML($pdfcontent2);


//Page Two
$mpdf->AddPage();

// Write some HTML code:
$mpdf->WriteHTML($pdfcontent3);


//Page Three
$mpdf->AddPage();

// Write some HTML code:
$mpdf->WriteHTML($pdfcontent4);


//Page Four
$mpdf->AddPage();

// Write some HTML code:
$mpdf->WriteHTML($pdfcontent5);

//Page Five
$mpdf->AddPage();


// Write some HTML code:
$mpdf->WriteHTML($pdfcontent6);


//Keep with Header Method
$mpdf->use_kwt = true;



$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0; 

//call watermark content and image
$mpdf->SetWatermarkText('Company Name');
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;

// Output a PDF file directly to the browser
$mpdf->Output('','');


