<?php
include "db_conn.php";

// Fetch data from the database
$stmt = $conn->prepare("SELECT product_name, h_price, c_price FROM `crud`");
$stmt->execute();
$result = $stmt->get_result();
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Prepare data for Chart.js
$productNames = json_encode(array_column($data, 'product_name'));
$historicalPrices = json_encode(array_column($data, 'h_price'));
$currentPrices = json_encode(array_column($data, 'c_price'));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANALYSIS</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .charts {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            gap: 20px; /* Added gap between charts */
        }

        .home-button {
    display: inline-block;
    margin: 20px auto;
    text-align: center;
    text-decoration: none;
    background-color: #ff0000; 
    color: white;
    padding: 12px 24px; 
    font-size: 1rem;
    font-weight: bold;
    border-radius: 6px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
}

.home-button:hover {
    background-color: #cc0000; /* Darker red on hover */
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
}

/* Parent container's flex to center button */
.container {
    display: flex;
    flex-direction: column;
    align-items: center; /* Centers the button horizontally */
    justify-content: center;
    width: 80%;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    padding: 30px;
}

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
            color: #333333;
        }

        .charts {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .chart-container {
            width: 48%;
            background: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        canvas {
            max-width: 100%;
            height: 300px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        table thead {
            background-color: #007bff;
            color: white;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border: 1px solid black; /* Black border for cells */
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        table th {
            font-size: 1rem;
            border: 1px solid black; /* Black border for headers */
        }

        table td {
            font-size: 0.9rem;
            color: #555555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>PRODUCTS PRICE ANALYSIS</h1>
        <div class="charts">
            <!-- Chart Containers -->
            <div class="chart-container">
                <canvas id="barChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="lineChart"></canvas>
            </div>
        </div>

        <!-- Data Table -->
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Historical Price</th>
                    <th>Current Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($row['h_price'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($row['c_price'], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Home Button -->
        <a href="admin_index.php" class="home-button">HOME</a>
    </div>

    <script>
        // Data from PHP
        const productNames = <?= $productNames ?>;
        const historicalPrices = <?= $historicalPrices ?>;
        const currentPrices = <?= $currentPrices ?>;

        // Bar Chart
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: productNames,
                datasets: [
                    {
                        label: 'Historical Price',
                        data: historicalPrices,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    },
                    {
                        label: 'Current Price',
                        data: currentPrices,
                        backgroundColor: 'rgba(255, 159, 64, 0.7)',
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Bar Chart: Prices' },
                },
            },
        });

        // Line Chart
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: productNames,
                datasets: [
                    {
                        label: 'Historical Price',
                        data: historicalPrices,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.4,
                    },
                    {
                        label: 'Current Price',
                        data: currentPrices,
                        borderColor: 'rgba(255, 159, 64, 1)',
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        tension: 0.4,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Line Chart: Prices' },
                },
            },
        });
    </script>
</body>

</html>
