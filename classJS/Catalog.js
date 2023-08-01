class Catalog {

    add_catalog() {
        let button_value = new Account().get_button_value("add_catalog");
        new Account().button_loading("add_catalog", "loading", "");

        let msg = "Adding catalog....";
        new Notification().create_notification(msg, "neutral");

        var form_data = new FormData(document.getElementById('catalog_form'));
        form_data.append('add_catalog', 'add_catalog');
        fetch('../controller/c_catalog.php', {
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
                    window.location.reload();
                    window.clearTimeout(tID);
                }, 1000);
            }
            else if (response_data.error) {
                new Account().button_loading("add_catalog", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });

        if (status !== 0) {

        }

    }

    delete_catalog(catalog_id) {
        if (confirm("Are you sure you want to delete it?")) {
            var form_data = new FormData();
            form_data.append('catalog_id', catalog_id);
            form_data.append('delete_catalog', 'delete_catalog');
            fetch('../controller/c_catalog.php', {
                method: "POST",
                body: form_data
            }).then(function (response) {
                return response.json();
            }).then(function (response_data) {
                console.log(response_data);
                if (response_data.success) {
                    alert('Catalog Deleted Successfully');
                    location.reload();
                }
            });
        }
    }

    get_catalogId(catalog_id) {
        console.log(catalog_id);
        $.ajax({
            url: "../controller/c_catalog.php",
            type: "POST",
            data: { sessionValue: catalog_id },
            success: function (response) {
                // reloadWithModal();
            },
            error: function () {
                alert("Something went wrong!");
            }
        });
    }

    edit_catalog(catalog_id) {
        var form_data = new FormData(document.getElementById('catalog_form'));
        form_data.append('catalog_id', catalog_id);
        form_data.append('edit_catalog', 'edit_catalog');
        fetch('../controller/c_catalog.php', {
            method: "POST",
            body: form_data
        }).then(function (response) {
            return response.json();
        }).then(function (response_data) {
            console.log(response_data);
            if (response_data.success) {
                console.log(response_data.success);
                window.location.href = 'freelanceHomePage.php';
                alert('Catalog Updated Successfully');

            }
        })
    }
}