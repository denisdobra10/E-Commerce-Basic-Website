<?php



function ConnectToDatabase()
{
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "ecommerce";

    return mysqli_connect($host, $user, $password, $db);
}

function CreateAccount($database, $accountDetails)
{
    $query = "SELECT * FROM users WHERE username='" . $accountDetails[0] . "'";
    $result = mysqli_query($database, $query);

    $rows = mysqli_num_rows($result);

    if($rows == 1)
    {
        return false;
    }
    else
    {
        $query = "INSERT INTO users VALUES(null, '" . $accountDetails[0] . "', '" . $accountDetails[1] . "', '" . $accountDetails[2] . "', '" . $accountDetails[3] . "');";
        mysqli_query($database, $query);

        return true;
    }
}

function Login($database, $accountDetails)
{
    $query = "SELECT * FROM users WHERE username='" . $accountDetails[0] . "' AND password='" . $accountDetails[1] . "';";
    $result = mysqli_query($database, $query);

    $rows = mysqli_num_rows($result);

    if($rows == 1)
    {
        return mysqli_fetch_object($result);
    }
    else
    {
        return null;
    }
}

function AddProduct($imagePath, $title, $description, $price)
{
    $connection = ConnectToDatabase();

    $query = "INSERT INTO products (image, title, description, price) VALUES (
        '" . $imagePath . "', '" . $title . "', '" . $description . "', '" . $price . "'
    );";

    mysqli_query($connection, $query);

    mysqli_close($connection);
}

function DeleteProduct($id)
{
    $connection = ConnectToDatabase();

    $query = "DELETE FROM products WHERE id=" . $id . ";";

    mysqli_query($connection, $query);

    mysqli_close($connection);
}

function DeleteFileFromServer($path)
{
    unlink($path);
}

function DisplayAvailableProducts()
{

}

function GetDBInfo($query)
{
    $connection = ConnectToDatabase();
    $row = mysqli_query($connection, $query);
    $productInfo =  mysqli_fetch_object($row);

    mysqli_close($connection);

    return $productInfo;
}

function InsertInDatabase($query)
{
    $connection = ConnectToDatabase();

    mysqli_query($connection, $query);

    mysqli_close($connection);
}

function GoToLocation($location, $message, $timer)
{
    echo "
    <script>
        alert('{$message}');
        var timer = setTimeout(function() {
            window.location='{$location}'
        }, {$timer});
    </script>
    ";
}

function GetProductTitleById($id)
{
    return GetDBInfo("SELECT * FROM products WHERE id='{$id}'")->title;
}

function GetProductPriceById($id)
{
    return GetDBInfo("SELECT * FROM products WHERE id='{$id}'")->price;
}

function LoggedIn()
{
    if(empty($_SESSION['userInfo']))
        return false;
    else
        return true;
}

function PlaceOrder($name, $email, $shippingAddress, $billingAddress, $orderSummary, $totalPrice)
{
    $query = "INSERT INTO orders (name, email, shippingAddress, billingAddress, orderSummary, totalPrice)
    VALUES ('{$name}', '{$email}', '{$shippingAddress}', '{$billingAddress}', '{$orderSummary}', '{$totalPrice}');";

    InsertInDatabase($query);
}

?>