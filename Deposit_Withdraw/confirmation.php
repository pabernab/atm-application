<?php
session_start();



?>


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
      <br><br>

      Transaction Number #

      <?php

        echo $_SESSION["ordernumber"];

      ?>


      <br><br>
      <p class = "regularFont">

        Thank you

        <?php

        //LATER ENTER NAME
        //echo $_SESSION["username"];

        ?>

        <br>

        You're all done!

        <br><br>

        Your new total is: $


      <?php
      echo $_SESSION["amount"];

      ?>


      <br><br>

      Thank You!

      </p>


      <button class = "homepageButton" onclick = "window.location = '../Balance/Balance.php';">Return to Homepage</button>

    </center>


    <center>
  </body>
<html>
