<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "ration";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$db_select = mysqli_select_db($conn, $dbname);
session_start();
if(isset($_SESSION['user']))
{
    include("../config/connection.php");
    date_default_timezone_set("Asia/Kolkata");
    $date = date("Y-m-d");
   
    $sql="SELECT * FROM shopowner";
    $result=mysqli_query($conn,$sql);
    $shopOwners=mysqli_fetch_all($result,MYSQLI_ASSOC);
    $shopOwnerCount=mysqli_num_rows($result);

    $sql4="SELECT DISTINCT date FROM apply_stock ORDER BY date DESC";
    $result4=mysqli_query($conn,$sql4);
    $dates=mysqli_fetch_assoc($result4);
    $applyStockCount=mysqli_num_rows($result4);

    if($applyStockCount > 0)
    {
        $last_date=$dates['date'];
    }
    
    if(isset($last_date))
    {
        $t_date = date('Y-m-d', strtotime($last_date. ' + 30 days'));
    }
    else
    {
        $t_date=$date;
    }
    
    if(isset($_REQUEST['submit']))
    {
        $rows = []; // Initializing $rows as an empty array
        $sql2="SELECT * from apply_stock";
        $result3=mysqli_query($conn,$sql2);
        $rows=mysqli_fetch_all($result3,MYSQLI_ASSOC);
        
        foreach($shopOwners as $shopOwner)
        {
            $pds=$shopOwner['shopno'];
            $sql1 = "SELECT tbl_user.* FROM tbl_user, tbl_distributor 
            WHERE tbl_user.pincode='$pincode' AND tbl_distributor.pincode='$pincode'";
            $result1 = mysqli_query($conn, $sql1);
            $res=mysqli_fetch_all($result1,MYSQLI_ASSOC);
            $count = mysqli_num_rows($result1);
            
            $sql2="SELECT * FROM stock";
            $result2=mysqli_query($conn,$sql2);
            $details=mysqli_fetch_all($result2,MYSQLI_ASSOC);
            
            foreach($details as $detail)
            {
                $name = $detail['stock_name'];
                $quan = $detail['quantity'] * $count * 4;
                $sql3="INSERT INTO give_stock (shopno, item, quantity, date) VALUES ('$pds', '$name', '$quan', '$date')";
                $sql5="UPDATE stock SET quantity='$quan' WHERE pds_no='$pds' AND stock_name='$name'";
                mysqli_query($conn,$sql3);
                mysqli_query($conn,$sql5);
            }
        }
?>
<script>
    alert("Count-" + <?php echo $count; ?>);
</script>
<?php
    }
    echo '<script>
        alert("Stock has been assigned to all PDS");
        window.location.href="giveration.php";
        </script>';
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Admin | E-Ration </title>
    <link rel="stylesheet" href="style.css?v">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
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
                <a href="add_dist.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Add Distributor</span>
                </a>
            </li>
            <li>
                <a href="add_stock.php">
                    <i class="bx bxs-cart-add"></i>
                    <span class="links_name">Add Stock</span>
                </a>
            </li>
            <li>
                <a href="#" class="active">
                    <i class="bx bx-coin-stack"></i>
                    <span class="links_name">Give Stock</span>
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
                <span class="dashboard">Give Stock</span>
            </div>
            <div class="profile-details">
                <span class="admin_name">ADMIN</span>
            </div>
        </nav>
        <div class="home-content">
            <div class="add-distributor">
                <div class="form_wrapper w3-round-large">
                    <div class="form_container">
                        <form action="" method="post">
                            <h2><b>Total Distributors : </b><?php echo $count; ?></h2>
                            <?php
                                if($date==$t_date)
                                {
                            ?>
                    <div class="form_container">
                        <form action="" method="post">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Applied Id</th>
                                        <th>Date</th>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Distributor Name </th>
                                        <th>Shop No.</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                      foreach($rows as $row)
                      {
                    ?>
                                    <tr>
                                        <td data-label="Applied Id"><?php echo $row['slno']; ?></td>
                                        <td data-label="Date"><?php echo $row['date']; ?></td>
                                        <td data-label="Item Name"><?php echo $row['item']; ?></td>
                                        <td data-label="quantity"><?php echo $row['quantity']; ?></td>
                                        <td data-label="Name"><?php echo $row['name']; ?></td>
                                        <td data-label="Shop No."><?php echo $row['shopno']; ?></td>
                                    </tr>
                                    <?php
                      }
                    ?>
                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
                        </form>
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

                            <button type="submit" class="w3-round-large w3-button w3-dark-blue w3-padding"
                                style="margin-top:2rem;" name="submit">Assign
                                Ration to
                                All Distributors</button>
                            <?php
                                }
                                else
                                {
                                    ?>
                            <button type="submit" class="w3-round-large w3-button w3-dark-blue w3-padding"
                                style="margin-top:2rem;" name="submit" disabled>Assign
                                Ration to
                                All Distributors</button>
                            <?php
                                echo "<br><br><h3>Stock has been assigned previously on $last_date.<br>Please wait for next month!!</h3>";
                                }
                                ?>
                        </form>
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

