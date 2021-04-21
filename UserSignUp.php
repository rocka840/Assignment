<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>User Signup</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    
<?php
include_once("dbWebs.php");

if(isset(
    $_POST["FirstName"],
    $_POST["LastName"],
    $_POST["UserName"],
    $_POST["Psw"],
    $_POST["Psw2"],
    $_POST["Country"],
    $_POST["UserRole"]
                        )
) {

}
?>

</body>
</html>