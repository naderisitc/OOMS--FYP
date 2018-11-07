<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_POST['send'])) {
    $userid = intval($_GET['Notification_id']);

    $name = $_POST['hospitalname'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $message = $_POST['message'];
    $fullname = $_POST['fullname'];
    $passport = $_POST['passport'];
    $bloodtype = $_POST['bloodtype'];
    $organ = $_POST['organ'];
    $state = $_POST['state'];
    $sql = "INSERT INTO  tablehospitalalert(HospitalName,Email,ContactNumber,Message,FullName,Passport,OrganDonated,BloodType,State) VALUES(:name,:email,:contactno,:message,:fullname,:passport,:organ,:bloodtype,:state)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':contactno', $contactno, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
    $query->bindParam(':passport', $passport, PDO::PARAM_STR);
    $query->bindParam(':organ', $organ, PDO::PARAM_STR);
    $query->bindParam(':bloodtype', $bloodtype, PDO::PARAM_STR);
    $query->bindParam(':state', $state, PDO::PARAM_STR);

    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        $msg = " Message sent successfully to the transplant center.";
    } else {
        $error = " Something went wrong. Please try again";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>General Hospital | Contact Transplant Hospital</title>

        <link rel="stylesheet" href="css/font-awesome.min.css">  <!-- Icon Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css">   <!-- Main Bootstrap  -->
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

                            <h2 class="page-title"><font face="Comic Sans MS" color="red">Contact a Transplant Hospital</font></h2>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">


                                        <div class="col-lg-8 mb-4">
                                            <h3>Send a Notification to Transplant Center</h3><br>
                                            <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) {
                                                ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                                            <form method="post">
                                                <?php
                                                // Get the userid
                                                $user = $_SESSION['alogin'];
                                                $sql = "SELECT HospitalName,PhoneNumber,Email from tablegeneralhospital where UserName=:user";
                                                //Prepare the query:
                                                $query = $dbh->prepare($sql);
                                                //Bind the parameters
                                                $query->bindParam(':user', $user, PDO::PARAM_STR);
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
                                                            <label>Hospital Name:</label>
                                                            <input type="text" class="form-control" placeholder="Please enter your hospital name" value="<?php echo htmlentities($result->HospitalName); ?>" pattern="[a-zA-Z\s]+" maxLength="35" id="hospitalname" name="hospitalname" required title="Please enter only characters">
                                                            <p class="help-block"></p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Contact Number:</label>
                                                            <input type="text" class="form-control" placeholder="Please enter only 10 numbers" value="<?php echo htmlentities($result->PhoneNumber); ?>" pattern="[0-9]{10}" maxlength="10"  title="Remove any character/spaces/negative numbers. Enter numbers only, e.g 0325553693."  id="contactno" name="contactno"  required title="Please enter only numbers">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Email Address:</label>
                                                            <input type="email" class="form-control" placeholder="Please provide valid hospital email address" value="<?php echo htmlentities($result->Email); ?>"  maxlength="20" id="email" name="email" required data-validation-required-message="Please enter email address.">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Message:</label>
                                                            <textarea rows="5" cols="10" class="form-control" placeholder="Please write your message to the transplant center" id="message" name="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                                                        </div>
                                                         <?php
                                                // Get the userid
                                                $userid = intval($_GET['Donor_id']);

                                                $sql = "SELECT FullName,Passport,State,BloodType,OrganDonated,OrganDonated2,OrganDonated3,OrganDonated4,OrganDonated5,Donor_id from tableorgandonors where Donor_id=:uid";
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
                                                            <label>Donor Name:</label>
                                                            <input type="text" class="form-control"  maxlength="20" id="fullname" name="fullname" value="<?php echo htmlentities($result->FullName); ?>" title="Please enter only characters" pattern="[a-zA-Z\s]+" maxLength="25" required >
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Passport/IC No:</label>
                                                            <input type="text" class="form-control"  maxlength="20" id="passport" name="passport" value="<?php echo htmlentities($result->Passport); ?>" required data-validation-required-message="Please enter passport/IC No.">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Organ Donated:</label>
                                                            <?php $Organ1 = $result->OrganDonated; ?>
                                                            <?php $Organ2 = $result->OrganDonated2; ?>       
                                                            <?php $Organ3 = $result->OrganDonated3; ?>
                                                            <?php $Organ4 = $result->OrganDonated4; ?>
                                                            <?php $Organ5 = $result->OrganDonated5; ?>
                                                            <input type="text" class="form-control" maxlength="20" id="organ" name="organ" value="<?php
                                                            echo $Organ1;
                                                            echo $Organ2;
                                                            echo $Organ3;
                                                            echo $Organ4;
                                                            echo $Organ5;
                                                            ?>" pattern="[a-zA-Z\s]+" maxLength="10" required title="Please enter only characters">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Blood Type:</label>
                                                            <input type="text" class="form-control"  maxlength="20" id="bloodtype" name="bloodtype" value="<?php echo htmlentities($result->BloodType); ?>" pattern="[a-zA-Z\s]+" maxLength="2" required title="Please enter only characters">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>State:</label>
                                                            <input type="text" class="form-control"  id="state" name="state"  value="<?php echo htmlentities($result->State); ?>" pattern="[a-zA-Z\s]+" maxLength="20" required title="Please enter only characters">
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                    }
                                                }
                                                ?>
                                                <a href="donor-list.php" class="btn btn-danger"><font face="Trebuchet MS" style="font-size:14px;"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<b>Back</b></font></a>
                                                <button type="submit" name="send"  class="btn btn-primary btn-lg"><font face="Trebuchet MS" style="font-size:14px;"><span class="glyphicon glyphicon-envelope"></span>&nbsp;<b>Send Notification</b></font></button>
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

        <!-- Bootstrap core Java Script -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>
                                                    