document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById("myModal");
    var closeButton = document.getElementsByClassName("close")[0];

    // Display the modal
    modal.style.display = "block";

    // Close the modal when the close button is clicked
    closeButton.addEventListener("click", function () {
        modal.style.display = "none";
    });
});

