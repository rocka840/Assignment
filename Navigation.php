
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
   <?php
   }
   ?>
</div>