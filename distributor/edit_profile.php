<?php
include("../config/connection.php");
if(isset($_GET['name'])){
    // Retrieve email value from query parameter
    $name = $_GET['name'];
    $sql = "SELECT  email FROM shopowner WHERE name = ?";

    // Prepare and bind the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    
    // Execute the statement
    $stmt->execute();
    
    // Bind the result variables
    $stmt->bind_result( $email);
    
    // Fetch the result
    $stmt->fetch();
    $stmt->close();

}
    ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title> Distributor | E-Ration </title>
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
                <a href="#" class="active">
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
                <span class="dashboard">Edit Profile</span>
            </div>
            <!--div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div-->
            <div class="profile-details">
              
                <span class="admin_name"> HELLO <?php echo $name; ?></span>

            </div>
        </nav>
        <div class="home-content">
            <div class="add-distributor">
                <div class="form_wrapper">
                    <div class="form_container">
                        <form action="" method="POST">
                            <div class="w3-row-padding">
                                <div class="w3-third w3-margin-top">
                                    <label>Name</label>
                                    <input class="w3-input w3-border w3-margin-top" name="name" type="text"
                                        >
                                </div>
                              
                            </div>
                            <div class="w3-row-padding w3-margin-top">
                                <div class="w3-third w3-margin-top">
                                    <label>Email ID</label>
                                    <input class="w3-input w3-border w3-margin-top" name="email" type="email"
                                        
                                        >
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Shop No.</label>
                                    <input class="w3-input w3-border w3-margin-top" name="shopno" type="text"
                                        >
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Phone Number</label>
                                    <input class="w3-input w3-border w3-margin-top" name="phno" type="tel"
                                     
                                        >
                                </div>
                            </div>
                           
                            <div class="w3-row-padding w3-margin-top">
                                 <div class="w3-third w3-margin-top">
                                    <label>place</label>
                                    <input class="w3-input w3-border w3-margin-top" name="place" type="tel"
                                    >
                                    
                                </div></div>
                                <div class="w3-row-padding w3-margin-top">
                                    <div class="w3-third w3-margin-top">
                                    <label>District</label>
                                    <input class="w3-input w3-border w3-margin-top" name="district" type="tel"
                                        >
                                </div></div>
                               
                               
                           
                            <div class="w3-center w3-margin-top">
                                <button class="w3-button w3-round-large"
                                    style="margin: top 100px;margin-bottom: 10px;background-color: #0A2558;color: white;"
                                    name="btn-update-dist">SUBMIT</button>
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

<?php
  if(isset($_POST['btn-update-dist']))
  {
    $mail=$_POST['email'];
    $phno=$_POST['phno'];
    $name1=$_POST['name'];
    $shopno=$_POST['shopno'];
    $place=$_POST['place'];
    $district=$_POST['district'];
    include 'connection.html';
    $sql1="UPDATE shopowner SET email='$mail', phno='$phno', name='$name1', cardno='$cardno' WHERE name='$name'";
    if(mysqli_query($conn,$sql1))
    {
      echo "<script>alert('Updated Successfully');
      window.location.href='edit_profile.html';
      </script>";
    }
    else{
      echo '<script>alert("Something Went Wrong")</script>';
    }
  }
?>