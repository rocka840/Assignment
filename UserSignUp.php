<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>User Signup</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='assignment.css'>
    <script src='main.js'></script>
</head>
<body>
    
<?php
include_once("dbWebs.php");
include_once "Navigation.php";


if(isset(
    $_POST["FirstName"],
    $_POST["LastName"],
    $_POST["UserName"],
    $_POST["Psw"],
    $_POST["Psw2"],
    $_POST["Country"]
                        )
) {
    print "We are trying to sign you up!";

    if($_POST["Psw"]==$_POST["Psw2"]) {
        $sql = $connection->prepare("INSERT INTO People(FirstName, LastName, UserName, Psw, UserRole, ID_Country) VALUES(?,?,?,?,?,?)");

        if (!$sql) {
            print "Error in your sql";
        }
        $RegularUserRole = "Normal";
        $hashedPassword = password_hash($_POST["Psw"], PASSWORD_BCRYPT);

        $sql->bind_param(
            "sssssi",
            $_POST["FirstName"],
            $_POST["LastName"],
            $_POST["UserName"],
            $hashedPassword,
            $RegularUserRole,
            $_POST["Country"]
        );

        $ressultOfExecute = $sql->execute();
        if ($ressultOfExecute) {
            print "We are done. Please check the database...";
        } else {
            print 'We could not update the database.';
        }

    } else {
        print "Passwords do not match.";
    }
}
?>

<h1>Welcome to our page. You will signup here</h1>
<div class="container">
    <form class="container" method="POST"><BR>
        <label for="FirstName">First Name</label> <input name="FirstName"> <BR>
        <label for="LastName">Last Name</label> <input name="LastName"> <BR>
        <label for="UserName">User Name</label> <input name="UserName"> <BR>
        <label for="Psw">Password</label> <input name="Psw" type="password"> <BR>
        <label for="Psw2">Re-type Password</label> <input name="Psw2" type="password"> <BR>

        <label for="Country">Country</label>
        <select name="Country">
        
            <?php
            $sqlSelect = $connection->prepare("SELECT * from Countries");
            $selectionWentOK = $sqlSelect->execute();

            if($selectionWentOK){

                $result = $sqlSelect->get_result();
                while ($row = $result->fetch_assoc()){
            ?>
                <option value="<?= $row["ID_Country"] ?>"><?= $row["CountryName"] ?></option>
            <?php
                }
            } else {
                print "Something went wrong when selecting Country data";
            }
            ?>

        </select>

        <input type="submit" name="submit">
    </form>
</div>

</body>
</html>