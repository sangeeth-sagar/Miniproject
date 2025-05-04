
<?php




 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $dbname = "ration";
 
 $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
 $db_select = mysqli_select_db($conn, $dbname);
   

    if (isset($_POST['btn-add-dist'])) {
        include("../config/connection.php");
       
        $post_password1 = $_POST['password'];
        $post_password2 = $_POST['con_password'];
        if ($post_password1 == $post_password2) {
            $post_fname = $_POST['name'];
            $post_ph_no = $_POST['phone_no'];
            $post_email = $_POST['email'];
            $post_city = $_POST['place'];
            $post_district = $_POST['district'];
            $post_state = $_POST['state'];
            $post_pds_no = $_POST['shopno'];
            $post_email = $_POST['email'];
            
            // SQL query to insert data into the database
            $sql = "INSERT INTO shopowner (name, phno, shopno, place, district, state, email, password) 
                    VALUES ('$post_fname', '$post_ph_no', '$post_pds_no', '$post_city', '$post_district', '$post_state', '$post_email', '$post_password1')";
            
            // Execute the SQL query
            if (mysqli_query($conn, $sql)) {
                echo "Record added successfully!<script>setTimeout(function(){document.getElementById('success-msg').style.display='none';}, 1000);</script>";
            } else {
                // If an error occurs, handle it here
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        
        } else {
            // Passwords don't match, handle the error here
            echo "Error: Passwords do not match!";
        }
        $post_email = $_POST['email']; // Change this to fetch email from your database
$post_username = $_POST['email']; // Change this to fetch username from your database
$post_password = $_POST['password']; // Change this to fetch password from your database

// Email subject
$subject = "Registration Successful";

// Email message body (customize as needed)
$message = "Dear $post_username,\n\n";
$message .= "Congratulations! Your registration was successful.\n";
$message .= "Your login details are as follows:\n";
$message .= "Username: $post_username\n";
$message .= "Password: $post_password\n\n";
$message .= "Thank you for registering with us.\n\n";
$message .= "Best regards,\nYour Company";

// Email headers
$headers = "From: sangeeth87654@gmail.com\r\n";
$headers .= "Reply-To: sangeeth87654@gmail.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send the email
if (mail($post_email, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email. Please try again later.";
}
        
    }
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
                <span class="dashboard">Add Distributor</span>
            </div>
            <div class="profile-details">
                <span class="admin_name">ADMIN</span>
            </div>
        </nav>
        <div class="home-content">
            <div class="add-distributor">
                <div class="form_wrapper">
                    <div class="form_container">
                        <form method="post" enctype="multipart/form-data">
                            <div class="w3-row-padding">
                                <div class="w3-third w3-margin-top">
                                    <label>Name</label>
                                    <input class="w3-input w3-border w3-margin-top" name="name" type="text"
                                        placeholder="Enter  Name" required>
                                </div>
                              
                            </div>
                            <div class="w3-row-padding w3-margin-top">
                                <div class="w3-third w3-margin-top">
                                    <label>Email ID</label>
                                    <input class="w3-input w3-border w3-margin-top" name="email" type="email"
                                        placeholder="Enter Email ID" required>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Shop No</label>
                                    <input class="w3-input w3-border w3-margin-top" name="shopno" type="text"  placeholder="Enter Shop No."required>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Phone Number</label>
                                    <input class="w3-input w3-border w3-margin-top" name="phone_no" type="tel"
                                        placeholder="Enter Phone No." maxlength="10" required>
                                </div>
                            </div>
                           
                            <div class="w3-row-padding">
                                <div class="w3-third w3-margin-top">
                                    <label>place</label>
                                    <input class="w3-input w3-border w3-margin-top" name="place" type="text"
                                        placeholder="Enter  place" required>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>District</label>
                                    <input class="w3-input w3-border w3-margin-top" name="district" type="text"
                                        placeholder="Enter  District" required>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>state</label>
                                    <input class="w3-input w3-border w3-margin-top" name="state" type="text"
                                        placeholder="Enter  state" required>
                                </div>
                              
                            </div>
                            <div class="w3-row-padding w3-margin-top">
                               
                                   
                                <div class="w3-third w3-margin-top">
                                    <label>Password</label>
                                    <input class="w3-input w3-border w3-margin-top" name="password" type="password"
                                        placeholder="Enter Password" required>
                                </div>
                                <div class="w3-third w3-margin-top">
                                    <label>Confirm Password</label>
                                    <input class="w3-input w3-border w3-margin-top" name="con_password" type="password"
                                        placeholder="Enter Confirm Password" required>
</div>
                               
                            </div>
                    </div>
                    <div class="w3-center w3-margin-top">
                        <button class="w3-button w3-round-large w3-dark-blue" name="btn-add-dist">SUBMIT</button>
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
   include("../config/connection.php");
// Assuming you have retrieved the user details from the database
$post_email = $_POST['email']; // Change this to fetch email from your database
$post_username = $_POST['email']; // Change this to fetch username from your database
$post_password = $_POST['password']; // Change this to fetch password from your database

// Email subject
$subject = "Registration Successful";

// Email message body (customize as needed)
$message = "Dear $post_username,\n\n";
$message .= "Congratulations! Your registration was successful.\n";
$message .= "Your login details are as follows:\n";
$message .= "Username: $post_username\n";
$message .= "Password: $post_password\n\n";
$message .= "Thank you for registering with us.\n\n";
$message .= "Best regards,\nYour Company";

// Email headers
$headers = "From: sangeeth87654@gmail.com\r\n";
$headers .= "Reply-To: sangeeth87654@gmail.com\r\n";
$header .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send the email
if (mail($post_email, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email. Please try again later.";
}
?>
