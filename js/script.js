

//-----------Freelance Registration start-----------------------------------//


//-----------Registration Functions
//var button = document.getElementById("myButton");
var selectedChoice = "";

function sendData() {

    if (selectedChoice !== "") {
        var data = selectedChoice;
        var encodedData = encodeURIComponent(data);
        window.location.href = data;
    } else {
        alert("Please Select a choice first.");
        //showWarningModal();
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
        selectedChoice = "user/userRegistration.php";
    } else if (choice === 'choice2') {
        choice2.classList.add('selected');
        choice1.classList.remove('selected');
        button.textContent = "Continue as Freelancer";
        selectedChoice = "freelance/freelanceRegis1.php";
    }
}




function freelanceChoice(freelanceWorkChoice) {
    var workChoice1 = document.getElementById('freelanceBrowse');
    var workChoice2 = document.getElementById('freelancePackage');

    if (freelanceWorkChoice === 'freelanceBrowse') {
        workChoice1.classList.add('selected');
        workChoice2.classList.remove('selected');
        // button.textContent = "Continue as User";
        freelanceChoice1 = "freelanceRegisterInfo.php";
    } else if (freelanceWorkChoice === 'freelancePackage') {
        workChoice2.classList.add('selected');
        workChoice1.classList.remove('selected');
        // button.textContent = "Continue as Freelancer";
        freelanceChoice1 = "freelanceRegisterInfo.php";
    }

}

function clearFreelanceChoice() {
    var workChoice1Clear = document.getElementById('freelanceBrowse');
    var workChoice2Clear = document.getElementById('freelancePackage');

    workChoice1Clear.classList.remove('selected');
    workChoice2Clear.classList.remove('selected');
    freelanceChoice1 = "";

}
//-----------Freelance Registration end--------------------------------------------//


var logout = document.getElementById('logout1');
logout.addEventListener('click', function () {
    $('#modalLogOut').modal('show');
    $('#cancelLogOutBtn').on("click", function (e) {
        $('#modalLogOut').modal('hide');
    });
});



//dont move this to other JS file (it will generate bug)
//FOR FREELANCE PROFILE "VIEW MORE"
var viewmore = document.getElementById('viewmore');
viewmore.addEventListener('click', function () {
    $('#modalViewMore').modal('show');
    $('#cancelViewMore').on("click", function (e) {
        $('#modalViewMore').modal('hide');
    });
    $('#editFreelanceAcc').on("click", function (e) {
        $('#modalViewMore').modal('hide');
    });
});

function reloadWithModal() {
    localStorage.setItem('showModalFlag', 'true');

    location.reload();
}

function resendOtp(email) {
    var form_data = new FormData();
    form_data.append('email', email);
    form_data.append('resendOtp', 'resendOtp');
    fetch('../controller/c_Faccount.php', {
        method: "POST",
        body: form_data
    }).then(function (response) {
        return response.json();
    }).then(function (response_data) {
        console.log(response_data);
        if (response_data.success) {
            alert('OTP resend to ' + email);
            window.location.replace('verifyAccount.php');
        }
    });
}



















