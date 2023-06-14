$(document).ready(function () {
    $('#loginform').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'c_login.php',
            data: $(this).serialize(),
            success: function (response) {
                var jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    location.href = 'pages/dashboard.php';
                } else {
                    alert('Invalid Credentials');
                }
            }
        });
    });
});