<!DOCTYPE html>
<html lang="en">

<?php include 'includes/header.php' ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include 'includes/topbar.php' ?>
        <?php include 'includes/sidebar.php';
        if (isset($_GET['approveid'])) {
            $appid = $_GET['approveid'];
            $status = 1;
            $sql = "UPDATE appointments SET paymentstatus = ? WHERE appid = ?";
            $update = $dbh->prepare($sql);
            $update->execute(array($status, $appid));
            if ($update) {
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
                                HR management</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Cases</li>
                            </ol>
                        </div>
                        You can manage other top level users to the system
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
                        <form method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label><span class="fa fa-user"></span>
                                                        Add new
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>User role</label>
                                                <select class="form-control" name='role'>
                                                    <option>Secretary</option>
                                                    <option>Manager</option>

                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input type="text" class="form-control" name="name">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Contacts</label>
                                                    <input type="text" class="form-control" name="phone">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Email <span class="fa fa-arrow-down"></span>
                                                        <input type="text" name="email" class="form-control"
                                                            placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Username <span class="fa fa-arrow-down"></span>
                                                        <input type="text" name="username" class="form-control"
                                                            placeholder="Username">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Password
                                                        <input type="text" name="password" class="form-control"
                                                            placeholder="*****">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">

                                    <button type="submit" name="save" class="btn btn-success">Save <span
                                            class="fa fa-download"></span></button>

                                </div>
                        </form>
                        <?php
                        if (isset($_POST['save'])) {
                            $phone = $_POST['phone'];
                            $password = $_POST['password'];
                            $name = $_POST['name'];
                            $role = $_POST['role'];
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $status = 1;
                            $sql = "INSERT INTO admin (fullname,email,contacts,username,role,password,status) VALUES(?,?,?,?,?,?,?)";
                            $save = $dbh->prepare($sql);
                            $save->execute(array($name, $email, $phone, $username, $role, $password, $status));
                            if ($save = 1) {

                                echo "<script>window.alert('User was added!!'); window.location='hr.php'; </script>";
                            }


                        }
                        ?>


                        <div class="col-md-12 table-responsive"><br>
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Fullname</th>
                                        <th>Contact</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $lawid = $_SESSION['userid'];
                                    $sql = "SELECT * from admin";
                                    $query = $dbh->prepare($sql);
                                    $approved = 1;
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                            $status = $result->status; ?>

                                            <tr>
                                                <td>
                                                    <?php echo $cnt; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result->fullname; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result->contacts; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result->username; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result->email; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result->role; ?>
                                                </td>




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