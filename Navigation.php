<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Navigation</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='Assignment.css'>
</head>
<body>

<div class="nav">
   <a href="HomePage.php">Home</a>
   <a href="UserLogin.php">Login</a>
   <?php
      if($_SESSION["isUserLoggedIn"] == false){

   ?>
   <a href="UserSignUp.php">SignUp</a>
   <?php
      }
   ?>
   
   <a href="ViewProducts.php">Products</a>
   
   <?php 
   if(isset($_SESSION["UserRole"])&&$_SESSION["UserRole"]=="Admin"){
     
   ?>
      <a href="AddCountry.php">Add Country</a>
      <a href="AddProducts.php">Add Products</a>
      <a href="ViewOrders.php">View Orders</a>
   <?php
   } else if($_SESSION["isUserLoggedIn"]){
      ?>
         <a href="ShoppingCart.php">Checkout: <?= sizeof($_SESSION["ShoppingCart"]) ?> items</a>
         
      <?php
      

   }
   ?>
</div>
</body>
</html>