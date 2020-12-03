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
    $checkingAccountNumber =
    "SELECT checkingAccountNumber
    FROM userRegistration
    WHERE userName = '$userName' ";

    // sql string to find current user's routing number
    $userRoutingNumber =
    "SELECT userRoutingNumber
    FROM userRegistration
    WHERE userName = '$userName' ";

    $results = mysqli_query($mysqli, $checkingAccountNumber);
    $results2 = mysqli_query($mysqli, $userRoutingNumber);

    $row = mysqli_fetch_assoc($results);
    $row2 = mysqli_fetch_assoc($results2);

    $previousAccountNumber = $row['checkingAccountNumber'];
    $routingNumber = $row2['userRoutingNumber'];

    $setCheckingToZero =

    "UPDATE userRegistration
    SET checkingAccountNumber = NULL
    WHERE userName = '$userName';";

    $checkingSetToZeroResult = mysqli_query($mysqli, $setCheckingToZero);

    // Set savings balance to 0 when close account
    $setCheckingBalanceToZero =
    "UPDATE userRegistration
    SET userCheckingAccountBalance = ''
    WHERE userName = '$userName';";

    $checkingBalanceSetToZeroResult = mysqli_query($mysqli, $setCheckingBalanceToZero);

    $eraseHistory = "DELETE from checkDeposit WHERE userName = '$userName' and accountType = 'Checking'";
    mysqli_query($mysqli, $eraseHistory);

    if ($checkingSetToZeroResult){

        echo "<br> checking set to 0.";

    }
    else {
        echo "<br> Couldn't delete account.";
    }
    $accountNumber = $row['checkingAccountNumber'];
?>






<html>
    <head>
        <meta charset = "utf-8">
        <title>Checking Account Information</title>
        <link rel = "stylesheet" href = "../Account_Successful/AccountSuccessful.css?v=<?php echo time(); ?>">
    </head>


    <body>
        <!-- bank logo -->
        <header>
            <meta name="viewport" content="width=device-width">
            <img id = "logo" src="logo.png"/>
        </header>


        <!-- gray bar -->
        <div id="graybar"></div>

        <!-- thank you message -->
        <div class="greeting">Checking Account Closed</div>

        <!-- details: account/routing number/types -->
        <!-- Remove hardcode numbers & type, values should be from the the database -->
        <!-- Values here just for demonstration -->
        <div class="details">
            <div class="detailsElement">Details:</div>
            <div class="detailsElement">Acccount Number: <?php echo htmlspecialchars($accountNumber); ?></div>
            <div class="detailsElement">Routing Number: <?php echo htmlspecialchars($routingNumber); ?></div>
            <div>Type: Checking</div>
        </div>


        <!-- homepage button -->
        <!-- replace '#' with url link to homepage -->
        <div class="homepageDiv">
            <button class="homepageButton" onclick="location.href='../Balance/Balance.php'">Return to Homepage</button>
        </div>
    </body>
</html>
