<?php
// Connection to the database
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/x-icon" href="/Assets/Images/Batstatelogo.png">
    <link rel="stylesheet" href="/stylecursor.css">
    <title>Claimed Items</title>
    <style>
        .table-container {
            height: 50vh;
            overflow-y: auto;
        }

        table {
            border-collapse: collapse;
            width: 90vw;
            border: 1px solid black;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            width: 25vw;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="table-container">
    <?php
    // Retrieve all the claimed items
    $query = "SELECT * FROM lost_items WHERE date_claimed IS NOT NULL";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Display the claimed items
        echo "<table>
            <tr>
                <th>Item Number</th>
                <th>Item Name</th>
                <th>Date Found</th>
                <th>Date Claimed</th>
            </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>" . $row['item_number'] . "</td>
                <td>" . $row['item_name'] . "</td>
                <td>" . $row['date_found'] . "</td>
                <td>" . $row['date_claimed'] . "</td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "Error retrieving claimed items: " . mysqli_error($connection);
    }
    ?>
</div>

</body>
</html>

