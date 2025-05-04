
<?php
     include("../config/connection.php");
      $sql2="SELECT * from apply_stock";
      $result3=mysqli_query($conn,$sql2);
      $rows=mysqli_fetch_all($result3,MYSQLI_ASSOC);

// Assuming you have database connection established


// Assuming you have database connection established


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Admin | E-Ration </title>
    <link rel="stylesheet" href="style.css">
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
                <a href="#" class="active">
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
                <span class="dashboard">View Applied Stock</span>
            </div>
            <div class="profile-details">
                <span class="admin_name">ADMIN</span>
            </div>
        </nav>
        <div class="home-content">
            <div class="add-distributor">
                <div class="form_wrapper">
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
                                        <th></th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                      foreach($rows as $row)
                      {
                    ?><tr>
                    <td data-label="Applied Id"><?php echo $row['slno']; ?></td>
                    <td data-label="Date"><?php echo $row['date']; ?></td>
                    <td data-label="Item Name"><?php echo $row['item']; ?></td>
                    <td data-label="Quantity"><?php echo $row['quantity']; ?></td>
                    <td data-label="Name"><?php echo $row['name']; ?></td>
                    <td data-label="Shop No."><?php echo $row['shopno']; ?></td>
                    <td data-label="Action">
                        <button style="background-color: #0A2558;"><a href="add_stock.php?slno=<?php echo $row['slno']; ?>" style="color: #ffffff;text-decoration:none;">Add stock</a></button><br>
						
                        
                    </td>
                </tr>
                      
                                    <?php
                                    

                      }
                    ?>
                                   
                                </tbody>
                            </table>
                           
        
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
