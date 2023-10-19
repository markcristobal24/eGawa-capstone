



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
// Function to update the min attribute of Date Ended
function updateDateEndedMin() {
    const dateStartedInput = document.getElementById('dateStarted');
    const dateEndedInput = document.getElementById('dateEnded');
    
    dateEndedInput.min = dateStartedInput.value;
}
// Function to update the max attribute of Date Started
function updateDateStartedMax() {
    const dateStartedInput = document.getElementById('dateStarted');
    const dateEndedInput = document.getElementById('dateEnded');
    
    dateStartedInput.max = dateEndedInput.value;
}





//for clear button on change password page
function resetInputPass(){

    var currPassword = document.getElementById('currentPass');
    var newPassword = document.getElementById('newPass');
    var newPassword2 = document.getElementById('newPass2');

    currPassword.value ='';
    newPassword.value ='';
    newPassword2.value ='';
}

//for clear button on change email page
function resetInputEmail(){

    var currEmail = document.getElementById('currentEmail');
    var newEmail = document.getElementById('newEmail');

    currEmail.value ='';
    newEmail.value ='';

}

function clearInputs(){
    var img = document.getElementById('uploadedEditImage');
    var setImg = '../img/upload.png';
    var imgFile = document.getElementById('uploadInputEdit');
    var addr = document.getElementById('editAddress');
    var webDesignCB = document.getElementById('webDesign');
    var webDevCB = document.getElementById('webDev');
    var mobAppDevCB = document.getElementById('mobAppDev');
    var brandDesignCB = document.getElementById('brandDesign');
    var hostingMaintenanceCB = document.getElementById('hostingMaintenance');
    

    img.src = setImg;
    imgFile.value = '';
    addr.value = '';
    webDesignCB.checked = false;
    webDevCB.checked = false;
    mobAppDevCB.checked = false;
    brandDesignCB.checked = false;
    hostingMaintenanceCB.checked = false;

}

function cancelAddCatalog(){
    var img = document.getElementById('uploadedImageCatalog');
    var setImg = '../img/upload.png';
    var imgFile = document.getElementById('uploadInput');
    var catalogTitle = document.getElementById('catalogTitle');
    var catalogDesc = document.getElementById('catalogDescription');

    img.src = setImg;
    imgFile.value = '';
    catalogTitle.value = '';
    catalogDesc.value = '';
}

function clearUploadedID(){
    var img1 = document.getElementById('uploadedImage1');
    var img2 = document.getElementById('uploadedImage2');
    var setImg = '../img/upload.png';
    var imgFile1 = document.getElementById('uploadInput1');
    var imgFile2 = document.getElementById('uploadInput2');

    img1.src = setImg;
    img2.src = setImg;

    imgFile1.value = '';
    imgFile2.value = '';
    
}

function clearInputsProfile(){
    var img = document.getElementById('uploadedImage');
    var setImg = '../../img/uploadIMG.png';
    var imgFile = document.getElementById('uploadInput');
    var addr = document.getElementById('address');
    var webDesignCB = document.getElementById('webDesign');
    var webDevCB = document.getElementById('webDev');
    var mobAppDevCB = document.getElementById('mobAppDev');
    var brandDesignCB = document.getElementById('brandDesign');
    var hostingMaintenanceCB = document.getElementById('hostingMaintenance');
    var compName = document.getElementById('companyName');
    var workTitle = document.getElementById('workTitle');
    var started = document.getElementById('dateStarted');
    var ended = document.getElementById('dateEnded');
    var desc = document.getElementById('comment');
    

    img.src = setImg;
    imgFile.value = '';
    addr.value = '';
    webDesignCB.checked = false;
    webDevCB.checked = false;
    mobAppDevCB.checked = false;
    brandDesignCB.checked = false;
    hostingMaintenanceCB.checked = false;
    compName.value = '';
    workTitle.value = '';
    started.value = '';
    ended.value = '';
    desc.value = '';

}