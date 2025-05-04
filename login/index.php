
<!DOCTYPE html>
<html lang="zxx">
<?php 
$message; 
$message1; 
$message2; 
?>
<head>
    <title>Service login form Responsive Widget Template : W3Layouts</title>

    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Google fonts -->
    <link href="//fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />

</head>

<body>
    <div class="signinform">
        <h1>e-RATION SERVICE</h1>
        <!-- container -->
        <div class="container">
            <!-- main content -->
            <div class="w3l-form-info">
                <div class="w3_info">
                    <h2 style="color:#7d32eb;">Login</h2>
<?php 
    include("../config/connection.php");

        if(isset($_POST['submit'])){
            //process for login
            //$username= $_POST['username'];
            $username= $_POST['email'];
            $password= $_POST['password'];

            //sql query to check username and password
            if (!empty($username)) {
                if (!empty($password)) {
                    // Check if it's admin login
                    if ($username === 'admin@gmail.com' && $password === '12345') {
                        // Redirect to admin interface
                        header("Location: ../admin/admin_dash.php");
                        exit;
                    } else {
                        // Check in the user table
                        $sql = "SELECT * FROM user WHERE email='$username' AND password='$password'";
                        $result_user = $conn->query($sql);
            
                        if ($result_user->num_rows == 1) {
                            // User found in user table, redirect to user interface
                            header("Location: ../web/customer.php?email=" . urlencode($username));
                            exit;
                        } else {
                            // Check in the shopowner table
                            $sql = "SELECT * FROM shopowner WHERE email='$username' AND password='$password'";
                            $result_shopowner = $conn->query($sql);
            
                            if ($result_shopowner->num_rows == 1) {
                                // User found in shopowner table, redirect to distributor interface
                                header("Location: ../distributor/customer.php?email=" . urlencode($username));
                                exit;
                            } else {
                                // Handle case when neither admin, user nor shop owner
                                $message = "Invalid email or password";
                            }
                        }
                    }
                } else {
                    $message = "Password is required";
                }
            } else {
                $message = "Username is required";
            }
            
        }
        
        
       
?>
                    <form action="" method="post">
                        <div class="input-group">
                            <p style="color: red"><?php 
                            if(isset($message)){
                                echo $message; 
                            }
                            ?></p>
                            <span><i class="fas fa-user" aria-hidden="true"></i></span>
                            <input type="email" placeholder="Username or Email" required="" name="email">
                            <p style="color: red"><?php 
                            if(isset($message1)){
                                echo $message1; 
                            }
                            ?></p>
                        </div>
                        <div class="input-group">
                             <span><i class="fas fa-key" aria-hidden="true"></i></span>
                            <input type="Password" placeholder="Password" required="" name="password">
                            <p style="color: red"><?php 
                            if(isset($message2)){
                                echo $message2; 
                            }
                            ?></p>
                        </div>
                        
                        <button class="btn btn-primary btn-block" type="submit" name="submit">Login</button>
                        
                    </form>
                    
                    <p class="account">Don't have an account? <a href="register.php">Sign up</a></p>
                </div>
            </div>
            <!-- //main content -->
        </div>
        <!-- //container -->
    </div>

    <!-- fontawesome v5-->
    <script src="js/fontawesome.js"></script>

    

</body>

</html>