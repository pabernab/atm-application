

<?php
session_start();


print_r($_SESSION);
$numb = rand(123456789101112, 200000000000000);
$savingsNumber = strval($numb);

$userName = $_SESSION["userName"];

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

    $setSavingsAccountNumber = "UPDATE userRegistration SET savingsAccountNumber = $savingsNumber, userSavingsAccountBalance = 0 WHERE userName = '{$_SESSION['userName']}' ";
    $userRoutingNumber = "SELECT userRoutingNumber FROM userRegistration WHERE userName = '{$_SESSION['userName']}' ";

    $results2 = mysqli_query($mysqli, $userRoutingNumber);
    $row2 = mysqli_fetch_assoc($results2);
    $routingNumber = $row2['userRoutingNumber'];

    $results = mysqli_query($mysqli, $setSavingsAccountNumber);


    if ($results)
    {
        echo "Information inserted.";
        $type = "Checking";
    }

    // making sure we were able to insert the information properly into
    // our MySQL database
  

 ?>
<!-- HTML HTML HTML HTML HTML HTML HTML HTML HTML ******************************** -->
<html>
    <head>
        <meta charset = "utf-8">
        <title>Savings Account Successful</title>
        <link rel = "stylesheet" href = "AccountSuccessful.css?v=<?php echo time(); ?>">
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
        <div class="greeting">Thank you for opening a savings account with us!</div>

        <!-- details: account/routing number/types -->
        <!-- Remove hardcode numbers & type, values should be from the the database -->
        <!-- Values here just for demonstration -->
        <div class="details">
            <div class="detailsElement">Details:</div>
            <div class="detailsElement">Savings Acccount Number: <?php echo htmlspecialchars($savingsNumber); ?></div>
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
