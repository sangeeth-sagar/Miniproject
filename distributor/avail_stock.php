<?php
include("../config/connection.php");
if(isset($_GET['name'])){
    // Retrieve email value from query parameter
    $name = $_GET['name'];
    $sql = "SELECT shopno, email FROM shopowner WHERE name = ?";

    // Prepare and bind the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    
    // Execute the statement
    $stmt->execute();
    
    // Bind the result variables
    $stmt->bind_result($shopno, $email);
    
    // Fetch the result
    $stmt->fetch();
    $stmt->close();
   

    $sql = "SELECT  mattarice , kuruvarice , whiterice , wheat , kerosene , sugar , atta FROM stock WHERE shopno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $shopno);

    $stmt->execute();
    $stmt->bind_result($mattarice, $kuruvarice, $whiterice, $wheat, $kerosene, $sugar, $atta);
    $stmt->fetch();
    $stmt->close();}
    ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Distributor Dashboard | E-Ration </title>
    <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
    #customers {
        margin-top: 20px;
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #0A2558;
        color: white;
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
                <a href="#" class="active">
                    <i class='bx bx-coin-stack'></i>
                    <span class="links_name">Check Available Stock</span>
                </a>
            </li>
            <li>
                <a href="apply_stock.php?name=<?php echo urlencode($name); ?>">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">Apply For Stock</span>
                </a>
            </li>
            <li>
            <a href="customer.php?email=<?php echo urlencode($email); ?>">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Customers</span>
                </a>
            </li>
           
            <li>
                <a href="edit_profile.php?name=<?php echo urlencode($name); ?>">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Edit Profile</span>
                </a>
            </li>
            <li class="log_out">
            <a href="../login/index.php">
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
                <span class="dashboard">Check Available Stock</span>
            </div>
            <div class="profile-details">
                <span class="distributor_name"><?php echo $name; ?></span>

            </div>
        </nav>

        <div class="home-content">
            <div class="add-distributor">
                <div class="form_wrapper">
                    <div class="form_container">
                      
                     

<div class="w3-responsive">
                            <table id="customers" class="w3-table-all">
                                <thead>
                                    <tr>
                                        
                                        <th>Item Name</th>
                                        <th>Item Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>MATTA RICE</td>
                                        <td data-label="Distributor Name">
                                            <?php echo $mattarice; ?> KG
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>KURUVA RICE</td>
                                        <td data-label="Distributor Name">
                                            <?php echo $kuruvarice; ?> KG
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>WHITE RICE</td>
                                        <td data-label="Distributor Name">
                                            <?php echo $whiterice; ?> KG
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>SUGAR</td>
                                        <td data-label="Distributor Name">
                                            <?php echo $sugar; ?> KG
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>WHEAT</td>
                                        <td data-label="Distributor Name">
                                            <?php echo $wheat; ?> KG
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ATTTA</td>
                                        <td data-label="Distributor Name">
                                            <?php echo $atta; ?> KG
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>KEROSENE</td>
                                        <td data-label="Distributor Name">
                                            <?php echo $kerosene; ?> Litr
                                        </td>
                                    </tr>
                                    
                                    
                                </tbody>
                            </table>
                        </div>
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
