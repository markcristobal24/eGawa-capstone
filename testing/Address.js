class Address {
    addressSelector = (_region, _province, _municipality, _barangay) => {
        _region = document.getElementById("_region");
        _province = document.getElementById("_province");
        _municipality = document.getElementById("_municipality");
        _barangay = document.getElementById("_barangay");
        const getAddress = (url, address_code, user_address_code) => {
            return fetch(url)
                .then((response) => {
                    return response.json();
                }).then((data) => {
                    if (url.match('/region')) {
                        console.log("da");
                        return data.map((address) => {
                            return (address);
                        });
                    } else {
                        return data.filter((data) => {
                            if (address_code == "region_code") return data.region_code ==
                                user_address_code;
                            else if (address_code == "province_code") return data.province_code ==
                                user_address_code;
                            else if (address_code == "city_code") return data.city_code ==
                                user_address_code;
                            else if (address_code == "brgy_code") return data.brgy_code ==
                                user_address_code;
                        }).map((address) => {
                            return address;
                        });
                    }
                });
        };

        const directory = () => {
            if ((window.location.href).includes('/testing/')) {
                return "../";
            } else {
                return "";
            }
        };

        const setAddress = (address_name, address_code, element) => {
            let createAlertDialog = document.createElement("option");
            createAlertDialog.setAttribute("id", address_code);
            createAlertDialog.value = address_name;
            createAlertDialog.innerHTML = address_name;
            element.appendChild(createAlertDialog);
        };

        getAddress(`${directory()}json/address/region.json`, "", "").then((result) => {
            result.map((region) => {
                setAddress(region.region_name, region.region_code, _region);
            });
        });


        const removeSelect = (select, selection) => {
            const nextSelect = select;
            if (select == _province.id) {
                /* parameter */
                _province.selectedIndex = 0;
                _municipality.selectedIndex = 0;
                _barangay.selectedIndex = 0;
                for (let i = 0; i < selection.length; i++) {
                    let selected = document.getElementById(selection[i]);
                    while (selected[1]) {
                        selected.removeChild(selected.lastChild);
                    }
                }
            } else if (select == _municipality.id) {
                /* parameter */
                _municipality.selectedIndex = 0;
                _barangay.selectedIndex = 0;
                for (let i = 1; i < selection.length; i++) {
                    let selected = document.getElementById(selection[i]);
                    while (selected[1]) {
                        selected.removeChild(selected.lastChild);
                    }
                }
            } else if (select == _barangay.id) {
                /* parameter */
                _barangay.selectedIndex = 0;
                for (let i = 2; i < selection.length; i++) {
                    let selected = document.getElementById(selection[i]);
                    while (selected[1]) {
                        selected.removeChild(selected.lastChild);
                    }
                }
            }
        };

        const selection = ["province", "municipality", "barangay"];
        // _region.addEventListener("change", (event) => {
        //     const selectOption = event.target.options[event.target.selectedIndex];
        //     const user_region_code = selectOption.id;
        //     // removeSelect(_province.id, selection); // Clear province, municipality, and barangay selects
        //     // removeSelect(_municipality.id, selection.slice(1));
        //     //  removeSelect(_province, selection);
        //     getAddress(`${directory()}json/address/province.json`, "region_code", user_region_code).then((result) => {
        //         result.map((province) => {
        //             setAddress(province.province_name, province.province_code, _province);
        //         });
        //     });
        // });

        // _province.addEventListener("change", (event) => {
        //     const selectOption = event.target.options[event.target.selectedIndex];
        //     const user_province_code = selectOption.id;
        //     removeSelect(_municipality.id, selection.slice(1));
        //     // removeSelect(_municipality, selection);
        //     getAddress(`${directory()}json/address/city.json`, "province_code", user_province_code).then((result) => {
        //         result.map((city) => {
        //             setAddress(city.city_name, city.city_code, _municipality);
        //         });
        //     });
        // });

        // _municipality.addEventListener("change", (event) => {
        //     const selectOption = event.target.options[event.target.selectedIndex];
        //     const user_city_code = selectOption.id;
        //     removeSelect(_barangay.id, selection.slice(2));
        //     // removeSelect(_barangay, selection);
        //     getAddress(`${directory()}json/address/barangay.json`, "city_code", user_city_code).then((result) => {
        //         result.map((brgy) => {
        //             setAddress(brgy.brgy_name, brgy.brgy_code, _barangay);
        //         });
        //     });
        // });

        _region.addEventListener("change", (event) => {
            const selectOption = event.target.options[event.target.selectedIndex];
            const user_region_code = selectOption.id;
            removeSelect(_province.id, selection);
            removeSelect(_municipality.id, selection.slice(1));
            removeSelect(_barangay.id, selection.slice(2));

            getAddress(`${directory()}json/address/province.json`, "region_code", user_region_code).then((result) => {
                _province.innerHTML = ''; // Clear previous options
                result.forEach((province) => {
                    setAddress(province.province_name, province.province_code, _province);
                });
            });
        });

        _province.addEventListener("change", (event) => {
            const selectOption = event.target.options[event.target.selectedIndex];
            const user_province_code = selectOption.id;
            removeSelect(_municipality.id, selection.slice(1));
            removeSelect(_barangay.id, selection.slice(2));

            getAddress(`${directory()}json/address/city.json`, "province_code", user_province_code).then((result) => {
                _municipality.innerHTML = ''; // Clear previous options
                result.forEach((city) => {
                    setAddress(city.city_name, city.city_code, _municipality);
                });
            });
        });

        _municipality.addEventListener("change", (event) => {
            const selectOption = event.target.options[event.target.selectedIndex];
            const user_city_code = selectOption.id;
            removeSelect(_barangay.id, selection.slice(2));

            getAddress(`${directory()}json/address/barangay.json`, "city_code", user_city_code).then((result) => {
                _barangay.innerHTML = ''; // Clear previous options
                result.forEach((brgy) => {
                    setAddress(brgy.brgy_name, brgy.brgy_code, _barangay);
                });
            });
        });
    };

}