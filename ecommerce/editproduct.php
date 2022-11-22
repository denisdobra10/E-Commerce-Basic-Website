<?php
include "config.php";
$connection = ConnectToDatabase();

$query = "SELECT * FROM products WHERE id={$_GET['id']}";
$productInfo =  GetDBInfo($query);

$title = $productInfo->title;
$price = $productInfo->price;

if(isset($_POST['submit']))
{
    // Update product with new infos
    $title = $_POST['title'];
    $price = $_POST['price'];

    $query = "UPDATE products
    SET title='{$title}', price='{$price}'
    WHERE id={$_POST['id']};
    ";

    mysqli_query($connection, $query);

    mysqli_close($connection);
    
    GoToLocation("products.php", "Product successfully updated!", 0);
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>PRODUCTS</title>
</head>

<body>

  <form action="" method="POST">
    <div>
        <label for="id">PRODUCT ID: </label>
        <input type="text" name="id" value="<?php echo htmlentities($_GET['id']); ?>" readonly>
    </div>
    <div>
        <label for="title">PRODUCT Title: </label>
        <input type="text" name="title" value="<?php echo htmlentities($title); ?>" required>
    </div>
    <div>
        <label for="id">PRODUCT Price: </label>
        <input type="text" name="price" value="<?php echo htmlentities($price); ?>" required>
    </div>

    <button type="submit" name="submit">UPDATE PRODUCT</button>
  </form>

</body>

</html>