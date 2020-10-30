<?php
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
                    echo "<br>";
                    echo "\n\nInformation inserted into database.\n\n";
                    echo "<br>";
                    
                }

                // in the event we somehow were unable to insert the information
                // thus not being able to create the account
                else {
                    echo "<br>";
                    echo "Error: Information not inserted into database.";
                    echo "<br>";
                    echo "Those login credentials already exist in our database.";
                    echo "<br>";
                }
            }

            // if passwords don't match
            else {

                echo "<br>";
                echo "Both passwords must match.";
                echo "<br>";
            }

    }
    else {

        echo "<br>";
        echo "All forms must be filled.";
        echo "<br>";
    }
        // close connection
        mysqli_close($mysqli);
    

   
?>
