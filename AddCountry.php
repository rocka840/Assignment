<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Add Country</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>

    <?php
    include_once("dbWebs.php");
    include_once "Navigation.php";

    
    if($_SESSION["isUserLoggedIn"]){
        
        if(isset($_POST["NewCountry"])){
            $sqlInsert = $connection->prepare("INSERT INTO Countries (CountryName) values(?)");
            $sqlInsert->bind_param("s", $_POST["NewCountry"]);
            $resultOfExecute = $sqlInsert->execute();
            if(!$resultOfExecute){
                print "Creation of country, failed.";
            }
            
        }
    } else {
        die("Access denied. Please login first");
    }
    ?>

    <form method="POST">
        Type the new country name:<input name="NewCountry">
        <input type="submit" value="Add">
    </form>

    <h1>Current Existing countries in our database</h1>
    <table>
        <th>
            <td>Country name:</td>
        </th>

        <?php
        $sqlSelect = $connection->prepare("SELECT CountryName from Countries");
        $selectionWentOK = $sqlSelect->execute();

        if($selectionWentOK){
            $result = $sqlSelect->get_result();
            while($row=$result->fetch_assoc()){
                ?>
                <tr>
                    <td><?=$row["CountryName"]?></td>
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