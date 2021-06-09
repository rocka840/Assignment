
<?php
if (
    !isset($_SESSION["UserRole"]) ||
    $_SESSION["UserRole"] != "Admin"
) {
    header("Location: HomePage.php");
    die("Access denied");
}
?>