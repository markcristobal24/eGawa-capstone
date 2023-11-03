

$(document).ready(function () {
    var rating_data = 0;

    $('#add_review').click(function () {

        $('#review_modal').modal('show');

    });

    $('#close_review').click(function () {

        $('#review_modal').modal('hide');

    });


    $(document).on('mouseenter', '.submit_star', function () {

        var rating = $(this).data('rating');

        reset_background();

        for (var count = 1; count <= rating; count++) {

            $('#submit_star_' + count).addClass('text-warning');

        }

    });

    function reset_background() {
        for (var count = 1; count <= 5; count++) {

            $('#submit_star_' + count).addClass('star-light');

            $('#submit_star_' + count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function () {

        reset_background();

        for (var count = 1; count <= rating_data; count++) {

            $('#submit_star_' + count).removeClass('star-light');

            $('#submit_star_' + count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function () {

        rating_data = $(this).data('rating');

    });

    $('#save_review').click(function () {

        // var user_name = $('#user_name').val();

        // var user_review = $('#user_review').val();

        // var review_ss = $('#review_ss').val();

        // if (user_name == '' || user_review == '') {
        //     alert("Please Fill Both Field");
        //     return false;
        // }
        // else {
        //     $.ajax({
        //         url: "../controller/c_ratings.php",
        //         method: "POST",
        //         data: { rating_data: rating_data, user_name: user_name, user_review: user_review, review_ss: review_ss },
        //         success: function (data) {
        //             $('#review_modal').modal('hide');

        //             load_rating_data();

        //             alert(data);
        //         }
        //     })
        // }

        let form_data = new FormData(document.getElementById('rating_form'));
        form_data.append('rating_data', rating_data);
        fetch('../controller/c_ratings.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);

            if (response_data.success) {
                $('#review_modal').modal('hide');

                load_rating_data();
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    window.location.reload();
                    window.clearTimeout(tID);
                }, 1500);
            }
        });
    });



    // function submit_review() {
    //     let form_data = new FormData(document.getElementById('rating_form'));
    //     form_data.append('rating_data', rating_data);
    //     fetch('../controler/c_ratings.php', {
    //         method: "POST",
    //         body: form_data
    //     }).then((response) => {
    //         return response.json();
    //     }).then((response_data) => {
    //         console.log(response_data);

    //         if (response_data.success) {
    //             $('#review_modal').modal('hide');
    //             load_rating_data();
    //             new Notification().create_notification(response_data.success, "success");
    //         }
    //     });
    // }

    load_rating_data();

    function load_rating_data() {
        let form_data = new FormData();
        form_data.append('action', 'action');
        fetch('../controller/c_ratings.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);

            let data = response_data;
            $('#average_rating').text(data.average_rating);
            $('#total_review').text(data.total_review);

            var count_star = 0;

            $('.main_star').each(function () {
                count_star++;
                if (Math.ceil(data.average_rating) >= count_star) {
                    $(this).addClass('text-warning');
                    $(this).addClass('star-light');
                }
            });

            $('#total_five_star_review').text(data.five_star_review);

            $('#total_four_star_review').text(data.four_star_review);

            $('#total_three_star_review').text(data.three_star_review);

            $('#total_two_star_review').text(data.two_star_review);

            $('#total_one_star_review').text(data.one_star_review);

            $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 + '%');

            $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 + '%');

            $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 + '%');

            $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 + '%');

            $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 + '%');

            if (data.review_data.length > 0) {
                var html = '';

                for (var count = 0; count < data.review_data.length; count++) {
                    html += '<div class="row mb-3">';

                    // html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">' + data.review_data[count].user_name.charAt(0) + '</h3></div></div>';
                    if (data.review_data[count].user_image != "") {
                        html += '<div class="col-sm-1"><img src="../img/uploads/company/' + data.review_data[count].user_image + '" alt="" style="width: 55px; height: 55px; border-radius: 50%;"></div>';
                    } else {
                        html += '<div class="col-sm-1"><img src="../img/profile.png" alt="" style="width: 55px; height: 55px; border-radius: 50%;"></div>';
                    }

                    html += '<div class="col-sm-11">';

                    html += '<div class="card">';

                    html += '<div class="card-header"><b>' + data.review_data[count].user_name + '</b></div>';

                    html += '<div class="card-body">';

                    for (var star = 1; star <= 5; star++) {
                        var class_name = '';

                        if (data.review_data[count].rating >= star) {
                            class_name = 'text-warning';
                        }
                        else {
                            class_name = 'star-light';
                        }

                        html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
                    }

                    html += '<br />';

                    html += data.review_data[count].user_review;

                    html += '<img src = "../img/uploads/company/reviews/' + data.review_data[count].screenshot + '" style="height: 150px; width: 150px; display: block;">'

                    html += '</div>';

                    html += '<div class="card-footer text-right">On ' + data.review_data[count].datetime + '</div>';

                    html += '</div>';

                    html += '</div>';

                    html += '</div>';
                }

                $('#review_content').html(html);
            }
        });
    }

    // function load_rating_data() {
    //     $.ajax({
    //         url: "../controller/c_ratings.php",
    //         method: "POST",
    //         data: { action: 'load_data' },
    //         dataType: "JSON",
    //         success: function (data) {
    //             $('#average_rating').text(data.average_rating);
    //             $('#total_review').text(data.total_review);

    //             var count_star = 0;

    //             $('.main_star').each(function () {
    //                 count_star++;
    //                 if (Math.ceil(data.average_rating) >= count_star) {
    //                     $(this).addClass('text-warning');
    //                     $(this).addClass('star-light');
    //                 }
    //             });

    //             $('#total_five_star_review').text(data.five_star_review);

    //             $('#total_four_star_review').text(data.four_star_review);

    //             $('#total_three_star_review').text(data.three_star_review);

    //             $('#total_two_star_review').text(data.two_star_review);

    //             $('#total_one_star_review').text(data.one_star_review);

    //             $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 + '%');

    //             $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 + '%');

    //             $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 + '%');

    //             $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 + '%');

    //             $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 + '%');

    //             if (data.review_data.length > 0) {
    //                 var html = '';

    //                 for (var count = 0; count < data.review_data.length; count++) {
    //                     html += '<div class="row mb-3">';

    //                     html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">' + data.review_data[count].user_name.charAt(0) + '</h3></div></div>';

    //                     html += '<div class="col-sm-11">';

    //                     html += '<div class="card">';

    //                     html += '<div class="card-header"><b>' + data.review_data[count].user_name + '</b></div>';

    //                     html += '<div class="card-body">';

    //                     for (var star = 1; star <= 5; star++) {
    //                         var class_name = '';

    //                         if (data.review_data[count].rating >= star) {
    //                             class_name = 'text-warning';
    //                         }
    //                         else {
    //                             class_name = 'star-light';
    //                         }

    //                         html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
    //                     }

    //                     html += '<br />';

    //                     html += data.review_data[count].user_review;

    //                     html += '</div>';

    //                     html += '<div class="card-footer text-right">On ' + data.review_data[count].datetime + '</div>';

    //                     html += '</div>';

    //                     html += '</div>';

    //                     html += '</div>';
    //                 }

    //                 $('#review_content').html(html);
    //             }
    //         }
    //     })
    // }

});

//for image upload
function loadImageReview(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var uploadedImage = document.getElementById('uploadedImageReview');
        uploadedImage.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

