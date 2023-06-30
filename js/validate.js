$(document).ready(function () {
    $('#btnLogin').on("click", function (e) {
        const email = document.getElementById('email').value;
        const password = document.getElementById('pass').value;
        const modalBody = document.getElementById('modal-body');

        if (email === "" && password === "") {
            modalBody.innerHTML = "Please enter your email and password!";
            $('#loginModal').modal('show');
            $('#confirm').on("click", function (e) {
                $('#loginModal').modal('hide');
            });
        }
        else if (email === "") {
            modalBody.innerHTML = "Please enter your email!";
            $('#loginModal').modal('show');
            $('#confirm').on("click", function (e) {
                $('#loginModal').modal('hide');
            });
        }
        else if (password === "") {
            modalBody.innerHTML = "Please enter your password!";
            $('#loginModal').modal('show');
            $('#confirm').on("click", function (e) {
                $('#loginModal').modal('hide');
            });
        }
    });


    //=====================================modal for verification page============================================
    $('#btnVerify').on("click", function (e) {
        const code = document.getElementById('verificationCode').value;
        const modalBody2 = document.getElementById('modalbody2');

        if (code === "") {
            modalBody2.innerHTML = "Please enter your verification code!";
            $('#verifyModal').modal('show');
            $('#verifyConfirm').on("click", function (e) {
                $('#verifyModal').modal('hide');
            });
        }
    });
});

function invalidOtp() {
    const modalBody2 = document.getElementById('modalbody2');
    modalBody2.innerHTML = "Invalid OTP Code!";
    $('#verifyModal').modal('show');
    $('#verifyConfirm').on("click", function (e) {
        $('#verifyModal').modal('hide');
    });
}

function verifySuccess() {
    const modalTitle = document.getElementById('modalTitle');
    const modalBody2 = document.getElementById('modalbody2');
    modalTitle.innerHTML = "Success!";
    modalBody2.innerHTML = "Account Verified! You may sign in now.";
    $('#verifyModal').modal('show');
    $('#verifyConfirm').on("click", function (e) {
        $('#verifyModal').modal('hide');
    });
}

function validateRegForm() {
    const pass = document.getElementById('pass1').value;
    const rpass = document.getElementById('pass2').value;
    const fName = document.getElementById('firstName').value;
    const mName = document.getElementById('middleName').value;
    const lName = document.getElementById('surName').value;
    const username = document.getElementById('username').value;
    const email = document.getElementById('emailAddress').value;
    const address = document.getElementById('address').value;
    const modalBody = document.getElementById('modalUser');

    if (fName === "" || mName === "" || lName === "" || address === "" || username === "" || email === "" || pass === "" || rpass === "") {
        modalBody.innerHTML = "Incomplete Details!";
        $('#modalUserReg').modal('show');
        $('#yesReg').on("click", function (e) {
            $('#modalUserReg').modal('hide');
        });
        return false;
    } else if (pass !== rpass) {
        modalBody.innerHTML = "Your password is not matched!";
        $('#modalUserReg').modal('show');
        $('#yesReg').on("click", function (e) {
            $('#modalUserReg').modal('hide');
        });
        return false;
    }
    return true;
}

function validateForgotPass() {
    const email = document.getElementById('sendEmail').value;
    const modalBody = document.getElementById('modalForgot');
    if (email === "") {
        modalBody.innerHTML = "Please provide an email address!";
        $('#forgotModal').modal('show');
        $('#forgotConfirm').on("click", function (e) {
            $('#forgotModal').modal('hide');
        });
        return false;
    }
    return true;
}

function validateFreelanceForm() {
    const fName = document.getElementById('firstName').value;
    const mName = document.getElementById('middleName').value;
    const lName = document.getElementById('surName').value;
    const username = document.getElementById('username').value;
    const email = document.getElementById('emailAddress').value;
    const pass1 = document.getElementById('pass1').value;
    const pass2 = document.getElementById('pass2').value;
    const modalBody = document.getElementById('modalFreelance');

    if (fName === "" || mName == "" || lName === "" || username === "" || email === "" || pass1 === "" || pass2 === "") {
        modalBody.innerHTML = "Incomplete Details!";
        $('#modalFreelanceReg').modal('show');
        $('#yesFReg').on("click", function (e) {
            $('#modalFreelanceReg').modal('hide');
        });
        return false;
    }
    else if (pass1 !== pass2) {
        modalBody.innerHTML = "Your password is not matched!";
        $('#modalFreelanceReg').modal('show');
        $('#yesFReg').on("click", function (e) {
            $('#modalFreelanceReg').modal('hide');
        });
        return false;
    }
    return true;
}

function validateProfileForm() {
    const webDesign = document.getElementById('webDesign');
    const webDev = document.getElementById('webDev');
    const mobAppDev = document.getElementById('mobAppDev');
    const brandDesign = document.getElementById('brandDesign');
    const hostingMaintenance = document.getElementById('hostingMaintenance');

    const address = document.getElementById('address').value;
    const companyName = document.getElementById('companyName').value;
    const workTitle = document.getElementById('workTitle').value;
    const dateStarted = document.getElementById('dateStarted').value;
    const dateEnded = document.getElementById('dateEnded').value;
    const comment = document.getElementById('comment').value;
    const modalBody = document.getElementById('modalCreate');

    if (!webDesign.checked && !webDev.checked && !mobAppDev.checked && !brandDesign.checked && !hostingMaintenance.checked) {
        modalBody.innerHTML = "Please choose a job role!";
        $('#modalCreateProfile').modal('show');
        $('#confirmCreate').on("click", function (e) {
            $('#modalCreateProfile').modal('hide');
        });
        return false;
    }
    else if (address === "" || companyName === "" || workTitle === "" || dateStarted === "" || dateEnded === "" || comment === "") {
        modalBody.innerHTML = "Incomplete Details!";
        $('#modalCreateProfile').modal('show');
        $('#confirmCreate').on("click", function (e) {
            $('#modalCreateProfile').modal('hide');
        });
        return false;
    }
    return true;
}