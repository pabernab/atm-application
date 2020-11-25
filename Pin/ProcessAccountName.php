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
// pull user name from login / registration form
$userName = $_SESSION["userName"];

// query to find current user's balance
$findAccountBalance = "SELECT userCheckingAccountBalance from userRegistration where userName = '$userName';";

// query to find 
$resultBalance = mysqli_query($mysqli, $findAccountBalance);

$userBalance = 0;
// query to find current user's balance and link it to variable $userBalance
if ($resultBalance->num_rows > 0 ){

    $row = $resultBalance->fetch_assoc();

    echo "<br>UserBalance: " . $row["userCheckingAccountBalance"];
    $userBalance = $row["userCheckingAccountBalance"];
    
}
else {
    echo "<br> Row is 0.";
}

// grabbing these from user login or user registration
$transferValue = $_POST["entryValue"];
$accountNumber = $_POST["inputValue"];

// echo "<br> TransferValue:   $transferValue <br>";
// echo "<br> AccountNumber: $accountNumber <br>";

// echo "<br> Transfer value: " . $transferValue . "<br>Account number: " . $accountNumber . "<br>";

// variables to save for later
$currentBalance = $userBalance;
$postBalance = $currentBalance - $transferValue;

// sql query to update current user's balance
$updateCurrentUserBalances = 

"UPDATE userRegistration
SET userCheckingAccountBalance = $currentBalance - $transferValue
WHERE userName = '$userName';";


$findTransferUserAccountBalance = 
"SELECT userCheckingAccountBalance 
FROM userRegistration 
WHERE checkingAccountNumber = $accountNumber;";

$findTransferUserBalance = mysqli_query($mysqli, $findTransferUserAccountBalance);

$transferUserAccountBalance = 0;

// sql query to find the transfer recipient 
if ($findTransferUserBalance->num_rows > 0 ){

    $row = $findTransferUserBalance->fetch_assoc();

    echo "<br>UserBalance: " . $row["userCheckingAccountBalance"];
    $transferUserAccountBalance = $row["userCheckingAccountBalance"];
    
}
else {
    echo "<br> Row is 0.";
}

// sql query to add to transfer recipient 
$updateTransferUserBalances =

"UPDATE userRegistration
SET userCheckingAccountBalance = $transferUserAccountBalance + $transferValue
WHERE checkingAccountNumber = $accountNumber;";


echo "Updating balance<br><br>" . "Current Balance: $currentBalance <br>" . "Post Transfer Balance: $postBalance <br>";

// querying our connected database with the given data points
// inserting form information

if ($currentBalance >= $transferValue){
    $results = mysqli_query($mysqli, $updateCurrentUserBalances);
    
    // if we were able to remove funds from the user 
    if ($results){
        
        // then we can add the money to the transfer recipient
        $transferResults = mysqli_query($mysqli, $updateTransferUserBalances);

        // if we sucessfully removed funds from the user and transferred to the recipient
        if ($transferResults){
                
            // send user to transaction confirmation page
            header('Location: ../Transaction_Confirmation/transactionconfirmation.php');
            echo "Sending you to transaction confirmation.";
        }
        
    }
    
    // couldn't transfer funds for some reason
    else {
        echo "<br>";
        echo "Error: Information not inserted into database.";
        echo "<br>";
        header('Location: AccountName.php');
        echo "<br>";
    }

}
else {
    // if the user tries to transfer more funds than they have in balance
    echo "Current balance must exceed or equal transfer value. <br>";
    header('Location: AccountName.php');
}







mysqli_close($mysqli);


?>
