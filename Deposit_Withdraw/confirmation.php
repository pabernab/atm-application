<?php
session_start();



?>


<html>
  <head>
    <link rel = "stylesheet" href = "Style.css">
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
      <br><br><br><br>
      <p class = "regularFont">
        You're all done.

        <br><br>

        Your new total is: $

      <?php

      echo $_SESSION["amount"];

      ?>


      <br><br>

      Thank You!

      </p>

      <form>
        <input type ="submit" value= "Go Back">
      </form>
    </center>


    <center>
  </body>
<html>
