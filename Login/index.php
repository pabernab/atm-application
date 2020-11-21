<?php


session_start();





	$logged_in  = false;
	if (isset($_POST["userlogin"]) && isset($_POST["loginpassword"]))
			{
				if ($_POST["userlogin"] && $_POST["loginpassword"])
				{
					$_SESSION["username"] = $_POST["userlogin"];
					$_SESSION["password"] = $_POST["loginpassword"];


					//create connection
					$serverEndpoint = 'mysqldb.cjezeavsieu7.us-west-1.rds.amazonaws.com';
					$serverUserName = 'butteadmin';
					$serverPassword = 'buttecmpe131';
					$dbname = 'registration';


					//create connection
				  $conn = new mysqli($serverEndpoint, $serverUserName, $serverPassword, $dbname, 3306);


					//check connection
					if (!$conn)
					{
						die("Connection failed: " . mysqli_connect_error());
					}



          $sql = "SELECT userPassword FROM userRegistration WHERE userName = '$username'";

          $results = mysqli_query($conn, $sql);

          if($results)
					{
                $row = mysqli_fetch_assoc($results);
                if ($row["userPassword"] === $password)
                {
                  $logged_in = true;
                  $sql = "SELECT * FROM userRegistration";
                  $results = mysqli_query($conn, $sql);
                }
                else
                {
                  echo "password incorrect";
                }
          }

					else
					{
						echo mysqli_error($conn);
					}


					mysqli_close($conn);
				}

			else
			{
					echo "Nothing was submitted.";
			}
		}

		if ($_SERVER['REQUEST_METHOD'] === 'POST')
		{
		  $file = '/tmp/sample-app.log';
		  $message = file_get_contents('php://input');
		  file_put_contents($file, date('Y-m-d H:i:s') . " Received message: " . $message . "\n", FILE_APPEND);
		}
		else
		{

  ?>







<html>
  <head>
    <meta charset = "utf-8">
    <title>Login Page</title>
    <link rel = "stylesheet" href = "Login.css">
  </head>
  <body>

    <!-- bank logo -->
    <header>
      <meta name="viewport" content="width=device-width">
        <img id = "logo" src="logo.png"/>
    </header>

    <!-- gray bar -->
    <div id="graybar"></div>

    <!-- deposit/withdraw & transfer & open account nagivations/
          empty divs are for layout purposes -->
    <nav id="nav_layout">
      <div id="column"></div>
      <div id="column"></div>


      <div id="column"><a class="nav_column">Deposit/Withdrawal</a></div>|

      <div id="column"><a class="nav_column">Transfer</a></div>|

      <div id="column"><a class="nav_column">Open Account</a></div>


      <div id="column"></div>
      <div id="column"></div>
    </nav>

    <!-- <describe this> -->
    <div class = "center">
      <form method = "post">
        <div class = "txt_field">
          <input type = "text" name = "userlogin" placeholder="Username" required>
        </div>
        <div class = "txt_field">
          <input type = "password" name= "loginpassword" placeholder="Password" required>
        </div>
        <input type = "submit" value = "Sign In">
        <div class = "pass">Forgot Password?</div>
        <div class = "signup_link">
          Need an account? <a href="Registration/Registration.php">Sign up</a>
      </form>
    </div>
    <div class = "canvas">
      <form method = "post">
        <h1 style = "font-family: Franklin Gothic Medium">Your Money. Secured.</h1>
          <!-- checking -->
        <div class = "checking">
          <img src="check.png">
          <br>
          <p style= "font-family: Franklin Gothic Medium"> Open a Checking account</p>
          </div>
          <!-- saving -->
          <div class = "savings">
            <img src="money_bag.png">
          <p style = "font-family: Franklin Gothic Medium">Open a Savings account</p>
          </div>
      </form>
    </div>


    				<?php
					}

    					if($logged_in && $results)
    					{
    						header('Location: Balance/Balance/Balance.php');
    					}

    				?>






  </body>
</html>
