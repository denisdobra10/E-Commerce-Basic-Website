<?php
include "config.php";

$isAdmin = false;

if (LoggedIn()) {
  if ($_SESSION['userInfo'][0] == 'admin') {
    $isAdmin = true;
  }
}

$connection = ConnectToDatabase();
session_start();

$productIds = "";

if (!empty($_SESSION['cart'])) {
  $productIds = implode(',', $_SESSION['cart']);
}



$query =  "
    SELECT * FROM products
    WHERE id in ($productIds);
";


?>




<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>PRODUCTS</title>
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
      if (empty($_SESSION['userInfo'])) {
        echo '
            <button class="register"><a href="register.php">REGISTER</a></button>
            <button class="login"><a href="login.php">LOGIN</a></button>
          ';
      } else {
        echo '
          <label for="userName">Logged in as: ' . $_SESSION["userInfo"][1] . '</label>
          <button class="login"><a href="logout.php">LOG OUT</a></button>
        ';
      }
      ?>


    </div>

  </nav>
  <table border=1 cellspacing=0 cellpadding=10>
    <tr>
      <td>#</td>
      <td>Title</td>
      <td>Image</td>
      <td>Price</td>
      <td>Quantity</td>
    </tr>
    <?php

    $rows = [];
    $counter = [];
    if ($productIds != "") {
      $rows = mysqli_query($connection, "SELECT * FROM products WHERE id in ({$productIds})");
      $counter = array_count_values($_SESSION['cart']);
    }
    $i = 1;
    ?>

    <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row["title"]; ?></td>
        <td> <img src="<?php echo $row["image"]; ?>" width=300px height="300px" title="<?php echo $row['image']; ?>"> </td>
        <td><?php echo $row["price"]; ?></td>
        <td><?php echo '<label for="counter">' . $counter[$row['id']] . '</label>' ?></td>

        <form action="delete-from-cart.php" method="GET">
          <td> <?php echo '<button type="submit" name="id" value="' . $row['id'] . '">Delete from cart</button>' ?> </td>
        </form>

      </tr>
    <?php endforeach; ?>

    <form action="delete-from-cart.php" method="GET">
      <td> <?php echo '<button type="submit" name="all">DELETE ALL ITEMS IN CART</button>'; ?> </td>
    </form>

  </table>

  <form action="order.php">
      <?php  if(!empty($counter)) { echo '<button type="submit" name="order">ORDER</button>'; }?>
  </form>

</body>

</html>