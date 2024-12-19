<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorial";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$notification = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'add') {
        $product_id = $_POST['product_id'];
        $consumption_rate = $_POST['consumption_rate'];

        // Check for duplicate Product ID
        $result = $conn->query("SELECT * FROM consumer WHERE product_id = '$product_id'");
        if ($result->num_rows > 0) {
            $notification = "Product ID already exists. Please enter a unique Product ID.";
        } else {
            $conn->query("INSERT INTO consumer (product_id, consumption_rate) VALUES ('$product_id', '$consumption_rate')");
        }
    } elseif ($_POST['action'] === 'delete') {
        $id = $_POST['id'];
        $conn->query("DELETE FROM consumer WHERE demand_id = $id");
    } elseif ($_POST['action'] === 'edit') {
        $id = $_POST['id'];
        $product_id = $_POST['product_id'];
        $consumption_rate = $_POST['consumption_rate'];
        $conn->query("UPDATE consumer SET product_id = '$product_id', consumption_rate = '$consumption_rate' WHERE demand_id = $id");
    }
}

$result = $conn->query("SELECT * FROM consumer");
$data = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumer Data</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .content {
            text-align: center;
            width: 80%;
            max-width: 1000px;
        }
        canvas {
            display: block;
            margin: 0 auto;
            width: 80% !important;
            height: 400px !important;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            text-align: center;
            background-color: #333;
            color: white;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
        }
        th {
            background-color: #2d3a55;
        }
        tr:nth-child(even) {
            background-color: #1a2532;
        }
        tr:nth-child(odd) {
            background-color: #25313e;
        }
        button {
            padding: 5px 10px;
            margin: 2px;
            cursor: pointer;
        }
        .edit-button {
            background-color: #4CAF50; /* Green */
            color: white;
        }
        .delete-button {
            background-color: #F44336; /* Red */
            color: white;
        }
        .form-container {
            margin-bottom: 20px;
        }
        .form-container input, .form-container select {
            padding: 8px;
            margin: 5px;
        }
        .notification {
            background-color: #f44336;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
            display: <?php echo ($notification != "") ? 'block' : 'none'; ?>;
        }
    </style>
</head>
<body>
    <div class="content">
        <h1>Product vs Consumption Rate</h1>

        <!-- Notification Section -->
        <div class="notification"><?php echo $notification; ?></div>

        <div>
            <canvas id="myChart"></canvas>
        </div>

        <div class="form-container">
            <form method="POST">
                <input type="hidden" name="action" value="add">
                <input type="text" name="product_id" placeholder="Product ID" required>
                <select name="consumption_rate" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
                <button type="submit">Add Data</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Demand ID</th>
                    <th>Product ID</th>
                    <th>Consumption Rate</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= $row['demand_id'] ?></td>
                        <td><?= $row['product_id'] ?></td>
                        <td><?= $row['consumption_rate'] ?></td>
                        <td>
                            <!-- Edit Form -->
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $row['demand_id'] ?>">
                                <input type="text" name="product_id" value="<?= $row['product_id'] ?>" required>
                                <select name="consumption_rate" required>
                                    <option value="Low" <?= $row['consumption_rate'] === 'Low' ? 'selected' : '' ?>>Low</option>
                                    <option value="Medium" <?= $row['consumption_rate'] === 'Medium' ? 'selected' : '' ?>>Medium</option>
                                    <option value="High" <?= $row['consumption_rate'] === 'High' ? 'selected' : '' ?>>High</option>
                                </select>
                                <input type="hidden" name="action" value="edit">
                                <button type="submit" class="edit-button">Edit</button>
                            </form>

                            <!-- Delete Form -->
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $row['demand_id'] ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="delete-button">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const data = <?= json_encode($data) ?>;

        // Mapping consumption rates to numeric values for graph height
        const consumptionValues = {
            'Low': 1,
            'Medium': 2,
            'High': 3
        };

        // Prepare the data for the chart
        const labels = data.map(item => item.product_id);
        const consumptionRates = data.map(item => consumptionValues[item.consumption_rate]);
        const colors = data.map(item => {
            // Map colors to each consumption rate
            switch (item.consumption_rate) {
                case 'Low':
                    return 'red';
                case 'Medium':
                    return 'green';
                case 'High':
                    return 'black';
                default:
                    return 'gray';
            }
        });

        // Create the bar chart
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Consumption Rate',
                    data: consumptionRates,  // Actual data points for consumption rates
                    backgroundColor: colors,
                    borderColor: colors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 3,  // Since the highest consumption rate is "High" with value 3
                    },
                    x: {
                        ticks: {
                            autoSkip: false
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
