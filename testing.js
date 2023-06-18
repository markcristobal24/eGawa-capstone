
function validatePassword() {
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;

    if (pass1 === pass2) {
        alert("Passwords match!");
    } else {
        alert("Passwords do not match!");
    }
}


$('#btnVerify').on("click", function (e) {
    const code = document.getElementById('verificationCode').value;

    if (code === "") {
        // alert("testing")
        modalBody.innerHTML = "Please enter your verification code!";
        $('#verifyModal').modal('show');
        $('#verifyConfirm').on("click", function (e) {
            $('#verifyModal').modal('hide');
        });
    }
});