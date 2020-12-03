

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

// grabbing these from user login or user registration
$transferValue = $_POST["entryValue"];
$accountNumber = $_POST["inputValue"];

$mysqli->query(
"SELECT checkingAccountNumber 
FROM userRegistration 
WHERE checkingAccountNumber = $accountNumber;");

$accountExists = true;
if ($mysqli->affected_rows == 0 || $mysqli->affected_rows == -1){
    $accountExists = false;
    
}
// pull user name from login / registration form
$userName = $_SESSION["userName"];

// query to find current user's balance
$findAccountBalance =
"SELECT userCheckingAccountBalance
FROM userRegistration WHERE userName = '$userName';"
;

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

$currentUserCheckingAccountNumber =
"SELECT checkingAccountNumber from userRegistration
WHERE userName = '$userName';"
;

$currentUserCheckingResult = mysqli_query($mysqli, $currentUserCheckingAccountNumber);

$currentChecking = 0;

// query to find current user's checking account
// number and link it to variable $currentChecking
if ($currentUserCheckingResult->num_rows > 0){

    $row = $currentUserCheckingResult->fetch_assoc();

    $currentChecking = $row["checkingAccountNumber"];
}


//$userBalance = 0;

// variables to save for later
$currentBalance = $userBalance;


// sql query to update current user's balance
$updateCurrentUserBalances =

"UPDATE userRegistration
SET userCheckingAccountBalance = $currentBalance - $transferValue
WHERE userName = '$userName';"

;


$findTransferUserAccountBalance =
"SELECT userCheckingAccountBalance
FROM userRegistration
WHERE checkingAccountNumber = $accountNumber;"
;

$findTransferUserBalance = mysqli_query($mysqli, $findTransferUserAccountBalance);

$transferUserAccountBalance = 0;

// sql query to find the transfer recipient
if ($findTransferUserBalance->num_rows > 0 ){

    $row = $findTransferUserBalance->fetch_assoc();

    echo "<br>UserBalance: " . $row["userCheckingAccountBalance"];
    $transferUserAccountBalance = $row["userCheckingAccountBalance"];

}



// sql query to add to transfer recipient
$updateTransferUserBalances =

"UPDATE userRegistration
SET userCheckingAccountBalance = $transferUserAccountBalance + $transferValue
WHERE checkingAccountNumber = $accountNumber;"

;

// check that the current user's balance exceeds or equals the desire
// transfer value
// ALSO
// ensure current user is not sending money to themselves
// ALSO
// ensure recipient account exists
if ($currentBalance >= $transferValue){

    if ($currentChecking != $accountNumber){

        if ($accountExists == true){
            
            $results = mysqli_query($mysqli, $updateCurrentUserBalances);
        
            // if we were able to remove funds from the user
            if ($results){
        
                // then we can add the money to the transfer recipient
                $transferResults = mysqli_query($mysqli, $updateTransferUserBalances);
        
                // if we sucessfully removed funds from the user and transferred to the recipient
                if ($transferResults){
        
                  //Sets OrderID
                  $randomID = rand(1000000,9999999);
                  $_SESSION["ordernumber"] = $randomID;
                  // Grabs accountNumber's name
                  $sqlTo = "SELECT userName FROM userRegistration where checkingAccountNumber = $accountNumber";
                  $result1 = mysqli_query($mysqli, $sqlTo);
                  $row1 = mysqli_fetch_assoc($result1);
        
                  $accName = $row1['userName'];
        
                  //Adds to History
                  $sql1 = "INSERT into checkDeposit(userName,filePath,typess,amount,accountType) VALUES ('$accName',$randomID,'Transfer',$transferValue,'Checking')";
                  $results1 = mysqli_query($mysqli, $sql1);
                  $sql2 = "INSERT into checkDeposit(userName,filePath,typess,amount,accountType) VALUES ('$userName',$randomID,'Transfer',-$transferValue,'Checking')";
                  $results2 = mysqli_query($mysqli, $sql2);
        
        
                    // then we send user to transaction confirmation page
                    header('Location: ../Transaction_Confirmation/transactionconfirmation.php');
                    //echo "Sending you to transaction confirmation.";
                }
        
            }
            // couldn't transfer funds for some reason
            else {
                echo "<script> alert('Unable to transfer funds to recipient account.');
                window.setTimeout(() =>{
                    window.location.href = 'AccountName.php';
        
                }, 0);
                </script>";
            }
        }
        else {
             // alerts user 
            // timeout set to 
            echo "<script> alert('The account number you entered is invalid. Please enter a valid recipient account number.');
            window.setTimeout(() =>{
                window.location.href = 'AccountName.php';
    
            }, 0);
            </script>";
        }

    }
    else {
        // alerts user 
        // timeout set to 
        echo "<script> alert('You cannot send money to yourself. Please enter a valid, non-null recipient account number (that is not your own number.');
        window.setTimeout(() =>{
            window.location.href = 'AccountName.php';

        }, 0);
        </script>";
    }
    // remove funds from current user


}
else {
    // if the user tries to transfer more funds than they have in balance

    // alerts user 
    // timeout set to 0 for shortest redirect time
    echo "<script> 
    
    alert('You do not possess sufficient balance. Please enter a value less than or equal to your current balance.');
    window.setTimeout(() =>{
        window.location.href = 'AccountName.php';

    }, 0);
    </script>";
    
    
}







mysqli_close($mysqli);


?>
