<!DOCTYPE html>
<html>

<head>
    <title>User Registration Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div style="width: 70%; margin: auto;">
        <canvas id="registrationGraph"></canvas>
    </div>

    <script>
    function do_graph() {
        let form_data = new FormData();
        form_data.append('graph', 'graph');
        fetch('graph.php', {
            method: "POST",
            body: form_data
        }).then((response) => {
            return response.json();
        }).then((response_data) => {
            console.log(response_data);
            var data = response_data;

            var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August",
                "September", "October", "November", "December"
            ];

            // Create arrays to hold the month names and user counts
            var monthLabels = [];
            var userCounts = [];

            // Map the numerical month values to month names
            data.forEach(function(entry) {
                monthLabels.push(monthNames[entry.registration_month - 1]);
                userCounts.push(entry.user_count);
            });

            // Create a bar chart using Chart.js
            var ctx = document.getElementById('registrationGraph').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: monthLabels,
                    datasets: [{
                        label: 'User Registrations',
                        data: userCounts,
                        backgroundColor: 'rgba(77, 2, 55, 0.2)',
                        borderColor: 'rgba(77, 2, 55, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    }
    do_graph();
    </script>
</body>

</html>