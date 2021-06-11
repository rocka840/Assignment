<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Checkout</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='Assignment.css'>
    <script src='main.js'></script>
</head>

<body>
    <div class="shopping">
    <?php
    include_once("dbWebs.php");
    

    if(isset($_POST["itemToDelete"])){
        unset($_SESSION["ShoppingCart"][$_POST["itemToDelete"]]);
    }

    if(isset($_POST["BuyAll"]) && sizeof($_SESSION["ShoppingCart"]) != 0){
  
        $OrderStatus = "Order to process";
      //  INSERT into Orders (PersonOrder) values (SELECT ID_Person from People where Username = ?);
        
        $sqlInsert = $connection->prepare("INSERT into Orders(PersonOrder,OrderStatus) values ((SELECT ID_Person from People where UserName = ?),?);");
        $sqlInsert->bind_param("ss", $_SESSION["CurrentUser"], $OrderStatus);
        $insertWentOK = $sqlInsert->execute();
        $newOrderId = mysqli_insert_id($connection);

        foreach ($_SESSION["ShoppingCart"] as $key => $value){
            //INSERT INTO OrderContents (OrderNumber, OrderItem, HowMany) values(?,?,?);

            $sqlInsert2 = $connection->prepare("INSERT INTO OrderContents (OrderNumber, OrderItem, HowMany) values(?,?,?)");
            $sqlInsert2->bind_param("iii", $newOrderId, $key, $value);
            $insertWentOK = $sqlInsert2->execute();
        }
        $_SESSION["ShoppingCart"] = [];
        print "Thank you for your order. It will be processed soon!";
    }
    
    include_once "Navigation.php";

    ?>

    <h1>Shopping cart content:</h1>
    <table class="shopping">
        <tr>
            <th>Product Name</th>
            <th>Number Ordered:</th>
            <th>Price:</th>
        </tr>
        <?php
        $totalPrice = 0;
        foreach ($_SESSION["ShoppingCart"] as $key => $value) {
            //print $value. "<br>";

            $sqlSelect = $connection->prepare("SELECT * from Products where ID_Product=?");
            $sqlSelect->bind_param("i", $key);
            $selectionWentOK = $sqlSelect->execute();

            if ($selectionWentOK) {
                
                $result = $sqlSelect->get_result();
                $row = $result->fetch_assoc();
                $totalPrice += $row["Price"] * $value;
        ?>
                <tr>
                    <td><?= $row["ProductName"] ?></td>
                    <td><?= $value ?></td>
                    <td>
                        <?= $row["Price"] * $value ?>
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="itemToDelete" value="<?= $key ?>">
                            <input type="submit" value="Remove">
                        </form>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </table>
        <?php
            print "The total order price is: " . $totalPrice . "€";
        ?>
        <form method="POST">
            <input type="submit" name="BuyAll">
        </form>
    
    </div>
</body>

</html>