<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="confirmation.css">
    <title></title>
  </head>
  <body>
    <?php
      if(isset($_POST['inputValue'])) {
        $amount = $_POST['inputValue'];
      }
    ?>

    <header>
        <img id = "logo" src="logo.png"/>
    </header>

    <div id="graybar">
    </div>

  <h1>Please confirm the amount: <br>
    <?php
      echo $amount;
      
    ?>
  
  </h1>


  <div id = buttonLayout>

    <button id = "Re-Enter" onclick="location.href='../Pin/AmountTransferring.html'" type="button">Re-Enter</button>
    <button id = "Confirm" type="button" name="button">Confirm</button>



  </div>



  </body>
</html>
