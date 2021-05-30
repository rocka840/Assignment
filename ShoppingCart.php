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
    <?php
    include_once("dbWebs.php");

    if(isset($_POST["itemToDelete"])){
        unset($_SESSION["ShoppingCart"][$_POST["itemToDelete"]]);
    }

    include_once "Navigation.php";
    ?>

    <h1>Shopping cart content:</h1>
    <table>
        <tr>
        <th>Product Name</td>
        <th>Number Ordered:</td>
        </tr>
        <?php
        foreach ($_SESSION["ShoppingCart"] as $key => $value) {
            //print $value. "<br>";

            $sqlSelect = $connection->prepare("SELECT * from Products where ID_Product=?");
            $sqlSelect->bind_param("i", $key);
            $selectionWentOK = $sqlSelect->execute();

            if ($selectionWentOK) {
                $result = $sqlSelect->get_result();
                $row = $result->fetch_assoc();
        ?>
                <tr>
                    <td><?= $row["ProductName"] ?></td>
                    <td><?= $value ?></td>
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
</body>

</html>