<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>User Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='assignment.css'>
    <script src='main.js'></script>
</head>

<body>

<div class="nav">

<?php
include_once "dbWebs.php";



if(isset($_POST["logout"])){

    session_unset();
    session_destroy();
    $_SESSION["isUserLoggedIn"] = false;
}

if(isset($_POST["UserName"], $_POST["Psw"])){

    $sql = $connection->prepare("Select * from People where UserName=?");
    if(!$sql){
        die("Error in your sql");
    }

    $sql->bind_param("s", $_POST["UserName"]);
    if(!$sql->execute()){

        die("Error execute sql statement");
    }

    $result = $sql->get_result();

    if($result->num_rows==0){
        print "Your username is not in our database";
    } else {
       
        $row = $result->fetch_assoc();

        if(password_verify($_POST["Psw"], $row["Psw"])){
            print "You typed the correct password. You are now logged in";
            $_SESSION["isUserLoggedIn"] = true;
            $_SESSION["CurrentUser"]=$_POST["UserName"];
            $_SESSION["UserRole"]=$row["UserRole"];
        } else {
            print "Wrong password";
        }
    }
}

include_once "Navigation.php";
if($_SESSION["isUserLoggedIn"]){
    ?>

    <h1>Logout Page</h1>
    <form method="POST">
        <input type="submit" value="logout" name="logout">
    </form>

    <?php
} else {
    ?>
    <h1>Login here please.</h1>
    <form method="POST">
        <label for="UserName">Your UserName</label> <input name="UserName">
        <label for="Psw">Your Password</label> <input name="Psw" type="password">
        <input type="submit" value="login">
    </form>
    <?php
}

?>

</div>

</body>

</html>