<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>User Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='Assignment.css'>
    <script src='main.js'></script>
</head>



<div class="nav">
   <a href="UserLogin.php">Login</a>
   <a href="UserSignUp.php">User SignUp</a>
   <a href="ViewProducts.php">View Products</a>

   <?php 
   if(isset($_SESSION["UserRole"])&&$_SESSION["UserRole"]=="Admin"){
     
   ?>
      <a href="AddCountry.php">Add Country</a>
      <a href="AddProducts.php">Add Products</a>
   <?php
   }
   ?>
</div>


</head>
</html>