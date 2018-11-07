<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['tlogin']) == 0) {
    header('location:tindex.php');
} else {
    ?>
    <!doctype html>
    <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>Admin |  Dashboard</title>

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
                                <div><h3 style="color: black;">Welcome <font face="Tahoma" color="purple"> <?php echo $_SESSION['tlogin']; ?>! </font></h3></div>

                                <div class="row">                                    
                                    <div class="col-md-4">
                                        <div class="panel panel-default">
                                            <div class="panel-body bk-primary text-light">
                                                <div class="stat-panel text-center">
                                                    <?php
                                                    $sql = "SELECT Donor_id from tableorgandonors ";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $organs = $query->rowCount();
                                                    ?>
                                                    <div class="stat-panel-number h1 "><?php echo htmlentities($organs); ?></div>
                                                    <div class="stat-panel-title text-uppercase">Total Registered Organ Donors</div>
                                                </div>
                                            </div>
                                            <a href="donor-list.php" class="block-anchor panel-footer text-center"><font face="Trebuchet MS" style="font-size:14px;"><b>Full Details</b></font> &nbsp; <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>                      

                                    <div class="col-md-4">
                                        <div class="panel panel-default">
                                            <div class="panel-body bk-danger text-light">
                                                <div class="stat-panel text-center">
                                                    <?php
                                                    $sql2 = "SELECT Notification_id from tablehospitalalert ";
                                                    $query2 = $dbh->prepare($sql2);
                                                    $query2->execute();
                                                    $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                                    $notification = $query2->rowCount();
                                                    ?>
                                                    <div class="stat-panel-number h1 "><?php echo htmlentities($notification); ?></div>
                                                    <div class="stat-panel-title text-uppercase">Total Hospital Notifications</div>
                                                </div>
                                            </div>
                                            <a href="manage-hospital-notifications.php" class="block-anchor panel-footer text-center"><font face="Trebuchet MS" style="font-size:14px;"><b>Full Details</b></font> &nbsp; <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="panel panel-default">
                                            <div class="panel-body bk-info text-light">
                                                <div class="stat-panel text-center">

                                                    <?php
                                                    $sql3 = "SELECT Hospital_id from tablegeneralhospital ";
                                                    $query3 = $dbh->prepare($sql3);
                                                    $query3->execute();
                                                    $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
                                                    $hospital = $query3->rowCount();
                                                    ?>
                                                    <div class="stat-panel-number h1 "><?php echo htmlentities($hospital); ?></div>
                                                    <div class="stat-panel-title text-uppercase">Total Registered Hospital Accounts</div>
                                                </div>
                                            </div>
                                            <a href="manage-hospital-account.php" class="block-anchor panel-footer text-center"><font face="Trebuchet MS" style="font-size:14px;"><b>Full Details</b></font> &nbsp; <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">      

                                    <div class="col-md-4">
                                        <div class="panel panel-default">
                                            <div class="panel-body bk-danger text-light">
                                                <div class="stat-panel text-center">
                                                    <?php
                                                    $sql4 = "SELECT Query_id from tablecontactusquery ";
                                                    $query4 = $dbh->prepare($sql4);
                                                    $query4->execute();
                                                    $results4 = $query4->fetchAll(PDO::FETCH_OBJ);
                                                    $contact = $query4->rowCount();
                                                    ?>
                                                    <div class="stat-panel-number h1 "><?php echo htmlentities($contact); ?></div>
                                                    <div class="stat-panel-title text-uppercase">Total Queries</div>
                                                </div>
                                            </div>
                                            <a href="manage-queries.php" class="block-anchor panel-footer text-center"><font face="Trebuchet MS" style="font-size:14px;"><b>Full Details</b></font> &nbsp; <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="panel panel-default">
                                            <div class="panel-body bk-success text-light">
                                                <div class="stat-panel text-center">
                                                    <?php
                                                    $sqlkidney = "SELECT id from tablekidney ";
                                                    $querykidney = $dbh->prepare($sqlkidney);
                                                    $querykidney->execute();
                                                    $resultskidney = $querykidney->fetchAll(PDO::FETCH_OBJ);
                                                    $kidney = $querykidney->rowCount();
                                                    ?>
                                                    <div class="stat-panel-number h1 "><?php echo htmlentities($kidney); ?></div>
                                                    <div class="stat-panel-title text-uppercase">Total Registered Kidney Patients</div>
                                                </div>
                                            </div>
                                            <a href="kidney-list.php" class="block-anchor panel-footer text-center"><font face="Trebuchet MS" style="font-size:14px;"><b>Full Details</b></font> &nbsp; <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>                              

                                    <div class="col-md-4">
                                        <div class="panel panel-default">
                                            <div class="panel-body bk-danger text-light">
                                                <div class="stat-panel text-center">
                                                    <?php
                                                    $sqlh = "SELECT id from tableheart ";
                                                    $queryh = $dbh->prepare($sqlh);
                                                    $queryh->execute();
                                                    $resultsh = $queryh->fetchAll(PDO::FETCH_OBJ);
                                                    $heart = $queryh->rowCount();
                                                    ?>
                                                    <div class="stat-panel-number h1 "><?php echo htmlentities($heart); ?></div>
                                                    <div class="stat-panel-title text-uppercase">Total Registered Heart Patients</div>
                                                </div>
                                            </div>
                                            <a href="heart-list.php" class="block-anchor panel-footer text-center"><font face="Trebuchet MS" style="font-size:14px;"><b>Full Details</b></font> &nbsp; <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">      
                                    <div class="col-md-4">
                                        <div class="panel panel-default">
                                            <div class="panel-body bk-info text-light">
                                                <div class="stat-panel text-center">
                                                    <?php
                                                    $sql1ungs = "SELECT id from tablelungs";
                                                    $query1ungs = $dbh->prepare($sql1ungs);
                                                    $query1ungs->execute();
                                                    $results1ungs = $query1ungs->fetchAll(PDO::FETCH_OBJ);
                                                    $lungs = $query1ungs->rowCount();
                                                    ?>
                                                    <div class="stat-panel-number h1 "><?php echo htmlentities($lungs); ?></div>
                                                    <div class="stat-panel-title text-uppercase">Total Registered Lungs Patients</div>
                                                </div>
                                            </div>
                                            <a href="lungs-list.php" class="block-anchor panel-footer text-center"><font face="Trebuchet MS" style="font-size:14px;"><b>Full Details</b></font> &nbsp; <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="panel panel-default">
                                            <div class="panel-body bk-danger text-light">
                                                <div class="stat-panel text-center">
                                                    <?php
                                                    $sqlliver = "SELECT id from tableliver ";
                                                    $queryliv = $dbh->prepare($sqlliver);
                                                    $queryliv->execute();
                                                    $resultsliv = $queryliv->fetchAll(PDO::FETCH_OBJ);
                                                    $liver = $queryliv->rowCount();
                                                    ?>
                                                    <div class="stat-panel-number h1 "><?php echo htmlentities($liver); ?></div>
                                                    <div class="stat-panel-title text-uppercase">Total Registered Liver Patients</div>
                                                </div>
                                            </div>
                                            <a href="liver-list.php" class="block-anchor panel-footer text-center"><font face="Trebuchet MS" style="font-size:14px;"><b>Full Details</b></font> &nbsp; <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>            

                                    <div class="col-md-4">
                                        <div class="panel panel-default">
                                            <div class="panel-body bk-primary text-light">
                                                <div class="stat-panel text-center">
                                                    <?php
                                                    $sqlpancreas = "SELECT id from tablepancreas ";
                                                    $querypancreas = $dbh->prepare($sqlpancreas);
                                                    $querypancreas->execute();
                                                    $resultspancreas = $querypancreas->fetchAll(PDO::FETCH_OBJ);
                                                    $pancreas = $querypancreas->rowCount();
                                                    ?>
                                                    <div class="stat-panel-number h1 "><?php echo htmlentities($pancreas); ?></div>
                                                    <div class="stat-panel-title text-uppercase">Total Registered Pancreas Patients</div>
                                                </div>
                                            </div>
                                            <a href="pancreas-list.php" class="block-anchor panel-footer text-center"><font face="Trebuchet MS" style="font-size:14px;"><b>Full Details</b></font> &nbsp; <i class="fa fa-arrow-right"></i></a>
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