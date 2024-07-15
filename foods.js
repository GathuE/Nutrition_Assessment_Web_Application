//Show Bio Data form
function start() {
    document.getElementById("display").style.display = "none";
    document.getElementById("innercard").style.display = "block";
}


// save user bio data  to database 
$(document).ready(function() {
    $("#btn").click(function() {
        var age = document.getElementById("age").value;
        var height = document.getElementById("height").value;
        var weight = document.getElementById("weight").value;
        var work = document.getElementById("work").value;
        var pregnant = document.getElementById("pregnant").value;
        var lactating = document.getElementById("lactating").value;
        var sex = document.getElementById("sex").value;
        var goal = document.getElementById("goal").value;
        $.ajax({
            url: 'bio.php',
            method: 'POST',
            data: {
                age: age,
                height: height,
                weight: weight,
                work: work,
                pregnant: pregnant,
                lactating: lactating,
                sex: sex,
                goal: goal
            },

        });
    });
});

// save eer and reference data to database
$(document).ready(function() {
    $("#savebtn").click(function() {
        var eer = document.getElementById("eer").innerHTML;
        var protein = document.getElementById("protein").innerHTML;
        var fat = document.getElementById("fat").innerHTML;
        var carbohydrate = document.getElementById("carbohydrate").innerHTML;
        var water = document.getElementById("water").innerHTML;
        var fibre = document.getElementById("fibre").innerHTML;
        var calcium = document.getElementById("calcium").innerHTML;
        var iron = document.getElementById("iron").innerHTML;
        var magnesium = document.getElementById("magnesium").innerHTML;
        var phosphorous = document.getElementById("phosphorous").innerHTML;
        var potassium = document.getElementById("potassium").innerHTML;
        var sodium = document.getElementById("sodium").innerHTML;
        var zinc = document.getElementById("zinc").innerHTML;
        var sellenium = document.getElementById("sellenium").innerHTML;
        var vitarae = document.getElementById("vitarae").innerHTML;
        var vitare = document.getElementById("vitare").innerHTML;
        var retinol = document.getElementById("retinol").innerHTML;
        var bcarotene = document.getElementById("bcarotene").innerHTML;
        var thiamin = document.getElementById("thiamin").innerHTML;
        var riboflavin = document.getElementById("riboflavin").innerHTML;
        var niacin = document.getElementById("niacin").innerHTML;
        var dietaryfolate = document.getElementById("dietaryfolate").innerHTML;
        var foodfolate = document.getElementById("foodfolate").innerHTML;
        var vitb12 = document.getElementById("vitb12").innerHTML;
        var vitc = document.getElementById("vitc").innerHTML;
        var cholestrol = document.getElementById("cholestrol").innerHTML;
        var oxalicacid = document.getElementById("oxalicacid").innerHTML;
        var phytate = document.getElementById("phytate").innerHTML;
        $.ajax({
            url: 'reference.php',
            method: 'POST',
            data: {
                eer: eer,
                protein: protein,
                fat: fat,
                carbohydrate: carbohydrate,
                water: water,
                fibre: fibre,
                calcium: calcium,
                iron: iron,
                magnesium: magnesium,
                phosphorous: phosphorous,
                potassium: potassium,
                sodium: sodium,
                zinc: zinc,
                sellenium: sellenium,
                vitarae: vitarae,
                vitare: vitare,
                retinol: retinol,
                bcarotene: bcarotene,
                thiamin: thiamin,
                riboflavin: riboflavin,
                niacin: niacin,
                dietaryfolate: dietaryfolate,
                foodfolate: foodfolate,
                vitb12: vitb12,
                vitc: vitc,
                cholestrol: cholestrol,
                oxalicacid: oxalicacid,
                phytate: phytate

            },
            dataType: 'html',
            success: function() {
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    text: 'Successfully Saved!',
                    showConfirmButton: true,
                    timer: 2500
                });
            }
        });
    });
});


// Move to Meal Input Prompt Page
function meals() {
    document.getElementById("food").style.display = "none";
    document.getElementById("prompt").style.display = "block";

}

// Unhide Meal Fields
function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
    } else document.getElementById('ifYes').style.display = 'none';
}








