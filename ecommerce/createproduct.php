<?php
include "config.php";

if(isset($_POST['submit']))
{
    if($_FILES["image"]["error"] == 4)
    {
        echo "Image doesn't exist";
    }
    else
    {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
    
        if(!in_array($imageExtension, $validImageExtension))
        {
            echo "
            <script>alert('Invalid image extension!');
            </script>
            ";
        }
        else if($fileSize > 10000000)
        {
            echo "
            <script>alert('Image is too big! Maximum size: 10mb!');
            </script>
            ";
        }
        else
        {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            $imagesPath = 'images/';
            $imagePath = $imagesPath . $newImageName;
            move_uploaded_file($tmpName, $imagePath);

            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];

            AddProduct($imagePath, $title, $description, $price);
            echo 'Product was successfully added to database!';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CREATE PRODUCT</title>
  </head>
  <body>
    <form class="" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
        <div>
            <label for="image">Image: </label>
            <input type="file" name="image" accept=".jpg, .jpeg, .png" value="">
        </div>
        <div>
            <label for="title">Title: </label>
            <input type="text" name="title" required placeholder="Title of product">
        </div>
        <div>
            <label for="description">Description: </label>
            <textarea name="description" cols="30" rows="10" placeholder="Description of product"></textarea>
        </div>
        <div>
            <label for="price">Price: </label>
            <input type="text" name="price" required placeholder="Price of product">
        </div>

      <button type = "submit" name = "submit">Create product</button>
    </form>
    <br>

    <button><a href="products.php" style="text-decoration: none;">Product list</a></button>
    
  </body>
</html>