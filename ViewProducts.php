<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>View Products</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='assignment.css'>
    <script src='main.js'></script>
</head>

<body>
    <?php
    include_once("dbWebs.php");

    if(isset($_POST["ProductToBuy"])){
        //array_push($_SESSION["ShoppingCart"], $_POST["ProductToBuy"]);
        //ALTERNATIVE:
        $_SESSION["ShoppingCart"][$_POST["ProductToBuy"]] = $_POST["HowManyItems"];
    }

    if (isset($_POST["ProductToDelete"])) {
        $sqlDelete = $connection->prepare("Delete from Products where ID_Product =?");
        if (!$sqlDelete)
            die("Error in sql delete statement");
        $sqlDelete->bind_param("i", $_POST["ProductToDelete"]);
        $sqlDelete->execute();
    }

    include_once "Navigation.php";

    ?>
    <h1>Products</h1>

    <table>
        <?php
        $sqlSelect = $connection->prepare("SELECT * from Products");
        $selectionWentOK = $sqlSelect->execute();

        if ($selectionWentOK) {
            $result = $sqlSelect->get_result();
            while ($row = $result->fetch_assoc()) {
        ?>
                <tr>
                    <td>Product Name:<?= $row["ProductName"] ?></td>
                    <td>Price:<?= $row["Price"] ?>€</td>
                    <td>How many Available:<?= $row["ItemsAvailable"] ?></td>
                    <?php
                    if (isset($_SESSION["UserRole"]) && $_SESSION["UserRole"] == "Admin") {
                    ?>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="ProductToDelete" value="<?= $row["ID_Product"] ?>">
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    <?php
                    } else {
                    ?>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="ProductToBuy" value="<?= $row["ID_Product"] ?>">
                                <input type="number" name="HowManyItems" value="0">
                                <input type="submit" value="Add to cart">
                            </form>
                        </td>
                    <?php
                    }
                    ?>
                </tr>
        <?php
            }
        } else {
            print "Something went wrong when selecting data";
        }

        ?>

    </table>
</body>

</html>