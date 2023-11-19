<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/x-icon" href="/assets/Images/Batstatelogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/assets/Aside-Nav/Aside.css">
    <link rel="stylesheet" href="/ReportMissing/Reportmissing.css">
    <!-- btn Logout Connection -->
    <link rel="stylesheet" href="/assets/css/btn-LogoutView.css">
    <!-- btn save connection -->
    <link rel="stylesheet" href="/assets/css/btn-save.css">
    <!-- Add CSS for success message -->
    <link rel="stylesheet" href="/ReportMissing/SuccessMessage.css">
    <title>Report Missing Item | Lost and Found </title>
</head>
<body>

    <aside>
      <!-- Just Wait Here this is navigation but in Left side -->
        <div class="Logo">
          <div class="logo-align">
            <span><img src="/assets/Images/lost-items-missing-svgrepo-com (1).png" alt="This is Image"></span>
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

      <main class="parent-Report-Missing">
        <nav class="nav-Report">
          <div class="report-missing">
            <span><i class="fa-solid fa-person-circle-question fa-bounce"></i></span>
            <h1>Report Missing</h1>
          </div>
          <div class="user-button-Log-out">
            <button id="Logout" class="box btn-color-Logout">
              <i class="fa-solid fa-right-from-bracket fa-bounce"></i> <!--This is Bouncing Icon-->
              Logout  <!--This is Text Logout-->
            </button> 
          </div>
        </nav>

        <?php
        // Connection to the database (Replace 'db.php' with your actual database connection file)
        include 'db.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $itemNumber = $_POST["itemNumber"];
            $itemName = $_POST["itemName"];
            $dateFound = $_POST["dateFound"];

            // Insert the reported lost item into the database
            $query = "INSERT INTO lost_items (item_number, item_name, date_found) VALUES ('$itemNumber', '$itemName', '$dateFound')";
            $result = mysqli_query($connection, $query);

            // Check if the query was successful
            if ($result) {
                echo "Lost item reported successfully";
            } else {
                echo "Error reporting lost item: " . mysqli_error($connection);
            }
        }
        ?>

    <form action="" method="post" class="report-section">
        <h2>Report Lost Item</h2>
        <label for="itemNumber">Item Number:</label>
        <input type="text" id="itemNumber" name="itemNumber" required>

        <label for="itemName">Item Name:</label>
        <input type="text" id="itemName" name="itemName" required>

        <label for="dateFound">Date Found:</label>
        <input type="date" id="dateFound" name="dateFound" required>

        <button type="submit">Report Lost Item</button>
    </form>

</body>
 <script src="/One/script.js"></script>
</html>
