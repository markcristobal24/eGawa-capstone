
//for logout button
var logout = document.getElementById('logout1');
logout.addEventListener('click', function () {
    $('#modalLogOut').modal('show');
    $('#cancelLogOutBtn').on("click", function () {
        $('#modalLogOut').modal('hide');
    });
});

