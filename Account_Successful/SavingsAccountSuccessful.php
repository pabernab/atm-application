

<?php
session_start();



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

    // sql string to find current user's checking account number
    $savingsAccountNumber = "SELECT savingsAccountNumber FROM userRegistration WHERE userName = '$userName' ";
    $results = mysqli_query($mysqli, $savingsAccountNumber);
    $row = mysqli_fetch_assoc($results);


    $previousAccountNumber = $row['savingsAccountNumber'];
    if($results->num_rows > 0)
    {
        if(!empty($previousAccountNumber))
        {
            // echo "Error! No Savings Account to Close. ";
            $_SESSION['errorFour'] = "Error! No Savings Account to Close. ";
            header('Location: ../Balance/Balance.php');
        }
        else {
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
                }
            }

    else{
        
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
