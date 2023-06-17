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

    $('#btnUserReg').on("click", function (e) {
        e.preventDefault();
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
            $('#yes').on("click", function (e) {
                $('#modalUserReg').modal('hide');
            });
        }
        else if (pass !== rpass) {
            modalBody.innerHTML = "Your password is not matched!";
            $('#modalUserReg').modal('show');
            $('#yes').on("click", function (e) {
                $('#modalUserReg').modal('hide');
            });
        }

    });
});