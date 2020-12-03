<?php


session_start();

print_r($_SESSION);

//CONNECTING SERVER
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
//Checker
$checkSQL = "SELECT userCheckingAccountBalance, userSavingsAccountBalance FROM userRegistration WHERE userName = '$name'";

if(isset($_POST["amount"]) && isset($_POST["AccountNumber"]))
{
  $input = $_POST["amount"];
  $typeAcc = $_POST["AccountNumber"];

  if(!empty($_FILES["userFile"]['name']))
  {
    //checker if account is null
    $checkAcc = mysqli_query($conn, $checkSQL);
    $cCheck = mysqli_fetch_assoc($checkAcc);

    if($typeAcc === 'Checking')//WHEN USER SELECTS CHECKING ACCOUNT
    {

        if($cCheck['userCheckingAccountBalance'] == "")//if checking is null
        {
          //CHECKING ACCOUNT DOES NOT EXIST
        }
        else
        {
          try
          {
            $results1 = mysqli_query($conn,$sql1);
            $row1 = mysqli_fetch_assoc($results1);
            //Updated value
            $num = $row1["userCheckingAccountBalance"] + $input;
            // PLEASE CHECK
            $sqlUpdate = "UPDATE userRegistration SET userCheckingAccountBalance = $num WHERE userName = '$name'";

            $stmt = $conn->prepare($sqlUpdate);
            $stmt->execute();
                  //END CONNECTION (MAKE SURE YOU UNCOMMENT THIS) -------------------

            $_SESSION["amount"] = $num;


            $rand = rand(1000000,9999999);

            $order= $rand;
            $_SESSION["ordernumber"] = $order;
            $upload = "INSERT into checkDeposit(userName,filePath,typess,amount,accountType) VALUES ('$name',$order,'Deposit',$input,'$typeAcc')";

            $results = mysqli_query($conn, $upload);

            $newname = "{$order}.".$ext;
            $target = 'images/'.$newname;
            move_uploaded_file( $_FILES['userFile']['tmp_name'], $target);


            mysqli_close($conn);
            header("Location: confirmation.php");
            //GO TO NEXT PAGE HERE
            }
            catch (PDOException $e)
            {
              echo $sql . "<br>" . $e->getMessage();
            }
        }
      }

    else if($typeAcc === 'Savings')//WHEN USER SELECTS SAVINGS ACCOUNT
    {
      $checkAcc = mysqli_query($conn, $checkSQL);
      $cCheck = mysqli_fetch_assoc($checkAcc);

        if($cCheck['userSavingsAccountBalance'] == "")//if checking is null
        {
          //Savings Account DOES NOT EXIST
        }
        else
        {
          try
          {
            $results2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($results2);
            //Updated value
            $num = $row2["userSavingsAccountBalance"] + $input;
              // PLEASE CHECK
            $sqlUpdate = "UPDATE userRegistration SET userSavingsAccountBalance = $num WHERE userName = '$name'";

            $_SESSION["amount"] = $num;


            $stmt = $conn->prepare($sqlUpdate);
            $stmt->execute();

            $rand = rand(1000000,9999999);

            $order= $rand;
            $_SESSION["ordernumber"] = $order;
            $upload = "INSERT into checkDeposit(userName,filePath,typess,amount,accountType) VALUES ('$name',$order,'Deposit',$input,'$typeAcc')";

            $results = mysqli_query($conn, $upload);

            $newname = "{$order}.".$ext;
            $target = 'images/'.$newname;
            move_uploaded_file( $_FILES['userFile']['tmp_name'], $target);




            //END CONNECTION (MAKE SURE YOU UNCOMMENT THIS) -------------------
             mysqli_close($conn);
             header("Location: confirmation.php");
             //Go to NEXT PAGE HERE
          }
            catch (PDOException $e)
            {
              echo $sql . "<br>" . $e->getMessage();
            }
        }

      }
    }
    }




?>

<html>
  <head>
    <link rel = "stylesheet" href = "Style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500;700&display=swap" rel="stylesheet">

    <title> Deposit </title>

  </head>

  <body>

    <header>
        <img id = "logo" src="logo.png"/>
    </header>

    <div id="graybar">
    </div>

    <br><br>
    <!-- TITLE -->
    <center>

      <p class = regularFont>
        Deposit
        <br>
      </p>

      <form action="" method="POST" enctype='multipart/form-data'>
        <p class = "regularFont">
          <label for="AccountNumber">Choose an account:</label>
          <select name="AccountNumber">
            <option value="null">--Choose--</option>
            <option value="Checking">Checking</option>
            <option value="Savings">Savings</option>
          </select>
        </p>


    <!-- File input -->
      <p class = "regularFont">
        Please input png file
      <!-- <label for="myfile">Select a file:</label> -->
      </p>
      <input type="file" name= "userFile" accept = "image/png">

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


  <!-- END =- -->
      </p>


      <br>

      <!-- PRINTS OUT ERRORS -->

      <?php

      $results1 = mysqli_query($conn,$sql1);
      $row1 = mysqli_fetch_assoc($results1);
      $results2 = mysqli_query($conn,$sql2);
      $row2 = mysqli_fetch_assoc($results2);

      $checkAcc = mysqli_query($conn, $checkSQL);
      $cCheck = mysqli_fetch_assoc($checkAcc);

      //If user did not select account
      if(isset($_POST["AccountNumber"]) )
      {
        if($_POST["AccountNumber"] === "null")
        {
          echo '<span style="color:RED;text-align:center;">ERROR: You did not select which account.</span>';
        }
        else if(empty($_FILES["userFile"]['name']))
        {
          echo '<span style="color:RED;text-align:center;">ERROR: Please Upload file.</span>';
        }
        else if($cCheck['userCheckingAccountBalance'] === "" || $cCheck['userSavingsAccountBalance'] === "")
        {
          echo '<span style="color:RED;text-align:center;">ERROR: Account you selected needs to be created.</span>';
        }
      }

      ?>
      <!-- END PRINT ERROR -->
      <br>
      <br>

      <input type = "number" name = "amount" min = "0.01" max = "4000.00" step = "0.01" required>
      <input type = "submit" value = "submit" name = 'upload_btn'>
    </form>


      <br>

      <div>
                    <button class="homepageButton" onclick="location.href='../Balance/Balance.php'">Back</button>
                </div>



    <center>
  </body>
<html>
