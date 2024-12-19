<?php
// Database Connection
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "tutorial"; // Change to your actual DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle AJAX delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteId = intval($_POST['delete_id']);
    $query = "DELETE FROM production_records_t WHERE Product_ID = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $deleteId);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete record']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement']);
    }
    $conn->close();
    exit; // Terminate the script after handling the delete request
}

// Fetch production data for the table
$query = "SELECT * FROM production_records_t";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Production Records</title>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #2d4059;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background: #2d4059;
            color: #fff;
        }

        table tr:nth-child(even) {
            background: #f4f4f9;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #b52d3a;
        }

        .edit-btn {
            background-color: #007bff; /* Blue color */
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: default; /* Non-clickable */
        }

        .edit-btn:hover {
            background-color: #0056b3; /* Slightly darker blue */
        }

        /* Custom styles for Accepted and Rejected */
        .status-accepted {
            color: green;
            font-weight: bold;
        }

        .status-rejected {
            color: red;
            font-weight: bold;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to delete a row
        function deleteRow(deleteId, row) {
            if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                    url: '', // The same file handles the request
                    type: 'POST',
                    data: { delete_id: deleteId },
                    success: function(response) {
                        try {
                            const result = JSON.parse(response);
                            if (result.status === 'success') {
                                // Remove the row from the table
                                $(row).closest('tr').remove();
                                alert('Record deleted successfully.');
                            } else {
                                alert('Error deleting record: ' + result.message);
                            }
                        } catch (e) {
                            alert('Invalid response from server.');
                        }
                    },
                    error: function() {
                        alert('An error occurred while deleting the record.');
                    }
                });
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Production Records</h1>
        <table>
            <thead>
                <tr>
                    <th>Product_ID</th>
                    <th>Product Name</th>
                    <th>Yields (KG)</th>
                    <th>Acreage (Hectares)</th>
                    <th>Cost ($)</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $counter = 1;
                    while ($row = $result->fetch_assoc()) {
                        // Alternate the status based on row index (odd or even)
                        $status = ($counter % 2 == 1) ? "Accepted" : "Rejected"; // Odd rows - Accepted, Even rows - Rejected
                        $statusClass = ($counter % 2 == 1) ? "status-accepted" : "status-rejected"; // Assign CSS class for color
                        
                        echo "<tr>";
                        echo "<td>" . $counter++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['Product_Name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Yields']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Acreage']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Cost']) . "</td>";
                        echo "<td class='$statusClass'>" . $status . "</td>"; // Display alternating status with color
                        echo "<td>
                                <button class='edit-btn'>Edit</button> 
                                <button class='delete-btn' onclick='deleteRow(" . $row['Product_ID'] . ", this)'>Delete</button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>



















