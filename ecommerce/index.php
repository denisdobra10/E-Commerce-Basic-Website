<?php
include "config.php";
session_start();

$isAdmin = false;

if (LoggedIn()) {
    if ($_SESSION['userInfo'][0] == 'admin') {
      $isAdmin = true;
    }
  }


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptop Store</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <span class="hero"></span>
    <div class="all">
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
            <div class="userInfo">
                <?php
                if (empty($_SESSION['userInfo'])) {
                    echo '
            <button class="register"><a href="register.php">REGISTER</a></button>
            <button class="login"><a href="login.php">LOGIN</a></button>
          ';
                } else {
                    echo '
                    <label for="userName">Logged in as: ' . $_SESSION["userInfo"][1] . '</label>
          <button class="register"><a href="logout.php">LOG OUT</a></button>
        ';
                }
                ?>


            </div>

        </nav>

        <div class="header">
            <h1>SHOP YOUR DREAM LAPTOP</h1>
            <p>ARE YOU INTO BUSINESS, GAMING OR DESIGN? THIS IS THE BEST PLACE FOR YOU!</p>
            <img src="images/presentation-laptop.png" width="420" height="20">
        </div>

        <div class="buy">
            <h1>Order now</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iure commodi, totam, nihil qui voluptatum, aliquam fugit eos deserunt pariatur doloremque minus! Nihil, beatae? Quo iure, nihil id molestiae eius consectetur.</p>

        </div>

        <div class="cart">
            <h1>Need some more details?</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. In, iste laudantium? Saepe, tempore molestiae optio dicta aperiam illo quibusdam architecto eaque praesentium alias repellendus voluptates expedita dolores illum repudiandae dolore.</p>
        </div>

        <form class="form" action="">
            <input class="firstname" autocomplete="off" placeholder="First Name" type="text" name="" id="">
            <input class="lastname" autocomplete="off" placeholder="Last Name" type="text" name="" id="">
            <input class="email" autocomplete="off" placeholder="Email" type="text" name="" id="">
            <input class="details" autocomplete="off" placeholder="Details" type="text" name="" id="">
            <button class="submit" type="submit">SUBMIT</button>
        </form>
    </div>
    <div class="icons">
        <div class="bottom">
            <p>denis.dobra@stud.ubbcluj.ro</p>
        </div>
    </div>
</body>

</html>