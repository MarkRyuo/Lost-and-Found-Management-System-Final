<?php
// Connection to the database
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="/ViewLost_Student/StudentView.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="/Assets/css/btn-LogoutView.css">
  <title>Claimed Item | Lost and Found</title>
</head>
<body>

  <main class="Tables">
    <!-- Header Section -->
        <header class="nav">
          <nav class="parent-Nav">
            <h1><span><i class="fa-solid fa-eye fa-beat-fade"></i></span>Claimed Item</h1>
            <div class="user-button-Log-out">
              <button id="Logout" class="box btn-color-Logout">
                <i class="fa-solid fa-right-from-bracket fa-bounce"></i> <!--This is Bouncing Icon-->
                Logout  <!--This is Text Logout-->
              </button> 
            </div>
          </nav>
        </header>

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
  </main>
  
</body>
<script src="script.js"></script>
</html>