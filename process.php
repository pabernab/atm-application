Skip to content
Search or jump to…

Pull requests
Issues
Marketplace
Explore
 
@pabernab 
Learn Git and GitHub without any code!
Using the Hello World guide, you’ll start a branch, write comments, and open a pull request.


pabernab
/
atm-application
Private
3
23
Code
Issues
Pull requests
Actions
Projects
1
Wiki
Security
Insights
Settings
atm-application/process.php
@lukebrouwer2000
lukebrouwer2000 another round of big changes
…
Latest commit 9ad9322 7 days ago
 History
 2 contributors
@pabernab@lukebrouwer2000
113 lines (90 sloc)  3.82 KB
  
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
        && isset($_POST["userPassword"])) 

        {
       

            // simple test pathing
            echo "<br>";
            echo "All forms are set";
            echo "<br>";


    

                // simple test pathing
                echo "<br>";
                echo "Passwords are equal";
                echo "<br>";
    
                // data points we will be selecting from the database
                $userName = $_POST["userName"];
                $userPassword = $_POST["userPassword"];
    
    
                // simple sql syntax to select the corresponding username and password
                // database, formatted for visual clarity
                $sql = "SELECT userName, userPassword
                FROM `registration`.`userRegistration`
                WHERE userName = $userName AND userPassword = $userPassword;
                )";
            
                // querying our connected database with the given data points
                // selecting form information
                $results = mysqli_query($mysqli, $sql);
    
                // making sure we were able to find the information properly from
                // our MySQL database
                if ($results){
                    echo "<br>";
                    echo "\n\nLogin successful.\n\n";
                    echo "<br>";
                    
                }

               // in the event that the username/password combo is wrong
                else {
                    echo "<br>";
                    echo "Username and/or password is incorrect.";
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
© 2020 GitHub, Inc.
Terms
Privacy
Security
Status
Help
Contact GitHub
Pricing
API
Training
Blog
About
