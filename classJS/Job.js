class Job {
    view_job(jobId) {
        let form_data = new FormData();
        console.log(jobId);
        form_data.append('jobId', jobId);
        form_data.append('view_job', 'view_job');
        fetch('../controller/c_jobapplication.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);
            let job = response_data;
            document.getElementById('btn_declineJob').value = `${job.application_id}`;
            document.getElementById('btn_acceptJob').value = `${job.application_id}`;


            document.getElementById('post_title').innerHTML = `${job.post_title}`.toUpperCase();
            document.getElementById('from').innerHTML = `${job.from_name}`;
            document.getElementById('jobstatus').innerHTML = `${job.jobstatus}`;
            document.getElementById('from_message').innerHTML = `${job.message}`;
        });
    }

    decline_job(jobId) {
        let button_value = new Account().get_button_value("btn_declineJob");
        new Account().button_loading("btn_declineJob", "loading", "");

        let form_data = new FormData();
        form_data.append('jobId', jobId);
        form_data.append('decline_job', 'decline_job');
        fetch('../controller/c_jobapplication.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);

            if (response_data.success) {
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    window.location.reload();
                    window.clearTimeout(tID);
                }, 1500);
            }
            else if (response_data.error) {
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    accept_job(jobId) {
        new Account().button_loading("btn_acceptJob", "loading", "");

        let form_data = new FormData();
        form_data.append('jobId', jobId);
        form_data.append('accept_job', 'accept_job');
        fetch('../controller/c_jobapplication.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);
            if (response_data.success) {
                console.log(response_data.user_id);
                new Job().create_convo(response_data.user_id, response_data.freelance_id);
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    window.location.reload();
                    window.clearTimeout(tID);
                }, 1500);
            }
            else if (response_data.error) {
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    create_convo(user_id, freelance_id) {
        let form_data = new FormData();
        form_data.append('user_id', user_id);
        form_data.append('freelance_id', freelance_id);
        form_data.append('create_convo', 'create_convo');
        fetch('../controller/c_jobapplication.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);

            if (response_data.success) {
                console.log(response_data.success);
            }
        })
    }
}