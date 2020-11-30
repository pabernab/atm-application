<html>
    <head>
        <meta charset = "utf-8">
        <title>Account Successful</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500;700&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href = "Pin.css?v=<?php echo time(); ?>">
    </head>


    <body>
        <!-- bank logo -->
        <header>
            <meta name="viewport" content="width=device-width">
            <img id = "logo" src="logo.png"/>
        </header>

        
        <!-- gray bar -->
        <div id="graybar"></div>

        <!-- thank you message -->
        <div class="greeting">Please enter the Transfer amount:</div>
        <?php
        session_start();
        $serverEndpoint = 'mysqldb.cjezeavsieu7.us-west-1.rds.amazonaws.com';
        $serverUserName = 'butteadmin';
        $serverPassword = 'buttecmpe131';
        $dbname = 'registration';

        // creating a new server connection using our preset AWS login values
        $mysqli = new mysqli($serverEndpoint, $serverUserName, $serverPassword, $dbname, 3306);

        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        // pull user name from login / registration form
        $userName = $_SESSION["userName"];

        // query to find current user's balance
        $findAccountBalance = 
        "SELECT userCheckingAccountBalance 
        FROM userRegistration WHERE userName = '$userName';"
        ;

        // query to find 
        $resultBalance = mysqli_query($mysqli, $findAccountBalance);

        $userBalance = 0;

        // query to find current user's balance and link it to variable $userBalance
        if ($resultBalance->num_rows > 0 ){

            $row = $resultBalance->fetch_assoc();

            //echo "<br>UserBalance: " . $row["userCheckingAccountBalance"];
            $userBalance = $row["userCheckingAccountBalance"];
            
        }
        else {
            echo "<br> Row is 0.";
        }

        if(isset($_POST["entryValue"]) && isset($_POST["inputValue"])){

            $_SESSION["entryValue"] = $_POST["entryValue"];
            $_SESSION["inputValue"] = $_POST["inputValue"];
        }
        
        
        ?>
        <!-- details: account/routing number/types -->
        <!-- Remove hardcode numbers & type, values should be from the the database -->
        <!-- Values here just for demonstration -->
        <div class="textbox">
            <form action="ProcessAccountName.php" onsubmit="return checkValue()" method="POST">
                <input class="resizeTextbox" type="text" id="entryValue" name="entryValue">
                <!-- Continue button -->
                <!-- replace '#' with url link -->
           
        </div>

        <div class="greeting">Please enter the Account Number:</div>
        <div class="textbox">
            
                <input class="resizeTextbox" type="text" id="inputValue" name="inputValue">
                <!-- Continue button -->
                <!-- replace '#' with url link -->
                <div class="homepageDiv">
                    <button href="#" class="homepageButton" type="submit">Continue</button>
                
                </div>

         
            </form>

            <div class="homepageDiv">
            <button class="homepageButton" onclick="location.href='../Balance/Balance.php'">Return to Homepage</button>
        </div>
        </div>




        <script>
        function checkValue() {
        var x;

        // Get the value of the input field with id="entryValue"
        x = document.getElementById("entryValue").value;

        if (x == '')
        {
            alert("Please input a valid number.");
            return false;
        }

        else if (x > <?php echo $userBalance?>)
        {
            alert("We were unable to process the transaction. Please ensure you have sufficient funds.");
            return false;
        }
        
        else
        {
            return true;
        }

        }
        </script>

    </body>
</html>
