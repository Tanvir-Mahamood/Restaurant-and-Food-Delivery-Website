<?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
         <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }

   else if (isset($_SESSION['user_name']) && isset($wel) && $wel == '1') {
         echo '
         <div class="message">
            <span> Welcome ' .$_SESSION['user_name']. '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
         $wel = 'nai';
   }
   else if(!isset($_SESSION['user_name'])) {
      //echo 'Please login or sign up';
      echo '
         <div class="message">
            <span>Please login or sign up</span>
         </div>
         ';
   }
?>

<header class="header">
   <section class="flex">
      <div class="logo">
         <a href="home.php"><img src="images/main_logo.jpg" style="mix-blend-mode: multiply;"></a>
      </div>

      <a href="home.php">
         <h2>64bit Kitchen</h2>
      </a>

      <div class="icons">
         <?php
         $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $count_cart_items->execute([$user_id]);
         $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="search.php"><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
            <p class="name"><?= $fetch_profile['name']; ?></p>
            <div class="flex">
               <a href="profile.php" class="btn">profile</a>
               <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
            </div>
            <!--<p class="account">
               <a href="login.php">login</a> or
               <a href="register.php">register</a>
            </p>-->
         <?php
         } else {
         ?>
            <p class="name">please login first!</p>
            <a href="login.php" class="btn">login</a>
         <?php
         }
         ?>
      </div>

   </section>
</header>

<div class="heading">
   <h3>Satisfy your cravings with food made to lift your mood.</h3>
   <nav class="navbar2">
      <a href="home.php">home</a>
      <a href="about.php">about</a>
      <a href="menu.php">menu</a>
      <a href="orders.php">orders</a>
      <a href="contact.php">contact</a>
   </nav>
</div>