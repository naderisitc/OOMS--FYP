<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['tlogin']) == 0) {
    header('location:tindex.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "delete from tablegeneralhospital  WHERE Hospital_id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $msg = " Hospital account deleted successfully!";
    }
    ?>

    <!doctype html>
    <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>Admin |  Manage Hospital Account  </title>

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

                                <h2 class="page-title"><font face="Comic Sans MS" color="red">Manage Hospital Accounts</font></h2>

                                <!-- Zero Configuration Table -->
                                <div class="panel panel-default">
                                    <div class="panel-heading" style="color: green;">Available Hospital Accounts</div>
                                    <div class="panel-body">
                                        <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) {
                                            ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                                        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="color:blue;">#</th>
                                                    <th style="color:blue;">Hospital Name</th>
                                                    <th style="color:blue;">Username</th>
                                                    <th style="color:blue;">Email</th>
                                                    <th style="color:blue;">Phone Number</th>
                                                    <th style="color:blue;">Creation Date</th>
                                                    <th style="color:blue;">Last Updated Date</th>
                                                    <th style="color:blue;">Actions To Perform</th>

                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th style="color:blue;">#</th>
                                                    <th style="color:blue;">Hospital Name</th>
                                                    <th style="color:blue;">Username</th>
                                                    <th style="color:blue;">Email</th>
                                                    <th style="color:blue;">Phone Number</th>
                                                    <th style="color:blue;">Creation Date</th>
                                                    <th style="color:blue;">Last Updated Date</th>
                                                    <th style="color:blue;">Actions To Perform</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>

                                                <?php
                                                $sql = "SELECT * from  tablegeneralhospital";
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
                                                            <td><?php echo htmlentities($result->UserName); ?></td>
                                                            <td><?php echo htmlentities($result->Email); ?></td>
                                                            <td><?php echo htmlentities($result->PhoneNumber); ?></td>
                                                            <td><?php echo htmlentities($result->PostingDate); ?></td>
                                                            <td><?php echo htmlentities($result->UpdationDate); ?></td>
                                                            <td><a href="update-hospital-account.php?Hospital_id=<?php echo htmlentities($result->Hospital_id); ?>"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <a href="manage-hospital-account.php?del=<?php echo $result->Hospital_id; ?>"><button class="btn btn-danger btn-xs" onclick="return confirm('Do you want to delete this hospital account?');"><span class="glyphicon glyphicon-trash"></span></button></a>
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
