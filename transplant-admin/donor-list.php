<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['tlogin']) == 0) {
    header('location:tindex.php');
} else {
    if (isset($_REQUEST['hidden'])) {
        $eid = intval($_GET['hidden']);
        $status = "0";
        $sql = "UPDATE tableorgandonors SET Status=:status WHERE  Donor_id=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        $msg = " Donor marked as Matched!";
    }
    if (isset($_REQUEST['public'])) {
        $aeid = intval($_GET['public']);
        $status = 1;
        $sql = "UPDATE tableorgandonors SET Status=:status WHERE  Donor_id=:aeid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
        $query->execute();
        $msg = " Donor marked as Not Matched!";
    }
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "DELETE FROM tableorgandonors WHERE Donor_id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $msg = " Donor deleted successfully from OOMS List.";
    }
    ?>

    <!doctype html>
    <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>Admin | Donor List  </title>
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
                .scroll {
                    width: 100%;
                    height: 100%;
                    overflow: scroll;
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

                                <h2 class="page-title"><font face="Comic Sans MS" color="red">Organ Donors List</font></h2>

                                <div class="panel panel-default">
                                    <div class="panel-heading" style="color: green;">Donors Personal and Medical Information</div>
                                    <div class="panel-body">
                                        <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) {
                                            ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                                        <a href="donor-download-records.php" style="color:red; font-size:16px;"><span class="glyphicon glyphicon-save-file"></span> &nbsp;Download Donor List</a>
                                        <div class="scroll">
                                            <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th style="color:blue">#</th>
                                                        <th style="color:blue">Name</th>
                                                        <th style="color:blue">IC/Passport No.</th>
                                                        <th style="color:blue">Nationality</th>
                                                        <th style="color:blue">Mobile No</th>
                                                        <th style="color:blue">Email</th>
                                                        <th style="color:blue">State</th>
                                                        <th style="color:blue">Gender</th>
                                                        <th style="color:blue">Date Of Birth</th>
                                                        <th style="color:red">Organ(s) Donated</th>
                                                        <th style="color:red">Blood Type</th>
                                                        <th style="color:blue">Address</th>
                                                        <th style="color:blue">Registration Date</th>
                                                        <th style="color:blue">Image</th>
                                                        <th style="color:blue">Status</th>
                                                        <th style="color:blue">Actions To Perform</th>
                                                        <th style="color:blue">Added by</th>

                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th style="color:blue">#</th>
                                                        <th style="color:blue">Name</th>
                                                        <th style="color:blue">IC/Passport No.</th>
                                                        <th style="color:blue">Nationality</th>
                                                        <th style="color:blue">Mobile No</th>
                                                        <th style="color:blue">Email</th>
                                                        <th style="color:blue">State</th>
                                                        <th style="color:blue">Gender</th>
                                                        <th style="color:blue">Date Of Birth</th>
                                                        <th style="color:red">Organ(s) Donated</th>
                                                        <th style="color:red">Blood Type</th>
                                                        <th style="color:blue">Address</th>
                                                        <th style="color:blue">Registration Date</th>
                                                        <th style="color:blue">Image</th>
                                                        <th style="color:blue">Status</th>
                                                        <th style="color:blue">Actions To Perform</th>
                                                        <th style="color:blue">Added by</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>

                                                    <?php
                                                    $sql = "SELECT * from  tableorgandonors ";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt = 1;
                                                    if ($query->rowCount() > 0) {
                                                        foreach ($results as $result) {
                                                            ?>	
                                                            <tr>
                                                                <td><?php echo htmlentities($cnt); ?></td>
                                                                <td><?php echo htmlentities($result->FullName); ?></td>
                                                                <td><?php echo htmlentities($result->Passport); ?></td>
                                                                <td><?php echo htmlentities($result->Nationality); ?></td>
                                                                <td><?php echo htmlentities($result->MobileNumber); ?></td>
                                                                <td><?php echo htmlentities($result->Email); ?></td>
                                                                <td><?php echo htmlentities($result->State); ?></td>
                                                                <td><?php echo htmlentities($result->Gender); ?></td>
                                                                <td><?php echo htmlentities($result->DateOfBirth); ?></td>
                                                                <td><?php echo htmlentities($result->OrganDonated); ?> <?php echo htmlentities($result->OrganDonated2); ?> <?php echo htmlentities($result->OrganDonated3); ?>
                                                                    <?php echo htmlentities($result->OrganDonated4); ?> <?php echo htmlentities($result->OrganDonated5); ?></td>
                                                                <td><?php echo htmlentities($result->BloodType); ?></td>
                                                                <td><?php echo htmlentities($result->Address); ?></td>
                                                                <td><?php echo htmlentities($result->PostingDate); ?></td>
                                                                <td><?php echo ("<a target='_blank' href='view-donor-image.php?Donor_id=" . $result->Donor_id . "'>" . $result->name . "</a>"); ?> </td>
                                                                <td> <?php if ($result->status == 1) {
                                                                        ?>                                                   <a href="donor-list.php?hidden=<?php echo htmlentities($result->Donor_id); ?>" onclick="return confirm('Do you  want to mark this organ donor as Matched?')"> Donor Not Matched</a> 
                                                                    <?php } else { ?>
                                                                        <a href="donor-list.php?public=<?php echo htmlentities($result->Donor_id); ?>" onclick="return confirm('Do you  want to mark this organ donor as Not Matched?')"> Donor Matched</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <a href="update-donor-info.php?Donor_id=<?php echo htmlentities($result->Donor_id); ?>"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a>&nbsp;&nbsp;
                                                                    <a href="donor-list.php?del=<?php echo $result->Donor_id; ?>"><button class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete the Donor from the waiting list?');"><span class="glyphicon glyphicon-trash"></span></button></a>
                                                                </td>
                                                                <td><?php echo htmlentities($result->User); ?></td>
                                                            </tr>
                                                            <?php
                                                            $cnt = $cnt + 1;
                                                        }
                                                    }
                                                    ?>     </tbody>
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
