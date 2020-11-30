<?php


session_start();

print_r($_SESSION);

//CONNECTING SERVER
$serverEndpoint = 'mysqldb.cjezeavsieu7.us-west-1.rds.amazonaws.com';
$serverUserName = 'butteadmin';
$serverPassword = 'buttecmpe131';
$dbname = 'registration';

// creating a new server connection using our preset AWS login values
$conn = new mysqli($serverEndpoint, $serverUserName, $serverPassword, $dbname, 3306);

// simple error catch if we are unable to connect to the MySQL Database
if ($conn->connect_errno) {
  echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}

$name = $_SESSION['userName'];
$randomID = $_SESSION["ordernumber"];
?>


<html>
  <head>
    <link rel = "stylesheet" href = "Style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500;700&display=swap" rel="stylesheet">

    <title> Transaction Confirmation </title>

  </head>

  <body>

    <header>
        <img id = "logo" src="logo.png"/>
    </header>

    <div id="graybar">
    </div>

    <center>
      <br><br><br><br>
      <p class = "regularFont">
        You're all done.
      </p>

      <p class = "regularAmount">
        <?php
        if(isset($_POST["entryValue"]) && isset($_POST["inputValue"])){

          $_SESSION["entryValue"] = $_POST["entryValue"];
          $_SESSION["inputValue"] = $_POST["inputValue"];
        }

        $amountTransferred = $_SESSION["entryValue"];
        $tranfserAccount = $_SESSION["inputValue"];
        echo 'Amount transferred: $' . $amountTransferred . "<br>";
        echo 'To Account Number: ' .$tranfserAccount . "<br>";


        ?>
      </p>

      <p class = "regularFont">
        Type: Transfer
        <br>
        <br>
        Transaction ID:
        <?php
          echo $randomID ;
        ?>
      </p>
      <br>
      <form action="../Balance/Balance.php">
        <input type="submit" value = "Return to Homepage">

      </form>
    </center>


    <center>
  </body>
<html>
