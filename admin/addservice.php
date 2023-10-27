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
                            <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-file"></span><span
                                    class="fa fa-plus"></span>Add Service
                            </h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Add service</li>
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
                        <form method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label><span class="fa fa-pen"></span>
                                                        ADD New Service
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Service name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Service name">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Service Description</label>
                                                    <textarea class="form-control" name="desc"></textarea>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="save">Save</button>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['save'])) {
                            $service = $_POST['name'];
                            $lawid = $_SESSION['userid'];
                            $description = $_POST['desc'];

                            $sql = "INSERT INTO services (name,Description,lawyerid) values (?,?,?)";
                            $query = $dbh->prepare($sql);
                            $query->execute(array($service, $description, $lawid));

                            if ($query) {
                                echo "<script>alert('service added');window.location='services.php'; </script>";
                            } else {
                                echo "<script>alert('Something went wrong please retry'); </script>";

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