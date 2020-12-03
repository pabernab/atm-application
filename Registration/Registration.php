


<?php

session_start();

if(! empty($_SESSION['error']))
{
  echo "<script>";
  echo "alert('There is already an account associated with this username. Please try again.');";
  echo "</script>";
 unset($_SESSION['error']);
}



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


    // all forms are properly filled and no null submissions
    if (isset($_POST["userName"])
        && isset($_POST["userPassword"])
        && isset($_POST["userEmailAddress"])
        && isset($_POST["userFirstName"])
        && isset($_POST["userLastName"])
        && isset($_POST["repassword"])){

            // simple test pathing
            echo "<br>";
            echo "All forms are set";
            echo "<br>";


            // making sure both passwords are equal
            if ($_POST["userPassword"] == $_POST["repassword"]){

                // simple test pathing
                echo "<br>";
                echo "Passwords are equal";
                echo "<br>";

                // data points we will be inserting into the database
                // pulled from the registration form
                $userName = $_POST["userName"];
                $userPassword = $_POST["userPassword"];
                $userEmailAddress = $_POST["userEmailAddress"];
                $userFirstName = $_POST["userFirstName"];
                $userLastName = $_POST["userLastName"];

                $_SESSION["userName"] = $userName;
                $_SESSION["userPassword"] = $userPassword;


                // simple sql syntax to insert into our registration
                // database, formatted for visual clarity
                $sql = "INSERT into userRegistration (
                    userName,
                    userPassword,
                    userEmailAddress,
                    userFirstName,
                    userLastName
                ) 	VALUES (
                    '$userName',
                    '$userPassword',
                    '$userEmailAddress',
                    '$userFirstName',
                    '$userLastName'
                )";

                // querying our connected database with the given data points
                // inserting form information
                $results = mysqli_query($mysqli, $sql);

                // making sure we were able to insert the information properly into
                // our MySQL database
                if ($results){
                  header('Location: ../PinPages/CreatePin.php');
                }

                // in the event we somehow were unable to insert the information
                // thus not being able to create the account
                else {
                  $_SESSION['error'] = true; 
                   header('Location: Registration.php');
                }
            }

            // if passwords don't match
            else {
              //password is checked by js. if it reaches this then something is definitely wrong
              echo('Something went wrong');
                
            }

    }
    else {

    }
        // close connection
        mysqli_close($mysqli);



?>


<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500;700&display=swap" rel="stylesheet">
    <link rel = "stylesheet" href = "Regi-styles.css?v=<?php echo time(); ?>">

    <title> Registration</title>

  </head>

  <body>
    <!-- Enables javaScript -->
    <script src="Checker.js"></script>
    <header>
      <meta name="viewport" content="width=device-width">
        <img id = "logo" src="logo.png"/>
    </header>

    <div id="graybar">
    </div>

    <h1><center>First things first,</center></h1>

    <!-- <br>
    First Name:
    <br>
    Last Name: -->

      <form action="" method="post" name = "myForm">

        <div class = "row">
          <!-- LEFT -->
          <div class = "column">
            <div class = "a">
                First name
                <br>
                <br>
                <div class = "b">
                  <input type="text" name="userFirstName" required>
                </div>
                <br>
                <br>
                <br>
                Last Name
                <br>
                <br>
                <div class = "b">
                  <input type="text" name="userLastName" required>
                </div>
                <br>
                <br>
                <br>
                <div class = "e">
                  Email
                </div>
                <br>

                  <div class = "d">
                      <input type="text" name="userEmailAddress" required>
                  </div>
                <br>
                <br>
                <br>
              </div>
          </div>




          <!-- Right -->
          <div class="column">

              <div class = "a">
              Username
              <br>
              <br>

                <div class = "b">
                  <input type="text" name="userName" required>
                </div>

              <br>

              <br>
              Password
              <br>
              <br>
                <div class = "b">
                  <input type="password" name="userPassword" required>
                </div>
              <br>
              <br>
              <br>
                <div class = "c">
                  Re-enter Password
                </div>
              <br>

                <div class = "d">
                  <input type="password" name="repassword" required>
                </div>
              <br>
              <br>
              <br>

              <br>
              <br>
              </div>


          </div>

          <!-- Can some one explain why the Create Account button is pointing to this html file? -->
          <!-- I set it to point to CreatPin.php file -->
          <center>
            <button id = "CreateButton" type = 'submit' onclick="return submission();" value = "Create Account" > Create Account </button>
            <!-- <input id ="CreateButton" onclick="location.href='../PinPages/CreatePin.php'" type="submit" value = "Create Account" onclick="return submission();" > -->
          </center>

      </form>
      <br>

  </body>
<html>
