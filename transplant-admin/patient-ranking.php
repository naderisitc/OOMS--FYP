<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>



<!doctype html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#3e454c">

        <title>Admin | Ranking Patients</title>

        <link rel="stylesheet" href="css/font-awesome.min.css"> <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Main Bootstrap -->
        <link rel="stylesheet" href="css/style.css"> <!-- Header Style -->
        <link rel="stylesheet" href="css/tindex_c.css"> <!-- Customized Bootstrap-->
    </head>

    <body>
        <?php include('includes/header.php'); ?>
        <div class="ts-main-content">
            <?php include('includes/leftbar.php'); ?>
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <h2 class="page-title"><font face="Comic Sans MS" color="red">Patient Ranking Page</font></h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading" style="color: green;">Ranking</div>
                                    <div class="panel-body">



                                        <?php
                                        if (isset($_POST['submit'])) {
                                            $_SESSION['organ'] = $_POST['organ'];
                                            $organ = $_POST['organ'];
                                            $bloodtype = $_POST['bloodtype'];
                                            $medical = $_POST['medical'];
                                            $state = $_POST['state'];
                                            $O = "O";
                                            $AB = "AB";
                                            $A = "A";
                                            $B = "B";
                                            $Kidney = "Kidney";
                                            $Heart = "Heart";
                                            $Lungs = "Lungs";
                                            $Liver = "Liver";
                                            $Pancreas = "Pancreas";

                                            if ($bloodtype == $O && $medical == 'High') {

                                                if ($organ == $Kidney) {
                                                    $sql = "SELECT * FROM tablekidney
                                        WHERE (MedicalUrgency=:medical   and BloodType=:bloodtype) 
                                        UNION 
                                       SELECT * 
                                        FROM tablekidney
                                        WHERE   (MedicalUrgency=:medical    and BloodType=:AB) 
                                        UNION 
                                        SELECT * 
                                        FROM tablekidney
                                        WHERE   (MedicalUrgency=:medical    and BloodType=:A)
                                        UNION 
                                        SELECT * 
                                        FROM tablekidney
                                        WHERE   (MedicalUrgency=:medical    and BloodType=:B)
                                        ORDER BY RegistrationDate ";
                                                } else if ($organ == $Heart) {
                                                    $sql = "SELECT * FROM tableheart
                                        WHERE (MedicalUrgency=:medical   and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tableheart
                                        WHERE  (MedicalUrgency=:medical   and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tableheart
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:AB) 
                                        UNION 
                                        SELECT * 
                                        FROM tableheart
                                        WHERE   (MedicalUrgency=:medical   and BloodType=:A)
                                        UNION 
                                        SELECT * 
                                        FROM tableheart
                                        WHERE   (MedicalUrgency=:medical   and BloodType=:B)
                                        ORDER BY RegistrationDate ";
                                                } else if ($organ == $Lungs) {
                                                    $sql = "SELECT * FROM tablelungs
                                        WHERE (MedicalUrgency=:medical   and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tablelungs
                                        WHERE  (MedicalUrgency=:medical   and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tablelungs
                                        WHERE   (MedicalUrgency=:medical   and BloodType=:AB) 
                                        UNION 
                                        SELECT * 
                                        FROM tablelungs
                                        WHERE   (MedicalUrgency=:medical   and BloodType=:A)
                                        UNION 
                                        SELECT * 
                                        FROM tablelungs
                                        WHERE   (MedicalUrgency=:medical   and BloodType=:B)
                                        ORDER BY RegistrationDate ";
                                                } else if ($organ == $Liver) {
                                                    $sql = "SELECT * FROM tableliver
                                        WHERE (MedicalUrgency=:medical  and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tableliver
                                        WHERE  (MedicalUrgency=:medical  and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tableliver
                                        WHERE   (MedicalUrgency=:medical   and BloodType=:AB) 
                                        UNION 
                                        SELECT * 
                                        FROM tableliver
                                        WHERE   (MedicalUrgency=:medical   and BloodType=:A)
                                        UNION 
                                        SELECT * 
                                        FROM tableliver
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:B)
                                       ORDER BY RegistrationDate ";
                                                } else {
                                                    $sql = "SELECT * FROM tablepancreas
                                        WHERE (MedicalUrgency=:medical  and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tablepancreas
                                        WHERE  (MedicalUrgency=:medical  and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tablepancreas
                                        WHERE   (MedicalUrgency=:medical   and BloodType=:AB) 
                                        UNION 
                                        SELECT * 
                                        FROM tablepancreas
                                        WHERE   (MedicalUrgency=:medical   and BloodType=:A)
                                        UNION 
                                        SELECT * 
                                        FROM tablepancreas
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:B)
                                     ORDER BY RegistrationDate ";
                                                }
                                                $query = $dbh->prepare($sql);
                                                $query->bindValue(':organ', $organ, PDO::PARAM_STR);
                                                $query->bindValue(':bloodtype', $bloodtype, PDO::PARAM_STR);
                                                $query->bindParam(':medical', $medical, PDO::PARAM_STR);
                                                $query->bindValue(':state', $state, PDO::PARAM_STR);
                                                $query->bindValue(':AB', $AB, PDO::PARAM_STR);
                                                $query->bindValue(':A', $A, PDO::PARAM_STR);
                                                $query->bindValue(':B', $B, PDO::PARAM_STR);
                                                $query->execute();
                                                $count = $query->rowCount();
                                                $no = $count - $count + 1;
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            }
                                            //blood type A, B, AB
                                            else if ($medical == 'High') {
                                                if ($organ == $Kidney) {
                                                    $sql = "SELECT * FROM tablekidney
                                        WHERE  (MedicalUrgency=:medical  and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tablekidney
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tablekidney
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:AB) 
                                        ORDER BY  RegistrationDate ";
                                                } else if ($organ == $Heart) {
                                                    $sql = "SELECT * FROM tableheart
                                        WHERE (MedicalUrgency=:medical   and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tableheart
                                        WHERE  (MedicalUrgency=:medical   and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tableheart
                                        WHERE   (MedicalUrgency=:medical   and BloodType=:AB) 
                                        ORDER BY RegistrationDate ";
                                                } else if ($organ == $Lungs) {
                                                    $sql = "SELECT * FROM tablelungs
                                        WHERE (MedicalUrgency=:medical   and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tablelungs
                                        WHERE  (MedicalUrgency=:medical  and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tablelungs
                                        WHERE   (MedicalUrgency=:medical   and BloodType=:AB) 
                                       ORDER BY RegistrationDate ";
                                                } else if ($organ == $Liver) {
                                                    $sql = "SELECT * FROM tableliver
                                        WHERE (MedicalUrgency=:medical  and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tableliver
                                        WHERE  (MedicalUrgency=:medical  and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tableliver
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:AB) 
                                        ORDER BY RegistrationDate ";
                                                } else {
                                                    $sql = "SELECT * FROM tablepancreas
                                        WHERE (MedicalUrgency=:medical  and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tablepancreas
                                        WHERE  (MedicalUrgency=:medical  and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tablepancreas
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:AB) 
                                        ORDER BY RegistrationDate ";
                                                }

                                                $query = $dbh->prepare($sql);
                                                $query->bindValue(':organ', $organ, PDO::PARAM_STR);
                                                $query->bindValue(':bloodtype', $bloodtype, PDO::PARAM_STR);
                                                $query->bindParam(':medical', $medical, PDO::PARAM_STR);
                                                $query->bindValue(':state', $state, PDO::PARAM_STR);
                                                $query->bindValue(':AB', $AB, PDO::PARAM_STR);
                                                $query->execute();
                                                $count = $query->rowCount();
                                                $no = $count - $count + 1;
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            }


                                            //if medical urgency is low
                                            else if ($bloodtype == $O && $medical == 'Low') {

                                                if ($organ == $Kidney) {
                                                    $sql = "SELECT * FROM tablekidney
                                        WHERE   (MedicalUrgency=:medical   and BloodType=:bloodtype) and (State=:state)  
                                        UNION 
                                        SELECT * 
                                        FROM tablekidney
                                        WHERE  (MedicalUrgency=:medical  and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tablekidney
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:AB) 
                                        UNION 
                                        SELECT * 
                                        FROM tablekidney
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:A)
                                        UNION 
                                        SELECT * 
                                        FROM tablekidney
                                        WHERE   (MedicalUrgency=:medical and BloodType=:B)
                                       ORDER BY DateOfBirth DESC,RegistrationDate";
                                                } else if ($organ == $Heart) {
                                                    $sql = "SELECT * FROM tableheart
                                        WHERE (MedicalUrgency=:medical and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tableheart
                                        WHERE  (MedicalUrgency=:medical  and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tableheart
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:AB) 
                                        UNION 
                                        SELECT * 
                                        FROM tableheart
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:A)
                                        UNION 
                                        SELECT * 
                                        FROM tableheart
                                        WHERE   (MedicalUrgency=:medical and BloodType=:B)
                                       ORDER BY DateOfBirth DESC,RegistrationDate ";
                                                } else if ($organ == $Lungs) {
                                                    $sql = "SELECT * FROM tablelungs
                                        WHERE (MedicalUrgency=:medical and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tablelungs
                                        WHERE  (MedicalUrgency=:medical  and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tablelungs
                                        WHERE   (MedicalUrgency=:medical and BloodType=:AB) 
                                        UNION 
                                        SELECT * 
                                        FROM tablelungs
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:A)
                                        UNION 
                                        SELECT * 
                                        FROM tablelungs
                                        WHERE   (MedicalUrgency=:medical and BloodType=:B)
                                       ORDER BY DateOfBirth DESC,RegistrationDate ";
                                                } else if ($organ == $Liver) {
                                                    $sql = "SELECT * FROM tableliver
                                        WHERE (MedicalUrgency=:medical and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tableliver
                                        WHERE  (MedicalUrgency=:medical  and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tableliver
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:AB) 
                                        UNION 
                                        SELECT * 
                                        FROM tableliver
                                        WHERE   (MedicalUrgency=:medical and BloodType=:A)
                                        UNION 
                                        SELECT * 
                                        FROM tableliver
                                        WHERE   (MedicalUrgency=:medical and BloodType=:B)
                                        ORDER BY DateOfBirth DESC,RegistrationDate ";
                                                } else {
                                                    $sql = "SELECT * FROM tablepancreas
                                        WHERE (MedicalUrgency=:medical  and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tablepancreas
                                        WHERE  (MedicalUrgency=:medical and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tablepancreas
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:AB) 
                                        UNION 
                                        SELECT * 
                                        FROM tablepancreas
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:A)
                                        UNION 
                                        SELECT * 
                                        FROM tablepancreas
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:B)
                                        ORDER BY DateOfBirth DESC,RegistrationDate ";
                                                }
                                                $query = $dbh->prepare($sql);
                                                $query->bindValue(':organ', $organ, PDO::PARAM_STR);
                                                $query->bindValue(':bloodtype', $bloodtype, PDO::PARAM_STR);
                                                $query->bindParam(':medical', $medical, PDO::PARAM_STR);
                                                $query->bindValue(':state', $state, PDO::PARAM_STR);
                                                $query->bindValue(':AB', $AB, PDO::PARAM_STR);
                                                $query->bindValue(':A', $A, PDO::PARAM_STR);
                                                $query->bindValue(':B', $B, PDO::PARAM_STR);
                                                $query->execute();
                                                $count = $query->rowCount();
                                                $no = $count - $count + 1;
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            }
                                            // blood type A,B,AB
                                            else if ($medical == 'Low') {

                                                if ($organ == $Kidney) {
                                                    $sql = "SELECT * FROM tablekidney
                                       WHERE  (MedicalUrgency=:medical   and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tablekidney
                                        WHERE   (MedicalUrgency=:medical   and BloodType=:bloodtype)
                                        UNION
                                        SELECT * 
                                        FROM tablekidney
                                        WHERE   (MedicalUrgency=:medical   and BloodType=:AB) 
                                        
                                        ORDER BY DateOfBirth DESC,RegistrationDate ";
                                                } else if ($organ == $Heart) {
                                                    $sql = "SELECT * FROM tableheart
                                        WHERE (MedicalUrgency=:medical and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tableheart
                                        WHERE  (MedicalUrgency=:medical and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tableheart
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:AB) 
                                       ORDER BY DateOfBirth DESC,RegistrationDate ";
                                                } else if ($organ == $Lungs) {
                                                    $sql = "SELECT * FROM tablelungs
                                        WHERE (MedicalUrgency=:medical  and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tablelungs
                                        WHERE  (MedicalUrgency=:medical  and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tablelungs
                                        WHERE   (MedicalUrgency=:medical and BloodType=:AB) 
                                        ORDER BY DateOfBirth DESC,RegistrationDate ";
                                                } else if ($organ == $Liver) {
                                                    $sql = "SELECT * FROM tableliver
                                        WHERE (MedicalUrgency=:medical  and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tableliver
                                        WHERE  (MedicalUrgency=:medical and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tableliver
                                        WHERE   (MedicalUrgency=:medical  and BloodType=:AB) 
                                        ORDER BY DateOfBirth DESC,RegistrationDate ";
                                                } else {
                                                    $sql = "SELECT * FROM tablepancreas
                                        WHERE (MedicalUrgency=:medical  and BloodType=:bloodtype) and (State=:state)
                                        UNION 
                                        SELECT * 
                                        FROM tablepancreas
                                        WHERE  (MedicalUrgency=:medical and BloodType=:bloodtype)
                                        UNION 
                                        SELECT * 
                                        FROM tablepancreas
                                        WHERE   (MedicalUrgency=:medical and BloodType=:AB) 
                                        ORDER BY DateOfBirth DESC,RegistrationDate ";
                                                }

                                                $query = $dbh->prepare($sql);
                                                $query->bindValue(':organ', $organ, PDO::PARAM_STR);
                                                $query->bindValue(':bloodtype', $bloodtype, PDO::PARAM_STR);
                                                $query->bindParam(':medical', $medical, PDO::PARAM_STR);
                                                $query->bindValue(':state', $state, PDO::PARAM_STR);
                                                $query->bindValue(':AB', $AB, PDO::PARAM_STR);
                                                $query->execute();
                                                $count = $query->rowCount();
                                                $no = $count - $count + 1;
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            }
                                        }
                                        if ($query->rowCount() > 0) {
                                            print("<span style='color:green'> The number of patient(s) that match the criteria entered is/are $count patient(s). The patient on the left is the best matched in the ranking criteria.</span><br><br> Match Results:<br>");
                                            print("<br><span style='color:purple'>Organ Needed = <span style='color:red'><b>$organ</b></span><br>Blood Type = <span style='color:red'><b>$bloodtype</b></span><br>State = <span style='color:red'><b>$state</b></span><br>Medical Urgency = <span style='color:red'><b>$medical</b></span><br> </span>");
                                            foreach ($results as $result) {
                                                ?>
                                                <div class="col-sm-6  portfolio-item"> <br>
                                                    <h5><strong><span style='color:red'> Patient Ranking No.<?php echo htmlentities($no++) ?></span></strong></h5>
                                                    <div class="card" style="width: 15em;">
                                                        <a href="#"><img  src="images/patient.png" alt="" style="width:100%"></a>
                                                        <div class="card-block">
                                                            <h4 class="card-title"><a href="#"><span style='color:red'> <?php echo htmlentities($result->FullName); ?></span></a></h4>
                                                            <p class="card-text"><b>Medical Urgency:</b><span style='color:red'> <?php echo htmlentities($result->MedicalUrgency); ?></span></p>
                                                            <p class="card-text"><b>Organ Needed:</b><span style='color:red'>  
                                                                    <?php echo htmlentities($result->OrganNeeded); ?></span></p>
                                                            <p class="card-text"><b>Blood Type:</b><span style='color:blue'> <?php echo htmlentities($result->BloodType); ?></span></p>
                                                            <p class="card-text"><b>Gender:</b><span style='color:blue'> <?php echo htmlentities($result->Gender); ?></span></p>
                                                            <p class="card-text"><b>Date Of Birth:</b><span style='color:blue'> <?php echo htmlentities($result->DateOfBirth); ?></span></p>
                                                            <p class="card-text"><b>Registration Date:</b><span style='color:blue'> <?php echo htmlentities($result->RegistrationDate); ?></span></p>
                                                            <p class="card-text"><b>State:</b><span style='color:blue'> <?php echo htmlentities($result->State); ?></p>
                                                            <p class="card-text"><b>Mobile No. / Email:</b><span style='color:blue'> <?php echo htmlentities($result->MobileNumber); ?> /
                                                                    <?php echo htmlentities($result->Email); ?></span></p>
                                                            <p class="card-text"><b>Notified:</b><span style='color:red'><?php if ($result->status == 0) { ?>
                                                                        Yes    <i class="fa fa-check" style="color:red;" aria-hidden="true"></i>
                                                                    <?php } else { ?> 
                                                                        No   <i class="fa fa-close" style="color:red;" aria-hidden="true"></i>
                                                                    <?php } ?></span></p>
                                                            <a href="sms-patient.php?id=<?php echo htmlentities($result->id); ?>"><button class="btn btn-info btn-sm"><i class="fa fa-send-o" style="font-size:14px;"></i>&nbsp;<font face="Trebuchet MS" style="font-size:14px;"><b> SMS</b></font></button></a>&nbsp;&nbsp;&nbsp;
                                                            <a href="email-patient.php?id=<?php echo htmlentities($result->id); ?>"><button  class="btn btn-info btn-sm"><i class="fa fa-envelope" style="font-size:14px;"></i>&nbsp;<font face="Trebuchet MS" style="font-size:14px;"><b> Email</b></font></button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            echo htmlentities(" Sorry! No patient(s) in the OOMS waiting list is/are found with the entered data.");
                                        }
                                        ?> 

                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-8 col-xs-offset-4">
                                            <a href="match-organs.php"> <button class="btn btn-default"><font face="Trebuchet MS" style="font-size:14px;"><b>Back</b></font></button></a>
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
