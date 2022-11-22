<?php
include "config.php";
session_start();
$isAdmin = false;

if (LoggedIn()) {
    if ($_SESSION['userInfo'][0] == 'admin') {
      $isAdmin = true;
    }
  }

$connection = ConnectToDatabase();

if ($connection->connect_error) {
    die("Connection failed " . $connection->connect_error);
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $accountDetails = [$username, $password];

    $userAccountDetails = Login($connection, $accountDetails);

    if (!empty($userAccountDetails)) {
        // Save infos in session
        $userInfo = [$userAccountDetails->username, $userAccountDetails->name, $userAccountDetails->email];
        $_SESSION['userInfo'] = $userInfo;

        $message = "Welcome " . $userAccountDetails->name;
        GoToLocation("index.php", $message, 0);
    }
    else
    {
        GoToLocation("login.php", "Invalid username or password", 0);
    }

    
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>

<body>
    <nav class="navbar">
        <img src="images/logo.png" width="80" height="80">
        <div class="pages">
            <a href="index.php">Home</a>
            <a href="products.php">Shop</a>
            <?php if ($isAdmin) : ?>
                <a href="createproduct.php">Create product</a>
            <?php endif; ?>
            <a href="shopping-cart.php">Shopping Cart</a>
        </div>
        <button class="register"><a href="register.php">REGISTER</a></button>
        <button class="login"><a href="login.php">LOGIN</a></button>
    </nav>
    <form action="" method="POST">
        <div>
            <label for="username">USERNAME: </label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label for="password">PASSWORD: </label>
            <input type="password" name="password" required>
        </div>
        <input type="submit" value="LOGIN" name="submit">
    </form>
</body>

</html>