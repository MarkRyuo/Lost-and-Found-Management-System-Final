<?php
// Connection to the database
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost Items</title>
    <style>
        .table-container {
            height: 50vh;
            overflow-y: auto;
        }

        table {
            border-collapse: collapse;
            width: 70vw;
            border: 1px solid black;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            width: 40vw;
        }

        th {
            background-color: #f2f2f2;
        }

        .claim-button {
            padding: 5px 10px;
            font-size: 1.2rem;
            border: 1px solid black;
            border-radius: 30px;
        }
        
        .claim-button:hover {
            background-color: cadetblue;
        }
    </style>
</head>
<body>

<div class="table-container">
    <?php
    // Retrieve all the lost items
    $query = "SELECT * FROM lost_items WHERE date_claimed IS NULL";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Display the lost items
        echo "<table>
            <tr>
                <th>Item Number</th>
                <th>Item Name</th>
                <th>Date Found</th>
                <th>Claim</th>
            </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>" . $row['item_number'] . "</td>
                <td>" . $row['item_name'] . "</td>
                <td>" . $row['date_found'] . "</td>
                <td><button class='claim-button' onclick='claimItem(" . $row['id'] . ")'>Claim</button></td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "Error retrieving lost items: " . mysqli_error($connection);
    }
    ?>
</div>

</body>
</html>
