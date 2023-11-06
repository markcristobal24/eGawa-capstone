class Admin {
    accept_idverify(id) {
        let button_value = new Account().get_button_value("btn_acceptverify");
        new Account().button_loading("btn_acceptverify", "loading", "");
        let form_data = new FormData();
        form_data.append('accept_id', 'accept_id');
        form_data.append('id', id);
        fetch('../controller/c_admin.php', {
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
                    window.location.reload();
                    window.clearTimeout(tID);
                }, 1000);
            }
            else if (response_data.error) {
                new Account().button_loading("btn_acceptverify", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    deny_idverify(id) {
        let button_value = new Account().get_button_value("btn_denyverify");
        new Account().button_loading("btn_denyverify", "loading", "");
        let form_data = new FormData();
        form_data.append('deny_id', 'deny_id');
        form_data.append('id', id);
        fetch('../controller/c_admin.php', {
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
                    window.location.reload();
                    window.clearTimeout(tID);
                }, 1000);
            }
            else if (response_data.error) {
                new Account().button_loading("btn_denyverify", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }
}