class Account {

    /* ------------------- Freelancer Section */
    login() {
        let button_value = new Account().get_button_value("btnLogin");
        new Account().button_loading("btnLogin", "loading", "");
        document.getElementById('btnLogin').disabled = true;
        var form_data = new FormData(document.getElementById('account_form'));
        form_data.append('login', 'login');
        fetch('controller/c_login.php', {
            method: "POST",
            body: form_data
        }).then(function (response) {
            return response.json();
        }).then(function (response_data) {
            console.log(response_data);
            if (response_data.success) {
                console.log(response_data.success);
                if (response_data.success == "super_admin") {
                    new Notification().create_notification(response_data.message, "success");
                    let tID = setTimeout(function () {
                        window.location.replace('admin/dashboard.php');
                        window.clearTimeout(tID);
                    }, 3000);
                }
                else if (response_data.success == "freelancer") {
                    if (response_data.status == "11") {
                        new Notification().create_notification(response_data.message, "success");
                        let tID = setTimeout(function () {
                            window.location.replace('freelance/freelanceHome.php');
                            window.clearTimeout(tID);
                        }, 3000);
                    }
                    else if (response_data.status == "10") {
                        new Notification().create_notification(response_data.message, "success");
                        let tID = setTimeout(function () {
                            window.location.replace('freelance/createProfile.php');
                            window.clearTimeout(tID);
                        }, 3000);
                    }
                    else if (response_data.status == "0") {
                        new Notification().create_notification(response_data.message, "success");
                        let tID = setTimeout(function () {
                            window.location.replace('freelance/verifyAccount.php');
                            window.clearTimeout(tID);
                        }, 3000);
                    }
                }
                else if (response_data.success == "user") {
                    if (response_data.status == "0") {
                        new Notification().create_notification(response_data.message, "success");
                        let tID = setTimeout(function () {
                            window.location.replace('freelance/verifyAccount.php');
                            window.clearTimeout(tID);
                        }, 3000);
                    }
                    else if (response_data.status == "1") {
                        new Notification().create_notification(response_data.message, "success");
                        let tID = setTimeout(function () {
                            window.location.replace('user/userHome.php');
                            window.clearTimeout(tID);
                        }, 3000);
                    }
                }
            } else if (response_data.error) {
                console.log(response_data.error);
                new Account().button_loading("btnLogin", "", button_value);
                document.getElementById('btnLogin').disabled = false;
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    logout() {
        let button_value = new Account().get_button_value("logoutBtn");
        new Account().button_loading("logoutBtn", "loading", "");
        document.getElementById('logoutBtn').disabled = true;
        var form_data = new FormData();
        form_data.append('logout', 'logout');
        fetch('../controller/c_logout.php', {
            method: "POST",
            body: form_data
        }).then(function (response) {
            return response.json();
        }).then(function (response_data) {
            console.log(response_data);
            if (response_data.success) {
                console.log(response_data.success);
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    window.location.replace('../login.php');
                    window.clearTimeout(tID);
                }, 2000);
            }
            else if (response_data.error) {
                console.log(response_data.error);
                new Account().button_loading("logoutBtn", "", button_value);
                document.getElementById('logoutBtn').disabled = false;
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    registerFreelance() {
        let button_value = new Account().get_button_value("btnFreelanceReg");
        new Account().button_loading("btnFreelanceReg", "loading", "");
        document.getElementById('btnFreelanceReg').disabled = true;
        var form_data = new FormData(document.getElementById('account_form'));
        form_data.append('registerFreelance', 'registerFreelance');
        fetch('../controller/c_fRegister.php', {
            method: "POST",
            body: form_data
        }).then(function (response) {
            return response.json();
        }).then(function (response_data) {
            console.log(response_data);
            if (response_data.success) {
                console.log(response_data.success);
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    window.location.replace('verifyAccount.php');
                    window.clearTimeout(tID);
                }, 3000);
            }
            else if (response_data.error) {
                console.log(response_data.error);
                document.getElementById('btnFreelanceReg').disabled = false;
                new Account().button_loading("btnFreelanceReg", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    forgot_password() {
        let button_value = new Account().get_button_value("forgot_password");
        new Account().button_loading("forgot_password", "loading", "");
        document.getElementById('forgot_password').disabled = true;
        var form_data = new FormData(document.getElementById('account_form'));
        form_data.append('forgot_password', 'forgot_password');
        fetch('controller/c_forgotPassword.php', {
            method: "POST",
            body: form_data
        }).then(function (response) {
            return response.json();
        }).then(function (response_data) {
            console.log(response_data);
            if (response_data.success) {
                console.log(response_data.success);
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    window.location.replace('forgot_password2.php');
                    window.clearTimeout(tID);
                }, 3000);
            }
            else if (response_data.error) {
                document.getElementById('forgot_password').disabled = false;
                new Account().button_loading("forgot_password", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    new_password() {
        let button_value = new Account().get_button_value("btnNewPassword");
        new Account().button_loading("btnNewPassword", "loading", "");
        document.getElementById('btnNewPassword').disabled = true;
        var form_data = new FormData(document.getElementById('account_form'))
        form_data.append('new_password', 'new_password');
        fetch('../controller/c_newPassword.php', {
            method: "POST",
            body: form_data
        }).then(function (response) {
            return response.json();
        }).then(function (response_data) {
            console.log(response_data);
            if (response_data.success) {
                console.log(response_data.success);
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    window.location.replace('../login.php');
                    window.clearTimeout(tID);
                }, 3000);
            } else if (response_data.error) {
                document.getElementById('btnNewPassword').disabled = false;
                new Account().button_loading("btnNewPassword", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    create_fprofile() {
        let button_value = new Account().get_button_value("create_profile");
        new Account().button_loading("create_profile", "loading", "");
        document.getElementById('create_profile').disabled = true;
        var form_data = new FormData(document.getElementById('create_profileForm'));
        form_data.append('create_fprofile', 'create_fprofile');
        fetch('../controller/c_createProfile.php', {
            method: "POST",
            body: form_data
        }).then(function (response) {
            return response.json();
        }).then(function (response_data) {
            console.log(response_data);
            if (response_data.success) {
                console.log(response_data.success);
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    window.location.replace('freelanceHomePage.php');
                    window.clearTimeout(tID);
                }, 3000);
            }
            else if (response_data.error) {
                document.getElementById('create_profile').disabled = false;
                new Account().button_loading("create_profile", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    verify_otp() {
        let button_value = new Account().get_button_value("btnVerify");
        new Account().button_loading("btnVerify", "loading", "");
        document.getElementById('btnVerify').disabled = true;
        var form_data = new FormData(document.getElementById('verify_form'));
        form_data.append('verify_otp', 'verify_otp');
        fetch('../controller/c_otp.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);
            if (response_data.success) {
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    window.location.replace('../login.php');
                    window.clearTimeout(tID);
                }, 1500);
            }
            else if (response_data.error) {
                document.getElementById('btnVerify').disabled = false;
                new Account().button_loading("btnVerify", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    edit_fprofile() {
        let button_value = new Account().get_button_value("edit_fprofile");
        new Account().button_loading("edit_fprofile", "loading", "");
        document.getElementById('edit_fprofile').disabled = true;
        var form_data = new FormData(document.getElementById('edit_profile'));
        form_data.append('edit_fprofile', 'edit_fprofile');
        fetch('../controller/c_createProfile.php', {
            method: "POST",
            body: form_data
        }).then(function (response) {
            return response.json();
        }).then(function (response_data) {
            console.log(response_data);
            if (response_data.success) {
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    window.location.reload();
                    window.clearTimeout(tID);
                }, 3000);
            }
            else if (response_data.error) {
                document.getElementById('edit_fprofile').disabled = false;
                new Account().button_loading("edit_fprofile", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    update_uProfile(type) {
        console.log('hi');

        if (type == "username") {
            new Account().button_loading("update_username", "loading", "");
            document.getElementById('update_username').disabled = true;
        } else {
            new Account().button_loading("update_profile", "loading", "");
            document.getElementById('update_profile').disabled = true;
        }

        let form_data = new FormData(document.getElementById('editProfile_form'));
        form_data.append('type', type);
        form_data.append('update_profile', 'update_profile');
        fetch('../controller/c_uAccount.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            if (type == "username") {
                new Account().button_loading("update_username", "", "Update");
                document.getElementById('update_username').disabled = false;

            } else {
                new Account().button_loading("update_profile", "", "Update");
                document.getElementById('update_profile').disabled = false;
            }

            console.log(response_data);

            if (response_data.success) {
                new Account().fetch_user();
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    window.location.reload();
                    window.clearTimeout(tID);
                }, 2000);
            }
            else if (response_data.error) {
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    change_email() {
        let button_value = new Account().get_button_value("change_email");
        new Account().button_loading("change_email", "loading", "");
        document.getElementById('change_email').disabled = true;
        var form_data = new FormData(document.getElementById('account_form'));
        form_data.append('change_email', 'change_email');
        fetch('controller/c_Faccount.php', {
            method: "POST",
            body: form_data
        }).then(function (response) {
            return response.json();
        }).then(function (response_data) {
            console.log(response_data);
            if (response_data.success) {
                console.log(response_data.success);
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    if (response_data.type == 'freelancer') {
                        window.location.replace('freelance/freelanceHomePage.php');
                    } else {
                        window.location.replace('user/userHomePage.php');
                    }
                    window.clearTimeout(tID);
                }, 3000);
            }
            else if (response_data.error) {
                new Account().button_loading("change_email", "", button_value);
                document.getElementById('change_email').disabled = false;
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    change_password() {
        let button_value = new Account().get_button_value("change_password");
        new Account().button_loading("change_password", "loading", "");
        document.getElementById('change_password').disabled = true;
        var form_data = new FormData(document.getElementById('account_form'));
        form_data.append('change_password', 'change_password');
        fetch('controller/c_Faccount.php', {
            method: "POST",
            body: form_data
        }).then(function (response) {
            return response.json();
        }).then(function (response_data) {
            console.log(response_data);
            if (response_data.success) {
                console.log(response_data.success);
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    if (response_data.type == 'freelancer') {
                        window.location.replace('freelance/freelanceHomePage.php');
                    } else {
                        window.location.replace('user/userHomePage.php');
                    }
                    window.clearTimeout(tID);
                }, 3000);
            }
            else if (response_data.error) {
                document.getElementById('change_password').disabled = false;
                new Account().button_loading("change_password", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    user_register() {
        let button_value = new Account().get_button_value("btnUserReg");
        new Account().button_loading("btnUserReg", "loading", "");
        document.getElementById('btnUserReg').disabled = true;
        var form_data = new FormData(document.getElementById('account_form'));
        form_data.append('user_register', 'user_register');
        fetch('../controller/c_uRegister.php', {
            method: "POST",
            body: form_data
        }).then(function (response) {
            return response.json();
        }).then(function (response_data) {
            console.log(response_data);
            if (response_data.success) {
                console.log(response_data.success);
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    window.location.replace('../freelance/verifyAccount.php');
                    window.clearTimeout(tID);
                }, 3000);
            }
            else if (response_data.error) {
                console.log(response_data.error);
                document.getElementById('btnUserReg').disabled = false;
                new Account().button_loading("btnUserReg", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    user_changeEmail() {
        let button_value = new Account().get_button_value("user_changeEmail");
        new Account().button_loading("user_changeEmail", "loading", "");

        let form_data = new FormData(document.getElementById('account_form'));
        form_data.append('change_email', 'change_email');
        fetch('../controller/c_uAccount.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);
            if (response_data.success) {
                console.log(response_data.success);
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    window.location.replace('../user/userHome.php');
                    window.clearTimeout(tID);
                }, 3000);
            }
            else if (response_data.error) {
                new Account().button_loading("user_changeEmail", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    user_changePass() {
        let button_value = new Account().get_button_value("user_changePass");
        new Account().button_loading("user_changePass", "loading", "");


        let form_data = new FormData(document.getElementById('account_form'));
        form_data.append('change_pass', 'change_pass');
        fetch('../controller/c_uAccount.php', {
            method: "POST",
            body: form_data
        }).then(function (response) {
            return response.json();
        }).then(function (response_data) {
            console.log(response_data);
            if (response_data.success) {
                console.log(response_data.success);
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    window.location.replace('../user/userHome.php');
                    window.clearTimeout(tID);
                }, 3000);
            }
            else if (response_data.error) {
                new Account().button_loading("user_changePass", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });

    }

    fetch_user() {
        console.log('function call');
        let form_data = new FormData();
        form_data.append('fetch_user', 'fetch_user');
        return fetch('../controller/c_uAccount.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);
            let user = response_data;
            // document.getElementById('new_barangay').value = `${user.barangay}`;
            // document.getElementById('new_municipality').value = `${user.municipality}`;
            // document.getElementById('new_province').value = `${user.province}`;

            let province = document.getElementById('provinceDropdown');
            for (var i = 0; i < province.options.length; i++) {
                if (province.options[i].textContent === `${user.province}`) {
                    province.selectedIndex = i;
                    break;
                }
            }
            let municipality = document.getElementById('municipalityDropdown');
            for (var i = 0; i < municipality.options.length; i++) {
                if (municipality.options[i].textContent === `${user.municipality}`) {
                    municipality.selectedIndex = i;
                    break;
                }
            }
            let barangay = document.getElementById('barangayDropdown');
            for (var i = 0; i < barangay.options.length; i++) {
                if (barangay.options[i].textContent === `${user.barangay}`) {
                    barangay.selectedIndex = i;
                    break;
                }
            }
            document.getElementById('uname').value = `${user.username}`;

            if (user.user_image != "") {
                document.getElementById('imgUpload').src = `../img/uploads/company/${user.user_image}`;
            } else {
                document.getElementById('imgUpload').src = `../img/uploadIMG.png`;
            }
        });
    }

    button_loading(element, type, text) {
        if (type == "loading") {
            document.getElementById(element).innerHTML = '<i class="fas fa-spinner fa-spin px-4"></i>';
            document.getElementById.disabled = true;
        } else {
            document.getElementById(element).innerHTML = text;
            document.getElementById(element).disabled = false;
        }
    }

    get_button_value(element) {
        return document.getElementById(element).innerHTML;
    }

    verify_password(password, user_type) {
        // document.getElementById('password_error').style.display = "none";

        document.querySelector(".length").style.opacity = 1;
        document.querySelector(".case").style.opacity = 1;
        document.querySelector(".special").style.opacity = 1;
        document.querySelector(".number").style.opacity = 1;
        let case_requirements = /^(?=.*[a-z])(?=.*[A-Z])/;
        let special_requirements = /(?=.*[@#$%^&,*.])/;
        let number_requirements = /(?=.*\d)/;

        if (password.length >= 8 && password.length <= 16) {
            document.getElementById("length").innerHTML = "&#x2714";
            document.getElementById("length_con").style.color = "green";
        } else {
            document.getElementById("length").innerHTML = "&#x2716";
            document.getElementById("length_con").style.color = "red";
        }

        if (password.match(case_requirements)) {
            document.getElementById("case").innerHTML = "&#x2714";
            document.getElementById("case_con").style.color = "green";
        } else {
            document.getElementById("case").innerHTML = "&#x2716";
            document.getElementById("case_con").style.color = "red";
        }

        if (password.match(special_requirements)) {
            document.getElementById("special").innerHTML = "&#x2714";
            document.getElementById("special_con").style.color = "green";
        } else {
            document.getElementById("special").innerHTML = "&#x2716";
            document.getElementById("special_con").style.color = "red";
        }

        if (password.match(number_requirements)) {
            document.getElementById("number").innerHTML = "&#x2714";
            document.getElementById("number_con").style.color = "green";
        } else {
            document.getElementById("number").innerHTML = "&#x2716";
            document.getElementById("number_con").style.color = "red";
        }

        if ((password.length >= 8 && password.length <= 16) && password.match(case_requirements) && password.match(special_requirements) && password.match(number_requirements)) {
            document.querySelector(".password_requirements").classList.remove("password_requirement_active");
            if (user_type == 'company') {
                document.getElementById('btnUserReg').disabled = false;
            } else {
                document.getElementById('btnFreelanceReg').disabled = false;
            }
        } else {
            document.querySelector(".password_requirements").classList.add("password_requirement_active");
            if (user_type == 'company') {
                document.getElementById('btnUserReg').disabled = true;
            } else {
                document.getElementById('btnFreelanceReg').disabled = true;
            }
        }
    }

    id_verify() {
        let button_value = new Account().get_button_value("btn_verifyID");
        new Account().button_loading("btn_verifyID", "loading", "");
        document.getElementById('btn_verifyID').disabled = true;
        let form_data = new FormData(document.getElementById('idverify_form'));
        form_data.append('id_verification', 'id_verification');
        fetch('controller/c_Faccount.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);

            if (response_data.success) {

                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    window.location.replace('freelance/freelanceHomePage.php');
                    window.clearTimeout(tID);
                }, 2000);
            }
            else if (response_data.error) {
                document.getElementById('btn_verifyID').disabled = false;
                new Account().button_loading("btn_verifyID", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    fetch_ratings_freelancer(freelance_id) {
        let form_data = new FormData();
        form_data.append('fetch_ratings_freelancerpov', 'fetch_ratings_freelancerpov');
        form_data.append('freelance_id', freelance_id);
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

                    html += '<img src = "../img/uploads/company/reviews/' + data.review_data[count].screenshot + '" style="height: 150px; display: block;">'

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
}