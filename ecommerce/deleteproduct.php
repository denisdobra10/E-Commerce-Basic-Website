<?php
include "config.php";

if(isset($_GET['id']))
{
    $connection = ConnectToDatabase();

    $result = mysqli_query($connection, 'SELECT * FROM products WHERE id=' . $_GET['id'] . ';');

    $imagePath = mysqli_fetch_object($result)->image;

    DeleteProduct($_GET['id']);
    DeleteFileFromServer($imagePath);

    $message = "Product has been successfully deleted from database";
    GoToLocation("products.php", $message, 0);
}

?>
