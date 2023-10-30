class Dashboard {
    get_information_freelancer() {
        let form_data = new FormData();
        form_data.append('get_information_freelancer', 'get_information_freelancer');
        fetch('../controller/c_dashboard.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data.data);

            if (response_data.error) {
                new Notification().create_notification(response_data.error, "error");
            } else {
                document.getElementById('total_applied_freelancer').innerHTML = response_data.data[0].total_applied_freelancer;
                document.getElementById('total_accepted_freelancer').innerHTML = response_data.data[0].total_accepted_freelancer;
                document.getElementById('total_declined_freelancer').innerHTML = response_data.data[0].total_declined_freelancer;
            }
        })
    }

    get_information_company() {
        let form_data = new FormData();
        form_data.append('get_information_company', 'get_information_company');
        fetch('../controller/c_dashboard.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data.data);

            if (response_data.error) {
                new Notification().create_notification(response_data.error, "error");
            } else {
                document.getElementById('total_posts').innerHTML = response_data.data[0].total_posts;
                document.getElementById('total_accepted').innerHTML = response_data.data[0].total_accepted;
                document.getElementById('total_declined').innerHTML = response_data.data[0].total_declined;
            }
        });
    }
}