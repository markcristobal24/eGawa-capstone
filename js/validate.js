$(document).ready(function () {
    $('#btnLogin').on("click", function (e) {
        const email = document.getElementById('email').value;
        const password = document.getElementById('pass').value;

        if (email === "" && password === "") {
            ////insert modal here
            alert("Please input your email and password!");
        }
        else if (email === "") {
            alert("Please input your email!");
        }
        else if (password === "") {
            alert("Please input your password!");
        }
    });
});