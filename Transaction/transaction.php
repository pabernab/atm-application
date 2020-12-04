<html>
  <head>
    <link rel = "stylesheet" href = "Style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500;700&display=swap" rel="stylesheet">

    <title> Transaction </title>

  </head>

  <body>

    <header>
        <img id = "logo" src="logo.png"/>
    </header>

    <div id="graybar">
    </div>

    <h1><center>What would you like to do today?</center></h1>

    <center>
        <!-- Desposit -->
      <form>
        <input type="submit" onclick="location.href='../DepositWithdraw/Deposit.php'" value = "Deposit">
      </form>

      <!-- Withdraw -->
      <form>
        <input type="submit"   onclick="location.href='../DepositWithdraw/Deposit.php'" value = "Withdraw">
      </form>

      <!-- Transfer  -->
      <form>
        <input type="submit"  onclick="location.href='../Pin/AccountName.php'" value = "Transfer">
      </form>


    <center>
  </body>
<html>
