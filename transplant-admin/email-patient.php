<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['tlogin']) == 0) {
    header('location:tindex.php');
} else {

    if (isset($_POST['email'])) {
        $organ1 = $_SESSION['organ'];
        $userid = intval($_GET['id']);   // Get the userid

        if ($organ1 == "Kidney") {
            $sql = "SELECT FullName,Email,Gender,id FROM tablekidney WHERE id=:uid ";
        } else if ($organ1 == "Heart") {
            $sql = "SELECT FullName,Email,Gender,id FROM tableheart WHERE id=:uid ";
        } else if ($organ1 == "Lungs") {
            $sql = "SELECT FullName,Email,Gender,id FROM tablelungs WHERE id=:uid ";
        } else if ($organ1 == "Liver") {
            $sql = "SELECT FullName,Email,Gender,id FROM tableliver WHERE id=:uid ";
        } else {
            $sql = "SELECT FullName,Email,Gender,id FROM tablepancreas WHERE id=:uid ";
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
                $emailp = $result->Email;
                $name = $result->FullName;
                $gender = $result->Gender;
                //$organ = $result->OrganNeeded;
                if ($gender == "Male") {
                    $g = "Mr.";
                } else {
                    $g = "Ms.";
                }
                require 'phpmailer/PHPMailerAutoload.php';
                $mail = new PHPMailer;

//$mail->SMTPDebug = 4;                               // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->Host = 'smtp.aol.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'nadrex2009@aol.com';                 // SMTP username
                $mail->Password = 'NkmS2013';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                $mail->setFrom('nadrex2009@aol.com', 'Online Organ Matching System');
                $mail->addAddress($emailp, 'Patient');     // Add a recipient
                //$mail->addAddress('ellen@example.com');               // Name is optional
                $mail->addReplyTo('nadrex2009@aol.com');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');
                $mail->addAttachment('images/banner1.jpg');         // Add attachments
                //$mail->addAttachment('/images/ts-avatar.png', 'Pic');    // Optional name
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Matching Organ Found';
                $mail->Body = "Dear $g $name,<br><br>Congratulations! An organ($organ1) that matchs your medical data is found for your "
                        . "organ transplantation. Kindly reply to us as soon as possible by calling our transplant center at 03-2555 4447 or through our email: ooms@aol.com."
                        . "<br><br> Sincerely,<br>OOMS";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if (!$mail->send()) {
                    echo "<script>alert(Message could not be sent.');</script>";
                    // echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
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
                    echo "<script>alert('Email notification sent successfully to $g $name that a matching organ $organ1 is found!');</script>";
                    echo "<script>window.location.href='match-organs.php'</script>";
                }
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

            <title>Admin | Email Patient</title>

            <link rel="stylesheet" href="css/font-awesome.min.css"> <!-- Bootstrap Icons -->
            <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Main Bootstrap -->
            <link rel="stylesheet" href="css/style.css"> <!-- Header Stye -->
            <link rel="stylesheet" href="css/tindex_c.css">
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
                                <h2 class="page-title"><font face="Comic Sans MS" color="red">Email Patient </font></h2>
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="color: green;">Notify Patient by Email</div>
                                            <div class="panel-body">
                                                <h5><font face="Comic Sans MS" color="purple">Click 'Notify Patient' below to send Email Notification to the selected patient.</font></h5>                            
                                                <form method="post" class="form-horizontal">

                                                    <?php
                                                    $organ1 = $_SESSION['organ']; //Get Organ Name
                                                    // Get the userid
                                                    $userid = intval($_GET['id']);
                                                    // Posted Values      
                                                    if ($organ1 == "Kidney") {
                                                        $sql = "SELECT FullName,Email,OrganNeeded,MedicalUrgency,BloodType,id FROM tablekidney WHERE id=:uid ";
                                                    } else if ($organ1 == "Heart") {
                                                        $sql = "SELECT FullName,Email,OrganNeeded,MedicalUrgency,BloodType,id FROM tableheart WHERE id=:uid ";
                                                    } else if ($organ1 == "Lungs") {
                                                        $sql = "SELECT FullName,Email,OrganNeeded,MedicalUrgency,BloodType,id FROM tablelungs WHERE id=:uid ";
                                                    } else if ($organ1 == "Liver") {
                                                        $sql = "SELECT FullName,Email,OrganNeeded,MedicalUrgency,BloodType,id FROM tableliver WHERE id=:uid ";
                                                    } else {
                                                        $sql = "SELECT FullName,Email,OrganNeeded,MedicalUrgency,BloodType,id FROM tablepancreas WHERE id=:uid ";
                                                    }
                                                    $query = $dbh->prepare($sql);
                                                    // Bind the parameters
                                                    $query->bindParam(':uid', $userid, PDO::PARAM_STR);
                                                    // Query Execution
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    if ($query->rowCount() > 0) {
                                                        foreach ($results as $result) {
                                                            ?>
                                                            <div class="col-lg-4 col-sm-6 portfolio-item"> <br>

                                                                <div class="card" style="width: 22rem;" >
                                                                    <a href="#"><img  src="images/patient.png" alt="" style="width:100%"></a>
                                                                    <div class="card-block">

                                                                        <h4 class="card-title"><a href="#"><span style='color:red'> <?php echo htmlentities($result->FullName); ?></span></a></h4>
                                                                        <p class="card-text"><b>Email: </b><?php echo htmlentities($result->Email); ?>  </p>
                                                                        <p class="card-text"><b>Organ Needed:</b><span style='color:red'>  
                                                                                <?php echo htmlentities($result->OrganNeeded); ?>  </span></p>
                                                                        <p class="card-text"><b>Blood Type: </b><?php echo htmlentities($result->BloodType); ?>  </p>
                                                                        <p class="card-text"><b>Medical Urgency: </b><?php echo htmlentities($result->MedicalUrgency); ?>  </p>

                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                                <a href="match-organs.php" class="btn btn-danger"><font face="Trebuchet MS" style="font-size:14px;"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<b>Back</b></font></a>
                                                                <button class="btn btn-primary text-yellow" name="email" type="submit" ><font face="Trebuchet MS" style="font-size:14px;"><span class="glyphicon glyphicon-envelope"></span>&nbsp;<b>Email Patient</b></font></button> 
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