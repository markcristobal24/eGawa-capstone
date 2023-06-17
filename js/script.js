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














