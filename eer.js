// Patient Form Swap
function divswap() {
    var agevalue = document.dataform.age.value;
    var gendervalue = document.dataform.gender.value;
    var heightvalue = document.dataform.height.value;
    var weightvalue = document.dataform.weight.value;
    var workvalue = document.dataform.work.value;
    var goalvalue = document.dataform.goal.value;

    if (agevalue === "" || heightvalue === "" || weightvalue === "" || gendervalue === "" || workvalue === "" || goalvalue === "") {
        Swal.fire({
            size: '200px',
            position: 'top-center',
            icon: 'error',
            text: 'Please fill in all Fields correctly.',
            showConfirmButton: true,
            timer: 2500
        })
        return false;
    } else {
        Swal.fire({
            position: 'top-center',
            icon: 'success',
            text: 'Successful!',
            showConfirmButton: true,
            timer: 1500
        })
        document.getElementById("innercard").style.display = "none";
        document.getElementById("info").style.display = "block";
    }
}



// EER Calculations
function EER() {
    var a = document.getElementById("age").value;
    var h = document.getElementById("height").value;
    var w = document.getElementById("weight").value;
    var j = document.getElementById("work").value;
    var p = document.getElementById("pregnant").value;
    var l = document.getElementById("lactating").value;
    var g = document.getElementById("sex").value;

    //male EER Calculations
    // PAL (0.5 - 1 years) checked
    if (a >= 0.5 && a <= 1 && g == "Male") {
        var eer = (99 * w - 100) + 22;
        // PAL (2 - 3 years) checked
    } else if (a >= 2 && a <= 3 && g == "Male") {
        var eer = (99 * w - 100) + 20;
    }
    // PAL (4 - 8 years) checked
    else if (a >= 4 && a <= 8 && j == 1 && g == "Male") {
        var eer = 88.5 - 61.9 * a + 1.00 * (26.7 * w + 903 * (h / 100)) + 20;
    } else if (a >= 4 && a <= 8 && j == 2 && g == "Male") {
        var eer = 88.5 - 61.9 * a + 1.13 * (26.7 * w + 903 * (h / 100)) + 20;
    } else if (a >= 4 && a <= 8 && j == 3 && g == "Male") {
        var eer = 88.5 - 61.9 * a + 1.26 * (26.7 * w + 903 * (h / 100)) + 20;
    } else if (a >= 4 && a <= 8 && j == 4 && g == "Male") {
        var eer = 88.5 - 61.9 * a + 1.42 * (26.7 * w + 903 * (h / 100)) + 20;
    }
    // PAL (9 - 13 years) checked
    else if (a >= 9 && a <= 13 && j == 1 && g == "Male") {
        var eer = 88.5 - 61.9 * a + 1.00 * (26.7 * w + 903 * (h / 100)) + 25;
    } else if (a >= 9 && a <= 13 && j == 2 && g == "Male") {
        var eer = 88.5 - 61.9 * a + 1.13 * (26.7 * w + 903 * (h / 100)) + 25;
    } else if (a >= 9 && a <= 13 && j == 3 && g == "Male") {
        var eer = 88.5 - 61.9 * a + 1.26 * (26.7 * w + 903 * (h / 100)) + 25;
    } else if (a >= 9 && a <= 13 && j == 4 && g == "Male") {
        var eer = 88.5 - 61.9 * a + 1.42 * (26.7 * w + 903 * (h / 100)) + 25;
    }
    // PAL (14 - 18 years) checked
    else if (a >= 14 && a <= 18 && j == 1 && g == "Male") {
        var eer = 88.5 - 61.9 * a + 1.00 * (26.7 * w + 903 * (h / 100)) + 25;
    } else if (a >= 14 && a <= 18 && j == 2 && g == "Male") {
        var eer = 88.5 - 61.9 * a + 1.13 * (26.7 * w + 903 * (h / 100)) + 25;
    } else if (a >= 14 && a <= 18 && j == 3 && g == "Male") {
        var eer = 88.5 - 61.9 * a + 1.26 * (26.7 * w + 903 * (h / 100)) + 25;
    } else if (a >= 14 && a <= 18 && j == 4 && g == "Male") {
        var eer = 88.5 - 61.9 * a + 1.42 * (26.7 * w + 903 * (h / 100)) + 25;
    }
    // PAL (19 - 30 years) checked
    else if (a >= 19 && a <= 30 && j == 1 && g == "Male") {
        var eer = 662 - 9.53 * a + 1.00 * (15.91 * w + 539.6 * (h / 100));
    } else if (a >= 19 && a <= 30 && j == 2 && g == "Male") {
        var eer = 662 - 9.53 * a + 1.11 * (15.91 * w + 539.6 * (h / 100));
    } else if (a >= 19 && a <= 30 && j == 3 && g == "Male") {
        var eer = 662 - 9.53 * a + 1.25 * (15.91 * w + 539.6 * (h / 100));
    } else if (a >= 19 && a <= 30 && j == 4 && g == "Male") {
        var eer = 662 - 9.53 * a + 1.48 * (15.91 * w + 539.6 * (h / 100));
    }
    // PAL (31 - 50 years) checked
    else if (a >= 31 && a <= 50 && j == 1 && g == "Male") {
        var eer = 662 - 9.53 * a + 1.00 * (15.91 * w + 539.6 * (h / 100));
    } else if (a >= 31 && a <= 50 && j == 2 && g == "Male") {
        var eer = 662 - 9.53 * a + 1.11 * (15.91 * w + 539.6 * (h / 100));
    } else if (a >= 31 && a <= 50 && j == 3 && g == "Male") {
        var eer = 662 - 9.53 * a + 1.25 * (15.91 * w + 539.6 * (h / 100));
    } else if (a >= 31 && a <= 50 && j == 4 && g == "Male") {
        var eer = 662 - 9.53 * a + 1.48 * (15.91 * w + 539.6 * (h / 100));
    }
    // PAL (51 - 70 years) checked
    else if (a >= 51 && a <= 70 && j == 1 && g == "Male") {
        var eer = 662 - 9.53 * a + 1.00 * (15.91 * w + 539.6 * (h / 100));
    } else if (a >= 51 && a <= 70 && j == 2 && g == "Male") {
        var eer = 662 - 9.53 * a + 1.11 * (15.91 * w + 539.6 * (h / 100));
    } else if (a >= 51 && a <= 70 && j == 3 && g == "Male") {
        var eer = 662 - 9.53 * a + 1.25 * (15.91 * w + 539.6 * (h / 100));
    } else if (a >= 51 && a <= 70 && j == 4 && g == "Male") {
        var eer = 662 - 9.53 * a + 1.48 * (15.91 * w + 539.6 * (h / 100));
    }
    // PAL (71 and Above years) checked
    else if (a >= 71 && a <= 100 && j == 1 && g == "Male") {
        var eer = 662 - 9.53 * a + 1.00 * (15.91 * w + 539.6 * (h / 100));
    } else if (a >= 71 && a <= 100 && j == 2 && g == "Male") {
        var eer = 662 - 9.53 * a + 1.11 * (15.91 * w + 539.6 * (h / 100));
    } else if (a >= 71 && a <= 100 && j == 3 && g == "Male") {
        var eer = 662 - 9.53 * a + 1.25 * (15.91 * w + 539.6 * (h / 100));
    } else if (a >= 71 && a <= 100 && j == 4 && g == "Male") {
        var eer = 662 - 9.53 * a + 1.48 * (15.91 * w + 539.6 * (h / 100));
    }

    // female PAL Calculations
    // PAL (0.5 - 1 years)
    else if (a >= 0.5 && a <= 1 && g == "Female") {
        var eer = (99 * w - 100) + 22;
        // PAL (2 - 3 years)
    } else if (a >= 2 && a <= 3 && g == "Female") {
        var eer = (99 * w - 100) + 20;
    }
    // PAL (4 - 8 years)
    else if (a >= 4 && a <= 8 && j == 1 && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.00)) + (934 * h / 100) + 20;
    } else if (a >= 4 && a <= 8 && j == 2 && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.16)) + (934 * h / 100) + 20;
    } else if (a >= 4 && a <= 8 && j == 3 && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.31)) + (934 * h / 100) + 20;
    } else if (a >= 4 && a <= 8 && j == 4 && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.56)) + (934 * h / 100) + 20;
    }
    // PAL (9 - 13 years)
    else if (a >= 9 && a <= 13 && j == 1 && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.00)) + (934 * h / 100) + 25;
    } else if (a >= 9 && a <= 13 && j == 2 && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.16)) + (934 * h / 100) + 25;
    } else if (a >= 9 && a <= 13 && j == 3 && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.31)) + (934 * h / 100) + 25;
    } else if (a >= 9 && a <= 13 && j == 4 && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.56)) + (934 * h / 100) + 25;
    }
    // PAL (14 - 18 years) Non pregnant Non Lactating checked
    else if (a >= 14 && a <= 18 && j == 1 && p == "no" && l == "no" && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.00)) + (934 * h / 100) + 25;
    } else if (a >= 14 && a <= 18 && j == 2 && p == "no" && l == "no" && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.16)) + (934 * h / 100) + 25;
    } else if (a >= 14 && a <= 18 && j == 3 && p == "no" && l == "no" && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.31)) + (934 * h / 100) + 25;
    } else if (a >= 14 && a <= 18 && j == 4 && p == "no" && l == "no" && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.56)) + (934 * h / 100) + 25;
    }
    // PAL (14 - 18 years) Pregnant Non Lactating checked
    else if (a >= 14 && a <= 18 && j == 1 && p == 1 && l == "no" && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.00)) + (934 * h / 100) + 25 + 272 + 180;
    } else if (a >= 14 && a <= 18 && j == 2 && p == 1 && l == "no" && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.12)) + (934 * h / 100) + 25 + 272 + 180;
    } else if (a >= 14 && a <= 18 && j == 3 && p == 1 && l == "no" && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.27)) + (934 * h / 100) + 25 + 272 + 180;
    } else if (a >= 14 && a <= 18 && j == 4 && p == 1 && l == "no" && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.45)) + (934 * h / 100) + 25 + 272 + 180;
    }
    // PAL (14 - 18 years) Lactating Non Pregnant checked
    else if (a >= 14 && a <= 18 && j == 1 && l == "yes" && p == "no" && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.00)) + (934 * h / 100) + 25 + 500 - 170;
    } else if (a >= 14 && a <= 18 && j == 2 && l == "yes" && p == "no" && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.12)) + (934 * h / 100) + 25 + 272 - 170;
    } else if (a >= 14 && a <= 18 && j == 3 && l == "yes" && p == "no" && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.27)) + (934 * h / 100) + 25 + 272 - 170;
    } else if (a >= 14 && a <= 18 && j == 4 && l == "yes" && p == "no" && g == "Female") {
        var eer = (135.3 - (30.8 * a) + (10 * w * 1.45)) + (934 * h / 100) + 25 + 272 - 170;
    }
    // PAL (19 - 30 years) Non pregnant non Lactating checked
    else if (a >= 19 && a <= 30 && j == 1 && p == "no" && l == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.00)) + (726 * h / 100);
    } else if (a >= 19 && a <= 30 && j == 2 && p == "no" && l == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.12)) + (726 * h / 100);
    } else if (a >= 19 && a <= 30 && j == 3 && p == "no" && l == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.27)) + (726 * h / 100);
    } else if (a >= 19 && a <= 30 && j == 4 && p == "no" && l == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.45)) + (726 * h / 100);
    }
    // PAL (19 - 30 years) Pregnant Non Lactating checked
    else if (a >= 19 && a <= 30 && j == 1 && p == 1 && l == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.00)) + (726 * h / 100) + 272 + 180;
    } else if (a >= 19 && a <= 30 && j == 2 && p == 1 && l == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.12)) + (726 * h / 100) + 272 + 180;
    } else if (a >= 19 && a <= 30 && j == 3 && p == 1 && l == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.27)) + (726 * h / 100) + 272 + 180;
    } else if (a >= 19 && a <= 30 && j == 4 && p == 1 && l == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.45)) + (726 * h / 100) + 272 + 180;
    }
    // PAL (19 - 30 years) Lactating Non Pregnant checked
    else if (a >= 19 && a <= 30 && j == 1 && l == "yes" && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.00)) + (726 * h / 100) + 500 - 170;
    } else if (a >= 19 && a <= 30 && j == 2 && l == "yes" && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.12)) + (726 * h / 100) + 500 - 170;
    } else if (a >= 19 && a <= 30 && j == 3 && l == "yes" && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.27)) + (726 * h / 100) + 500 - 170;
    } else if (a >= 19 && a <= 30 && j == 4 && l == "yes" && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.45)) + (726 * h / 100) + 500 - 170;
    }
    // PAL (31 - 50 years) Pregnant Non Lactating checked
    else if (a >= 31 && a <= 50 && j == 1 && p == 1 && l == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.00)) + (726 * h / 100) + 272 + 180;
    } else if (a >= 31 && a <= 50 && j == 2 && p == 1 && l == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.12)) + (726 * h / 100) + 272 + 180;
    } else if (a >= 31 && a <= 50 && j == 3 && p == 1 && l == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.27)) + (726 * h / 100) + 272 + 180;
    } else if (a >= 31 && a <= 50 && j == 4 && p == 1 && l == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.45)) + (726 * h / 100) + 272 + 180;
    }
    // PAL (31 - 50 years) Lactating Non Pregnant checked
    else if (a >= 31 && a <= 50 && j == 1 && l == "yes" && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.00)) + (726 * h / 100) + 500 - 170;
    } else if (a >= 31 && a <= 50 && j == 2 && l == "yes" && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.12)) + (726 * h / 100) + 500 - 170;
    } else if (a >= 31 && a <= 50 && j == 3 && l == "yes" && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.27)) + (726 * h / 100) + 500 - 170;
    } else if (a >= 31 && a <= 50 && j == 4 && l == "yes" && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.45)) + (726 * h / 100) + 500 - 170;
    }
    // PAL (31 - 50 years) Non pregnant checked
    else if (a >= 31 && a <= 50 && j == 1 && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.00)) + (726 * h / 100);
    } else if (a >= 31 && a <= 50 && j == 2 && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.12)) + (726 * h / 100);
    } else if (a >= 31 && a <= 50 && j == 3 && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.27)) + (726 * h / 100);
    } else if (a >= 31 && a <= 50 && j == 4 && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.45)) + (726 * h / 100);
    }
    // PAL (51 - 70 years) Non pregnant checked
    else if (a >= 51 && a <= 70 && j == 1 && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.00)) + (726 * h / 100);
    } else if (a >= 51 && a <= 70 && j == 2 && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.12)) + (726 * h / 100);
    } else if (a >= 51 && a <= 70 && j == 3 && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.27)) + (726 * h / 100);
    } else if (a >= 51 && a <= 70 && j == 4 && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.45)) + (726 * h / 100);
    }
    // PAL (71 years and Above) Non pregnant checked
    else if (a >= 71 && a <= 100 && j == 1 && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.00)) + (726 * h / 100);
    } else if (a >= 71 && a <= 100 && j == 2 && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.12)) + (726 * h / 100);
    } else if (a >= 71 && a <= 100 && j == 3 && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.27)) + (726 * h / 100);
    } else if (a >= 71 && a <= 100 && j == 4 && p == "no" && g == "Female") {
        var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.45)) + (726 * h / 100);
    }





    var eer = (eer.toFixed(1));
    window.eer = eer;
    window.a = a;
    window.g = g;
    window.w = w;
    window.p = p;
    window.l = l;


    document.getElementById("eer").innerHTML = "Client's EER is " + eer + " " + "Kcals";
    document.getElementById("standardeer").innerHTML = "<small>The above term <b>EER</b> represents the amount of energy<b>(in Kilo Calories)</b> that the client's body requires every day.</small>";
    document.getElementById("illustration").innerHTML = "<small>This energy in most scenarios is obtained from the variety of foods eaten by the client.<br>Such foods contain various nutrients that collectively contribute to the amount of energy the client's body needs <br> i.e <b>His / Her EER</b>.<br>You must be now curious about <b>what amounts of nutrient(s), (contained in the foods you eat), </b>the client needss to take to obtain energy equivalent to their EER.<br>Clicking on the button below will answer your question.</small>";
    document.getElementById("proceed").innerHTML = "Proceed";

};

function foodbreakdown() {

    document.getElementById("info").style.display = "none";
    document.getElementById("food").style.display = "block";

    // Nutrients Data (Male)
    // 0.5 - 1 yrs checked
    if (a >= 0.5 && a <= 1 && g == "Male") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 12;
        var calcium = 260;
        var iron = 11;
        var magnesium = 75;
        var phosphorous = 275;
        var potassium = 700;
        var sodium = 370;
        var zinc = 5;
        var sellenium = 20;
        var vitarae = 500;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 0.3;
        var riboflavin = 0.4;
        var niacin = 4;
        var dietaryfolate = 80;
        var foodfolate = 0;
        var vitb12 = 0.5;
        var vitc = 50;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 2 - 3 yrs checked
    else if (a >= 2 && a <= 3 && g == "Male") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 19;
        var calcium = 700;
        var iron = 7;
        var magnesium = 65;
        var phosphorous = 460;
        var potassium = 3000;
        var sodium = 1000;
        var zinc = 7;
        var sellenium = 20;
        var vitarae = 300;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 0.5;
        var riboflavin = 0.5;
        var niacin = 6;
        var dietaryfolate = 150;
        var foodfolate = 0;
        var vitb12 = 0.9;
        var vitc = 15;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 4 - 8 yrs checked
    else if (a >= 4 && a <= 8 && g == "Male") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 25;
        var calcium = 1000;
        var iron = 10;
        var magnesium = 130;
        var phosphorous = 500;
        var potassium = 3800;
        var sodium = 1200;
        var zinc = 12;
        var sellenium = 30;
        var vitarae = 400;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 0.6;
        var riboflavin = 0.6;
        var niacin = 8;
        var dietaryfolate = 200;
        var foodfolate = 0;
        var vitb12 = 1.2;
        var vitc = 25;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 9 - 13 yrs checked
    else if (a >= 9 && a <= 13 && g == "Male") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 31;
        var calcium = 1300;
        var iron = 8;
        var magnesium = 240;
        var phosphorous = 1250;
        var potassium = 4500;
        var sodium = 1500;
        var zinc = 12;
        var sellenium = 40;
        var vitarae = 600;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 0.9;
        var riboflavin = 0.9;
        var niacin = 12;
        var dietaryfolate = 300;
        var foodfolate = 0;
        var vitb12 = 1.8;
        var vitc = 45;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 14 - 18 yrs checked
    else if (a >= 14 && a <= 18 && g == "Male") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 38;
        var calcium = 1300;
        var iron = 11;
        var magnesium = 410;
        var phosphorous = 1250;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 11;
        var sellenium = 55;
        var vitarae = 900;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.2;
        var riboflavin = 1.3;
        var niacin = 16;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 75;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 19 - 30 yrs checked
    else if (a >= 19 && a <= 30 && g == "Male") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 38;
        var calcium = 1000;
        var iron = 8;
        var magnesium = 400;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 11;
        var sellenium = 55;
        var vitarae = 900;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.2;
        var riboflavin = 1.3;
        var niacin = 16;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 90;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;


    }
    // 31 - 50 yrs checked
    else if (a >= 31 && a <= 50 && g == "Male") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 38;
        var calcium = 1000;
        var iron = 8;
        var magnesium = 420;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 11;
        var sellenium = 55;
        var vitarae = 900;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.2;
        var riboflavin = 1.3;
        var niacin = 16;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 90;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 51 - 70 yrs checked
    else if (a >= 51 && a <= 70 && g == "Male") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 30;
        var calcium = 1000;
        var iron = 8;
        var magnesium = 420;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 11;
        var sellenium = 55;
        var vitarae = 900;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.2;
        var riboflavin = 1.3;
        var niacin = 16;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 90;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 71 - 100 yrs checked
    else if (a >= 71 && a <= 100 && g == "Male") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 30;
        var calcium = 1200;
        var iron = 8;
        var magnesium = 420;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 1200;
        var zinc = 11;
        var sellenium = 55;
        var vitarae = 900;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.2;
        var riboflavin = 1.3;
        var niacin = 16;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 90;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }

    // Nutrients Data (Female)
    // 0.5 - 1 yrs checked
    if (a >= 0.5 && a <= 1 && g == "Female") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 12;
        var calcium = 260;
        var iron = 11;
        var magnesium = 75;
        var phosphorous = 275;
        var potassium = 700;
        var sodium = 370;
        var zinc = 3;
        var sellenium = 20;
        var vitarae = 500;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 0.3;
        var riboflavin = 0.4;
        var niacin = 4;
        var dietaryfolate = 80;
        var foodfolate = 0;
        var vitb12 = 0.5;
        var vitc = 30;
        var cholestrol = 0;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 2 - 3 yrs checked
    else if (a >= 2 && a <= 3 && g == "Female") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 19;
        var calcium = 700;
        var iron = 9;
        var magnesium = 80;
        var phosphorous = 460;
        var potassium = 3000;
        var sodium = 1000;
        var zinc = 3;
        var sellenium = 20;
        var vitarae = 300;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 0.5;
        var riboflavin = 0.5;
        var niacin = 6;
        var dietaryfolate = 150;
        var foodfolate = 0;
        var vitb12 = 0.9;
        var vitc = 35;
        var cholestrol = 0;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 4 - 8 yrs checked
    else if (a >= 4 && a <= 8 && g == "Female") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 25;
        var calcium = 1000;
        var iron = 10;
        var magnesium = 130;
        var phosphorous = 500;
        var potassium = 3800;
        var sodium = 1200;
        var zinc = 5;
        var sellenium = 30;
        var vitarae = 400;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 0.6;
        var riboflavin = 0.6;
        var niacin = 8;
        var dietaryfolate = 200;
        var foodfolate = 0;
        var vitb12 = 1.2;
        var vitc = 35;
        var cholestrol = 0;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 9 - 13 yrs checked
    else if (a >= 9 && a <= 13 && g == "Female") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 26;
        var calcium = 1300;
        var iron = 8;
        var magnesium = 240;
        var phosphorous = 1250;
        var potassium = 4500;
        var sodium = 1500;
        var zinc = 8;
        var sellenium = 40;
        var vitarae = 600;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 0.9;
        var riboflavin = 0.9;
        var niacin = 12;
        var dietaryfolate = 300;
        var foodfolate = 0;
        var vitb12 = 1.8;
        var vitc = 45;
        var cholestrol = 0;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 14 - 18 yrs Non pegnant checked
    else if (a >= 14 && a <= 18 && p == "no" && g == "Female") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 26;
        var calcium = 1400;
        var iron = 15;
        var magnesium = 360;
        var phosphorous = 1250;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 9;
        var sellenium = 55;
        var vitarae = 700;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1;
        var riboflavin = 1;
        var niacin = 14;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 65;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 14 - 18 yrs Pregnant checked
    else if (a >= 14 && a <= 18 && p == 1 && g == "Female") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 28;
        var calcium = 1300;
        var iron = 27;
        var magnesium = 400;
        var phosphorous = 1250;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 12;
        var sellenium = 60;
        var vitarae = 750;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.4;
        var riboflavin = 1.4;
        var niacin = 18;
        var dietaryfolate = 600;
        var foodfolate = 0;
        var vitb12 = 2.6;
        var vitc = 80;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 14 - 18 yrs Lactating checked
    else if (a >= 14 && a <= 18 && l == "yes" && g == "Female") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 29;
        var calcium = 1300;
        var iron = 10;
        var magnesium = 360;
        var phosphorous = 1250;
        var potassium = 5100;
        var sodium = 2300;
        var zinc = 13;
        var sellenium = 70;
        var vitarae = 1200;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.4;
        var riboflavin = 1.6;
        var niacin = 17;
        var dietaryfolate = 500;
        var foodfolate = 0;
        var vitb12 = 2.8;
        var vitc = 115;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 19 - 30 yrs Non Preganant checked
    else if (a >= 19 && a <= 30 && p == "no" && g == "Female") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 25;
        var calcium = 1300;
        var iron = 18;
        var magnesium = 360;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 8;
        var sellenium = 55;
        var vitarae = 700;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.1;
        var riboflavin = 1.1;
        var niacin = 14;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 75;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 19 - 30 yrs  Preganant checked
    else if (a >= 19 && a <= 30 && p == 1 && g == "Female") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 28;
        var calcium = 1000;
        var iron = 27;
        var magnesium = 350;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 11;
        var sellenium = 60;
        var vitarae = 770;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.4;
        var riboflavin = 1.4;
        var niacin = 18;
        var dietaryfolate = 600;
        var foodfolate = 0;
        var vitb12 = 2.6;
        var vitc = 85;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 19 - 30 yrs  Lactating checked
    else if (a >= 19 && a <= 30 && l == "yes" && g == "Female") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 29;
        var calcium = 1000;
        var iron = 9;
        var magnesium = 310;
        var phosphorous = 700;
        var potassium = 5100;
        var sodium = 2300;
        var zinc = 12;
        var sellenium = 70;
        var vitarae = 1300;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.4;
        var riboflavin = 1.6;
        var niacin = 17;
        var dietaryfolate = 500;
        var foodfolate = 0;
        var vitb12 = 2.8;
        var vitc = 120;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 31 - 50 yrs Non Pregnant checked
    else if (a >= 31 && a <= 50 && p == "no" && g == "Female") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 25;
        var calcium = 1000;
        var iron = 18;
        var magnesium = 320;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 8;
        var sellenium = 55;
        var vitarae = 700;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.1;
        var riboflavin = 1.1;
        var niacin = 14;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 75;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 31 - 50 yrs  Pregnant checked
    else if (a >= 31 && a <= 50 && p == 1 && g == "Female") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 28;
        var calcium = 1000;
        var iron = 7;
        var magnesium = 360;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 11;
        var sellenium = 0;
        var vitarae = 770;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.4;
        var riboflavin = 1.4;
        var niacin = 18;
        var dietaryfolate = 600;
        var foodfolate = 0;
        var vitb12 = 2.6;
        var vitc = 85;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 31 - 50 yrs  Lactating checked
    else if (a >= 31 && a <= 50 && l == "yes" && g == "Female") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 29;
        var calcium = 1000;
        var iron = 9;
        var magnesium = 310;
        var phosphorous = 700;
        var potassium = 5100;
        var sodium = 2300;
        var zinc = 12;
        var sellenium = 70;
        var vitarae = 1300;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.4;
        var riboflavin = 1.6;
        var niacin = 17;
        var dietaryfolate = 500;
        var foodfolate = 0;
        var vitb12 = 2.8;
        var vitc = 120;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 51 - 70 yrs Non Pregnant checked
    else if (a >= 51 && a <= 70 && g == "Female") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 21;
        var calcium = 1200;
        var iron = 8;
        var magnesium = 320;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 1300;
        var zinc = 8;
        var sellenium = 55;
        var vitarae = 700;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.1;
        var riboflavin = 1.1;
        var niacin = 14;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 75;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 71 - 100 yrs Non pregnant checked
    else if (a >= 71 && a <= 100 && p == "no" && g == "Female") {
        var protein = (eer * 0.0375).toFixed(1);
        var fat = (eer * 0.0333).toFixed(1);
        var carbohydrate = (eer * 0.1375).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 21;
        var calcium = 1200;
        var iron = 8;
        var magnesium = 320;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 1200;
        var zinc = 8;
        var sellenium = 55;
        var vitarae = 700;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.1;
        var riboflavin = 1.1;
        var niacin = 14;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 75;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }


    document.getElementById("protein").innerHTML = protein + "g";
    document.getElementById("fat").innerHTML = fat + "g";
    document.getElementById("carbohydrate").innerHTML = carbohydrate + "g";
    document.getElementById("water").innerHTML = water + "mls";
    document.getElementById("fibre").innerHTML = fibre + "g";
    document.getElementById("calcium").innerHTML = calcium + "mg";
    document.getElementById("iron").innerHTML = iron + "mg";
    document.getElementById("magnesium").innerHTML = magnesium + "mg";
    document.getElementById("phosphorous").innerHTML = phosphorous + "mg";
    document.getElementById("potassium").innerHTML = potassium + "mg";
    document.getElementById("sodium").innerHTML = sodium + "mg";
    document.getElementById("zinc").innerHTML = zinc + "mg";
    document.getElementById("sellenium").innerHTML = sellenium + "mcg";
    document.getElementById("vitarae").innerHTML = vitarae + "mcg";
    document.getElementById("vitare").innerHTML = vitare + "mcg";
    document.getElementById("retinol").innerHTML = retinol + "mcg";
    document.getElementById("bcarotene").innerHTML = bcarotene + "mcg";
    document.getElementById("thiamin").innerHTML = thiamin + "mg";
    document.getElementById("riboflavin").innerHTML = riboflavin + "mg";
    document.getElementById("niacin").innerHTML = niacin + "mg";
    document.getElementById("dietaryfolate").innerHTML = dietaryfolate + "mcg";
    document.getElementById("foodfolate").innerHTML = foodfolate + "mcg";
    document.getElementById("vitb12").innerHTML = vitb12 + "mcg";
    document.getElementById("vitc").innerHTML = vitc + "mg";
    document.getElementById("cholestrol").innerHTML = cholestrol + "mg";
    document.getElementById("oxalicacid").innerHTML = oxalicacid + "mg";
    document.getElementById("phytate").innerHTML = phytate + "mg";

    document.getElementById("eer").innerHTML = eer + "Kcals";



    document.getElementById("foodentryprompt").innerHTML = "The above values are very important in that they are crucial references that will be useful when comparing the foods you normally consume to determine the nature of nutritional decisions you need to make to achieve your target goal(s).";


};