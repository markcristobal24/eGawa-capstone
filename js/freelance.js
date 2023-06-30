document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById("myModal");
    var closeButton = document.getElementsByClassName("close")[0];

    // Display the modal
    modal.style.display = "block";

    // Close the modal when the close button is clicked
    closeButton.addEventListener("click", function () {
        modal.style.display = "none";
    });



    //for log out
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





});






//for image upload
function loadImage(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var uploadedImage = document.getElementById('uploadedImage');
        uploadedImage.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
