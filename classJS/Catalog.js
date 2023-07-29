class Catalog {

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