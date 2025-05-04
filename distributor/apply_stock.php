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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Function to validate input
        function test_input($data) {
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
       }

       $name1 = test_input($_POST["name"]);
       $item = test_input($_POST["item"]);
       $quantity = test_input($_POST["quantity"]);
       $date=test_input($_POST["date"]);
    $query = "INSERT INTO apply_stock (shopno, name, item, quantity, date) VALUES ('$shopno', '$name1', '$item','$quantity', '$date')";
    if (mysqli_query($conn,$query)) {
        
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
	}
   
    }
}?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Distributor Dashboard | E-Ration </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <img src="logo2.png" height="40px" weight="40px" style="margin-left: 10px">
            <img src="logo3.png" height="40px" weight="140px">
        </div>
        <ul class="nav-links">
           
            <li>
                <a href="avail_stock.php?name=<?php echo urlencode($name); ?>">
                    <i class='bx bx-coin-stack'></i>
                    <span class="links_name">Check Available Stock</span>
                </a>
            </li>
            <li>
                <a href="#" class="active">
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
                <span class="dashboard">Apply For Stock</span>
            </div>
            <div class="profile-details">
                
                <span class="distributor_name">Hello <?php echo $name; ?></span>

            </div>
        </nav>

        <div class="home-content">
            <div class="add-distributor">
                <div class="form_wrapper">
                    <div class="form_container">
                        <form action="" method="POST" style="margin-top: 10px;">
                            <h2 class="w3-center" style="margin-bottom: 2rem;">
                                <b style="color: midnightblue;">Apply For Stock of Shop No <?php echo $shopno; ?></b>
                            </h2>
                            <div class="w3-row-padding w3-margin-top w3-margin-bottom">
                                <div class="w3-third w3-margin-top">
                                    <label> Name</label>
                                  <input type="text" id="name" class="w3-input w3-border w3-margin-top"
                                        name="name" placeholder=>
                                </div>
                                
                            </div>
                            <div class="w3-row-padding w3-margin-top w3-margin-bottom">
                                <div class="w3-third w3-margin-top">
                                    <label>Item Name</label>
                                    <select  name="item" class="w3-input w3-margin-top">
                                        <option>Select</option>
                                        <option value="MATTARICE">MATTA RICE</option>
<option value="KURUVARICE">KURUVA RICE</option>
<option value="WHITERICE">WHITE RICE</option>
<option value="SUGAR">SUGAR</option>
<option value="WHEAT">WHEAT</option>
<option value="KEROSENE">KEROSENE</option>
<option value="ATTA">ATTA</option>
                                    </select>
                                </div>
                              
                                <div class="w3-third w3-margin-top">
                                    <label>Date</label>
                                    <input type="date" class="w3-input w3-margin-top" id="date" name="date">
                                </div>
                            </div>
                            <div class="w3-row-padding w3-margin-top">
                                <div class="w3-third w3-margin-top">
                                    <label>Quantity</label>
                                    <input type="number" id="quantity" class="w3-input w3-border w3-margin-top"
                                        name="quantity" placeholder="Enter Quantity..">
                                </div>

                            </div>
                    </div>


                    <div class="w3-margin w3-center">
                        <input type="submit" class="w3-button w3-dark-blue w3-round-large " value="Submit"
                            name="btn-edit-dist">
                    </div>
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
