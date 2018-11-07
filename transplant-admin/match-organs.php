<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Admin | Match Organs</title>

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
                    <div class="col-md-12">
                        <h2 class="page-title"><font face="Comic Sans MS" color="red">Match Organs</font></h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading" style="color: green;">Match Organs</div>
                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal" action="patient-ranking.php" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="col-md-10">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" style="color: blue; font-size: 100%;">Enter the Deceased Donor Organ, Blood Type and the State of Residence</div>
                                                        <div class="panel-body">
                                                            <label class="col-sm-2 control-label">Organ Donated<span style="color:red">*</span></label>
                                                            <div class="col-sm-2">
                                                                <select name="organ"  class="form-control" id="default1" required="required">
                                                                    <option value="">---Select---</option>
                                                                    <option  value="Kidney">Kidney</option>
                                                                    <option  value="Heart">Heart</option>
                                                                    <option  value="Lungs">Lungs</option>
                                                                    <option  value="Liver">Liver</option>
                                                                    <option  value="Pancreas">Pancreas</option>
                                                                </select>
                                                            </div>

                                                            <label class="col-sm-2 control-label">Blood Type<span style="color:red">*</span></label>
                                                            <div class="col-sm-2">
                                                                <select name="bloodtype" class="form-control" required>
                                                                    <option value="">---Select---</option>
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                    <option value="AB">AB</option>
                                                                    <option value="O">O</option>
                                                                </select>

                                                            </div>

                                                            <label class="col-sm-2 control-label">State<span style="color:red">*</span></label>
                                                            <div class="col-sm-2">
                                                                <select name="state" class="form-control" required>
                                                                    <option value="">---Select---</option>
                                                                    <option value="Johor">Johor</option>
                                                                    <option value="Kedah">Kedah</option>
                                                                    <option value="Kelantan">Kelantan</option>
                                                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                                                    <option value="Melaka">Melaka</option>
                                                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                                                    <option value="Pahang">Pahang</option>
                                                                    <option value="Penang">Penang</option>
                                                                    <option value="Perak">Perak</option>
                                                                    <option value="Perlis">Perlis</option>
                                                                    <option value="Sabah">Sabah</option>
                                                                    <option value="Sarawak">Sarawak</option>
                                                                    <option value="Selangor">Selangor</option>
                                                                    <option value="Terengganu">Terengganu</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-sm-offset-9">
                                                    <img  src="images/organ.png" alt="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" style="color: blue; font-size: 100%;">Enter the Medical Urgency of the Patient</div>
                                                        <div class="panel-body">
                                                            <label class="col-sm-4 control-label">Patient Medical Urgency<span style="color:red">*</span></label>
                                                            <div class="col-sm-4">
                                                                <select name="medical" class="form-control" required>
                                                                    <option value="High">High</option>
                                                                    <option value="Low">Low</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button class="btn btn-default" type="reset"><font face="Trebuchet MS" style="font-size:14px;"><span class="glyphicon glyphicon-remove-sign"></span>&nbsp;<b>Reset</b></font></button>
                                            <button class="btn btn-primary btn-lg"  name="submit" type="submit" ><font face="Trebuchet MS" style="font-size:14px;"><span class="glyphicon glyphicon-transfer"></span>&nbsp;&nbsp;<b>Match</b></font></button><br>                                                                            
                                        </div>
                                    </div>   
                                    </form>
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
