class Catalog {

    delete_catalog(catalog_id) {
        if (confirm("Are you sure you want to delete it?")) {
            let form_data = new FormData();
            form_data.append('catalog_id', catalog_id);
            form_data.append('delete_catalog', 'delete_catalog');
            fetch('controller/c_catalog.php', {
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
}