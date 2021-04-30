<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>View Products</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <?php
        include_once("dbWebs.php");
        include_once "Navigation.php";
    ?>
    <h1>Products</h1>

    <table>
        <?php
            $sqlSelect = $connection->prepare("SELECT * from Products");
            $selectionWentOK = $sqlSelect->execute();

            if($selectionWentOK){
                $result = $sqlSelect->get_result();
                while($row=$result->fetch_assoc()){
                    ?>
                    <tr>
                        <td>Product Name:<?=$row["ProductName"]?></td>
                        <td>Price:<?=$row["Price"]?></td>
                        <td>How many Available:<?=$row["ItemsAvailable"]?></td>
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