<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['tlogin']) == 0) {
    header('location:tindex.php');
} else {
    if (isset($_REQUEST['eid'])) {
        $eid = intval($_GET['eid']);
        $status = 1;
        $sql = "UPDATE tablehospitalalert SET status=:status WHERE  Notification_id=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();

        $msg = " Message marked as Read.";
    }
    if (isset($_GET['del'])) {
        $aeid = $_GET['del'];
        $sql = "delete from tablehospitalalert  WHERE Notification_id=:aeid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
        $query->execute();
        $msg = " Hospital Notification deleted successfully!";
    }
    ?>

    <!doctype html>
    <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>Admin | Manage Hospital Notifications</title>
            <link rel="stylesheet" href="css/font-awesome.min.css"> <!-- Bootstrap Icons -->
            <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Main Bootstrap -->
            <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">   <!-- Bootstrap Data tables --> 
            <link rel="stylesheet" href="css/style.css"> <!-- Header Stye -->

            <style>
                .errorWrap {
                    padding: 10px;
                    margin: 0 0 20px 0;
                    background: #fff;
                    border-left: 4px solid #dd3d36;
                    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                }
                .succWrap{
                    padding: 10px;
                    margin: 0 0 20px 0;
                    background: #fff;
                    border-left: 4px solid #5cb85c;
                    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                }
            </style>

        </head>

        <body>
            <?php include('includes/header.php'); ?>

            <div class="ts-main-content">
                <?php include('includes/leftbar.php'); ?>
                <div class="content-wrapper">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">

                                <h2 class="page-title"><font face="Comic Sans MS" color="red">Manage Hospital Notifications</font></h2>

                                <!-- Zero Configuration Table -->
                                <div class="panel panel-default">
                                    <div class="panel-heading" style="color: green;">Hospital Notifications and Alerts</div>
                                    <div class="panel-body">
                                        <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) {
                                            ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                                        <div style="overflow-x:auto;">                             
                                            <table id="zctb" class="display table table-striped table-bordered table-hover"  cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th style="color:blue;">#</th>
                                                        <th style="color:blue;">Hospital Name</th>
                                                        <th style="color:blue;">Email</th>
                                                        <th style="color:blue;">Contact No</th>
                                                        <th style="color:blue;">Message</th>
                                                        <th style="color:blue;">Donor Name</th>
                                                        <th style="color:blue;">Passport/IC Number</th>
                                                        <th style="color:blue;">Organ Donated</th>
                                                        <th style="color:blue;">Blood Type</th>
                                                        <th style="color:blue;">State</th>
                                                        <th style="color:blue;">Posting Date</th>
                                                        <th style="color:blue;">Status</th>
                                                        <th style="color:blue;">Action</th>
                                                        <th style="color:blue;">Delete</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th style="color:blue;">#</th>
                                                        <th style="color:blue;">Hospital Name</th>
                                                        <th style="color:blue;">Email</th>
                                                        <th style="color:blue;">Contact No</th>
                                                        <th style="color:blue;">Message</th>
                                                        <th style="color:blue;">Donor Name</th>
                                                        <th style="color:blue;">Passport/IC Number</th>
                                                        <th style="color:blue;">Organ Donated</th>
                                                        <th style="color:blue;">Blood Type</th>
                                                        <th style="color:blue;">State</th>
                                                        <th style="color:blue;">Posting Date</th>
                                                        <th style="color:blue;">Status</th>
                                                        <th style="color:blue;">Action</th>
                                                        <th style="color:blue;">Delete</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>

                                                    <?php
                                                    $sql = "SELECT * from  tablehospitalalert ";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt = 1;
                                                    if ($query->rowCount() > 0) {
                                                        foreach ($results as $result) {
                                                            ?>	
                                                            <tr>
                                                                <td><?php echo htmlentities($cnt); ?></td>
                                                                <td><?php echo htmlentities($result->HospitalName); ?></td>
                                                                <td><?php echo htmlentities($result->Email); ?></td>
                                                                <td><?php echo htmlentities($result->ContactNumber); ?></td>
                                                                <td><?php echo htmlentities($result->Message); ?></td>
                                                                <td><?php echo htmlentities($result->FullName); ?></td>
                                                                <td><?php echo htmlentities($result->Passport); ?></td>
                                                                <td><?php echo htmlentities($result->OrganDonated); ?></td>
                                                                <td><?php echo htmlentities($result->BloodType); ?></td>
                                                                <td><?php echo htmlentities($result->State); ?></td>                                                            
                                                                <td><?php echo htmlentities($result->PostingDate); ?></td>
                                                                <?php
                                                                if ($result->status == 1) {
                                                                    ?><td>Read</td>
                                                                <?php } else { ?>

                                                                    <td><a href="manage-hospital-notifications.php?eid=<?php echo htmlentities($result->Notification_id); ?>" onclick="return confirm('Do you want to mark the notification as read?')" >Pending</a>
                                                                    </td>
                                                                <?php } ?>
                                                                <td>   <a class="btn btn-md btn-info btn-xs" href="match-organs.php" role="button">Match Organs</a>
                                                                </td>
                                                                <td>
                                                                    <a href="manage-hospital-notifications.php?del=<?php echo $result->Notification_id; ?>"><button class="btn btn-danger btn-xs" onclick="return confirm('Do you want to delete this hospital notification?');"><span class="glyphicon glyphicon-trash"></span></button></a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $cnt = $cnt + 1;
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading Scripts -->
            <script src="js/jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/jquery.dataTables.min.js"></script>
            <script src="js/dataTables.bootstrap.min.js"></script>
            <script src="js/main.js"></script>
        </body>
    </html>
    <?php
}