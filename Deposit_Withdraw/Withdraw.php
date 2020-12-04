<?php

session_start();

$serverEndpoint = 'mysqldb.cjezeavsieu7.us-west-1.rds.amazonaws.com';
$serverUserName = 'butteadmin';
$serverPassword = 'buttecmpe131';
$dbname = 'registration';

// creating a new server connection using our preset AWS login values
$conn = new mysqli($serverEndpoint, $serverUserName, $serverPassword, $dbname, 3306);

// simple error catch if we are unable to connect to the MySQL Database
if ($conn->connect_errno) {
  echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}

$name = $_SESSION['userName'];

// When you change this make sure it change Name to userName
$sql1 = "SELECT userCheckingAccountBalance FROM userRegistration WHERE userName = '$name'";
$sql2 = "SELECT userSavingsAccountBalance FROM userRegistration WHERE userName = '$name'";

if(isset($_POST["amount"]) && isset($_POST["AccountNumber"]))
{
  $input = $_POST["amount"];
  $typeAcc = $_POST["AccountNumber"];




  if($typeAcc === 'Checking')
  {
      $results1 = mysqli_query($conn,$sql1);
      $row1 = mysqli_fetch_assoc($results1);

      if($row1["userCheckingAccountBalance"] === "")
      {
        //Checking doesn't exist
      }

      else if($row1["userCheckingAccountBalance"] >= $input)
      {
        try
        {
          //Updated value
          $num = $row1["userCheckingAccountBalance"] - $input;
            // PLEASE CHECK
          $sqlUpdate = "UPDATE userRegistration SET userCheckingAccountBalance = $num WHERE userName = '$name'";

          $orders = rand(1000000,9999999);
          $_SESSION["ordernumber"] = $orders;
          $_SESSION["amount"] = $num;

          $upload = "INSERT into checkDeposit(userName,filePath,typess,amount,accountType) VALUES ('$name',$orders,'Withdraw',-$input,'$typeAcc')";

          $results = mysqli_query($conn, $upload);


          $stmt = $conn->prepare($sqlUpdate);
          $stmt->execute();
          //END CONNECTION
           mysqli_close($conn);
           header("Location: confirmation.php");
           //GO to next Page here
        }
        catch (PDOException $e)
        {
          echo $sql . "<br>" . $e->getMessage();
        }
      }
    }
    else if($typeAcc === 'Savings')
    {
      $results2 = mysqli_query($conn,$sql2);
      $row2 = mysqli_fetch_assoc($results2);

      if($row2["userSavingsAccountBalance"] === "")
      {
        //Savings Does not exist
      }

      if($row2["userSavingsAccountBalance"] >= $input)
      {
        try
        {
          //Updated value
          $num = $row2["userSavingsAccountBalance"] - $input;
            // PLEASE CHECK
          $sqlUpdate = "UPDATE userRegistration SET userSavingsAccountBalance = $num WHERE userName = '$name'";

          $orders = rand(1000000,9999999);
          $_SESSION["ordernumber"] = $order;
          $_SESSION["amount"] = $num;

          $upload = "INSERT into checkDeposit(userName,filePath,typess,amount,accountType) VALUES ('$name',$orders,'Withdraw',-$input,'$typeAcc')";

          $results = mysqli_query($conn, $upload);

          $stmt = $conn->prepare($sqlUpdate);
          $stmt->execute();
          //END CONNECTION (MAKE SURE YOU UNCOMMENT THIS) -------------------
          mysqli_close($conn);
          header("Location: confirmation.php");
          // Go to next page here
        }
        catch (PDOException $e)
        {
          echo $sql . "<br>" . $e->getMessage();
        }
      }

    }
}


?>

<html>
  <head>
    <link rel = "stylesheet" href = "Style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500;700&display=swap" rel="stylesheet">

    <title> Withdraw </title>

  </head>

  <body>

    <header>
        <img id = "logo" src="logo.png"/>
    </header>

    <div id="graybar">
    </div>

    <br>
    <!-- TITLE -->
    <center>

      <p class = regularFont>
        Withdraw
      </p>

      <p class = "regularFont">
        Put in value between 0.01 to 4000.00
      </p>

      <p class = "regularFont">


      <!-- SHOWS AMOUNT FOR USER -->
      Checking account:
      <?php
        $results1 = mysqli_query($conn,$sql1);
        $row1 = mysqli_fetch_assoc($results1);

        if($row1["userCheckingAccountBalance"] === "")
        {
            echo "Account Needs to be created.";
        }
        else
        {
            echo "$ ";
            echo $row1["userCheckingAccountBalance"];
        }


      ?>

      <br>

      Savings account:
      <?php
        $results2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($results2);

        if($row2["userSavingsAccountBalance"] === "")
        {
            echo "Account Needs to be created.";
        }
        else
        {
            echo "$ ";
            echo $row2["userSavingsAccountBalance"];
        }
      ?>
      <br>
    </p>

    <!-- END =- -->
    </form>


    <!-- When you take out money -->
    <!-- ALSO CHECK DIRECTORY -->
    <form action="" method="post">
      <p class = "regularFont">
      <label for="AccountNumber">Choose an account:</label>
      <select name="AccountNumber">
        <option value="null">--Choose--</option>
        <option value="Checking">Checking</option>
        <option value="Savings">Savings</option>
      </select>
      </p>


    <!-- PRINTS OUT ERRORS -->

    <?php

    $results1 = mysqli_query($conn,$sql1);
    $row1 = mysqli_fetch_assoc($results1);
    $results2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_assoc($results2);

    //If user did not select account
    if(isset($_POST["AccountNumber"]) && isset($row1["userCheckingAccountBalance"]) && isset($row2["userSavingsAccountBalance"]) )
    {
      if($_POST["AccountNumber"] === "null")
      {
        echo '<span style="color:RED;text-align:center;">ERROR: You did not select which account.</span>';
      }
      else if($row1["userCheckingAccountBalance"] === "" || $row2["userSavingsAccountBalance"] === "")
      {
        echo '<span style="color:RED;text-align:center;">ERROR: Account you selected needs to be created.</span>';
      }

      //If user puts in more than account number
      else if($row1["userCheckingAccountBalance"] < $input)
      {
        echo '<span style="color:RED;text-align:center;">ERROR: The amount you entered is greater than the amount you have.</span>';
      }
      else if($row2["userSavingsAccountBalance"] < $input)
      {
        echo '<span style="color:RED;text-align:center;">ERROR: The amount you entered is greater than the amount you have.</span>';
      }
    }

    ?>
    <!-- END PRINT ERROR -->



      <br>
      <br>
      <br>

      <input type = "number" name = "amount" min = "0.01" max = "4000.00" step = "0.01">
      <input type = "submit" value = "submit">
    </form>


      <br>

      <div>
                    <button class="homepageButton" onclick="location.href='../Balance/Balance.php'">Back</button>
                </div>



    <center>
  </body>
<html>
