<?php
include("includes/config.php");
 
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'includes/header.php'?>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
         
        <?php include 'includes/topbar.php'?>
        <?php include 'includes/sidebar.php'?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6 animated bounceInRight">
                     <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-user-tie"></span> Add User</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add user</li>
                     </ol>
                  </div>
                  <!-- /.col -->
               </div>
               <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
         </div>
         <!-- /.content-header -->
         <!-- Main content -->
         <section class="content">
            <div class="container-fluid">
               <div class="card card-info">
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="POST" enctype="">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label><span class="fa fa-user-tie"></span> User Information</label>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label>Law Office</label>
                                       <input type="text" class="form-control" name="office" placeholder="Law Office" required>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Full Name</label>
                                       <input type="text" class="form-control" name="names" placeholder="Full Name" required>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Contact</label>
                                       <input type="text" class="form-control" name="contacts" minlength="10" maxlength="10" placeholder="ex. 0785241454" required>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Email</label>
                                       <input type="text" class="form-control" name="email" placeholder="ex. email@gmail.com" required>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label>Address</label>
                                       <input type="text" class="form-control" name="adress" placeholder="ex. 123 kigali. kicukiro kagarama" required>
                                    </div>
                                 </div>
                                
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Education</label>
                                       <input type="text" name="education" class="form-control" placeholder="Education" required>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Licence</label>
                                       <input type="file" class="form-control" name="licence" >
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label>Professional And Legal Experience</label>
                                       <textarea class="form-control" name="experience" required></textarea>
                                    </div>
                                 </div>
                                 
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label><span class="fa fa-user-lock"></span> Account Information</label>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Username</label>
                                       <input type="text" class="form-control" name="username" placeholder="Username" required>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Password</label>
                                       <input type="password" name="password" class="form-control" placeholder="**********" required>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                     <!-- /.card-body -->

                     <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                     </div>
                  </form>
               </div>
            </div>
            <!-- /.container-fluid -->
         </section>
         <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
   </div>
   <!-- ./wrapper -->
   <!-- jQuery -->
   <script src="../asset/jquery/jquery.min.js"></script>
   <script src="../asset/js/adminlte.js"></script>

</body>

</html>
<?php
if(isset($_POST['submit']))
{
   $names=$_POST['names'];
   $email=$_POST['email'];
   @$office=$_POST['office'];
   $contact=$_POST['contacts'];
   $username=$_POST['username'];
   $password=md5($_POST['password']); 
   $education=$_POST['education']; 
   $experience=$_POST['experience']; 
   $adress=$_POST['adress'];
   $licence=$_POST['licence'];
   $status=1; 
   //default account status

   $sql="INSERT INTO  lawyer(fullname,email,adress,contacts,office,education,experience,license,username,password,status) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
$query = $dbh->prepare($sql);
$query->execute(array($names,$email,$adress,$contact,$office,$education,$experience,$licence,$username,$password,$status));
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Lawyer added ');window.location='lawyers.php'; </script>";
}
else 
{
   echo "<script>alert('Something went wrong please retry'); </script>";

}

} 
?>