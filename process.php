<?php

$firstname = $_POST['firstName'];


//database connection

$host="mysqldb.cjezeavsieu7.us-west-1.rds.amazonaws.com";
$port=3306;
$socket="";
$user="butteadmin";
$password="";
$dbname="bank_schema";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

  else
  {
    $stmt = $conn->prepare("insert int")
  }

//$con->close();
















?>
