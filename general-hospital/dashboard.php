<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:hindex.php');
} else {
    ?>
    <!doctype html>
    <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title> General Hospital | Dashboard</title>
            <link rel="stylesheet" href="css/font-awesome.min.css"> <!-- Bootstrap Icons -->
            <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Main Bootstrap -->
            <link rel="stylesheet" href="css/style.css"> <!-- Header Stye -->

        </head>

        <body>
            <?php include('includes/header.php'); ?>

            <div class="ts-main-content">
                <?php include('includes/leftbar.php'); ?>
                <div class="content-wrapper">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">

                                <h2 class="page-title"><font face="Comic Sans MS" color="red">Dashboard</font></h2>
                                <div><h3 style="color: black;">WELCOME  <font face="Tahoma" color="purple"> <?php echo $_SESSION['alogin']; ?>! </font></h3></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="panel panel-default">
                                                    <div class="panel-body bk-primary text-light">
                                                        <div class="stat-panel text-center">

                                                            <?php
                                                            $sql1 = "SELECT Donor_id from tableorgandonors ";
                                                            $query1 = $dbh->prepare($sql1);
                                                            $query1->execute();
                                                            $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                                            $regbd = $query1->rowCount();
                                                            ?>
                                                            <div class="stat-panel-number h1 "><?php echo htmlentities($regbd); ?></div>
                                                            <div class="stat-panel-title text-uppercase">Registered Organ Donors</div>
                                                        </div>
                                                    </div>
                                                    <a href="donor-list.php" class="block-anchor panel-footer text-center"><font face="Trebuchet MS" style="font-size:14px;"><b>Full Details</b></font> &nbsp; <i class="fa fa-arrow-right"></i></a>
                                                </div>
                                            </div>   
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
            <script src="js/main.js"></script>         

        </body>
    </html>
    <?php
} 
