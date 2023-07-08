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

var logout = document.getElementById('logout1');
logout.addEventListener('click', function () {
    $('#modalLogOut').modal('show');
    $('#cancelLogOutBtn').on("click", function () {
        $('#modalLogOut').modal('hide');
    });
});