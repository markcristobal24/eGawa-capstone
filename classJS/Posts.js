
class Posts {
    post() {
        let button_value = new Account().get_button_value("submitPost");
        new Account().button_loading("submitPost", "loading", "");

        let form_data = new FormData(document.getElementById('post_form'));
        form_data.append('jobPosts', 'jobPosts');
        fetch('../controller/c_jobPosts.php', {
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
                }, 1500);
            }
            else if (response_data.error) {
                new Account().button_loading("submitPost", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    filter_post(filterValue) {
        //let filterValue = document.getElementById('filterOption').value;

        let form_data = new FormData();
        form_data.append('filter_post', 'filter_post');
        form_data.append('filterValue', filterValue);
        fetch('../controller/c_jobPosts.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);
            console.log(filterValue);
            if (response_data.success) {
                document.getElementById('post_container').innerHTML = response_data.success;
            }
            else if (response_data.error) {
                document.getElementById('post_container').innerHTML = response_data.error;
                //new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    view_post(id) {
        let form_data = new FormData();
        form_data.append('id', id);
        form_data.append('view_post', 'view_post');
        fetch('../controller/c_jobPosts.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);
            const encodedData = encodeURIComponent(JSON.stringify(response_data));
            window.location.href = `userViewPost.php?data=${encodedData}`;
        });
    }

    search_post(keyword) {
        let form_data = new FormData();
        form_data.append('keyword', keyword);
        form_data.append('search_post', 'search_post');
        fetch('../controller/c_jobPosts.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);
            if (response_data.success) {
                document.getElementById('post_container').innerHTML = response_data.success;
            }
            else if (response_data.error) {
                document.getElementById('post_container').innerHTML = response_data.error;
            }
        });
    }
}

