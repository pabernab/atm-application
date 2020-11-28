<html>
  <head>
    <link rel = "stylesheet" href = "Style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500;700&display=swap" rel="stylesheet">

    <title> Transaction Confirmation </title>

  </head>

  <body>

    <header>
        <img id = "logo" src="logo.png"/>
    </header>

    <div id="graybar">
    </div>
      <!-- TitleScreen -->

      <center>
        <h1>Would you like to make a deposit or withdrawal today?</h1>

  <div id = buttonLayout>

    <!-- Checking Button -->  
    <button class = "choiceButton" onclick="location.href='Deposit.php'"
     type="button" name="button">Deposit</button>

    <!-- Savings Button -->
    <button class = "choiceButton" onclick="location.href='Withdraw.php'"
     type="button" name="button">Withdraw</button>
     </center>
  </div>

  </body>
</html>
