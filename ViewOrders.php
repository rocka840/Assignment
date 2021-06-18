<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>View Orders</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='assignment.css'>
    <script src='main.js'></script>
</head>
<body>
    <?php
    include_once("dbWebs.php");
    include_once("AdminCheck.php");
    include_once "Navigation.php";

    if(!isset($_GET["ID_Orders"]))
        print("Wrong access of this page. Please select an order to view and edit FIRST!");


    if(isset($_GET["OrderStatus"])){
        $updateOrder = $connection->prepare("Update Orders set OrderStatus = ? where ID_Orders = ?");
        $updateOrder->bind_param("ii",$_GET["OrderStatus"], $_GET["ID_Orders"]);
        $updateOrder->execute();
        $updateOrder->close();
    }
    ?>

    This page will allow you to change the status id of order number: <?= $_GET["ID_Orders"]?>
    <form method="GET">
        <input type="hidden" name="ID_Orders" value=<?= $_GET["ID_Orders"]?>>
        <select name="OrderStatus" value="option">
            <?php
                $statusListSelect = $connection->prepare("Select * from OrderStatus");
                $statusListSelect->execute();
                $resultStatus = $statusListSelect->get_result();
                $statusListSelect->close();

                while($row=$resultStatus->fetch_assoc()){
                    ?>
                    <option value=<?= $row["ID_Status"] ?> <?php if(isset($_GET["OrderStatus"]) && $_GET["OrderStatus"] == $row["ID_Status"]) {print "selected";}?>><?= $row["OrderStatus"] ?></option>
                    <?php
                    
                }
            ?>
        </select>
                <input type="submit" value="Save">
    </form>
</body>
</html>