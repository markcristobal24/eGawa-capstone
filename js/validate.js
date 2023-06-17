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
            })
        }
        else if (email === "") {
            modalBody.innerHTML = "Please enter your email!";
            $('#loginModal').modal('show');
            $('#confirm').on("click", function (e) {
                $('#loginModal').modal('hide');
            })
        }
        else if (password === "") {
            modalBody.innerHTML = "Please enter your password!";
            $('#loginModal').modal('show');
            $('#confirm').on("click", function (e) {
                $('#loginModal').modal('hide');
            })
        }
    });
});