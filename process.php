<?php





//database connection

$host="mysqldb.cjezeavsieu7.us-west-1.rds.amazonaws.com";
$user="butteadmin";
$password="buttcmpe131";
$dbname="bank_schema";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

//Register users

$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$registration_query = "INSERT INTO $dbname (password, username, firstName, lastName) VALUES ('$password', '$username','$firstName','$lastName')";
mysqli_query($conn,$registration_query);








$host="mysqldb.cjezeavsieu7.us-west-1.rds.amazonaws.com";
$port=3306;
$socket="";
$user="butteadmin";
$password="";
$dbname="bank_schema";



//$con->close();












?>
