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
}