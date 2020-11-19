<html>
    <head>
        <meta charset = "utf-8">
        <title>Account Successful</title>
        <link rel = "stylesheet" href = "Pin.css">
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

        if(isset($_POST["entryValue"]) && isset($_POST["inputValue"])){

            $_SESSION["entryValue"] = $_POST["entryValue"];
            $_SESSION["inputValue"] = $_POST["inputValue"];
        }

        
        ?>
        <!-- details: account/routing number/types -->
        <!-- Remove hardcode numbers & type, values should be from the the database -->
        <!-- Values here just for demonstration -->
        <div class="textbox">
            <form action="ProcessAccountName.php" method="POST">
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
        </div>




    </body>
</html>
