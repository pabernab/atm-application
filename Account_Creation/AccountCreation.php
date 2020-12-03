<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="AccountCreationStyles.css?v=<?php echo time(); ?>">
    <title></title>
  </head>
  <body>


    <header>
        <img id = "logo" src="logo.png"/>
    </header>

    <div id="graybar">
    </div>

  <h1>What kind of account are you looking to open?</h1>

  <div id = buttonLayout>

    <!-- Checking Button -->
    <button id = "checking" onclick="location.href='../Account_Successful/AccountSuccessful.php'"
     type="button" class= "button" name="button">Checking</button>

    <!-- Savings Button -->
    <button id = "savings" onclick="location.href='../Account_Successful/SavingsAccountSuccessful.php'"
     type="button" class = "button" name="button">Savings</button>

  </div>

  </body>
</html>
