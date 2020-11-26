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

    <center>
      <br><br><br><br>
      <p class = "regularFont">
        You're all done.
      </p>

      <p class = "regularAmount">
        <?php
        session_start();
        if(isset($_POST["entryValue"]) && isset($_POST["inputValue"])){

          $_SESSION["entryValue"] = $_POST["entryValue"];
          $_SESSION["inputValue"] = $_POST["inputValue"];
        }

        $amountTransferred = $_SESSION["entryValue"];
        echo 'Amount transferred: $' . $amountTransferred . "<br>";


        ?>
      </p>

      <p class = "regularFont">
        Type: Transfer
        <br>
        <br>
        <?php
        $randomID = (string) rand(1000000000, 9999999999);
        echo 'Transaction ID: ' . $randomID . "<br>";
        ?>
      </p>

      <form action="../Balance/Balance.php">
        <input type="submit" value = "Return to Homepage">
        
      </form>
    </center>


    <center>
  </body>
<html>
