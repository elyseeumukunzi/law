<!DOCTYPE html>
<html lang="en">

<?php include 'includes/header.php' ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include 'includes/topbar.php' ?>
        <?php include 'includes/sidebar.php';
        if(isset($_GET['approveid']))
        {        
         $appid=$_GET['approveid'];
         $status=1;
         $sql="UPDATE appointments SET paymentstatus = ? WHERE appid = ?";
         $update=$dbh->prepare($sql);
         $update->execute(array($status,$appid));
         if($update)
         {
            echo "<script>alert('Payment approved Saved'); window.location='cases.php';</script>";
         }
        }
        
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0" style="color: rgb(31,108,163);"><span
                                    class="fa fa-dollar-sign"></span>
                                Payment management</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Cases</li>
                            </ol>
                        </div>
                        You can view details of your transaction with clients though the platform
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
                            <table id="" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Dates</th>
                                        <th>Service name</th>
                                        <th>PaidPhone</th>
                                        <th>Holders name</th>
                                        <th>Paid transactionid</th>
                                        <th>Paid Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $lawid = $_SESSION['userid'];
                                    $total=0;
                                    $sql = "SELECT * from services,appointments,payments WHERE appointments.appid=payments.appid AND appointments.serviceid=services.serviceid AND appointments.lawyerid=? AND appointments.paymentstatus = ?";
                                    $query = $dbh->prepare($sql);
                                    $approved = 1;
                                    $query->execute(array($lawid, $approved));
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                            $status = $result->status;
                                            $total=$result->amount + $total
                                             ?>

                                            <tr>
                                                <td>
                                                    <?php echo $result->dates; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result->name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result->paidphone; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result->holdersname; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result->transactionid; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result->amount; ?>
                                                </td> 
                                            </tr>
                                           
                                            <?php $cnt++;
                                        }
                                    } ?>
                                     <tfooter>
                                                <tr>
                                                    <td><b>Totals</b></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><b><?php echo $total;  ?></b></td>
                                                </tr>
                                            </tfooter>


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