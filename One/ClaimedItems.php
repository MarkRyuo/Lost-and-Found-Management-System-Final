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
  <link rel="icon" type="img/x-icon" href="/Assets/Images/Batstatelogo.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="/Assets/css/btn-LogoutView.css">
  <link rel="stylesheet" href="/stylecursor.css">
  <title>Claimed Item | Lost and Found</title>
  <style>

          :root {
            --bg-Color: hsl(347, 100%, 98%);
            --bg-color-Aside: hsl(343, 79%, 36%);
            --bg-color-Aside-logo: hsl(343, 77%, 20%);
            --bg-color-Aside-shadow: hsl(343, 78%, 18%);
          }

        .table-container {
            height: 60vh;
            overflow-y: auto;
            /* border: 1px solid black; */
            width: 100vw;
            display: flex;
            flex-direction: column;
            align-items: center;
      
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
            width: 25vw;
            height: 5vh;
            font-size: 1.3rem;
        }

        th {
            background-color: var(--bg-color-Aside);
            color: #fff;
            height: 7vh;
            font-size: 1.3rem;
        }
    </style>
</head>
<body>

  <main class="Tables">
    <!-- Header Section -->
        <header class="nav">
          <nav class="parent-Nav">
            <h1><span><i class="fa-solid fa-eye fa-beat-fade"></i></span>Claimed Item</h1>
            <div class="user-button-Log-out">
              <button id="Back" class="box btn-color-Logout">
                <i class="fa-solid fa-right-from-bracket fa-bounce"></i> <!--This is Bouncing Icon-->
                back  <!--This is Text Logout-->
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
<!-- Connection back btn -->
<script src="/Assets/js/Backbutnoalert.js"></script>
</html>