<?php
error_reporting(0);
include('includes/config.php');

if (isset($_POST['submit'])) {

    //stores user input data
    $username = "Donor Registration";
    $fullname = $_POST['fullname'];
    $passport = $_POST['pass'];
    $nationality = $_POST['nationality'];
    $mobile = $_POST['mobileno'];
    $email = $_POST['email'];
    $state = $_POST['state'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $bloodtype = $_POST['bloodtype'];
    $address = $_POST['address'];
    $organ1 = $_POST['organ1'];
    $organ2 = $_POST['organ2'];
    $organ3 = $_POST['organ3'];
    $organ4 = $_POST['organ4'];
    $organ5 = $_POST['organ5'];
    $status = 1;
    //insert image
    $name = $_FILES['myfile']['name']; //stores image name
    $type = $_FILES['myfile']['type']; //stores image type
    $data = file_get_contents($_FILES['myfile']['tmp_name']); //stores image
    $valid_extensions = array('jpeg', 'jpg', 'png');  //valid file types
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    $imageSize = $_FILES['myfile']['size']; // stores image size 

    if (in_array($ext, $valid_extensions)) {  // if valid file types
        if ($imageSize > 1000 && $imageSize <= 1000000) { // image size checker less 1MB
            if (!empty($_POST['organ1']) || !empty($_POST['organ2']) || !empty($_POST['organ3']) || !empty($_POST['organ4']) || !empty($_POST['organ5'])) {
                $ret = " SELECT Passport,Email FROM tableorgandonors  where  Passport=:pass || Email=:email";
                $queryt = $dbh->prepare($ret);
                $queryt->bindParam(':pass', $passport, PDO::PARAM_STR);
                $queryt->bindParam(':email', $email, PDO::PARAM_STR);
                $queryt->execute();
                $results = $queryt->fetchAll(PDO::FETCH_OBJ);
                if ($queryt->rowCount() == 0) {

                    $sql = "INSERT INTO  tableorgandonors(FullName,Passport,Nationality,MobileNumber,Email,State,Gender,DateOfBirth,BloodType,Address,OrganDonated,OrganDonated2,OrganDonated3,OrganDonated4,OrganDonated5,User,name,mime,data,status) VALUES(:fullname,:passport,:nationality,:mobile,:email,:state,:gender,:dob,:bloodtype,:address,:organ1,:organ2,:organ3,:organ4,:organ5,:username,:name,:type,:data,:status)";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
                    $query->bindParam(':passport', $passport, PDO::PARAM_STR);
                    $query->bindParam(':nationality', $nationality, PDO::PARAM_STR);
                    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
                    $query->bindParam(':email', $email, PDO::PARAM_STR);
                    $query->bindParam(':state', $state, PDO::PARAM_STR);
                    $query->bindParam(':gender', $gender, PDO::PARAM_STR);
                    $query->bindParam(':dob', $dob, PDO::PARAM_STR);
                    $query->bindParam(':bloodtype', $bloodtype, PDO::PARAM_STR);
                    $query->bindParam(':address', $address, PDO::PARAM_STR);
                    $query->bindParam(':organ1', $organ1, PDO::PARAM_STR);
                    $query->bindParam(':organ2', $organ2, PDO::PARAM_STR);
                    $query->bindParam(':organ3', $organ3, PDO::PARAM_STR);
                    $query->bindParam(':organ4', $organ4, PDO::PARAM_STR);
                    $query->bindParam(':organ5', $organ5, PDO::PARAM_STR);
                    $query->bindParam(':username', $username, PDO::PARAM_STR);
                    $query->bindParam(':name', $name, PDO::PARAM_STR);
                    $query->bindParam(':type', $type, PDO::PARAM_STR);
                    $query->bindParam(':data', $data, PDO::PARAM_STR);
                    $query->bindParam(':status', $status, PDO::PARAM_STR);
                    $query->execute();
                    $lastInsertId = $dbh->lastInsertId();
                    if ($lastInsertId) {
                        require 'phpmailer/PHPMailerAutoload.php'; //sending email file
                        $mail = new PHPMailer;
                        //$mail->SMTPDebug = 4;               
                        $mail->isSMTP();  // Set mailer to use SMTP
                        $mail->SMTPOptions = array(
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            )
                        );
                        $mail->Host = 'smtp.aol.com';  // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;        // Enable SMTP authentication
                        $mail->Username = 'nadrex2009@aol.com';     // SMTP username
                        $mail->Password = 'NkmS2013';               // SMTP password
                        $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                          // TCP port to connect to

                        $mail->setFrom('nadrex2009@aol.com', 'Online Organ Matching System');
                        $mail->addAddress($email, 'Donor');     // Add a recipient
                        //$mail->addAddress('ellen@example.com');   // Name is optional
                        $mail->addReplyTo('nadrex2009@aol.com');
                        //$mail->addCC('cc@example.com');
                        //$mail->addBCC('bcc@example.com');
                        $mail->addAttachment('images/banner1.jpg');   // Add attachments
                        //$mail->addAttachment('/images/ts-avatar.png', 'Pic');    // Optional name
                        $mail->isHTML(true);         // Set email format to HTML

                        if ($gender == "Male") { //specify gender
                            $g = "Mr.";
                        } else {
                            $g = "Ms.";
                        }

                        $mail->Subject = 'Registration Successful-Organ Donor!';
                        $mail->Body = "Dear $g $fullname,<br><br>Thank you for registering as organ donor! By donating your "
                                . "organs, you are saving people suffering from organ failure.<br> "
                                . "This email is to inform you that you have registered in OOMS as $organ donor successfully!"
                                . "<br><br> Kind Regards,<br>OOMS";
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                        if (!$mail->send()) {
                            echo "<script>alert(Message could not be sent.');</script>";
                            // echo 'Mailer Error: ' . $mail->ErrorInfo;
                        } else {
                            echo "<script>alert('Thank you $g $fullname for registering as organ donor. Email confirmation is "
                            . "sent successfully to $email that confirms your registration as organ donor.');</script>";
                            echo "<script>window.location.href='become-donor.php'</script>";
                        }
                    } else { // if donor not added to the database
                        $error = " Oops! Something went wrong. Please try again.";
                    }
                } else { // if Passport/IC no. or Email address already exists
                    $error = "  Passport/IC no. or Email address already exists. Please use other Passport/IC No. or new email address.";
                }
            } else { // if no organ is selected
                $error = " Please select at least one organ to donate.";
            }
        } else {
            $error = " Oops! Picture size might be greater than 1 MB. Please upload picture less than 1 MB.";
        }
    } else { // if Unsupported Image Type Inserted
        $error = " Unsupported Image Type. Please upload jpg, jpeg, png extension files only.";
    }
}
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

        <title>OOMS | Become A Donor</title>

        <link rel="stylesheet" href="css/bootstrap.min.css" >
        <link href="css/modern-business.css" rel="stylesheet">

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
        <!-- Page Content -->
        <div class="container">

            <!-- Page Heading/Bread crumbs -->
            <h1 class="mt-4 mb-3">Become a <small>Donor</small></h1>

            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item active">Become a Donor</li>
            </ol>

            <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) {
                ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

            <form method="post" class="form-horizontal" enctype="multipart/form-data"> 

                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="font-italic">Full Name<span style="color:red">*</span></div>
                        <div><input type="text" name="fullname" class="form-control" placeholder="Enter only letters" title="Name can contain letters only"  pattern="[a-zA-Z\s]+" maxLength="35"  required></div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="font-italic">IC/Passport No.<span style="color:red">*</span></div>
                        <div><input type="text" name="pass" class="form-control"  maxlength="12" placeholder="Enter your IC/Passport No."  required></div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="font-italic">Nationality<span style="color:red">*</span></div>
                        <select name="nationality" class="form-control" value="<?php echo htmlentities($result->Nationality); ?>" required>
                            <option value="">---Select---</option>
                            <option value="Malaysian">Malaysian</option>
                            <option value="Permanent Resident">Permanent Resident</option>
                            <option value="Non-Malaysian">Non-Malaysian</option>
                        </select>                  
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="font-italic">Mobile Number<span style="color:red">*</span></div>
                        <div><input type="text" name="mobileno" class="form-control"   placeholder="Enter only 14 numeric values" pattern="[0-9]{14}" maxlength="14" title="Remove any characters/spaces/negative numbers. Enter numbers only, e.g. 00601113328804"  required></div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="font-italic">Email<span style="color:red">*</span></div>
                        <div><input type="email" name="email" class="form-control"  placeholder="Enter your email" maxLength="30"  required></div>
                    </div>
                    <div class="col-lg-2 mb-4">
                        <div class="font-italic">Date of Birth<span style="color:red">*</span></div>
                        <div>   <input type="date" name="dob" min="1930-01-01" max="2018-05-25" class="form-control" required></div>
                    </div>
                    <div class="col-lg-2 mb-4">
                        <div class="font-italic">Gender<span style="color:red">*</span></div>
                        <div><select name="gender" class="form-control" required>
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- /.row -->
                <div class="row">
                    <div class="col-sm-4">
                        <div class="font-italic">Blood Type<span style="color:red">*</span> </div>
                        <div><select name="bloodtype" class="form-control" required>
                                <option value="">---Select---</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="font-italic">State<span style="color:red">*</span></div>
                        <div><select name="state" class="form-control" required>
                                <option value="">Select</option>
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
                    <div class="col-sm-4 mb-4">
                        <div class="font-italic">Organ To Donate<span style="color:red">*</span> </div>
                        <label class="checkbox-inline">
                            <input type="checkbox"  name="organ1" id="organ1"  value="Kidney"> Kidney</label>
                        <label class="checkbox-inline">
                            <input type="checkbox"  name="organ2" id="organ2"  value="Heart"> Heart</label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="organ3" id="organ3"  value="Lungs"> Lungs</label>&nbsp;
                        <label class="checkbox-inline">
                            <input type="checkbox" name="organ4" id="organ4"  value="Liver"> Liver</label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="organ5" id="organ5"  value="Pancreas"> Pancreas</label>
                    </div>
                </div>   

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="font-italic">Address/Zip code<span style="color:red">*</span></div>
                        <div><textarea class="form-control" placeholder="Enter your address and zip code" name="address" maxLength="30" required></textarea></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="font-italic">Message</div>
                        <div><textarea class="form-control" name="message"  maxLength="200"> </textarea></div>
                        <p class="help-block">Leave any comment or message</p> 
                    </div>
                </div>

                <!-- /.row -->
                <div class="row">
                    <label class="col-sm-2 control-label">Donor Picture<span style="color:red">*</span></label>
                    <div class="col-sm-4">
                        <input type="file"  name="myfile"  required>
                        <p class="help-block"><font style="color:red;"><i> Picture size must be less than 1 MB. Picture type can be jpg, jpeg and png only.</i</font></p>
                    </div>
                </div>

                <!-- /.row --> 
                <button class="btn btn-primary btn-lg mb-4 text-yellow" name="submit" type="submit" ><font face="Trebuchet MS" style="font-size:14px;"><span class="glyphicon glyphicon-envelope"></span>&nbsp;<b>Register</b></font></button>     
            </form>   
        </div>

        <?php include('includes/footer.php'); ?>
        <script src="js/vendor/jquery.min.js"></script>
        <script src="js/vendor/bootstrap.min.js"></script>
    </body>
</html>
