//this is for the AboutUs Logout button
var abtUs = document.getElementById('logout1');

abtUs.addEventListener('click', function(){

    $('#modalAboutUsLogOut').modal('show');
    $('#cancelLogOutAbtUs').on("click", function (e) {
        $('#modalAboutUsLogOut').modal('hide');
    });


});

