<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['tlogin']) == 0) {
    header('location:tindex.php');
} else {
    if (isset($_POST['update'])) {

        $userid = intval($_GET['Hospital_id']);  // Get the userid
        // Posted Values
        $hospitalname = $_POST['hname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        // Query for Updation
        $sql = "UPDATE tablegeneralhospital SET HospitalName=:hospitalname,UserName=:username, Email=:email, PhoneNumber=:phonenumber WHERE Hospital_id=:uid ";
        //Prepare Query for Execution
        $query = $dbh->prepare($sql);
        // Bind the parameters
        $query->bindParam(':hospitalname', $hospitalname, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':phonenumber', $phonenumber, PDO::PARAM_INT);
        $query->bindParam(':uid', $userid, PDO::PARAM_STR);
        $query->execute();
        $msg = " Hospital account updated successfully!";
    }
    ?>
    <!doctype html>
    <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>Admin | Update Hospital Account</title>

            <link rel="stylesheet" href="css/font-awesome.min.css"> <!-- Bootstrap Icons -->
            <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Main Bootstrap -->
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

                                <h2 class="page-title"><font face="Comic Sans MS" color="red">Update Hospital Account</font></h2>
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="color: green;">Form fields</div>
                                            <div class="panel-body">

                                                <form method="post"  class="form-horizontal">
                                                    <!--Error Message-->
                                                    <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div>
                                                    <?php } ?>
                                                    <!--Success Message-->
                                                    <?php if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
                                                    <?php } ?>

                                                    <?php
                                                    // Get the userid
                                                    $userid = intval($_GET['Hospital_id']);
                                                    $sql = "SELECT HospitalName,UserName,Email,PhoneNumber, Hospital_id from tablegeneralhospital where Hospital_id=:uid";
                                                    //Prepare the query:
                                                    $query = $dbh->prepare($sql);
                                                    //Bind the parameters
                                                    $query->bindParam(':uid', $userid, PDO::PARAM_STR);
                                                    //Execute the query:
                                                    $query->execute();
                                                    //Assign the data which you pulled from the database (in the preceding step) to a variable.
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    // For serial number initialization
                                                    $cnt = 1;
                                                    if ($query->rowCount() > 0) {
                                                        //In case that the query returned at least one record, we can echo the records within a foreach loop:
                                                        foreach ($results as $result) {
                                                            ?> 
                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label">Hospital Name<span style="color:red">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" id="hname" name="hname" value="<?php echo htmlentities($result->HospitalName); ?>"  pattern="[a-zA-Z\s]+" title="Hospital name must contain letters only" class="form-control" required>
                                                                    <p class="help-block">Hospital name can contain any letters only</p>
                                                                </div>
                                                                <label class="col-sm-2 control-label">Username<span style="color:red">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" readonly id="username" name="username" onBlur="checkUsernameAvailability()" value="<?php echo htmlentities($result->UserName); ?>"  pattern="^[a-zA-Z][a-zA-Z0-9-_.]{5,12}$" title=" Username can contain any letters or numbers without spaces and between 6 and 12 characters" class="form-control" required>
                                                                    <span id="username-availability-status" style="font-size:12px;"></span> 
                                                                    <p class="help-block">Username can contain any letters or numbers, without spaces and between 6 and 12 characters </p> </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <input type="email" readonly id="email" name="email"  value="<?php echo htmlentities($result->Email); ?>" onBlur="checkEmailAvailability()" class="form-control" required>
                                                                    <span id="email-availability-status" style="font-size:12px;"></span> 

                                                                    <p class="help-block">Please provide General Hospital Email</p>                         
                                                                </div>
                                                                <label class="col-sm-2 control-label">Contact Number<span style="color:red">*</span></label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" id="phonenumber" name="phonenumber" pattern="[0-9]{10}" maxlength="10"  title="Remove any character/spaces/negative numbers. Enter numbers only, e.g 0325553693."  value="<?php echo htmlentities($result->PhoneNumber); ?>" class="form-control" required>
                                                                    <p class="help-block">Phone Number contains only 10 digit numeric values and no spaces</p>                                          
                                                                </div>
                                                            </div>






                                                        <?php }
                                                    }
                                                    ?>

                                                    <div class="form-group">
                                                        <div class="col-sm-8 col-sm-offset-4">
                                                            <a href="manage-hospital-account.php" class="btn btn-md btn-default"><font face="Trebuchet MS" style="font-size:14px;"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<b>Back</b></font></a>
                                                            <button class="btn btn-primary btn-lg" name="update" type="submit"><font face="Trebuchet MS" style="font-size:14px;"><span class="glyphicon glyphicon-ok"></span>&nbsp;<b>Update</b></font></button>
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
            </div>
            <!-- Loading Scripts -->
            <script src="js/jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/main.js"></script>
        </body>
    </html>
<?php }
?>