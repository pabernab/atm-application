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





<!-- ************************************************************************************************************ -->
    
    <!-- OPEN ACCOUNTS -->
  <h1>What kind of account are you looking to open?</h1>

  <div id = buttonLayout>

    <!-- Checking Button -->
    <button class="button" onclick="location.href='../Account_Successful/AccountSuccessful.php'"
     type="button" name="button">Checking</button>

    <!-- Savings Button -->
    <button class="button" onclick="location.href='../Account_Successful/SavingsAccountSuccessful.php'"
     type="button" name="button">Savings</button>

  </div>




<!-- *************** ************************************************************************-->

    <!-- CLOSE ACCOUNTS -->
    <h1>What kind of account are you looking to close?</h1>

    <div id = buttonLayout>

    <!-- Checking Button -->
    <button class="button" onclick="location.href='../Account_Close/CloseChecking.php'"
     type="button" name="button">Checking</button>

    <!-- Savings Button -->
    <button class="button" onclick="location.href='../Account_Close/CloseSavings.php'"
     type="button" name="button">Savings</button>

  </div>

  <!-- Back button to the balance page.  -->
  <div class="backButton">
      <button class="homepageButton" onclick="location.href='../Balance/Balance.php'">Back</button>
  </div>

  </body>
</html>
