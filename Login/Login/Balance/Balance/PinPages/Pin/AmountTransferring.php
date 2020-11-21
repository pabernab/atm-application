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
        <div class="greeting">Please enter the amount:</div>
        
        <!-- details: account/routing number/types -->
        <!-- Remove hardcode numbers & type, values should be from the the database -->
        <!-- Values here just for demonstration -->
        <div class="textbox">
            <form method="POST">
                <input class="resizeTextbox" type="text" id="inputValue" name="inputValue">
            </form>
        </div>


        <!-- Continue button -->
        <!-- replace '#' with url link -->
        <div class="homepageDiv">
            <button href="#" class="homepageButton">Continue</button>
        </div>



    </body>
</html>
