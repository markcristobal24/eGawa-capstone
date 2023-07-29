class Account {

    /* ------------------- Freelancer Section */
    registerFreelance() {
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
                window.location.href = 'verifyAccount.php';
            }
            else if (response_data.error) {
                console.log(response_data.error);
                new Notification().create_notification(response_data.error, "error");
                //location.reload();
            }
        });
    }
}