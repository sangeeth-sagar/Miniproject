
<!DOCTYPE html>
<html>	
<head>
<title>SIGNUP FORM</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
 <meta name="keywords" content="Queer Signup form a Flat Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<link href="cssr/style.css" rel='stylesheet' type='text/css' />
<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,900" rel="stylesheet">
<!--//webfonts-->
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

   
 <div class="w3_frm">
 <!---728x90---> 
  <form action="#" method="post">
			<h3>Signup Form</h3>
<?php
include("../config/connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 // Function to validate input
	 function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    
    
	function validate_password($password) {
        // Password length at least 8 characters
        if (strlen($password) < 8) {
            return false;
        }
        
        // Password must contain at least one uppercase letter
        if (!preg_match("/[A-Z]/", $password)) {
            return false;
        }
        
        // Password must contain at least one lowercase letter
        if (!preg_match("/[a-z]/", $password)) {
            return false;
        }
        
        // Password must contain at least one number
        if (!preg_match("/[0-9]/", $password)) {
            return false;
        }
        
        // Password must contain at least one special character
        if (!preg_match("/[\W_]/", $password)) {
            return false;
        }
        
        return true;
    }

	// Retrieve and validate form data
    $name = test_input($_POST["name"]);
    $phone_number = test_input($_POST["phno"]);
    $card_number = test_input($_POST["cardno"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $dob = $_POST["dob"];

    

	// Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }
	// Check if email already exists
    $check_query = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($result) > 0) {
        die("Email already exists");
    }

	if (!validate_password($password)) {
        $error_message = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
    }

    // Insert data into database
    $query = "INSERT INTO user (name, phno, cardno, email, password,dob) VALUES ('$name', '$phone_number', '$card_number', '$email', '$password','$dob')";
    
    if (mysqli_query($conn,$query)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
	}
    }



?>
			<div class="field-w3-agile-grid leftf">	
				<input type="text"  placeholder="Name" name="name">
			</div>
			<div class="field-w3-agile-grid leftf">	
				<input type="text"  placeholder="Phone Number"  name="phno">
			</div>
			<!---728x90---> 
			<div class="field-w3-agile-grid leftf">	
				<input type="text"  placeholder="Ration Card number" name="cardno">
			</div>
			
			
	        <div class="field-w3-agile-grid leftf">
				<input type="text"  placeholder="EMAIL ADDRESS" required="" name="email">
			</div>
			<div class="field-w3-agile-grid rightf">
				<input type="password"  placeholder="Password" required="" name="password">
			</div>
			<div class="field-w3-agile-grid rightf">
				<input type="password"  placeholder="Confirm Password" required="" />
			</div>
            
            <div class="field-w3-agile-grid rightf">
            <label for="dob" style="color: white;">Date Of Birth</label>

             <input type="date" id="dob" name="dob" required><br><br>
            </div>
			
			
			<input  type="submit" value="SIGNUP">
		</form>	
        <?php
// Database connection details
$dbhost = "localhost";
$dbname = "ration";
$dbuser = "root";
$dbpass = "";

try {
    // Create a PDO instance
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Given data
   
    $mattaRiceValueAPL = 5;
    $kuruvaRiceValueAPL = 5;
    $whiteRiceValueAPL = 5;
    $keroseneValueAPL = 1;
    $resetMattaRiceDays = 30;
    $resetKeroseneDays = 90;
    $mattaRiceValueBPL = 4;
    $kuruvaRiceValueBPL = 4;
    $whiteRiceValueBPL = 4;
    $keroseneValueBPL = 1;
    $attaValueBPL = 1;
    $wheatValueBPL = 1;

   
$currentDate = "2024-05-01"; 

// Fetch the type based on cardno
$sqlGetcardno = "SELECT type FROM ration_card WHERE cardno = :cardno";
$stmtGetcardno = $conn->prepare($sqlGetcardno);
$stmtGetcardno->bindParam(':cardno',   $card_number , PDO::PARAM_STR);
$stmtGetcardno->execute();
$result = $stmtGetcardno->fetch(PDO::FETCH_ASSOC);

// Check if query returned a result
if ($result) {
    $type = $result['type'];
    // Proceed with your logic here
} else {
    // Handle the case where no result was found
    echo "No result found for card number:   $card_number ";
}



if (  $type = "apl") {
    // Update for APL type
    $sqlAPL = "UPDATE ration_card SET mattarice = :mattaRiceValueAPL, kuruvarice = :kuruvaRiceValueAPL, whiterice = :whiteRiceValueAPL, kerosene = :keroseneValueAPL WHERE cardno = :cardno";
    $stmtAPL = $conn->prepare($sqlAPL);
    $stmtAPL->bindParam(':mattaRiceValueAPL', $mattaRiceValueAPL, PDO::PARAM_INT);
    $stmtAPL->bindParam(':kuruvaRiceValueAPL', $kuruvaRiceValueAPL, PDO::PARAM_INT);
    $stmtAPL->bindParam(':whiteRiceValueAPL', $whiteRiceValueAPL, PDO::PARAM_INT);
    $stmtAPL->bindParam(':keroseneValueAPL', $keroseneValueAPL, PDO::PARAM_INT);
    $stmtAPL->bindParam(':cardno',   $card_number , PDO::PARAM_STR);
    $stmtAPL->execute();

    // Reset rice values for APL type
    $sqlResetRiceAPL = "UPDATE ration_card SET mattarice = 5, kuruvarice = 5, whiterice = 5, last_reset_rice = :currentDate WHERE cardno = :cardno AND DATEDIFF(:currentDate, last_reset_rice) >= :resetMattaRiceDays";
    $stmtResetRiceAPL = $conn->prepare($sqlResetRiceAPL);
    $stmtResetRiceAPL->bindParam(':cardno',   $card_number , PDO::PARAM_STR);
    $stmtResetRiceAPL->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);
    $stmtResetRiceAPL->bindParam(':resetMattaRiceDays', $resetMattaRiceDays, PDO::PARAM_INT);
    $stmtResetRiceAPL->execute();

    // Reset kerosene value for APL type
    $sqlResetKeroseneAPL = "UPDATE ration_card SET kerosene = 1, last_reset_kerosene = :currentDate WHERE cardno = :cardno AND DATEDIFF(:currentDate, last_reset_kerosene) >= :resetKeroseneDays";
    $stmtResetKeroseneAPL = $conn->prepare($sqlResetKeroseneAPL);
    $stmtResetKeroseneAPL->bindParam(':cardno',   $card_number , PDO::PARAM_STR);
    $stmtResetKeroseneAPL->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);
    $stmtResetKeroseneAPL->bindParam(':resetKeroseneDays', $resetKeroseneDays, PDO::PARAM_INT);
    $stmtResetKeroseneAPL->execute();
}
elseif ($type == "bpl") {
    // Update for BPL type
    $sqlBPL = "UPDATE ration_card SET mattarice =mattarice + :mattaRiceValueBPL, kuruvarice = kuruvarice + :kuruvaRiceValueBPL, whiterice =whiterice + :whiteRiceValueBPL, kerosene = :keroseneValueBPL, atta =atta + :attaValueBPL, wheat = wheat + :wheatValueBPL WHERE cardno :cardno";
    $stmtBPL = $conn->prepare($sqlBPL);
    $stmtBPL->bindParam(':mattaRiceValueBPL', $mattaRiceValueBPL, PDO::PARAM_INT);
    $stmtBPL->bindParam(':kuruvaRiceValueBPL', $kuruvaRiceValueBPL, PDO::PARAM_INT);
    $stmtBPL->bindParam(':whiteRiceValueBPL', $whiteRiceValueBPL, PDO::PARAM_INT);
    $stmtBPL->bindParam(':keroseneValueBPL', $keroseneValueBPL, PDO::PARAM_INT);
    $stmtBPL->bindParam(':attaValueBPL', $attaValueBPL, PDO::PARAM_INT);
    $stmtBPL->bindParam(':wheatValueBPL', $wheatValueBPL, PDO::PARAM_INT);
    $stmtBPL->bindParam(':cardno',   $card_number , PDO::PARAM_STR);
    $stmtBPL->execute();

    // Reset filled columns for BPL type
    $sqlResetBPL = "UPDATE ration_card SET mattarice = (SELECT MAX(mattarice) FROM ration_card WHERE cardno = :cardno), 
                    kuruvarice = (SELECT MAX(kuruvarice) FROM ration_card WHERE cardno :cardno), 
                    whiterice = (SELECT MAX(whiterice) FROM ration_card WHERE cardno :cardno), 
                    atta = (SELECT MAX(atta) FROM ration_card WHERE cardno :cardno), 
                    wheat = (SELECT MAX(wheat) FROM ration_card WHERE cardno :cardno), 
                    last_reset_filled = :currentDate WHERE cardno :cardno AND DATEDIFF(:currentDate, last_reset_filled) >= :resetDays";
    $stmtResetBPL = $conn->prepare($sqlResetBPL);
    $stmtResetBPL->bindParam(':cardno',   $card_number , PDO::PARAM_STR);
    $stmtResetBPL->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);
    $stmtResetBPL->bindParam(':resetDays', $resetMattaRiceDays, PDO::PARAM_INT); // Assuming resetting after 30 days
    $stmtResetBPL->execute();
}else {
    echo "Invalid card number or type.";
}

    echo "Values updated successfully.";

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

	</div>
    <script>
        $(document).ready(function() {
            // Run the PHP script in the background when clicking the button
            $("#backgroundButton").click(function() {
                $.ajax({
                    type: "POST",
                    url: "background_script.php",
                    success: function(response) {
                        console.log(response); // Print response to console
                        alert("Background process completed.");
                    }
                });
            });
        });
    </script>


</body>
</html>