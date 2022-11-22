<?php

session_start();
if(empty($_SESSION['cart']))
{
    $_SESSION['cart'] = array();
}

array_push($_SESSION['cart'], $_GET['id']);

?>



<p>
    Product was successfully added to your cart!
    <br>
    <a href="products.php">Continue shopping</a>
    <br>
    <a href="shopping-cart.php">View Shopping Cart</a>
</p>