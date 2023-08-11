class Account {

    /* ------------------- Freelancer Section */
    login() {
        let button_value = new Account().get_button_value("btnLogin");
        new Account().button_loading("btnLogin", "loading", "");

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
                        window.location.replace('pages/dashboard.php');
                        window.clearTimeout(tID);
                    }, 3000);
                }
                else if (response_data.success == "freelancer") {
                    if (response_data.status == "11") {
                        new Notification().create_notification(response_data.message, "success");
                        let tID = setTimeout(function () {
                            window.location.replace('freelance/freelanceHomePage.php');
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
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    logout() {
        let button_value = new Account().get_button_value("logoutBtn");
        new Account().button_loading("logoutBtn", "loading", "");

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
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    registerFreelance() {
        let button_value = new Account().get_button_value("btnFreelanceReg");
        new Account().button_loading("btnFreelanceReg", "loading", "");

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
                new Account().button_loading("btnFreelanceReg", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    forgot_password() {
        let button_value = new Account().get_button_value("forgot_password");
        new Account().button_loading("forgot_password", "loading", "");

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
                    window.location.replace('forgotPassword2.php');
                    window.clearTimeout(tID);
                }, 3000);
            }
            else if (response_data.error) {
                new Account().button_loading("forgot_password", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    new_password() {
        let button_value = new Account().get_button_value("btnNewPassword");
        new Account().button_loading("btnNewPassword", "loading", "");

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
                new Account().button_loading("btnNewPassword", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    create_fprofile() {
        let button_value = new Account().get_button_value("create_profile");
        new Account().button_loading("create_profile", "loading", "");

        var form_data = new FormData(document.getElementById('create_profile'));
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
                    window.location.replace('../freelance/freelanceHomePage.php');
                    window.clearTimeout(tID);
                }, 3000);
            }
            else if (response_data.error) {
                new Account().button_loading("create_profile", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    edit_fprofile() {
        let button_value = new Account().get_button_value("edit_fprofile");
        new Account().button_loading("edit_fprofile", "loading", "");

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
                new Account().button_loading("btnNewPassword", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    change_email() {
        let button_value = new Account().get_button_value("change_email");
        new Account().button_loading("change_email", "loading", "");

        var form_data = new FormData(document.getElementById('change_email_form'));
        form_data.append('change_email', 'change_email');
        fetch('../controller/c_Faccount.php', {
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
                    window.location.replace('../freelance/freelanceHomePage.php');
                    window.clearTimeout(tID);
                }, 3000);
            }
            else if (response_data.error) {
                new Account().button_loading("change_email", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    change_password() {
        let button_value = new Account().get_button_value("change_password");
        new Account().button_loading("change_password", "loading", "");

        var form_data = new FormData(document.getElementById('change_password_form'));
        form_data.append('change_password', 'change_password');
        fetch('../controller/c_Faccount.php', {
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
                    window.location.replace('../freelance/freelanceHomePage.php');
                    window.clearTimeout(tID);
                }, 3000);
            }
            else if (response_data.error) {
                new Account().button_loading("change_password", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    user_register() {
        let button_value = new Account().get_button_value("btnUserReg");
        new Account().button_loading("btnUserReg", "loading", "");

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
                new Account().button_loading("btnUserReg", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    button_loading(element, type, text) {
        if (type == "loading") {
            document.getElementById(element).innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            document.getElementById.disabled = true;
        } else {
            document.getElementById(element).innerHTML = text;
            document.getElementById(element).disabled = false;
        }
    }

    get_button_value(element) {
        return document.getElementById(element).innerHTML;
    }
}