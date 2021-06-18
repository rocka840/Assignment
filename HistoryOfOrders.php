<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>History Of Orders</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='Assignment.css'>
    <script src='main.js'></script>
</head>

<body>
    <?php
    include_once("dbWebs.php");
    include_once "Navigation.php";

    if ((!$_SESSION["isUserLoggedIn"]) || ($_SESSION["UserRole"] == "Admin")) {
        header("Location: HomePage.php");
        die();
    }

    $transactionHistory = $connection->prepare("SELECT orders.ID_Orders, orderstatus.OrderStatus from orders, orderstatus where orders.PersonOrder=(SELECT ID_Person from people where UserName=?) and orders.OrderStatus = orderstatus.ID_Status");
    $transactionHistory->bind_param("s", $_SESSION["CurrentUser"]);
    $transactionHistory->execute();
    $result = $transactionHistory->get_result();
    $transactionHistory->close();
    print("<table>");
    while ($row = $result->fetch_assoc()) {
    ?>
        <tr>
            <td><?= $row["ID_Orders"] ?></td>
            <td><?= $row["OrderStatus"] ?></td>
        </tr>

    <?php
    }
    print("</table>");


    ?>


</body>

</html>