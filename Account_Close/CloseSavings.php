<?php

session_start();

print_r($_SESSION);

// these are our login values associated with the AWS
    // database instance, found here:
    // https://us-west-1.console.aws.amazon.com/rds/home?region=us-west-1#database:id=mysqldb;is-cluster=false
    $serverEndpoint = 'mysqldb.cjezeavsieu7.us-west-1.rds.amazonaws.com';
    $serverUserName = 'butteadmin';
    $serverPassword = 'buttecmpe131';
    $dbname = 'registration';

    // creating a new server connection using our preset AWS login values
    $mysqli = new mysqli($serverEndpoint, $serverUserName, $serverPassword, $dbname, 3306);

    // simple error catch if we are unable to connect to the MySQL Database
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    // test display of host connection info
    // echo $mysqli->host_info . "\n";

    $userName = $_SESSION['userName'];

    // sql string to find current user's checking account number
    $savingsAccountNumber = "SELECT savingsAccountNumber FROM userRegistration WHERE userName = '$userName' ";

    // sql string to find current user's routing number
    $userRoutingNumber = "SELECT userRoutingNumber FROM userRegistration WHERE userName = '$userName' ";

    $results = mysqli_query($mysqli, $savingsAccountNumber);
    $results2 = mysqli_query($mysqli, $userRoutingNumber);

    $row = mysqli_fetch_assoc($results);
    $row2 = mysqli_fetch_assoc($results2);

    $previousAccountNumber = $row['savingsAccountNumber'];
    $routingNumber = $row2['userRoutingNumber'];

    if($results->num_rows > 0)
    {
        if(empty($previousAccountNumber))
        {
            // echo "Error! No Savings Account to Close. ";
            $_SESSION['error'] = "Error! No Savings Account to Close. ";
            header('Location: ../Balance/Balance.php');
        }
    }

    else{

    }

    $setSavingsToZero =
    "UPDATE userRegistration
    SET savingsAccountNumber = NULL
    WHERE userName = '$userName';";

    $savingsSetToZeroResult = mysqli_query($mysqli, $setSavingsToZero);


    // Set savings balance to 0 when close account
    $setSavingsBalanceToZero =
    "UPDATE userRegistration
    SET userSavingsAccountBalance = ''
    WHERE userName = '$userName';";

    $savingsBalanceSetToZeroResult = mysqli_query($mysqli, $setSavingsBalanceToZero);

    $eraseHistory = "DELETE from checkDeposit WHERE userName = '$userName' and accountType = 'Savings'";
    mysqli_query($mysqli, $eraseHistory);

    if ($savingsSetToZeroResult){

        echo "<br> savings set to 0.";

    }
    else {
        echo "<br> Couldn't delete account.";
    }
    $savingsAccountNumber = $row['savingsAccountNumber'];
?>






<html>
    <head>
        <meta charset = "utf-8">
        <title>Savings Account Information</title>
        <link rel = "stylesheet" href = "../Account_Successful/AccountSuccessful.css?v=<?php echo time(); ?>">
    </head>

    <?php

print_r($_SESSION);


?>
    <body>
        <!-- bank logo -->
        <header>
            <meta name="viewport" content="width=device-width">
            <img id = "logo" src="logo.png"/>
        </header>


        <!-- gray bar -->
        <div id="graybar"></div>

        <!-- thank you message -->
        <div class="greeting">Savings Account Closed</div>

        <!-- details: account/routing number/types -->
        <!-- Remove hardcode numbers & type, values should be from the the database -->
        <!-- Values here just for demonstration -->
        <div class="details">
            <div class="detailsElement">Details:</div>
            <div class="detailsElement">Acccount Number: <?php echo htmlspecialchars($savingsAccountNumber); ?></div>
            <div class="detailsElement">Routing Number: <?php echo htmlspecialchars($routingNumber); ?></div>
            <div>Type: Savings</div>
        </div>


        <!-- homepage button -->
        <!-- replace '#' with url link to homepage -->
        <div class="homepageDiv">
            <button class="homepageButton" onclick="location.href='../Balance/Balance.php'">Return to Homepage</button>
        </div>
    </body>
</html>
