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
                                    class="fa fa-hand-holding-heart"></span>
                                Case management</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Cases</li>
                            </ol>
                        </div>
                        You can check on your current running cases thus keeping in touch with your clients
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
                                        <th>Dates</th>
                                        <th>Customer</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Service Name</th>
                                        <th>Price</th>
                                        <th>Payment Status</th>
                                        <th>Case action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $lawid = $_SESSION['userid'];
                                    $sql = "SELECT * from services,users,appointments WHERE users.userid=appointments.userid AND appointments.serviceid=services.serviceid AND appointments.lawyerid=? AND appointments.status = ?";
                                    $query = $dbh->prepare($sql);
                                    $approved = 1;
                                    $query->execute(array($lawid, $approved));
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                            $status = $result->status; ?>

                                            <tr>
                                                <td>
                                                    <?php echo $result->dates; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result->fullname; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result->contacts; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result->email; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result->name; ?>
                                                </td>
                                                <td>
                                                    <?php if (!empty($result->price)) { ?> <a
                                                            href="addprice.php?appid=<?php echo $result->appid; ?>&action=new"><button
                                                                class="btn btn-default">

                                                                <?php echo $result->price . " </button></a>";
                                                    } else {
                                                        ?>
                                                                <a href="addprice.php?appid=<?php echo $result->appid; ?>&action=new"><button
                                                                        class="btn btn-default">

                                                                        <?php echo "Add price </button></a>";



                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                <?php
                                                    if ($result-> paymentstatus == 1) {
                                                        ?>
                                                        <span class="badge bg-default">approved</span>
                                                       
                                                    </td>
                                                    <?php
                                                    } elseif ($result->paymentstatus == 0) {
                                                        ?>
                                                    <span class="badge bg-info">Waiting for client</span>
                                                    <a href="appointment.php?action=aprove&appid=<?php echo $result->appid; ?>">
                                                        <img src="images/offBlue.png" alt="Comfirm payment"></td></a>

                                                    <?php

                                                    }
                                                    elseif($result->paymentstatus == 2)
                                                    {
                                                        ?>
                                                        <a href="cases.php?approveid=<?php echo $result->appid; ?>"><img src="images/offBlue.png"></a>
                                                        <?php

                                                    }
                                                    ?>
                                                </td>

                                                <td>
                                                    <?php
                                                    if ($status == 1) {
                                                        ?>
                                                        <span class="badge bg-warning">case approved</span>
                                                        <a href="followup.php?appid=<?php echo $result->appid; ?>"><button
                                                                class="btn btn-default"><i
                                                                    class="fa fa-arrow-right"></i></button></a>
                                                    </td>


                                                    <?php
                                                    } elseif ($status == 0) {
                                                        ?>
                                                    <span class="badge bg-info">Waiting</span>
                                                    <a href="appointment.php?action=aprove&appid=<?php echo $result->appid; ?>">
                                                        <img src="images/offBlue.png"></td></a>

                                                    <?php

                                                    }
                                                    ?>
                                            </tr>
                                            <?php $cnt++;
                                        }
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