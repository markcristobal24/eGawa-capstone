



//for image upload
function loadImage(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var uploadedImage = document.getElementById('uploadedImage');
        uploadedImage.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}


//for id1 verification of freelancer
function loadImage1(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var uploadedImage = document.getElementById('uploadedImage1');
        uploadedImage.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
//for id2 verification of freelancer
function loadImage2(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var uploadedImage = document.getElementById('uploadedImage2');
        uploadedImage.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}



//for date input on create profile
const dateStartedInput = document.getElementById('dateStarted');
const dateEndedInput = document.getElementById('dateEnded');

dateStartedInput.addEventListener('change', function () {
  dateEndedInput.min = this.value;
});

dateEndedInput.addEventListener('change', function () {
    dateStartedInput.max = this.value;
  });



//for clear button on change password page
const clearPass = document.getElementById('clearChangePass');
const currPassword = document.getElementById('currentPass');
const newPassword = document.getElementById('newPass');

clearPass.addEventListener('click', function () {
    currPassword = null;
    newPassword = null;
});

//for clear button on change email page
const clearEmail = document.getElementById('clearChangeEmail');
const currEmail = document.getElementById('currentEmail');
const newEmail = document.getElementById('newEmail');

clearEmail.addEventListener('click', function () {
    currEmail = null;
    newEmail = null;
});

