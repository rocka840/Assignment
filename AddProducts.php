<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Add Products</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='assignment.css'>
    <script src='main.js'></script>
</head>

<body>
    <?php
    include_once("dbWebs.php");
    include_once("AdminCheck.php");
    include_once "Navigation.php";
    
    if (!$_SESSION["isUserLoggedIn"]) {
        header("Location: login.php");
        die();
    }

    if (isset(
        $_POST["ProductName"],
        $_POST["Price"],
        $_POST["ItemsAvailable"]
    )) {
        print "Making a new product, in process.";
        $sql = $connection->prepare("INSERT INTO Products(ProductName, Price, ItemsAvailable) VALUES(?,?,?)");
        if (!$sql) {
            print "Error in your sql";
        }

        $sql->bind_param(
            "sis",
            $_POST["ProductName"],
            $_POST["Price"],
            $_POST["ItemsAvailable"]
        );

        $resultOfExecute = $sql->execute();
        if ($resultOfExecute) {
            print "We are done. Please check the database...";
        } else {
            print 'We could not update the database';
        }

        if ($_SESSION["isUserLoggedIn"]) {

            if (isset($_POST["NewProduct"])) {
                $sqlInsert = $connection->prepare("INSERT INTO Products (ProductName) values(?)");
                $sqlInsert->bind_param("s", $_POST["NewProduct"]);
                $resultOfExecute = $sqlInsert->execute();
                $sqlInsert->close();

                if (!$resultOfExecute) {
                    print "Adding a new product, failed.";
                }
            }
        } else {
            die("Access denied. Please login first.");
        }
    }
    ?>

    <h1>Add a new product:</h1>

    <form class="myReg" method="POST">
        <div><label for="ProductName">Product Name:<label> <input name="ProductName"></div>
        <div><label for="Price">Price:<label> <input name="Price"></div>
        <div><label for="ItemsAvailable">How many?<label> <input name="ItemsAvailable"></div>
        <input type="submit" name="submit">
    </form>
</body>

</html>