$(document).ready(function () {
    //-----------Login Functions
    $('#loginform').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: './controller/c_login.php',
            data: $(this).serialize(),
            success: function (response) {
                var jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    location.href = 'pages/dashboard.php';
                } else {
                    //alert('Invalid Credentials');
                }
            }
        });
    });

});

//-----------Registration Functions
//var button = document.getElementById("myButton");
var selectedChoice = "";

function sendData() {
    if (selectedChoice !== "") {
        var data = selectedChoice;
        var encodedData = encodeURIComponent(data);
        window.location.href = encodedData;
    } else {
        //alert("Please Select a choice first.");
        showWarningModal();
    }
}

function selectChoice(choice) {
    var choice1 = document.getElementById('choice1');
    var choice2 = document.getElementById('choice2');
    var button = document.getElementById('myButton');

    if (choice === 'choice1') {
        choice1.classList.add('selected');
        choice2.classList.remove('selected');
        button.textContent = "Continue as User";
        selectedChoice = "userRegistration.php";
    } else if (choice === 'choice2') {
        choice2.classList.add('selected');
        choice1.classList.remove('selected');
        button.textContent = "Continue as Freelancer";
        selectedChoice = "freelanceRegistration.php";
    }
}




function validatePassword() {
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;

    const fname = document.getElementById('firstName').value;
    const sname = document.getElementById('middleName').value;
    const lname = document.getElementById('surName').value;
    const uname = document.getElementById('username').value;
    const eadd = document.getElementById('emailAddress').value;

    if (fname === "" || sname === "" || lname === "" || uname === "" || eadd === "" || pass1 === "" || pass2 === "") {
        showWarningModal();
    } else if (pass1 === pass2) {


        if (pass1.length < 8 || pass1.length > 12) {
            //=======bakit ayaw mag show nito??????????????????????????
            myModalPasswordChecker();
        }
        // Check for spaces
        else if (pass1.includes(" ")) {
            //=======bakit ayaw mag show nito??????????????????????????
            myModalPasswordChecker();
        }

        // Check for numeric characters
        else if (!/\d/.test(pass1)) {
            //=======bakit ayaw mag show nito??????????????????????????
            myModalPasswordChecker();
        }

        // Check for special characters
        else if (!/[!@#$%^&*]/.test(pass1)) {
            //=======bakit ayaw mag show nito??????????????????????????
            myModalPasswordChecker();
        }


    } else {
        showWarningPassModal();
    }

}









//===== modal for pasword checker
function myModalPasswordChecker() {
    $('#myModalPasswordChecker').modal('show');
    $('#yes3').on("click", function (e) {
        $('#myModalPasswordChecker').modal('hide');
    });
}





//===== modal for pasword did not match
function showWarningPassModal() {
    $('#myModalPassword').modal('show');
    $('#yes2').on("click", function (e) {
        $('#myModalPassword').modal('hide');
    });
}






//------Modal Function
function showWarningModal() {
    $('#myModal').modal('show');
    $('#yes').on("click", function (e) {
        $('#myModal').modal('hide');
    });
}

