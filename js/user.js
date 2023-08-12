var userVerifyBtn = document.getElementById('verifyUserAcc');
userVerifyBtn.addEventListener('click', function () {
    $('#modaluserIdVerification').modal('show');

});

//for id1 verification of user
function loadImageUser(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var uploadedImage = document.getElementById('uploadedImageUser');
        uploadedImage.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

//for clear button 
function clearUserID() {
    var imageInput = document.getElementById('uploadedImageUser1');
    var imageCleared = document.getElementById('uploadedImageUser');
    imageInput.value = null;
    imageCleared.src = '../img/upload.png';
}




//for edit profile picture of user
function editUserImg(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var uploadedEditImg = document.getElementById('uploadedEditProfileIMG');
        uploadedEditImg.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

//for clear button in the edit user modal
function clearUserEdit() {
    var imageInputEdit = document.getElementById('uploadedImageUserEdit');
    var imageClearedEdit = document.getElementById('uploadedEditProfileIMG');

    var clearUserAddress = document.getElementById('editUserAddress');
    var clearUserEmailAddress = document.getElementById('editUserEmailAddress');

    imageInputEdit.value = null;
    imageClearedEdit.src = '../img/upload.png';
    clearUserAddress.value = '';
    clearUserEmailAddress.value = '';
}


function termsNCond(){
    document.getElementById("overlay").style.display = "block";
    document.getElementById("fName").style.display = "none";
    document.getElementById("mName").style.display = "none";
    document.getElementById("sName").style.display = "none";
    document.getElementById("addr").style.display = "none";
    document.getElementById("uName").style.display = "none";
    document.getElementById("eAdd").style.display = "none";
    document.getElementById("pass1Label").style.display = "none";
    document.getElementById("pass2Label").style.display = "none";
}

function closeTerms(){
    document.getElementById("overlay").style.display = "none";
    document.getElementById("fName").style.display = "block";
    document.getElementById("mName").style.display = "block";
    document.getElementById("sName").style.display = "block";
    document.getElementById("addr").style.display = "block";
    document.getElementById("uName").style.display = "block";
    document.getElementById("eAdd").style.display = "block";
    document.getElementById("pass1Label").style.display = "block";
    document.getElementById("pass2Label").style.display = "block";
}

function clearFields(){
    document.getElementById("firstName").value = null;
    document.getElementById("middleName").value = null;
    document.getElementById("surName").value = null;
    document.getElementById("address").value = null;
    document.getElementById("username").value = null;
    document.getElementById("emailAddress").value = null;
    document.getElementById("pass1").value = null;
    document.getElementById("pass2").value = null;
}

//for clear button on change email page
function resetInputEmail(){

    var currEmail = document.getElementById('currentEmail');
    var newEmail = document.getElementById('newEmail');

    currEmail.value ='';
    newEmail.value ='';

}

function editUserIMG(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var uploadedEditImg = document.getElementById('imgUpload');
        uploadedEditImg.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}