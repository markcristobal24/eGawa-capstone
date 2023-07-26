    //USER RATING PAGE WHEN THE VIEW MORE BUTTON IS CLICKED (FREELANCE VIEW PROFILE)
    function modalFreelanceViewMore(){
        $('#modalViewMore1').modal('show');
        $('#cancelViewMore').on("click", function (e) {
            $('#modalViewMore1').modal('hide');
        });
    }