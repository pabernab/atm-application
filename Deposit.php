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












//END CONNECTION
  mysqli_close($mysqli);


?>

<html>
  <head>
    <link rel = "stylesheet" href = "Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500;700&display=swap" rel="stylesheet">

    <title> Deposit </title>

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
        Deposit
        <br>
        <br>
        Upload File

        <br>

      </p>


    <!-- File input -->
    <form name = checker>
      <!-- <label for="myfile">Select a file:</label> -->
      <input type="file" id="myfile" name= "depositpic" accept= "image/png, image/jpeg">
    <form>

      <br>
      <br>
      <p class = "regularFont">
        Put in value between 0.00 to 4000.00
    </form>
      </p>
      <br>
      <br>

    <form name = "ValueInput">
      <input type = "number" name = "amount" min = "0.00" max = "4000.00" step = "0.01">
      <input type = "submit" value = "submit">
    </form>


      <br>

      <input type="submit" value = "Go Back">



    <center>
  </body>
<html>
