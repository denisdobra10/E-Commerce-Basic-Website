<?php
function RedirectToCart($message)
{
    echo "
    <script>
        alert('{$message}');
        var timer = setTimeout(function() {
            window.location='shopping-cart.php'
        }, 0);
    </script>
    ";
}

session_start();

if(isset($_GET['all']))
{
    unset($_SESSION['cart']);
    RedirectToCart('Every item has been removed from cart');
}
else
{
    foreach($_SESSION['cart'] as $item => $val)
    {
        if($val == $_GET['id'])
        {
            unset($_SESSION['cart'][$item]);
            break;
        }
    }

    RedirectToCart('ITEM SUCCESSFULLY DELETED');

}

?>

<html>
    <body>
    <p>ITEM SUCCESSFULLY DELETED!</p>
</body>
</html>