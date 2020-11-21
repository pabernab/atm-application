
<?php
session_start();

print_r($_SESSION);


$pinValue = '2222';

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



    if(isset($_POST["pinValue"]))
    {

        $pinValue = $_POST["pinValue"];
        

        $setPin = "UPDATE userRegistration SET userPinNumber = '$pinValue' WHERE userName = '{$_SESSION['userName']}' ";
    
    
        $results = mysqli_query($mysqli, $setPin);
    
        if ($results)
        {
            header('Location: ../../../Registration/AccountCreation/AccountCreation.php');
        }

        else
        {
            echo "Something isnt working";
        }
    }



    // making sure we were able to insert the information properly into
    // our MySQL database
  












 ?>






<html>
    <head>
        <meta charset = "utf-8">
        <title>PIN Creation</title>
        <link rel = "stylesheet" href = "Pin/Pin.css">
    </head>


    <body>
        <!-- bank logo -->
        <header>
            <meta name="viewport" content="width=device-width">
            <img id = "logo" src="Pin/logo.png"/>
        </header>


        <!-- gray bar -->
        <div id="graybar"></div>

        <!-- thank you message -->
        <div class="greeting">Please create a 4 digit PIN:</div>

        <!-- details: account/routing number/types -->
        <!-- Remove hardcode numbers & type, values should be from the the database -->
        <!-- Values here just for demonstration -->
        <div class="textbox">
            <form action= "" method="post">
                <input type="text" class="resizeTextbox" name="pinValue">

                       <!-- Continue button -->
        <!-- replace '#' with url link -->
        <div class="homepageDiv">
            <button href="#" type="submit" class="homepageButton">Continue</button>
        </div>

            </form>
        </div>


        


 


    </body>
</html>
