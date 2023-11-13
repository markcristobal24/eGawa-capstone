class Admin {
    accept_idverify(id) {
        let button_value = new Account().get_button_value("btn_acceptverify");
        new Account().button_loading("btn_acceptverify", "loading", "");
        document.getElementById('btn_acceptverify').disabled = true;
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
                document.getElementById('btn_acceptverify').disabled = false;
                new Account().button_loading("btn_acceptverify", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    deny_idverify(id) {
        let button_value = new Account().get_button_value("btn_denyverify");
        new Account().button_loading("btn_denyverify", "loading", "");
        document.getElementById('btn_denyverify').disabled = true;
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
                document.getElementById('btn_denyverify').disabled = false;
                new Account().button_loading("btn_denyverify", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    fetch_report(report_id, reporter) {
        let form_data = new FormData();
        form_data.append('fetch_report', 'fetch_report');
        form_data.append('report_id', report_id);
        form_data.append('reporter', reporter);
        fetch('../controller/c_admin.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);
            let report = response_data;

            document.getElementById('reporter').innerHTML = report.reporter;
            if (report.report_status == 'DONE') {
                document.getElementById('btn_done').style.display = 'none';
            } else {
                document.getElementById('btn_done').style.display = 'block';
                document.getElementById('btn_done').value = report.report_id;
            }

            document.getElementById('reported_account').innerHTML = `[${report.account_id}] ${report.reported_account}`;
            document.getElementById('reason').innerHTML = report.reason;
            document.getElementById('screenshot').src = `../img/uploads/reports/${report.screenshot}`;
        });
    }

    search_filter(filter_value, type) {
        let form_data = new FormData();
        form_data.append('search_logs', 'search_logs');
        form_data.append('filter_value', filter_value);
        form_data.append('type', type);
        fetch('../controller/c_admin.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);

            if (type == 'freelancer') {
                if (response_data.result) {
                    document.getElementById('freelance_tbl').innerHTML = response_data.result;
                } else if (response_data.error) {
                    document.getElementById('freelance_tbl').innerHTML = response_data.error;
                }
            } else if (type == 'company') {
                if (response_data.result) {
                    document.getElementById('company_tbl').innerHTML = response_data.result;
                } else if (response_data.error) {
                    document.getElementById('company_tbl').innerHTML = response_data.error;
                }
            } else if (type == 'message') {
                if (response_data.result) {
                    document.getElementById('message_tbl').innerHTML = response_data.result;
                } else if (response_data.error) {
                    document.getElementById('message_tbl').innerHTML = response_data.error;
                }
            }
        });
    }

    dashboard() {
        let form_data = new FormData();
        form_data.append('dashboard', 'dashboard');
        fetch('../controller/c_admin.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);

            let data = response_data.data;

            if (response_data.error) {
                new Notification().create_notification(response_data.error, "error");
            } else {
                document.getElementById('total_registered').innerHTML = data[0].total_registered;
                document.getElementById('total_company').innerHTML = data[0].total_company;
                document.getElementById('total_company_banned').innerHTML = data[0].total_company_banned;
                document.getElementById('total_freelancers').innerHTML = data[0].total_freelancers;
                document.getElementById('total_freelancers_verified').innerHTML = data[0].total_freelancers_verified;
                document.getElementById('total_freelancers_banned').innerHTML = data[0].total_freelancers_banned;
            }
        });
    }

    fetch_freelancer(id) {
        let form_data = new FormData();
        form_data.append('fetch_freelancer', 'fetch_freelancer');
        form_data.append('id', id);
        fetch('../controller/c_admin.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);

            let data = response_data;

            if (response_data.error) {
                new Notification().create_notification(response_data.error, "error");
            } else {
                document.getElementById('btn_ban').value = data.account_id;
                document.getElementById('image_profile').src = `../img/uploads/freelancer/${data.imageProfile}`;
                document.getElementById('fullname').innerHTML = data.fullname;
                document.getElementById('tabname').innerHTML = data.fullname;
                document.getElementById('username').innerHTML = `@${data.username}`;
                document.getElementById('address').innerHTML = data.address;
                document.getElementById('email').innerHTML = data.email;
                document.getElementById('date_created').innerHTML = data.date_created;
                new Dashboard().get_information_freelancer_employerpov(id);
            }
        });
    }

    fetch_company(id) {
        let form_data = new FormData();
        form_data.append('fetch_company', 'fetch_company');
        form_data.append('id', id);
        fetch('../controller/c_admin.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);

            let data = response_data;

            if (response_data.error) {
                new Notification().create_notification(response_data.error, "error");
            } else {
                document.getElementById('btn_ban').value = data.account_id;
                document.getElementById('image_profile').src = `../img/uploads/company/${data.imageProfile}`;
                document.getElementById('fullname').innerHTML = data.fullname;
                document.getElementById('tabname').innerHTML = data.fullname;
                document.getElementById('username').innerHTML = `@${data.username}`;
                document.getElementById('address').innerHTML = data.address;
                document.getElementById('email').innerHTML = data.email;
                document.getElementById('date_created').innerHTML = data.date_created;
                new Dashboard().get_information_company_freelancerpov(id);
            }
        });
    }

    ban_account(id) {
        let button_value = new Account().get_button_value("btn_ban");
        new Account().button_loading("btn_ban", "loading", "");
        document.getElementById('btn_ban').disabled = true;
        let form_data = new FormData(document.getElementById('ban_form'));
        form_data.append('ban_account', 'ban_account');
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
            } else if (response_data.error) {
                document.getElementById('btn_ban').disabled = false;
                new Account().button_loading("btn_ban", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    fetch_all(id) {
        let form_data = new FormData();
        form_data.append('fetch_all', 'fetch_all');
        form_data.append('id', id);
        fetch('../controller/c_admin.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);
            let data = response_data;

            document.getElementById('reason').innerHTML = data.reason;
        });
    }

    report_done(id) {
        let button_value = new Account().get_button_value("btn_done");
        new Account().button_loading("btn_done", "loading", "");
        document.getElementById('btn_done').disabled = true;

        let form_data = new FormData();
        form_data.append('report_done', 'report_done');
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

            } else if (response_data.error) {
                document.getElementById('btn_done').disabled = false;
                new Account().button_loading("btn_done", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }
}