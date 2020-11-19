<?php
session_start();
if(isset($_POST["entryValue"]) && isset($_POST["inputValue"])){

    $_SESSION["entryValue"] = $_POST["entryValue"];
    $_SESSION["inputValue"] = $_POST["inputValue"];
}


$serverEndpoint = 'mysqldb.cjezeavsieu7.us-west-1.rds.amazonaws.com';
$serverUserName = 'butteadmin';
$serverPassword = 'buttecmpe131';
$dbname = 'registration';

// creating a new server connection using our preset AWS login values
$mysqli = new mysqli($serverEndpoint, $serverUserName, $serverPassword, $dbname, 3306);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

// accept form value
// @paul use sessions to change this checkingAccountNumber
$findAccountBalance = 'SELECT userCheckingAccountBalance from userRegistration where checkingAccountNumber = "23481698419";';

$resultBalance = mysqli_query($mysqli, $findAccountBalance);

$userBalance = 0;
if ($resultBalance->num_rows > 0 ){

    $row = $resultBalance->fetch_assoc();

    echo "<br>UserBalance: " . $row["userCheckingAccountBalance"];
    $userBalance = $row["userCheckingAccountBalance"];
    
}
else {
    echo "<br> Row is 0.";
}
$transferValue = $_POST["entryValue"];
$accountNumber = $_POST["inputValue"];

echo "<br> TransferValue:   $transferValue <br>";
echo "<br> AccountNumber: $accountNumber <br>";

echo "<br> Transfer value: " . $transferValue . "<br>Account number: " . $accountNumber . "<br>";
$currentBalance = $userBalance;
$postBalance = $currentBalance - $transferValue;

// need to somehow track current user so we know who to 
// modify value of ? 
$updateBalances = 
"UPDATE userRegistration
SET userCheckingAccountBalance = $currentBalance - $transferValue
WHERE checkingAccountNumber = '$accountNumber';";

echo "Updating balance<br><br>" . "Current Balance: $currentBalance <br>" . "Post Transfer Balance: $postBalance <br>";

// querying our connected database with the given data points
// inserting form information
$results = mysqli_query($mysqli, $updateBalances);


if ($currentBalance > $transferValue){

    if ($results){
        echo "<br>";
        echo "\n\nTransfer complete. Balance has been updated.\n\n";
        echo "<br>";
        header('Location: ../transactionconfirmation/transactionconfirmation.php');
        
    }
    
    // in the event we somehow were unable to insert the information
    // thus not being able to create the account
    else {
        echo "<br>";
        echo "Error: Information not inserted into database.";
        echo "<br>";
        
        echo "<br>";
    }

}
else {

    echo "Current balance must exceed transfer value. <br>";
}







mysqli_close($mysqli);


?>
