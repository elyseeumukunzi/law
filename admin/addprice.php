<!DOCTYPE html>
<html lang="en">

<?php include 'includes/header.php' ?>

<body class="hold-transition sidebar-mini layout-fixed">
   <div class="wrapper">

      <?php include 'includes/topbar.php' ?>
      <?php include 'includes/sidebar.php' ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6 animated bounceInRight">
                     <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-dollar-sign"></span> Add or
                        modify case price</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Attorney</li>
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
                  <?php
                  $appid = $_GET['appid'];
                  $sql = "SELECT * from services,users,appointments WHERE users.userid=appointments.userid AND appointments.serviceid=services.serviceid AND appointments.appid=?";
                  $query = $dbh->prepare($sql);
                  $approved = 1;
                  $query->execute(array($appid));
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  $cnt = 1;
                  if ($query->rowCount() > 0) {
                     foreach ($results as $result) {
                        $status = $result->status;

                        ?>
                        <form method="POST">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <div class="form-group">
                                             <label><span class="fa fa-user"></span>
                                                <?php echo $result->fullname; ?>
                                             </label>
                                          </div>
                                       </div>
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <label>Servie name</label>
                                             <input type="text" class="form-control" value="<?php echo $result->name; ?>" disabled>
                                          </div>
                                       </div>
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <label>Price</label>
                                             <input type="text" name="price" class="form-control" placeholder="ex. 20000"
                                                value="<?php echo $result->price; ?>">
                                          </div>
                                       </div>

                                    </div>
                                 </div>

                              </div>
                              <!-- /.card-body -->

                              <div class="card-footer">
                                 <button type="submit" name="save" class="btn btn-primary">Save</button>
                                <a href="cases.php">  <button type="button" class="btn btn-primary">Cancel</button></a>

                              </div>
                        </form>
                     <?php }
                  }
                  if(isset($_POST['save']))
                  {
                     $appid=$_GET['appid'];
                     $price=$_POST['price'];
                     $sql="UPDATE appointments SET price = ? WHERE appid = ?";
                     $update=$dbh->prepare($sql);
                     $update->execute(array($price,$appid));
                     if($update)
                     {
                        echo "<script>alert('Price Saved'); window.location='cases.php';</script>";
                     }

                  }


                  ?>
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