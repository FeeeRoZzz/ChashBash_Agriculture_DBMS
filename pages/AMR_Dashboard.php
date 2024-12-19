<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chashbash</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #3498db;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .navbar .menu ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar .menu ul li {
            margin: 0 10px;
        }

        .navbar .menu ul li a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
        }

        .navbar .menu ul li a:hover {
            background-color: #3498db;
            border-radius: 5px;
        }

        .main-content {
            text-align: center;
            margin: 20px;
        }

        .cta-button {
            text-decoration: none;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }

        .cta-button:hover {
            background-color: #3498db;
        }

        .chart-container {
            margin: 30px auto;
            width: 80%;
            max-width: 600px;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #3498db;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <h2>চাষবাস.কম</h2>
        </div>
        <div class="menu">
            <ul>
                <li><a href="AMR_Dashboard.php">HOME</a></li>
                <li><a href="product.php">PRODUCT</a></li>
                <li><a href="farmer-price.php">FARMER PRICE</a></li>
                <li><a href="price-control.php">PRICE CONTROL</a></li>
                <li><a href="LogOut.php">LOG OUT</li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Welcome to Chashbash</h1>
        
        <a href="product.php" class="cta-button">Explore Products</a>
    </div>

    <!-- Chart Section -->
    <div class="chart-container">
        <canvas id="priceChart"></canvas>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Chashbash. All Rights Reserved.</p>
    </footer>

    <!-- Chart.js Script -->
    <script>
        const ctx = document.getElementById('priceChart').getContext('2d');
        const priceChart = new Chart(ctx, {
            type: 'line', // Chart type
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'], // X-axis labels
                datasets: [{
                    label: 'Rice Price (TAKA)',
                    data: [1500, 1600, 1700, 1650, 1800, 1750], // Example price data
                    borderColor: '#4CAF50',
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                    borderWidth: 2
                },
                {
                    label: 'Potato Price (TAKA)',
                    data: [70, 80, 85, 90, 100, 95], // Example price data
                    borderColor: '#FFA726',
                    backgroundColor: 'rgba(255, 167, 38, 0.2)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Price (TAKA)'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
