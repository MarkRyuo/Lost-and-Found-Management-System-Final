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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
      <link rel="stylesheet" href="/ViewLost_Student/StudentView.css">
      <link rel="stylesheet" href="/Assets/css/btn-LogoutView.css">
      <link rel="stylesheet" href="/Assets/cssViewLost/style.css">
      <title>Student View Lost | Lost and Found</title>
      <style>

          :root {
            --bg-Color: hsl(347, 100%, 98%);
            --bg-color-Aside: hsl(343, 79%, 36%);
            --bg-color-Aside-logo: hsl(343, 77%, 20%);
            --bg-color-Aside-shadow: hsl(343, 78%, 18%);
          }
                  

        .table-claim {
          /* border: 1px solid black; */
          height: 50vh;
          display: flex;
          flex-direction: column;
          align-items: center;
        }
        /* .main-Conformation {
          border: 1px solid black;
        } */
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
          border: 1px solid var(--bg-color-Aside-shadow);
          padding: 8px;
          text-align: center;
          width: 40vw;
          height: 8vh;
          font-size: 1.4rem;
        }

        th {
          background-color: var(--bg-color-Aside);
          color: #fff;
        }

        .claim-button {
          padding: 5px 10px;
          font-size: 1.2rem;
          border: 1px solid var(--bg-color-Aside);
          border-radius: 30px;
          width: 10vw;
          height: 6vh;
        }

        .claim-button:hover {
          background-color: var(--bg-color-Aside);
          color: #fff;
        }
      </style>
  </head>
  <body>

    <main class="Tables">
      <!-- Header Section -->
          <header class="nav">
            <nav class="parent-Nav">
              <h1><span><i class="fa-solid fa-eye fa-beat-fade"></i></span>View Lost Item</h1>
              <div class="user-button-Log-out">
                <button id="Logout" class="box btn-color-Logout">
                  <i class="fa-solid fa-right-from-bracket fa-bounce"></i> <!--This is Bouncing Icon-->
                  Logout  <!--This is Text Logout-->
                </button> 
              </div>
            </nav>
          </header>

          
          <div class="table-container">
            <section class="table-claim">
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
                        </tr>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>" . $row['item_number'] . "</td>
                            <td>" . $row['item_name'] . "</td>
                            <td>" . $row['date_found'] . "</td>
                        </tr>";
                    }

                    echo "</table>";
                } else {
                    echo "Error retrieving lost items: " . mysqli_error($connection);
                }
                ?>
      </section>
   </div>

    </main>
  
</body>
  <script src="/Assets/js/script.js"></script>
  <!-- Connection to logout -->
  <script src="/Assets/js/Logout.js"></script>
</html>