<?php
session_start();


?>
<html>
    <head>
        <meta charset = "utf-8">
        <title>Pin Validation</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500;700&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href = "../Pin/Pin.css?v=<?php echo time(); ?>">

    </head>


    <body>
        <!-- bank logo -->
        <header>
            <meta name="viewport" content="width=device-width">
            <img id = "logo" src="../Pin/logo.png"/>
        </header>


        <!-- gray bar -->
        <div id="graybar"></div>

        <!-- thank you message -->
        <div class="greeting">Please enter your PIN:</div>

        <!-- details: account/routing number/types -->
        <!-- Remove hardcode numbers & type, values should be from the the database -->
        <!-- Values here just for demonstration -->
        <div class="textbox">
            <form method="POST">
                <input class="resizeTextbox" type="password" id="pinValue" name="pinValue" maxlength="4" pattern = ".{4}" title="The PIN must be 4 characters long.">
                 <!-- Continue button -->
                <div class="homepageDiv">
                    <button href="#" type="submit" class="homepageButton">Continue</button>
                </div>
            </form>
            
                <!-- Back button -->
                <div>
                    <button class="homepageButton" onclick="location.href='../Balance/Balance.php'">Back</button>
                </div>
        </div>

        <script>
            function checkPin()
            {
                var x = document.getElementById("pinValue").value;
            }



        </script>



    </body>
</html>


<?php


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

    // simple error catch if we are unable to connect to the MySQL Database
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    // test display of host connection info
    // echo $mysqli->host_info . "\n";

      

$pinCorrect = false;

    if(isset($_POST["pinValue"]))
    {

        $pinValue = $_POST["pinValue"];


        $setPin = "SELECT userPinNumber FROM userRegistration WHERE userName = '$userName';";


        $results = mysqli_query($mysqli, $setPin);

        $pin  = 0;

        if ($results)
        {
            $row = mysqli_fetch_assoc($results);
                if ($row["userPinNumber"] === $pinValue)
                {
                  $pinCorrect = true;
                  header('Location: ../Pin/AccountName.php');
                }

                else
                {
                    
                    echo "<script>";
                    echo "alert('The pin is incorrect.');";
                    echo "</script>";
                }

        }

        else
        {
            echo "Something isnt working";
        }

    }




    // making sure we were able to insert the information properly into
    // our MySQL database













 ?>




