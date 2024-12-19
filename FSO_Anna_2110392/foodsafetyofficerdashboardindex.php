<?php
// PHP code for dynamic data (can be fetched from a database later)
$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
$productionData = [45, 60, 80, 70, 85, 95, 100, 90, 75, 65, 55, 50]; // Sample data (you can replace this with dynamic data)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Production Dashboard</title>
    <link rel="stylesheet" href="simplifieddashboardstyle.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Ensure the entire page has a minimum height of 100vh and centers content */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* Title Section (Centered) */
        .production-record-title {
            text-align: center;
            margin-bottom: 20px; /* Space between title and chart */
            font-size: 2em;
            font-weight: bold;
            color: #4bc0c0;
        }

        /* Chart Container */
        .chart-container {
            width: 90%;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Footer */
        footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Welcome Section -->
    <header class="welcome">
        <h1>Welcome to Chashbash</h1>
    </header>

    <!-- Production Record Title Above Chart -->
    <div class="production-record-title">
        <h2>Production Record</h2>
    </div>

    <!-- Chart Section -->
    <div class="chart-container">
        <canvas id="productionChart"></canvas>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>© 2024. All Rights Reserved.</p>
    </footer>

    <!-- Chart.js Script -->
    <script>
        const ctx = document.getElementById('productionChart').getContext('2d');

        // Gradient Background for Chart
        const gradientFill = ctx.createLinearGradient(0, 0, 0, 400);
        gradientFill.addColorStop(0, 'rgba(75, 192, 192, 0.6)');
        gradientFill.addColorStop(1, 'rgba(153, 102, 255, 0.3)');

        // Data from PHP
        const months = <?php echo json_encode($months); ?>;
        const productionData = <?php echo json_encode($productionData); ?>;

        // Chart Configuration
        const productionChart = new Chart(ctx, {
            type: 'line', // Line Chart
            data: {
                labels: months, // Dynamic X-axis Labels
                datasets: [{
                    label: 'Production Records',
                    data: productionData, // Dynamic Data
                    fill: true,
                    backgroundColor: gradientFill, // Gradient fill
                    borderColor: '#4bc0c0', // Line color
                    borderWidth: 3,
                    tension: 0.4, // Smooth line
                    pointRadius: 6,
                    pointBackgroundColor: '#fff', // Point color
                    pointBorderColor: '#4bc0c0',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false // Remove legend for simplicity
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false // No gridlines for X-axis
                        },
                        title: {
                            display: false, // Hide x-axis title since we're placing it as a div above the chart
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(200, 200, 200, 0.2)' // Light gridlines for Y-axis
                        },
                        title: {
                            display: true,
                            text: 'Production Quantity',
                            font: {
                                size: 16,
                                weight: 'bold'
                            },
                            color: '#333'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
























