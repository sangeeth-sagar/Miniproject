<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "ration";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$db_select = mysqli_select_db($conn, $dbname);

session_start();

// Check if $_GET['pds'] is set
if ( isset($_GET['pds'])) {
    $pds=$_GET['pds'];
    
    // Proceed with your SQL query
    $sql = "SELECT * FROM shopowner WHERE shopno='$pds'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
} else {
    // Handle the case when $pds is not set
    echo "Error: Parameter 'pds' is not set.";
}

	?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Admin Dashboard | E-Ration </title>
    
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .heading {
        font-size: x-large;
        text-align: center;
        font-weight: 500;
    }

    button {
        color: #ffffff;
        background-color: #0A2558;
        font-size: 16px;
    }

    .img {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="sidebar">
        
        <div class="logo-details">
            <img src="logo2.png" height="40px" weight="40px" style="margin-left: 10px">
            <img src="logo3.png" height="40px" weight="140px">
        </div>
        <ul class="nav-links">
            <li>
                <a href="admin_dash.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="active">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Add Distributor</span>
                </a>
            </li>
           
          
            <li>
                <a href="applied_stock.php">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">View Applied Stock</span>
                </a>
            </li>
            <li>
                <a href="stock_details.php">
                    <i class='bx bx-coin-stack'></i>
                    <span class="links_name">Stock Details</span>
                </a>
            </li>
 
            <li class="log_out">
                <a href="logout.php">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Suspend Shopowner</span>
            </div>
            <div class="profile-details">
                <span class="admin_name">ADMIN</span>
            </div>
        </nav>
        <div class="home-content">
            <div class="add-distributor">
                <div class="form_wrapper">
                    <div class="form_container">
                        <form action="" method="POST">
                            <div class="heading w3-margin w3-xxlarge">
                                Shopowner Details
                            </div>
                           
                            <label><b>Name : </b><?php echo $rows['name']; ?>
                            </label>
                            <label><b>Shop No : </b><?php echo $rows['shopno']; ?></label>
                            <label>
                            <label><b>Email : </b><?php echo $rows['email']; ?></label>
                            <label><b>City : </b><?php echo $rows['place']; ?></label>
                            <label><b>State : </b><?php echo $rows['district']; ?></label>
                            <label><b>Reason : </b></label>
                            <textarea cols="50" rows="3" name="reason" placeholder="Enter Reason"></textarea><br>
                            <button name="del_dist"
                                class="w3-margin w3-button w3-dark-blue w3-round-large w3-center">Suspend
                                Distributor</button>
                        </form>
                        <?php
              if(isset($_REQUEST['del_dist']))
              {
                  $pds=$_REQUEST['pds'];
                 include("../config/connection.php");
                  $name=$rows['name'];
             
                  $ph_no=$rows['phno'];
                  $mail=$rows['email'];
                  $post_reason=$_REQUEST['reason'];
                  date_default_timezone_set("Asia/Kolkata");
                  $date=date("y-m-d");
                  //deleting from distributor table
                  $sql1="DELETE FROM shopowner WHERE shopno='$pds'";

                  $sql2="INSERT INTO suspendlist (shopno, name, phno, email, reason, suspend_date)
                  VALUES ('$pds', '$name', '$ph_no', '$mail', '$post_reason', '$date')";
                  if(mysqli_query($conn,$sql1) and  mysqli_query($conn,$sql2))
                  {
                    echo '<script>
                    alert("Distributor Suspended Successfully");
                    window.location.href="admin_dash.php";
                    </script>';
                  }
                  else
                  {
                      echo '<script>alert("Something Went Wrong..")</script>';
                  }
              }
            ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
            sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else
            sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
    </script>

</body>

</html>
