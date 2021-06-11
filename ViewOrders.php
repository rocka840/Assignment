<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>View Orders</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>

<body>

    <?php
    include_once("dbWebs.php");
    include_once("AdminCheck.php");
    include_once "Navigation.php";

    // at this point I AM AN ADMINISTRATOR USER !!

    $sqlSelect = $connection->prepare("SELECT ID_Orders,UserName from orders,people where orders.PersonOrder=people.ID_Person");
    $selectionWentOK = $sqlSelect->execute();

    if ($selectionWentOK) {
        $result = $sqlSelect->get_result();
        print("This is a list of all your orders");
    ?>
        <table>
        <tr>
            <th>Order ID</th>
            <th>User</th>
        </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                print("<tr>");
                print("<td>".$row["ID_Orders"] . "</td><td> " . $row["UserName"]."</td>");
                print("</td>");
            }

            ?>
        </table>
    <?php
    }

    ?>


</body>

</html>