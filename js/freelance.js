



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
