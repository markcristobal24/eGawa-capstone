class Posts {
    post() {
        let button_value = new Account().get_button_value("submitPost");
        new Account().button_loading("submitPost", "loading", "");
        document.getElementById('submitPost').disabled = true;

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
                document.getElementById('submitPost').disabled = false;
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
            let job = response_data;
            let applyBtn = document.getElementById('applyjob_btn');
            if (applyBtn) {
                applyBtn.value = `${job.post_id}`;
            }

            document.getElementById('exampleModalLabel').innerHTML = `${job.post_title}`.toUpperCase();
            document.getElementById('post_title').innerHTML = `${job.post_title}`;
            document.getElementById('post_author').innerHTML = `${job.author}`;
            document.getElementById('category').innerHTML = `${job.category}`;
            document.getElementById('post_tags').innerHTML = `${job.post_tags}`;
            document.getElementById('address').innerHTML = `${job.barangay}, ${job.municipality}, ${job.province}`;
            document.getElementById('posted_date').innerHTML = `${job.posted_date}`;
            document.getElementById('post_description').innerHTML = `${job.post_description}`;
            document.getElementById('rate').innerHTML = `${job.rate}`;
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

    apply_job(postId) {
        let form_data = new FormData();
        form_data.append('postId', postId);
        form_data.append('fetch_post', 'fetch_post');
        fetch('../controller/c_jobPosts.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);
            let job = response_data;

            document.getElementById('btn_sendJob').value = postId;
            document.getElementById('job_title').innerHTML = `${job.post_title}`.toUpperCase();
            document.getElementById('job_author').innerHTML = `${job.author}`;
        });
    }

    send_job(postId) {
        new Account().button_loading("btn_sendJob", "loading", "");
        document.getElementById('btn_sendJob').disabled = true;
        let form_data = new FormData(document.getElementById('sendJob_form'));
        form_data.append('postId', postId);
        form_data.append('send_job', 'send_job');
        fetch('../controller/c_jobapplication.php', {
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
                document.getElementById('btn_sendJob').disabled = false;
                new Account().button_loading("btn_sendJob", "", "Send");
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    fetch_jobposts(id) {
        let form_data = new FormData();
        form_data.append('view_post', 'view_post');
        form_data.append('id', id);
        fetch('../controller/c_jobPosts.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);
            let job = response_data;

            let category = document.getElementById('filterOptionPost');
            for (var i = 0; i < category.options.length; i++) {
                if (category.options[i].textContent === `${job.category}`) {
                    category.selectedIndex = i;
                    break;
                }
            }

            document.getElementById('post_title').value = job.post_title;
            document.getElementById('post_description').value = job.post_description;
            document.getElementById('post_tags').value = job.post_tags;
            document.getElementById('rate').value = job.post_rate;
            document.getElementById('btn_deletepost').value = job.post_id;
            document.getElementById('btn_editpost').value = job.post_id;
        });
    }

    delete_post(post_id) {
        let form_data = new FormData(document.getElementById('editpost_form'));
        form_data.append('delete_post', 'delete_post');
        form_data.append('post_id', post_id);
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
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    edit_post(post_id) {
        let form_data = new FormData(document.getElementById('editpost_form'));
        form_data.append('edit_post', 'edit_post');
        form_data.append('post_id', post_id);
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
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }
}