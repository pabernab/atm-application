

<?php
session_start();
if(isset($_POST["entryValue"])){

    $_SESSION["entryValue"] = $_POST["entryValue"];

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
$findAccountBalance =
"SELECT userSavingsAccountBalance
FROM userRegistration WHERE userName = '$userName';"
;

// query to find
$resultBalance = mysqli_query($mysqli, $findAccountBalance);

$userBalance = 0;

// query to find current user's balance and link it to variable $userBalance
if ($resultBalance->num_rows > 0 ){

    $row = $resultBalance->fetch_assoc();

    echo "<br>UserBalance: " . $row["userSavingsAccountBalance"];
    $userBalance = $row["userSavingsAccountBalance"];

}
else {
    echo "<br> Row is 0.";
}


//$userBalance = 0;

// grabbing these from user login or user registration
$transferValue = $_POST["entryValue"];



// variables to save for later
$currentBalance = $userBalance;


// sql query to update current user's balance
$updateCurrentUserBalances =

"UPDATE userRegistration
SET userSavingsAccountBalance = $currentBalance - $transferValue
WHERE userName = '$userName';"

;


$findTransferUserAccountBalance =
"SELECT userCheckingAccountBalance
FROM userRegistration
WHERE userName = '$userName';"
;

$findTransferUserBalance = mysqli_query($mysqli, $findTransferUserAccountBalance);

$transferUserAccountBalance = 0;

// sql query to find the transfer recipient
if ($findTransferUserBalance->num_rows > 0 ){

    $row = $findTransferUserBalance->fetch_assoc();

    $transferUserAccountBalance = $row["userCheckingAccountBalance"];

}
else {
    echo "<br> Row is 0.";
}

// sql query to add to transfer recipient
$updateTransferUserBalances =

"UPDATE userRegistration
SET userCheckingAccountBalance = $transferUserAccountBalance + $transferValue
WHERE userName = '$userName';"

;








// check that the current user's balance exceeds or equals the desire
// transfer value


if ($currentBalance >= $transferValue){

    // remove funds from current user
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
          //Adds to History
          $sql1 = "INSERT into checkDeposit(userName,filePath,typess,amount,accountType) VALUES ('$userName',$randomID,'Transfer',$transferValue,'Checking')";
          $results1 = mysqli_query($mysqli, $sql1);
          $sql2 = "INSERT into checkDeposit(userName,filePath,typess,amount,accountType) VALUES ('$userName',$randomID,'Transfer',-$transferValue,'Savings')";
          $results2 = mysqli_query($mysqli, $sql2);


            // then we send user to transaction confirmation page
            header('Location: ../Transaction_Confirmation/transactionconfirmation2.php');
            echo "Sending you to transaction confirmation.";
        }

    }

    // couldn't transfer funds for some reason
    else {
        // echo '<script type="text/javascript">',
        //                  'jsAlert();',
        //                  '</script>'
        // ;
        echo '<span style="color:RED;text-align:center;">ERROR: The amount you entered is greater than the amount you have.</span>';
    }

}
else {
    // if the user tries to transfer more funds than they have in balance

    // echo '<script type="text/javascript">',
    //                      'jsAlert();',
    //                      '</script>'
    // ;
    echo '<span style="color:RED;text-align:center;">ERROR: The amount you entered is greater than the amount you have.</span>';
}







mysqli_close($mysqli);


?>
