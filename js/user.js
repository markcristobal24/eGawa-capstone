
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


function clearFields() {
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
function resetInputEmail() {

    var currEmail = document.getElementById('currentEmail');
    var newEmail = document.getElementById('newEmail');

    currEmail.value = '';
    newEmail.value = '';

}

//FOR EDITING USER PROFILE (PICTURE)
function editUserIMG(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var uploadedEditImg = document.getElementById('imgUpload');
        uploadedEditImg.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}