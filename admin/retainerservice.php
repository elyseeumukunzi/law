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
                  <div class="col-sm-6">
                     <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-hand-holding-heart"></span>
                        Services</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Office</li>
                     </ol>
                  </div>
                  <a class="btn btn-sm elevation-2" href="add-attorney.php"
                     style="margin-top: 20px;margin-left: 10px;background-color: #05445E;color: #ddd;"><i
                        class="fa fa-plus"></i>
                     Add New</a>
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

                  <div class="col-md-12 table-responsive"><br>
                     <table id="example1" class="table table-bordered table-hover">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Service Name</th>
                              <th>Description</th>
                              <th>Rate</th>
                              <th class="text-right">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $lawid = $_SESSION['userid'];
                           $sql = "SELECT * from services,lawyer WHERE lawyer.lawid=services.lawyerid order by serviceid desc";
                           $query = $dbh->prepare($sql);
                           $query->execute();
                           $results = $query->fetchAll(PDO::FETCH_OBJ);
                           $cnt = 1;
                           if ($query->rowCount() > 0) {
                              foreach ($results as $result) { ?>
                                 <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $result->name; ?></td>
                                    <td><?php echo $result->Description; ?></td>
                                    <td><span class="fa fa-star"></span></td>
                                    <td class="text-right">
                                       <a class="btn btn-sm btn-success" href="#"><i class="fa fa-edit"></i> edit</a>
                                       <a class="btn btn-sm btn-danger" href="#" data-toggle="modal" data-target="#delete"><i
                                             class="fa fa-trash-alt"></i> delete</a>
                                    </td>
                                 </tr>
                              <?php $cnt=$cnt+1;}
                           } ?>


                        </tbody>
                     </table>
                  </div>
               </div>
            </div>

            <!-- /.container-fluid -->
         </section>
         <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
   </div>
   <!-- ./wrapper -->
   <div id="delete" class="modal animated rubberBand delete-modal" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-body text-center">
               <img src="../asset/img/sent.png" alt="" width="50" height="46">
               <h3>Are you sure want to delete this User?</h3>
               <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                  <button type="submit" class="btn btn-danger">Delete</button>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- jQuery -->
   <script src="../asset/jquery/jquery.min.js"></script>
   <script src="../asset/js/bootstrap.bundle.min.js"></script>
   <script src="../asset/js/adminlte.js"></script>
   <!-- DataTables  & Plugins -->
   <script src="../asset/tables/datatables/jquery.dataTables.min.js"></script>
   <script src="../asset/tables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
   <script src="../asset/tables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>s
   <script src="../asset/tables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
   <script>
      $(function () {
         $("#example1").DataTable();
      });
   </script>
</body>

</html>