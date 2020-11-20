<html>
    <head>
        <meta charset = "utf-8">
        <title>Balance</title>
        <link rel = "stylesheet" href = "Balance.css">
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


        <div id="column"><a class="nav_column">Deposit/Withdrawal</a></div>

        <div id="column"><a class="nav_column">Transfer</a></div>


        <div id="column"><a class="nav_column">Open Account</a></div>


        <div id="column"></div>
        <div id="column"></div>
        </nav>

        <section class="sectionLayout">
            <!-- Checking Accounts -->
            <!-- Replace hard coded balance with php code -->
            <div class="barLayout">Checking Accounts</div>
            <div class="contentLayout">
                <div class="availableBalance">$2,301.29
                    <br>
                    <a style="font-size: 50%;">Available Balance</a>
                </div>
                <div class="transferMoney"><a href="#">Transfer Money</a></div>
                <div class="transferMoney"><a href="#">Account Info</a></div>
            </div>


            <br>
            <!-- Savings Accounts -->
            <!-- Replace hard coded balance with php code -->
            <div class="barLayout">Savings Accounts</div>
            <div class="contentLayout">
                <div class="availableBalance">$4,121.21
                    <br>
                    <a style="font-size: 50%;">Available Balance</a>
                </div>
                <div class="transferMoney"><a href="#">Transfer Money</a></div>
                <div class="transferMoney"><a href="#">Account Info</a></div>
            </div>
            <form action="../AmountConfirmation/confirmation.php" method="POST">
                <div>
                    <button type="submit" id="Logout">Logout</button>
                </div>
            </form>
        </section>


    </body>
</html>
