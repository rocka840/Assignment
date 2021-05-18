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
        include_once "Navigation.php";

        if(isset(
            $_POST["ProductName"],
            $_POST["Price"],
            $_POST["ItemsAvailable"]
        )
        ){
            print "Making a new product, in process.";
            $sql = $connection->prepare("INSERT INTO Products(ProductName, Price, ItemsAvailable) VALUES(?,?,?)");
            if(!$sql){
                print "Error in your sql";
            }

            $sql->bind_param(
                "sis",
                $_POST["ProductName"],
                $_POST["Price"],
                $_POST["ItemsAvailable"]
            );

            $resultOfExecute = $sql->execute();
            if($resultOfExecute){
                print "We are done. Please check the database...";
            } else {
                print 'We could not update the database';
            }

            if($_SESSION["isUserLoggedIn"]){

                if(isset($_POST["NewProduct"])){
                    $sqlInsert = $connection->prepare("INSERT INTO Products (ProductName) values(?)");
                    $sqlInsert->bind_param("s", $_POST["NewProduct"]);
                    $resultOfExecute = $sqlInsert->execute();
    
                    if(!$resultOfExecute){
                    print "Adding a new product, failed.";
                    }
    
                }
    
            } else {
                die("Access denied. Please login first.");
            }
        }
    ?>

    <h1>Add a new product:</h1>
    <div class="container">
        <form method="POST"><BR>
            <label for="ProductName">Product Name:<label> <input name="ProductName"><BR>
            <label for="Price">Price:<label> <input name="Price"><BR>
            <label for="ItemsAvailable">How many are available?<label> <input name="ItemsAvailable"><BR>
            <input type="submit" name="submit">
        </form>
    </div>
        

</body>
</html>