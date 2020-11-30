<html>
    <head>
        <meta charset = "utf-8">
        <title>Account Successful</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500;700&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href = "Pin.css?v=<?php echo time(); ?>">
        <script>

            let jsAlert = () => alert("We were unable to transfer the funds. 
                                      "Please ensure you have sufficient balance and that the 
                                      "desired recipient's account number is accurate.");
        </script>
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
        <div class="greeting">Please enter an amount to transfer to your Savings Account:</div>
        <?php
        session_start();

        if(isset($_POST["entryValue"])){

            $_SESSION["entryValue"] = $_POST["entryValue"];
        }
        
        
        ?>
        <!-- details: account/routing number/types -->
        <!-- Remove hardcode numbers & type, values should be from the the database -->
        <!-- Values here just for demonstration -->
        <div class="textbox">
            <form action="ProcessTransferToSavings.php" method="POST">
                <input class="resizeTextbox" type="text" id="entryValue" name="entryValue">
                <!-- Continue button -->
                <!-- replace '#' with url link -->
           
       

                <!-- Continue button -->
                <!-- replace '#' with url link -->
                    <button href="#" class="homepageButton" type="submit">Continue</button>
                
                </div>

         
            </form>

            <div class="homepageDiv">
            <button class="homepageButton" onclick="location.href='../Balance/Balance.php'">Return to Homepage</button>
        </div>
        </div>




    </body>
</html>
