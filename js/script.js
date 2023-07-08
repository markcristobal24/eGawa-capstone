

//-----------Freelance Registration start-----------------------------------//


//-----------Registration Functions
//var button = document.getElementById("myButton");
var selectedChoice = "";

function sendData() {

    if (selectedChoice !== "") {
        var data = selectedChoice;
        var encodedData = encodeURIComponent(data);
        window.location.href = encodedData;
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
        selectedChoice = "userRegistration.php";
    } else if (choice === 'choice2') {
        choice2.classList.add('selected');
        choice1.classList.remove('selected');
        button.textContent = "Continue as Freelancer";
        selectedChoice = "freelanceRegis1.php";
    }
}


//-----------Freelancer type of work choice
//=========NOT IN USE=====================================//
// var freelanceChoice1 = "";
// function sendDataRegister() {

//     if (freelanceChoice1 !== "") {
//         var data2 = freelanceChoice1;
//         var encodedData2 = encodeURIComponent(data2);
//         window.location.href = encodedData2;
//     } else {
//         //alert("Please Select a choice first.");
//         // showWarningModal();
//         alert("please select");
//     }
// }

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

var viewmore = document.getElementById('viewmore');
viewmore.addEventListener('click', function () {
    $('#modalViewMore').modal('show');
    $('#cancelViewMore').on("click", function (e) {
        $('#modalViewMore').modal('hide');
    });
});















