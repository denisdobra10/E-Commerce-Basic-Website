<?php
include "visualhelper.php";
include "config.php";
session_start();
$isAdmin = false;

if (LoggedIn()) {
  if ($_SESSION['userInfo'][0] == 'admin') {
    $isAdmin = true;
  }
}


$name = "";
$email = "";
if(LoggedIn())
{
    $name = $_SESSION['userInfo'][1];
    $email = $_SESSION['userInfo'][2];
}

$shippingAddress = "";
$billingAddress = "";
$orderSummary = "";
$totalPrice = 0.00;

if(isset($_POST['placeorder']))
{
    $shippingAddress = $_POST['shippingaddress'];
    $billingAddress = $_POST['billingaddress'];
    $orderSummary = $_POST['orderSummary'];
    $totalPrice = $_POST['totalPrice'];

    PlaceOrder($name, $email, $shippingAddress, $billingAddress, $orderSummary, $totalPrice);

    unset($_SESSION['cart']);  // clean the cart

    GoToLocation("index.php", "Your order has been successfully sent!", 0);
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <div class="userInfo">
      <?php
        if(empty($_SESSION['userInfo']))
        {
          echo '
            <button class="register"><a href="register.php">REGISTER</a></button>
            <button class="login"><a href="login.php">LOGIN</a></button>
          ';
        }
        else
        {
          echo '
          <label for="userName">Logged in as: ' . $_SESSION["userInfo"][1] . '</label>
          <button class="login"><a href="logout.php">LOG OUT</a></button>
        ';
        }
      ?>
      
      
    </div>
    
  </nav>

  <br><br>

  <form action="" method="POST">
    <div>
        <label for="name">Name: </label>
        <input type="text" name="name" value="<?php echo $name; ?>" required>
    </div>

    <div>
        <label for="name">Email: </label>
        <input type="text" name="email" value="<?php echo $email; ?>" required>
    </div>

    <div>
        <label for="name">Shipping Address: </label>
        <input type="text" name="shippingaddress" required>
    </div>

    <div>
        <label for="name">Billing Address: </label>
        <input type="text" name="billingaddress">
    </div>

    <div class="summary">
        <?php
        $cart = $_SESSION['cart'];
        $counter = array_count_values($cart);

        BlankSpaces(2);
        CreateTextLabel("Order summary:");
        BlankSpaces(2);
        
        $i = 1;
        foreach($counter as $count => $value)
        {
            $orderSummary .= CreateTextLabel("Produsul {$i}: " . GetProductTitleById($count) . ", cantitate: " . $value) . ";";
            BlankSpaces(1);
            CreateTextLabel("---------");
            BlankSpaces(1);

            $totalPrice += floatval(GetProductPriceById($count)) * floatval($value);
            $i++;
        }

        BlankSpaces(3);
        ?>
    </div>

    <div>
        <input type="text" name="orderSummary" value="<?php echo $orderSummary; ?>" readonly hidden>
    </div>
    
    <div>
        <input type="text" name="totalPrice" value="<?php echo $totalPrice; ?>" readonly>
    </div>

    <button type="submit" name="placeorder">PLACE ORDER</button>
  </form>
</body>
</html>