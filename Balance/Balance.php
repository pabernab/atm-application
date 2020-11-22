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

    $user = $_SESSION['username'];

    $setBalance = "SELECT userCheckingAccountBalance FROM userRegistration WHERE userName = $user ";
    $setSaving = "SELECT userSavingsAccountBalance FROM userRegistration WHERE userName = $user ";

    $results = mysqli_query($mysqli, $setBalance);
    $results2 = mysqli_query($mysqli, $setSaving);

    $row = mysqli_fetch_assoc($results);
    $row2 = mysqli_fetch_assoc($results2);

    $balance = $row['userCheckingAccountBalance'];
    $saving = $row2['userSavingsAccountBalance'];

?>






<html>
    <head>
        <meta charset = "utf-8">
        <title>Balance</title>
        <link rel = "stylesheet" href = "Balance.css">
    </head>





    <body>
        <!-- bank logo -->
        <header>
            <meta name="viewport" content="width=device-width">
            <img id = "logo" src="logo.png"/>
        </header>

        <!-- gray bar -->
        <div id="graybar"></div>

        <!-- deposit/withdraw & transfer & open account nagivations/
          empty divs are for layout purposes -->
        <nav id="nav_layout">
        <div id="column"></div>
        <div id="column"></div>


        <div id="column"><a class="nav_column" href="../PinPages/EnterPin2.php">Deposit/Withdrawal</a></div>

        <div id="column"><a class="nav_column" href="../PinPages/EnterPin.php">Transfer</a></div>


        <div id="column"><a class="nav_column">Open Account</a></div>


        <div id="column"></div>
        <div id="column"></div>
        </nav>

        <section class="sectionLayout">
            <!-- Checking Accounts -->
            <!-- Replace hard coded balance with php code -->
            <div class="barLayout">Checking Accounts</div>
            <div class="contentLayout">
                <div class="availableBalance">
                  $
                  <?php
                  // prints user's checking
                    echo htmlspecialchars($balance);

                  ?>


                    <br>
                    <a style="font-size: 50%;">Available Balance</a>
                </div>
                <div class="transferMoney"><a href="../PinPages/EnterPin.php">Transfer Money</a></div>
                <div class="transferMoney"><a href="#">Account Info</a></div>
            </div>


            <br>
            <!-- Savings Accounts -->
            <!-- Replace hard coded balance with php code -->
            <div class="barLayout">Savings Accounts</div>
            <div class="contentLayout">
                <div class="availableBalance">
                  $
                  <?php
                  // prints user's saving
                    echo htmlspecialchars($saving);

                  ?>


                    <br>
                    <a style="font-size: 50%;">Available Balance</a>
                </div>
                <div class="transferMoney"><a href="../PinPages/EnterPin.php">Transfer Money</a></div>
                <div class="transferMoney"><a href="#">Account Info</a></div>
            </div>

        </section>



    </body>
</html>
