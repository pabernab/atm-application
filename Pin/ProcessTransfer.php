<?php
    

    
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
   
    $userName = $_SESSION["userName"];
    $getTransferValue = $_POST["inputValue"];
    // need to somehow track current user so we know who to 
    // modify value of ? 
    // @Paul change value where userName = 
    // using sessions
    $updateBalances = 
    "UPDATE userRegistration
    SET userCheckingAccountBalance = $currentBalance - $getTransferValue
    WHERE userName = '$userName';";

    // querying our connected database with the given data points
    // inserting form information
    $results = mysqli_query($mysqli, $updateBalances);
    //$secondResults = mysqli_query($mysqli, $myTestStatement);

    //echo $myTestStatement . "<br>";

    echo "result :" . $results . "<br>";
    // making sure we were able to insert the information properly into
    // our MySQL database
    if ($results){
        echo "<br>";
        echo "Transfer Processed.\n\n";
        echo "<br>";
        
    }

    // in the event we somehow were unable to insert the information
    // thus not being able to create the account
    else {
        echo "<br>";
        echo "Could not process transfer.";
    }
            

    
    // close connection
    mysqli_close($mysqli);

?>
