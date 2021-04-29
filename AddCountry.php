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
    if($_SESSION["isUserLoggedIn"]){

        if(isset($_POST["NewCountry"])){
            $sqlInsert = $connection->prepare("INSERT INTO Countries (CountryName) values(?)");
            
        }
    }
    ?>


</body>
</html>