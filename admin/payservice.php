<?php include 'pay_parse.php';
?>

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
                            <h1 class="m-0" style="color: rgb(31,108,163);"><span class="fa fa-dollar-sign"></span> Add
                                or
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
                        $sql = "SELECT services.name,lawyer.fullname,users.contacts,appointments.price,appointments.status,users.fullname as fn from services,lawyer,appointments,users WHERE users.userid=appointments.userid AND lawyer.lawid=appointments.lawyerid AND appointments.serviceid=services.serviceid AND appointments.appid=?";
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
                                                            You are about to pay the equivalent monetary to the lawyer <b>**Only
                                                                Mobile Money Supported</b>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Servie name</label>
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $result->name; ?>" disabled>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Checkout phone</label>
                                                            <input type="text" class="form-control" name="phone"
                                                                value="<?php echo $result->contacts; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Holder's name</label>
                                                            <input type="text" class="form-control" name="name"
                                                                value="<?php echo $result->fn; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Price</label> Make sure you have active balance <span
                                                                class="fa fa-arrow-down"></span>
                                                            <input type="text" name="price" class="form-control"
                                                                placeholder="ex. 20000" value="<?php echo $result->price; ?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <a href="cases.php"> <button type="button"
                                                    class="btn btn-primary">Cancel</button></a>

                                            <button type="submit" name="save" class="btn btn-success">Pay <span
                                                    class="fa fa-arrow-right"></span></button>

                                        </div>
                                </form>
                            <?php }
                        }
                        if (isset($_POST['save'])) {
                            $phone = $_POST['phone'];
                            $price = $_POST['price'];
                            $holdername = $_POST['name'];

                            $transID = uniqid();
                            $callback = '';
                            $paystatus = 0;
                            hdev_payment::api_id("HDEV-48d87cf2-c648-49c1-9c7c-a1a  12dbc30eb-ID"); //send the api ID to hdev_payment
                            hdev_payment::api_key("HDEV-79d8e552-5bed-4f5a-9551-cd051e32e406-KEY"); //send the api KEY to hdev_payment
                            $pay = hdev_payment::pay($phone, $price, $transID, $callback); //finishing the transaction 
                        
                            //var_dump($pay);//to get payment server response
                            $status = $pay->status; //get transaction status if sent or not
                            $message = $pay->message; //transaction message 
                            if ($status = 1) {
                                $sql = "INSERT INTO payments (appid,amount,paidphone,holdersname,transactionid,status) VALUES(?,?,?,?,?,?)";
                                $save = $dbh->prepare($sql);
                                $save->execute(array($appid, $price, $phone, $holdername, $transID, $paystatus));

                                if ($save = 1) {
                                    $sql = "UPDATE appointments SET paymentstatus = ? WHERE appid = ?";
                                    $update = $dbh->prepare($sql);
                                    $pstatus=2;
                                    $update->execute(array($pstatus, $appid));
                                echo "<script>window.alert('transaction was sent to the phone please checkout!!'); window.location='myappointment.php'; </script>";



                                } else {
                                    //if the query was not ok bring alert
                                    echo "<script>window.alert('failed to load querry'); window.location='myappointment.php'; </script>";

                                }
                            } else {
                                echo "<script>window.alert('transaction was not successfuly sent'); window.location='myappointment.php'; </script>";

                            }


                            //  $appid=$_GET['appid'];
                            //  $price=$_POST['price'];
                            //  $sql="UPDATE appointments SET price = ? WHERE appid = ?";
                            //  $update=$dbh->prepare($sql);
                            //  $update->execute(array($price,$appid));
                            //  if($update)
                            //  {
                            //     echo "<script>alert('Price Saved'); window.location='cases.php';</script>";
                            //  }
                        
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