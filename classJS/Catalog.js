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
    }

    delete_catalog(catalog_id) {
        // if (confirm("Are you sure you want to delete it?")) {
        console.log(catalog_id);
        // let button_value = new Account().get_button_value("delete_catalog");
        // new Account().button_loading("delete_catalog", "loading", "");

        let msg = "Deleting catalog....";
        new Notification().create_notification(msg, "neutral");

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
                console.log(response_data.success);
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    window.location.reload();
                    window.clearTimeout(tID);
                }, 1000);
            }
            else if (response_data.error) {
                // new Account().button_loading("add_catalog", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
        // }
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

        let button_value = new Account().get_button_value("edit_catalog");
        new Account().button_loading("edit_catalog", "loading", "");

        var form_data = new FormData(document.getElementById('edit_catalogForm'));
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
                new Notification().create_notification(response_data.success, "success");
                let tID = setTimeout(function () {
                    window.location.reload();
                    window.clearTimeout(tID);
                }, 1000);
            }
            else if (response_data.error) {
                new Account().button_loading("edit_catalog", "", button_value);
                new Notification().create_notification(response_data.error, "error");
            }
        });
    }

    view_catalogs(id) {
        console.log(id);
        let form_data = new FormData();
        form_data.append('id', id);
        form_data.append('view_catalog', 'view_catalog');
        fetch('../controller/c_catalog.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);
            console.log(response_data.catalogImage)
            let cat = response_data;

            document.getElementById('delete_catalog').value = `${cat.catalog_id}`;
            document.getElementById('edit_catalog').value = `${cat.catalog_id}`;
            document.getElementById('exampleModalLabel').innerHTML = `${cat.catalogTitle}`;
            document.getElementById('catalogImage').src = `../img/uploads/freelancer/catalog/${cat.catalogImage}`;
            document.getElementById('container-description').innerHTML = `${cat.catalogDescription}`;
        });
    }

    view_catalogs_user(id) {
        console.log(id);
        let form_data = new FormData();
        form_data.append('id', id);
        form_data.append('view_catalog', 'view_catalog');
        fetch('../controller/c_catalog.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);
            console.log(response_data.catalogImage)
            let cat = response_data;

            // document.getElementById('delete_catalog').value = `${cat.catalog_id}`;
            // document.getElementById('edit_catalog').value = `${cat.catalog_id}`;
            document.getElementById('exampleModalLabel').innerHTML = `${cat.catalogTitle}`;
            document.getElementById('catalogImage').src = `../img/uploads/freelancer/catalog/${cat.catalogImage}`;
            document.getElementById('container-description').innerHTML = `${cat.catalogDescription}`;
        });
    }
}