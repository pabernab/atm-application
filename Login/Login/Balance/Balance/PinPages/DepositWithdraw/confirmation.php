<?php

//CONNECTING SERVER
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

$sql1 = "SELECT userCheckingAccountBalance FROM userRegistration WHERE userName = 'AllenB'";

$results1 = mysqli_query($mysqli,$sql1);
$row1 = mysqli_fetch_assoc($results1);

echo $row1['userCheckingAccountBalance'];
echo "100";

//END CONNECTION
mysqli_close($mysqli);


?>
