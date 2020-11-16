<?php

// CONNECTING SERVER
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

//AccountNumber
$checkAcc = $_POST["checkingAccountNumber"];
//It's balance
$MaxBalance = $_POST["userCheckingAccountBalance"];









//END CONNECTION
  mysqli_close($mysqli);


?>

<html>
  <head>
    <link rel = "stylesheet" href = "Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500;700&display=swap" rel="stylesheet">

    <title> Withdraw </title>

  </head>

  <body>

    <header>
        <img id = "logo" src="logo.png"/>
    </header>

    <div id="graybar">
    </div>

    <br><br>
    <!-- TITLE -->
    <center>

      <p class = regularFont>
        Withdraw
      </p>


    <!-- File input -->

      <p class = "regularFont">
        Put in value between 0.00 to 4000.00
      </p>

      <br>
      <br>

    </form>


    <!-- When you take out money -->
    <form action="/Project/Withdraw.php" method="post">
      <input type = "number" name = "amount" min = "0.00" max = "4000.00" step = "0.01">
      <input type = "submit" value = "submit">
    </form>


      <br>

      <input type="submit" value = "Go Back">



    <center>
  </body>
<html>
