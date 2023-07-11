var userVerifyBtn = document.getElementById('verifyUserAcc');

userVerifyBtn.addEventListener('click', function(){
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
function clearUserID(){
    var imageInput = document.getElementById('uploadedImageUser1');
    var imageCleared = document.getElementById('uploadedImageUser');
    imageInput.value = null;
    imageCleared.src = 'img/upload.png';
}

//for logout button
var logout = document.getElementById('logout1');
logout.addEventListener('click', function () {
    $('#modalLogOut').modal('show');
    $('#cancelLogOutBtn').on("click", function () {
        $('#modalLogOut').modal('hide');
    });
});


//for edit profile of user
var userEdit = document.getElementById('editUserAcc');
userEdit.addEventListener('click', function () {
    $('#modaluserEditProfile').modal('show');
    $('#cancelLogOutBtn').on("click", function () {
        $('#modaluserEditProfile').modal('hide');
    });
});

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
function clearUserEdit(){
    var imageInputEdit = document.getElementById('uploadedImageUserEdit');
    var imageClearedEdit = document.getElementById('uploadedEditProfileIMG');

    var clearUserAddress = document.getElementById('editUserAddress');
    var clearUserEmailAddress = document.getElementById('editUserEmailAddress');

    imageInputEdit.value = null;
    imageClearedEdit.src = 'img/upload.png';
    clearUserAddress.value = '';
    clearUserEmailAddress.value = '';
}