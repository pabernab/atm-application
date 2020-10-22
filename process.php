<?php

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];



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
    $stmt = $conn->prepare("insert into login_info(username, password, firstName, lastName) values(?, ?, ?, ?)");
		$stmt->bind_param("ssss", $username, $passowrd, $firstName, $lastName);
		$stmt->execute();
		echo "registration successful";
		$stmt->close();
		$conn->close();
  }

//$con->close();
















?>
