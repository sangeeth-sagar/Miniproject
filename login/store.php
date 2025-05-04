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
    $typeAPL = "apl";
    $cardno = "bpl";
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

    $cardno = $_POST['cardno']; // Assuming cardno is passed via POST method
$currentDate = "2024-05-01"; 

// Fetch the type based on cardno
$sqlGetcardno ="SELECT type FROM rationcard WHERE cardno = $cardno";
$stmtGetcardno =$conn->prepare($sqlGetType);
$stmtGetType->bindParam(':cardno', $cardno, PDO::PARAM_STR);
$stmtGetType->execute();
$result = $stmtGetType->fetch(PDO::FETCH_ASSOC);
$cardno= $result['type'];

if ($cardno= "apl") {
    // Update for APL type
    $sqlAPL = "UPDATE ration_card SET mattarice = :mattaRiceValueAPL, kuruvarice = :kuruvaRiceValueAPL, whiterice = :whiteRiceValueAPL, kerosene = :keroseneValueAPL WHERE cardno = :cardno";
    $stmtAPL = $conn->prepare($sqlAPL);
    $stmtAPL->bindParam(':mattaRiceValueAPL', $mattaRiceValueAPL, PDO::PARAM_INT);
    $stmtAPL->bindParam(':kuruvaRiceValueAPL', $kuruvaRiceValueAPL, PDO::PARAM_INT);
    $stmtAPL->bindParam(':whiteRiceValueAPL', $whiteRiceValueAPL, PDO::PARAM_INT);
    $stmtAPL->bindParam(':keroseneValueAPL', $keroseneValueAPL, PDO::PARAM_INT);
    $stmtAPL->bindParam(':cardno', $cardno, PDO::PARAM_STR);
    $stmtAPL->execute();

    // Reset rice values for APL type
    $sqlResetRiceAPL = "UPDATE ration_card SET mattarice = 0, kuruvarice = 0, whiterice = 0, last_reset_rice = :currentDate WHERE cardno = :cardno AND DATEDIFF(:currentDate, last_reset_rice) >= :resetMattaRiceDays";
    $stmtResetRiceAPL = $conn->prepare($sqlResetRiceAPL);
    $stmtResetRiceAPL->bindParam(':cardno', $cardno, PDO::PARAM_STR);
    $stmtResetRiceAPL->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);
    $stmtResetRiceAPL->bindParam(':resetMattaRiceDays', $resetMattaRiceDays, PDO::PARAM_INT);
    $stmtResetRiceAPL->execute();

    // Reset kerosene value for APL type
    $sqlResetKeroseneAPL = "UPDATE ration_card SET kerosene = 0, last_reset_kerosene = :currentDate WHERE cardno = :cardno AND DATEDIFF(:currentDate, last_reset_kerosene) >= :resetKeroseneDays";
    $stmtResetKeroseneAPL = $conn->prepare($sqlResetKeroseneAPL);
    $stmtResetKeroseneAPL->bindParam(':cardno', $cardno, PDO::PARAM_STR);
    $stmtResetKeroseneAPL->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);
    $stmtResetKeroseneAPL->bindParam(':resetKeroseneDays', $resetKeroseneDays, PDO::PARAM_INT);
    $stmtResetKeroseneAPL->execute();
}
elseif ($type == "bpl") {
    // Update for BPL type
    $sqlBPL = "UPDATE ration_card SET mattarice = :mattaRiceValueBPL, kuruvarice = :kuruvaRiceValueBPL, whiterice = :whiteRiceValueBPL, kerosene = :keroseneValueBPL, atta = :attaValueBPL, wheat = :wheatValueBPL WHERE cardno :cardno";
    $stmtBPL = $conn->prepare($sqlBPL);
    $stmtBPL->bindParam(':mattaRiceValueBPL', $mattaRiceValueBPL, PDO::PARAM_INT);
    $stmtBPL->bindParam(':kuruvaRiceValueBPL', $kuruvaRiceValueBPL, PDO::PARAM_INT);
    $stmtBPL->bindParam(':whiteRiceValueBPL', $whiteRiceValueBPL, PDO::PARAM_INT);
    $stmtBPL->bindParam(':keroseneValueBPL', $keroseneValueBPL, PDO::PARAM_INT);
    $stmtBPL->bindParam(':attaValueBPL', $attaValueBPL, PDO::PARAM_INT);
    $stmtBPL->bindParam(':wheatValueBPL', $wheatValueBPL, PDO::PARAM_INT);
    $stmtBPL->bindParam(':cardno', $cardno, PDO::PARAM_STR);
    $stmtBPL->execute();

    // Reset filled columns for BPL type
    $sqlResetBPL = "UPDATE ration_card SET mattarice = (SELECT MAX(mattarice) FROM ration_card WHERE cardno = :cardno), 
                    kuruvarice = (SELECT MAX(kuruvarice) FROM ration_card WHERE cardno :cardno), 
                    whiterice = (SELECT MAX(whiterice) FROM ration_card WHERE cardno :cardno), 
                    atta = (SELECT MAX(atta) FROM ration_card WHERE cardno :cardno), 
                    wheat = (SELECT MAX(wheat) FROM ration_card WHERE cardno :cardno), 
                    last_reset_filled = :currentDate WHERE cardno :cardno AND DATEDIFF(:currentDate, last_reset_filled) >= :resetDays";
    $stmtResetBPL = $conn->prepare($sqlResetBPL);
    $stmtResetBPL->bindParam(':cardno', $cardno, PDO::PARAM_STR);
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
