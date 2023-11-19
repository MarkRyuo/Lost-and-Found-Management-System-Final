<?php
// Connection to the database
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="author" content="">
      <meta name="discription" content="">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
      <link rel="icon" type="img/x-icon" href="/assets/Images/Batstatelogo.png">

      <link rel="stylesheet" href="/assets/Aside/btn-Aside.css">
      <link rel="stylesheet" href="/assets/Aside/Aside.css">

      <link rel="stylesheet" href="/One/ClaimConformation/ClaimConformation.css">

            <!-- btn Logout connection -->
      <link rel="stylesheet" href="/assets/css/btn-LogoutView.css">
              <!-- btn Claim Connection -->
      <link rel="stylesheet" href="/ClaimConformation/claim-btn-conformation.css">
      <title>Claim Conformation | Lost and Found</title>
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

    <aside>
      <!-- Just Wait Here this is navigation but in Left side -->
        <div class="Logo">
          <div class="logo-align">
            <img src="/assets/Images/lost-items-missing-svgrepo-com (1).png" alt="This is Image">
            <h1>
              Lost and Found <br> 
              Management <br>System
            </h1>
          </div>
          <p>General</p>
        </div>
  
        <nav class="button-Nav">
          <!-- User Profile -->
        <hr>
        <button class="btn" id="User">
            <span class="btn-text-one"><i class="fa-solid fa-user-shield"></i></span>
            <span class="btn-text-two">User Profile</span>
        </button>
        <hr>
        <!-- View Lost Item -->
        <button class="btn" id="viewlostItem">
          <span class="btn-text-one"><i class="fa-regular fa-eye "></i></span>
          <span class="btn-text-two">View Lost Item</span>
        </button>
        <hr>
        <!--Report Missing-->
        <button class="btn" id="reportMissing">
          <span class="btn-text-one"><i class="fa-solid fa-person-circle-question "></i></span>
          <span class="btn-text-two">Report Missing</span>
        </button>
        <hr>
        <!-- Claim Conformation  -->
        <button class="btn" id="claimConformation">
          <span class="btn-text-one"><i class="fa-solid fa-square-check"></i></span>
          <span class="btn-text-two">Claim Conformation</span>
        </button>
        <hr>
      </aside>
      <!-- End of aside -->
    
      <main class="main-Conformation">

        <nav class="nav-Conformation">
          <div class="div-conformation">
            <span> <i class="fa-solid fa-square-check fa-bounce"></i></span>
            <h1>Claim Conformation</h1>
          </div>

            <div class="user-button-Log-out">
              <button id="Logout" class="box btn-color-Logout">
                <i class="fa-solid fa-right-from-bracket fa-bounce"></i> <!--This is Bouncing Icon-->
                Logout  <!--This is Text Logout-->
              </button> 
            </div>
        </nav>

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
      </section>
   </div>
 </main>
  
</body>
  <script src="/Assets/js/script.js"></script>
  <!-- Connection for Aside -->
  <script src="/Assets/Aside/btn-aside.js"></script>
  <!-- Connection in Logout -->
  <script src="/Assets/js/Logout.js"></script>
</html>