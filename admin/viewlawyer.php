<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php' ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include 'includes/topbar.php' ?>
        <?php include 'includes/sidebar.php' ?>
        <?php
        $lawid = $_GET['lawid'];
        $sql = "SELECT * from lawyer where lawid = ?";
        $query = $dbh->prepare($sql);
        $query->execute(array($lawid));
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
            foreach ($results as $result) {
            }
        } ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-graduation-cap"></span>
                                <?php echo $result->fullname; ?>
                            </h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">View lawyer</li>
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
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning elevation-1"><i
                                        class="fas fa-address-card"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Personal information </span>
                                    <span class="info-box-number">
                                        <?php echo $result->fullname; ?>
                                    </span>
                                    <span class="info-box-number">
                                        <?php echo $result->contacts; ?>
                                    </span>
                                    <span class="info-box-number">
                                        <?php echo $result->email; ?>
                                    </span>
                                    <span class="info-box-number">
                                        <?php echo $result->adress; ?>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-tie"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Education details</span>
                                    <span class="">
                                        <?php echo $result->education; ?>
                                    </span>
                                    <span class="">
                                        <?php echo $result->experience; ?>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i
                                        class="fas fa-hand-holding-heart"></i></span>

                                <div class="info-box-content">
                                <?php $sql = "SELECT * from services WHERE lawyerid=? order by serviceid desc";
                        $query = $dbh -> prepare($sql);
                        $query->execute(array($lawid));
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount() > 0)
                        {
                        foreach($results as $result)
                        {  ?>
                                    <span class="info-box-text"><?php echo $result->name; ?></span>
                                    <?php }} ?>

                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-indigo elevation-1"><i class="fas fa-plus"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Add new service</span>
                                    <form method="POST">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>SERVICE NAME</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Service name" required>
                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" name="save" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($_POST['save'])) {
                                        $service = $_POST['name'];
                                        $lawid = $_GET['lawid'];
                                        $sql = "INSERT INTO services (name,lawyerid) values (?,?)";
                                        $query = $dbh->prepare($sql);
                                        $query->execute(array($service, $lawid));

                                        if ($query) {
                                            echo "<script>alert('service added');window.location='viewlawyer.php?lawid=$lawid'; </script>";
                                        } else {
                                            echo "<script>alert('Something went wrong please retry'); </script>";

                                        }

                                    }
                                    ?>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row (main row) -->
                <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-calendar"></span>
                                Current appointments
                            </h1>

                <div class="col-md-12 table-responsive"><br>
                  <table id="example1" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>Client name</th>
                           <th>ID</th>
                           <th>Contact</th>
                           <th>Email</th>
                           <th>Adress</th>
                           <th>Service</th>
                           <th class="text-right">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $sql = "SELECT * from lawyer order by lawid desc";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount() > 0)
                        {
                        foreach($results as $result)
                        {  ?>
                    
                        <tr>
                           <td><?php echo $result->fullname; ?></td>
                           <td><?php echo $result->adress; ?></td>
                           <td><?php echo $result->contacts; ?></td>
                           <td><?php echo $result->email; ?></td>
                           <td><?php echo $result->experience; ?></td>
                           <td><?php echo $result->education; ?></td>

                           <td class="text-right">
                              <a class="btn btn-sm btn-info" href="viewlawyer.php?lawid=<?php echo $result->lawid; ?>"><i class="fa fa-eye"></i> view Chat</a>
                              <a class="btn btn-sm btn-success" href="editlawyer.php?lawid=<?php echo $result->lawid; ?>"><i class="fa fa-edit"></i> Follow up</a>
                             
                           </td>
                        </tr>
                        <?php }} ?>
                      
                        
                        </tbody>
                  </table>
               </div>
        </div>
        <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

    <?php include 'includes/footer.php' ?>
</body>

</html>