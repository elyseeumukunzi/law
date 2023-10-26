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
                            <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-envelope"></span><span
                                    class="fa fa-comments"></span> Follow up</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Follow up</li>
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
            <?php
            $appid = $_GET['appid'];
            $sql = "SELECT * from followup WHERE appointmentid=?";
            $query = $dbh->prepare($sql);
            $query->execute(array($appid));
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $cnt = 1;
            if ($query->rowCount() > 0) {
                foreach ($results as $result) {
                    $from=$result->fromsender;
                    if($from == 'user')
                    {
                        $float='right';
                        $color='card-success';
                        $from="Sent by you";
                    }
                    else
                    {
                        $float='left';
                        $color='card-primary';
                        $from='Sent by Lawyer';
                    }

                    ?><center>
                    <section class="content col-md-8" style="width:960px" >
                        <div class="container-fluid">
                            <div class="card <?php echo $color; ?>">
                                <!-- /.card-header -->
                                <div class="card-header">
                                    <h3 class="card-title">
                                    <span class="fa fa-info"></span>  <?php echo $result->tittle; ?>
                                    </h3>
                                    <?php echo $from; ?>
                                </div>
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-default">
                                                    <div class="card-header">
                                                        <p><span class="fa fa-envelope"></span>
                                                            <?php echo $result->description; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                You can download the attachement here: <button class="btn btn-default"><i
                                                        class="fa fa-download"></i></button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.container-fluid -->
                    </section>
                    <center>
                <?php }
            }
            ?>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-info">
                        <!-- /.card-header -->
                        <div class="card-header">
                            <h3 class="card-title">Add Something</h3>
                        </div>
                        <!-- form start -->
                        <form method="POST">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-default">
                                            <div class="card-header">
                                                <p><input type="text" name="tittle" class="form-control"
                                                        placeholder="Tittle"></p>

                                            </div>
                                        </div>
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <p><textarea class="form-control" name="desc">

                                                </textarea>
                                                </p>
                                                <input type="file" name="file">
                                                <button class="btn btn-primary" type="submit"
                                                    name="follow">Save</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

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
if (isset($_POST['follow'])) {
    $tittle = $_POST['tittle'];
    $file = $_GET['lawid'];
    $desc = $_POST['desc'];
    $dates=date('d/m/Y');
    $from='user';
    $sql = "INSERT INTO followup (appointmentid,tittle,description,attachement,fromsender,dates) values (?,?,?,?,?,?)";
    $query = $dbh->prepare($sql);
    $query->execute(array($appid, $tittle, $desc, $file, $from, $dates));

    if ($query) {
        echo "<script>alert('Follw up added');window.location='followup.php?appid=$appid'; </script>";
    } else {
        echo "<script>alert('Something went wrong please retry'); </script>";

    }

}
?>