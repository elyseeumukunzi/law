<?php
include ("config.php");
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
      <link rel="stylesheet" href="asset/fontawesome/css/all.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="asset/css/adminlte.min.css">
   </head>
   <body class="hold-transition login-page">
      <div class="login-box" style="width:600px">
         <!-- /.login-logo -->
         <div class="card card-outline card-info">
            <div class="card-header text-center">
               <h2>Create new account</h2>
            </div>
            <div class="card-body" >
               <form method="POST">
                  <div class="input-group mb-3">
                     <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-user"></span>
                        </div>
                     </div>
                  </div>
                  <div class="input-group mb-3">
                     <input type="text" name="id" class="form-control" placeholder="ID *16 digits" maxlength="16" minlength="16" required>
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-address-card"></span>
                        </div>
                     </div>
                  </div>
                  <div class="input-group mb-3">
                     <input type="text" name="contacts" class="form-control" placeholder="Phone number *10 digits" maxlength="16" minlength="16" required>
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-phone"></span>
                        </div>
                     </div>
                  </div>
                  <div class="input-group mb-3">
                     <input type="email" name="email" class="form-control" placeholder="Email" required>
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-mail-bulk"></span>
                        </div>
                     </div>
                  </div>
                  <div class="input-group mb-3">
                     <input type="email" class="form-control" name="adress" placeholder="Adress" required>
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-location-arrow"></span>
                        </div>
                     </div>
                  </div>
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" name="username" placeholder="username" required>
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
                        <button class="btn btn-block btn-success" type="submit" name="submit" style="color: aliceblue;" type="submit" name="admin">Submit</a>
                     </div>
                     
                  </div>
               </form>
               <a href="login.php"><center>have an account? Login</center></a>
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </div>
      <!-- /.login-box -->
   </body>
</html>
<?php
if(isset($_POST['submit']))
{
   $names=$_POST['name'];
   $id=$_POST['id'];
   $email=$_POST['email'];
   $username=$_POST['username'];
   $contacts=$_POST['contacts'];
   $password=$_POST['password'];
   $adress=$_POST['adress'];
   $status=1; //default account status

   $sql="INSERT INTO  users(fullname,id,contacts,email,adress,username,password,status) VALUES(?,?,?,?,?,?,?,?)";
$query = $dbh->prepare($sql);
$query->execute(array($names,$id,$contacts,$email,$adress,$username,$password,$status));
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('account created');</script>"
}
else 
{
$error="Something went wrong. Please try again";
}

} 
?>