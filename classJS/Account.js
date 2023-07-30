class Account {

    /* ------------------- Freelancer Section */
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