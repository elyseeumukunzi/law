<?php
include_once("config.php");
session_start();
?>
<!-- Navbar -->

<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: rgba(62,88,113);">
   <!-- Left navbar links -->

   <ul class="navbar-nav">
      <li class="nav-item">
         <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
   </ul>
   <?php
 echo $_SESSION['fname']." <font style='color:white;'>" ."  "." ". $_SESSION['role']; ?>  </font>
   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
      <li class="nav-item">
         <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
         </a>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-widget="fullscreen" href="logout.php">
            <i class="fas fa-power-off"></i>
         </a>
      </li>
   </ul>

</nav>
<!-- /.navbar -->