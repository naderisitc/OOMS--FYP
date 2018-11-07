<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['tlogin']) == 0) {
    header('location:tindex.php');
} else {

    if (isset($_POST['sms'])) {
        $organ1 = $_SESSION['organ'];
        // Get the userid
        $userid = intval($_GET['id']);
        if ($organ1 == "Kidney") {
            $sql = "SELECT FullName,MobileNumber,Gender,id FROM tablekidney WHERE id=:uid ";
        } else if ($organ1 == "Heart") {
            $sql = "SELECT FullName,MobileNumber,Gender,id FROM tableheart WHERE id=:uid ";
        } else if ($organ1 == "Lungs") {
            $sql = "SELECT FullName,MobileNumber,Gender,id FROM tablelungs WHERE id=:uid ";
        } else if ($organ1 == "Liver") {
            $sql = "SELECT FullName,MobileNumber,Gender,id FROM tableliver WHERE id=:uid ";
        } else {
            $sql = "SELECT FullName,MobileNumber,Gender,id FROM tablepancreas WHERE id=:uid ";
        }

        $query = $dbh->prepare($sql);
        $query->bindParam(':uid', $userid, PDO::PARAM_STR);
        // Query Execution
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        // For serial number initialization
        $cnt = 1;
        if ($query->rowCount() > 0) {
//In case that the query returned at least one record, we can echo the records within a foreach loop:
            foreach ($results as $result) {
                $no = $result->MobileNumber;
                $name = $result->FullName;
                $gender = $result->Gender;
                //$organ = $result->OrganNeeded;
                if ($gender == "Male") {
                    $g = "Mr.";
                } else {
                    $g = "Ms.";
                }
                include ( "sms/NexmoMessage.php" );

                /**
                 * To send a text message.
                 *
                 */
                // Step 1: Declare new NexmoMessage.
                $nexmo_sms = new NexmoMessage('155bb750', 'n2ZxnJZa9uh0o788');
                $message = "Greetings $g $name! Congratulations! An organ $organ1 that matchs your medical data is found for your organ transplantation. Kindly reply to us as soon as possible by calling our transplant center at 03-2555 4447 or through our email ooms@aol.com."
                        . " Sincerely, "
                        . " OOMS";
                $from = "OOMS";
                // Step 2: Use sendText( $to, $from, $message ) method to send a message. 
                $info = $nexmo_sms->sendText($no, $from, $message);

                // Step 3: Display an overview of the message
                //echo $nexmo_sms->displayOverview($info);
                // Done!
                $organ1 = $_SESSION['organ'];
                $userid = intval($_GET['id']);
                $status = "0";
                if ($organ1 == "Kidney") {
                    $sql2 = "UPDATE  tablekidney SET  Status=:status WHERE   id=:uid ";
                } else if ($organ1 == "Heart") {
                    $sql2 = "UPDATE  tableheart SET  Status=:status WHERE   id=:uid";
                } else if ($organ1 == "Lungs") {
                    $sql2 = "UPDATE  tablelungs SET  Status=:status WHERE   id=:uid ";
                } else if ($organ1 == "Liver") {
                    $sql2 = "UPDATE  tableliver SET  Status=:status WHERE   id=:uid ";
                } else {
                    $sql2 = "UPDATE  tablepancreas SET  Status=:status WHERE   id=:uid ";
                }

                $query2 = $dbh->prepare($sql2);
                $query2->bindParam(':status', $status, PDO::PARAM_STR);
                $query2->bindParam(':uid', $userid, PDO::PARAM_STR);
                $query2->execute();
                // Mesage after sending SMS
                echo "<script>alert(' SMS notification sent successfully to $g $name that a matching organ $organ1 is found!');</script>";
                // Code for redirection
                echo "<script>window.location.href='match-organs.php'</script>";
            }
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

            <title>Admin | SMS Patient</title>

            <link rel="stylesheet" href="css/font-awesome.min.css"> <!-- Bootstrap Icons -->
            <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Main Bootstrap -->
            <link rel="stylesheet" href="css/style.css"> <!-- Header Stye -->
            <link rel="stylesheet" href="css/tindex_c.css">

        </head>
        <body>
            <?php include('includes/header.php'); ?>
            <div class="ts-main-content">
                <?php include('includes/leftbar.php'); ?>
                <div class="content-wrapper">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">

                                <h2 class="page-title"><font face="Comic Sans MS" color="red">SMS Patient </font></h2>

                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="color: green;">Notify Patient by SMS</div>
                                            <div class="panel-body">
                                                <h5><font face="Comic Sans MS" color="purple">Click 'Notify Patient' below to send SMS Notification to the selected patient.</font></h5>                            
                                                <form method="post" class="form-horizontal">

                                                    <?php
                                                    $organ1 = $_SESSION['organ']; //Get Organ Name
                                                    // Get the userid
                                                    $userid = intval($_GET['id']);
                                                    // Posted Values
                                                    if ($organ1 == "Kidney") {
                                                        $sql = "SELECT FullName,MobileNumber,OrganNeeded,MedicalUrgency,BloodType,id FROM tablekidney WHERE id=:uid ";
                                                    } else if ($organ1 == "Heart") {
                                                        $sql = "SELECT FullName,MobileNumber,OrganNeeded,MedicalUrgency,BloodType,id FROM tableheart WHERE id=:uid ";
                                                    } else if ($organ1 == "Lungs") {
                                                        $sql = "SELECT FullName,MobileNumber,OrganNeeded,MedicalUrgency,BloodType,id FROM tablelungs WHERE id=:uid ";
                                                    } else if ($organ1 == "Liver") {
                                                        $sql = "SELECT FullName,MobileNumber,OrganNeeded,MedicalUrgency,BloodType,id FROM tableliver WHERE id=:uid ";
                                                    } else {
                                                        $sql = "SELECT FullName,MobileNumber,OrganNeeded,MedicalUrgency,BloodType,id FROM tablepancreas WHERE id=:uid ";
                                                    }

                                                    //Prepare Query for Execution
                                                    $query = $dbh->prepare($sql);
                                                    // Bind the parameters
                                                    $query->bindParam(':uid', $userid, PDO::PARAM_STR);
                                                    // Query Execution
                                                    $query->execute();

                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    if ($query->rowCount() > 0) {
                                                        //In case that the query returned at least one record, we can echo the records within a foreach loop:
                                                        foreach ($results as $result) {
                                                            ?>
                                                            <div class="col-lg-4 col-sm-6 portfolio-item"> <br>

                                                                <div class="card" style="width: 22rem;" >
                                                                    <a href="#"><img  src="images/patient.png" alt="" style="width:100%"></a>
                                                                    <div class="card-block">

                                                                        <h4 class="card-title"><a href="#"><span style='color:red'> <?php echo htmlentities($result->FullName); ?></span></a></h4>
                                                                        <p class="card-text"><b>Mobile Number: </b><?php echo htmlentities($result->MobileNumber); ?>  </p>
                                                                        <p class="card-text"><b>Organ Needed:</b><span style='color:red'>  
                                                                                <?php echo htmlentities($result->OrganNeeded); ?>  </span></p>
                                                                        <p class="card-text"><b>Blood Type: </b><?php echo htmlentities($result->BloodType); ?>  </p>
                                                                        <p class="card-text"><b>Medical Urgency: </b><?php echo htmlentities($result->MedicalUrgency); ?>  </p>

                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                                <a href="match-organs.php" class="btn btn-danger"><font face="Trebuchet MS" style="font-size:14px;"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<b>Back</b></font></a>
                                                                <button class="btn btn-primary text-yellow" name="sms" type="submit" ><font face="Trebuchet MS" style="font-size:14px;"><span class="glyphicon glyphicon-envelope"></span>&nbsp;<b>SMS Patient</b></font></button> 
                                                            </div>
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
    <?php
}

   
       