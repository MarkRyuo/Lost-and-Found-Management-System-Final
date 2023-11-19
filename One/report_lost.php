<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/x-icon" href="/Assets/Images/Batstatelogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/assets/Aside/Aside.css">
    <link rel="stylesheet" href="/One/ReportMissing/Reportmissing.css">
    <!-- btn Logout Connection -->
    <link rel="stylesheet" href="/Assets/css/btn-LogoutView.css">
    <!-- btn save connection -->
    <link rel="stylesheet" href="/Assets/css/btn-save.css">
    <!-- Add CSS for success message -->
    <link rel="stylesheet" href="/One/ReportMissing/SuccessMessage.js">
    <title>Report Missing Item | Lost and Found </title>
    <style>
        :root {
        --bg-Color: hsl(347, 100%, 98%);
        --bg-color-Aside: hsl(343, 79%, 36%);
        --bg-color-Aside-logo: hsl(343, 77%, 31%);
        --bg-color-Aside-shadow: hsl(343, 78%, 18%);
        }

        .parent-Report-Missing {
        /* border: 1px solid black; */

        width: 82vw;
        height: 93vh;
        display: flex;
        flex-direction: column;
        gap: 15vh;

        margin-top: 1vh;
        }
        .report-section {
        /* border: 1px solid black; */

        width: 80vw;
        height: 80vh;

        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        align-items: center;
        gap: 2.3vh;
    }

    .report-section label {
        margin-right: 15vw;
        font-size: 1.2rem;
        color: rgb(93, 93, 93);
    }

    .report-section button {
        border: 1px solid var(--bg-color-Aside-shadow);
        height: 5vh;
        width: 10vw;
        border-radius: 30px;
        font-size: 1.1rem;
    }

    .report-section .itemnumber {
        width: 10vw;
        margin-right: 10vw;
    }

    .report-section button:hover {
        background-color: var(--bg-color-Aside);
        color: #fff;
        box-shadow: 2px 4px 5px var(--bg-color-Aside-shadow);
    }
    
    .report-section input {
        font-size: 1.2rem;
    }

    .success-message {
        color: green;
        font-weight: bold;
        margin-top: 10px;
        }

    
    
    
    </style>
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

    $successMessage = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $itemNumber = $_POST["itemNumber"];
        $itemName = $_POST["itemName"];
        $dateFound = $_POST["dateFound"];

        // Insert the reported lost item into the database
        $query = "INSERT INTO lost_items (item_number, item_name, date_found) VALUES ('$itemNumber', '$itemName', '$dateFound')";
        $result = mysqli_query($connection, $query);

        // Check if the query was successful
        if ($result) {
            $successMessage = "Lost item reported successfully";
        } else {
            $successMessage = "Error reporting lost item: " . mysqli_error($connection);
        }
    }
    ?>
    <!-- Todo nagdodouble ang data kapag nirereload -->

    <form action="" method="post" class="report-section">
    <?php
            if (!empty($successMessage)) {
                echo "<div class='success-message'>$successMessage</div>";
            }
        ?>
        <label for="itemNumber">Item Number:</label>
        <input type="text" id="itemNumber" name="itemNumber" class="itemnumber" required>

        <label for="itemName">Item Name:</label>
        <input type="text" id="itemName" name="itemName" required>

        <label for="dateFound">Date Found:</label>
        <input type="date" id="dateFound" name="dateFound" required>

        <button type="submit">Report Lost Item</button>
    </form>
</body>
 <script src="/One/script.js"></script>
 <script>
    // Function to hide the success message after a delay
    function hideSuccessMessage() {
        var successMessage = document.querySelector('.success-message');
        if (successMessage) {
            setTimeout(function () {
                successMessage.style.display = 'none';
            }, 3000); // 3000 milliseconds (3 seconds) delay, you can adjust this value
        }
    }

    // Call the function when the page loads
    window.onload = function () {
        hideSuccessMessage();
    };
</script>
</html>
