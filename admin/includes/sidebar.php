<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-1">
   <!-- Brand Logo -->
   <a href="index.php" class="brand-link animated swing">
      <img src="../asset/img/logo2.png" alt="DSMS Logo" width="200" style="margin-top: -5px;margin-bottom: -60px;">
   </a>
   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php
            $role=$_SESSION['role'];
           if($role== 'user')
           { ?>
           <li class="nav-item">
               <a href="index.php" class="nav-link">
                  <i class="nav-icon fa fa-user"></i>
                  <p>
                     My Profile
                  </p>
               </a>
            </li>

           
            <li class="nav-item">
               <a href="retainerservice.php" class="nav-link">
               <i class="nav-icon fa fa-file"></i>
                  <p>
                     Retainer service
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="myappointment.php" class="nav-link">
               <i class="nav-icon fa fa-calendar"></i>
                  <p>
                     My Cases
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="attorney.php" class="nav-link">
                  <i class="nav-icon fa fa-landmark"></i>
                  <p>
                     Law Officers
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="sms.php" class="nav-link">
                  <i class="nav-icon fa fa-comments"></i>
                  <p>
                     Feedback
                  </p>
               </a>
            </li>
            


           <?php
           }
           elseif($role == ' SECRETARY')
           { ?>
            <li class="nav-item">
               <a href="index.php" class="nav-link">
                  <i class="nav-icon fa fa-tachometer-alt"></i>
                  <p>
                     Dashboard
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="office.php" class="nav-link">
                  <i class="nav-icon fa fa-address-card"></i>
                  <p>
                     Profile
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="lawyers.php" class="nav-link">
                  <i class="fas fa-graduation-cap"></i>
                  <p>
                     Manage Lawyers 
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="users.php" class="nav-link">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                     Manage users 
                  </p>
               </a>
            </li>
           
            <li class="nav-item">
               <a href="reports.php" class="nav-link">
                  <i class="nav-icon fa fa-file"></i>
                  <p>
                     Ongoing Cases
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="appointment.php" class="nav-link">
                  <i class="nav-icon fa fa-calendar"></i>
                  <p>
                     Apointments
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="paymentdetails.php" class="nav-link">
                  <i class="nav-icon fa fa-dollar-sign"></i>
                  <p>
                     Payment details
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="hr.php" class="nav-link">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                     HR Registry
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="reports.php" class="nav-link">
                  <i class="nav-icon fa fa-chart-bar"></i>
                  <p>
                     Reports
                  </p>
               </a>
            </li>
           <?php           

           }
           elseif($role== 'lawyer')
           {
            ?>
              <li class="nav-item">
               <a href="lawyerprofile.php" class="nav-link">
                  <i class="nav-icon fa fa-user"></i>
                  <p>
                     Profile
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="appointment.php" class="nav-link">
                  <i class="nav-icon fa fa-calendar-alt"></i>
                  <p>
                     Appointment
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="services.php" class="nav-link">
                  <i class="nav-icon fa fa-hand-holding-heart"></i>
                  <p>
                     My Services
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="cases.php" class="nav-link">
                  <i class="nav-icon fa fa-book"></i>
                  <p>
                    Case Management
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="payments.php" class="nav-link">
                  <i class="nav-icon fa fa-dollar-sign"></i>
                  <p>
                    Payment Management
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="services.php" class="nav-link">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                     Service Requests
                  </p>
               </a>
            </li>
            </li>
            <li class="nav-item">
               <a href="feedback.php" class="nav-link">
                  <i class="nav-icon fa fa-comments"></i>
                  <p>
                     Inbox
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="reports.php" class="nav-link">
                  <i class="nav-icon fa fa-chart-bar"></i>
                  <p>
                     Reports
                  </p>
               </a>
            </li>

            <?php
           }
            ?>  
           
           
           
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>