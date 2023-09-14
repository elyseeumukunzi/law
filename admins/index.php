<?php
include("../config.php"); 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Law-Office-Management-Information-System</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
   </head>
   <body class="hold-transition login-page">
      <div class="login-box">
         <!-- /.login-logo -->
         <div class="card card-outline card-info">
            <div class="card-header text-center">
               <a href="#" class="brand-link">
               <img src="../asset/img/logoadmin.png" alt="DSMS Logo" width="200">
               </a>
            </div>
            <div class="card-body" >
               <form method="POST">
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" name="username" placeholder="Username" required>
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-user"></span>
                        </div>
                     </div>
                  </div>
                  <div class="input-group mb-3">
                     <input type="password" class="form-control" name="password" placeholder="Password" required>
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-lock"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                    
                    
                     <div class="col-6">
                        <button class="btn btn-block btn-primary" style="color: aliceblue;" type="submit" name="login">Login</a>
                     </div>
                     
                  </div>
               </form>
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </div>
      <!-- /.login-box -->
   </body>
</html>
<?php
if(isset($_POST['login']))
{
$username=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT fullname,adminid,password,username FROM admin WHERE username=? and password=?";
$query= $dbh -> prepare($sql);
$query-> execute(array($username,$password));
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $result)
	{
if($query->rowCount() > 0)
{
$_SESSION['userid']=$result->userid;
$_SESSION['fname']=$result->fullname;
$_SESSION['role']="admin";

echo "<script type='text/javascript'> document.location = '../admin'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";
  
}
}
}


?>