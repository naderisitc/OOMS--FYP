<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['tlogin']) == 0) {
    header('location:tindex.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "delete from tablekidney  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $msg = " Patient deleted successfully from the OOMS Kidney waiting list.";
    }
}
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Admin | Patient Kidney Waiting List  </title>
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

                            <h2 class="page-title"><font face="Comic Sans MS" color="red"> Kidney Waiting List - Patients</font></h2>

                            <!-- Zero Configuration Table -->
                            <div class="panel panel-default">
                                <div class="panel-heading" style="color: green;"> Personal and Medical Information - Kidney Patients </div>
                                <div class="panel-body">
                                    <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) {
                                        ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                                    <a href="kidney-download-records.php" style="color:red; font-size:16px;"><span class="glyphicon glyphicon-save-file"></span> &nbsp;Download Kidney Waiting List</a>
                                    <div class="scroll">
                                        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">

                                            <thead>
                                                <tr>
                                                    <th style="color:blue;">#</th>
                                                    <th style="color:blue;">Name</th>
                                                    <th style="color:blue;">IC/Passport No.</th>
                                                    <th style="color:blue;">Nationality</th>
                                                    <th style="color:blue;">Mobile No</th>
                                                    <th style="color:blue;">Email</th>
                                                    <th style="color:blue;">Date Of Birth</th>
                                                    <th style="color:red">Organ Needed</th>
                                                    <th style="color:red">Medical Urgency</th>
                                                    <th style="color:blue;">State</th>
                                                    <th style="color:blue;">Gender</th>
                                                    <th style="color:blue;">Blood Type</th>
                                                    <th style="color:blue;">Address</th>
                                                    <th style="color:blue;">Registration Date</th>
                                                    <th style="color:blue;">Notified</th>
                                                    <th style="color:blue;">Image</th>
                                                    <th style="color:blue;">Actions To Perform</th>
                                                </tr>
                                            </thead>
                                            <tfoot>

                                                <tr>
                                                    <th style="color:blue;">#</th>
                                                    <th style="color:blue;">Name</th>
                                                    <th style="color:blue;">IC/Passport No.</th>
                                                    <th style="color:blue;">Nationality</th>
                                                    <th style="color:blue;">Mobile No</th>
                                                    <th style="color:blue;">Email</th>
                                                    <th style="color:blue;">Date Of Birth</th>
                                                    <th style="color:red">Organ Needed</th>
                                                    <th style="color:red">Medical Urgency</th>
                                                    <th style="color:blue;">State</th>
                                                    <th style="color:blue;">Gender</th>
                                                    <th style="color:blue;">Blood Type</th>
                                                    <th style="color:blue;">Address</th>
                                                    <th style="color:blue;">Registration Date</th>
                                                    <th style="color:blue;">Notified</th>
                                                    <th style="color:blue;">Image</th>
                                                    <th style="color:blue;">Actions To Perform</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>

                                                <?php
                                                $sql = "SELECT * from  tablekidney";
                                                //Prepare the query
                                                $query = $dbh->prepare($sql);
                                                //Execute the query
                                                $query->execute();
                                                //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                // For serial number initialization
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    //In case that the query returned at least one record, we can echo the records within a foreach loop:
                                                    foreach ($results as $result) {
                                                        ?>	
                                                        <tr> <!-- Display Records -->
                                                            <td><?php echo htmlentities($cnt); ?></td>
                                                            <td><?php echo htmlentities($result->FullName); ?></td>
                                                            <td><?php echo htmlentities($result->Passport); ?></td>
                                                            <td><?php echo htmlentities($result->Nationality); ?></td>
                                                            <td><?php echo htmlentities($result->MobileNumber); ?></td>
                                                            <td><?php echo htmlentities($result->Email); ?></td>
                                                            <td><?php echo htmlentities($result->DateOfBirth); ?></td>
                                                            <td><?php echo htmlentities($result->OrganNeeded); ?></td>
                                                            <td><?php echo htmlentities($result->MedicalUrgency); ?></td>
                                                            <td><?php echo htmlentities($result->State); ?></td>
                                                            <td><?php echo htmlentities($result->Gender); ?></td>
                                                            <td><?php echo htmlentities($result->BloodType); ?></td>
                                                            <td><?php echo htmlentities($result->Address); ?></td>
                                                            <td><?php echo htmlentities($result->RegistrationDate); ?></td>
                                                            <td><?php if ($result->status == 0) {
                                                            ?>
                                                                    Yes   <i class="fa fa-check" style="color:red;" aria-hidden="true"></i>
                                                                <?php } else { ?> 
                                                                    No  <i class="fa fa-close" style="color:red;" aria-hidden="true"></i>
                                                                <?php } ?></td>
                                                            <td><?php echo ("<a target='_blank' href='view-kidney-image.php?id=" . $result->id . "'>" . $result->name . "</a>"); ?></td>

                                                            <td>
                                                                <a href="update-kidney-info.php?id=<?php echo htmlentities($result->id); ?>"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a> &nbsp;
                                                                <a href="kidney-list.php?del=<?php echo $result->id; ?>"><button class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete the patient from the Kidney waiting list?');"><span class="glyphicon glyphicon-trash"></span></button></a>
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
