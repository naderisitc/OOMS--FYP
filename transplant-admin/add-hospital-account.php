<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['tlogin']) == 0) {
    header('location:tindex.php');
} else {
    if (isset($_POST['signup'])) {
//Getting Post Values
        $hospitalname = $_POST['hname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $mobile = $_POST['phonenumber'];
        $password1 = $_POST['password'];
        $password = md5($_POST['password']);

// Query for validation of username and email
        $ret = "SELECT * FROM tablegeneralhospital where (UserName=:uname ||  Email=:uemail)";
        $queryt = $dbh->prepare($ret);
        $queryt->bindParam(':uemail', $email, PDO::PARAM_STR);
        $queryt->bindParam(':uname', $username, PDO::PARAM_STR);
        $queryt->execute();
        $results = $queryt->fetchAll(PDO::FETCH_OBJ);
        if ($queryt->rowCount() == 0) {
// Query for Insertion
            $sql = "INSERT INTO tablegeneralhospital(HospitalName,UserName,Email,PhoneNumber,PassWord) VALUES(:hname,:uname,:uemail,:umobile,:upassword)";
            $query = $dbh->prepare($sql);
// Binding Post Values
            $query->bindParam(':hname', $hospitalname, PDO::PARAM_STR);
            $query->bindParam(':uname', $username, PDO::PARAM_STR);
            $query->bindParam(':uemail', $email, PDO::PARAM_STR);
            $query->bindParam(':umobile', $mobile, PDO::PARAM_INT);
            $query->bindParam(':upassword', $password, PDO::PARAM_STR);

            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            if ($lastInsertId) {
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
                $mail->addAddress($email, 'Donor');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
                $mail->addReplyTo('nadrex2009@aol.com');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

                $mail->addAttachment('images/banner1.jpg');         // Add attachments
//$mail->addAttachment('/images/ts-avatar.png', 'Pic');    // Optional name
                $mail->isHTML(true);                                  // Set email format to HTML


                $mail->Subject = ' Account Creation Successful-General Hospital Officer!';
                $mail->Body = "Dear $hospitalname Officer,<br><br>This email is to inform you that we have created an account successfully for your hospital to log into OOMS. By using OOMS, our transplant centre can get notification from your hospital that an organ donor is available.<br> "
                        . "<br> Your log in credentials are as follows: <br> Username: $username <br>Password:$password1 <br><br> "
                        . "Kindly change this given password in the OOMS by clicking Account and then Change password to protect your account. <br><be>"
                        . "Please contact us if you have any queries by calling our transplant center at 03-2555 4447 or through our email: ooms@aol.com."
                        . "<br><br> Kind Regards,<br>OOMS";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if (!$mail->send()) {
                    echo "<script>alert(Message could not be sent.');</script>";
                    // echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    $msg = " Hospital account created successfully and Email is sent to the General Hospital Officer with username and  password to log into OOMS.";
                }
            } else {
                $error = " Something went wrong. Please try again.";
            }
        } else {
            $error = " Username or Email already exists. Please use new username or email.";
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

            <title>Admin |  Add Account</title>

            <link rel="stylesheet" href="css/font-awesome.min.css"> <!-- Bootstrap Icons -->
            <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Main Bootstrap -->
            <link rel="stylesheet" href="css/style.css"> <!-- Header Stye -->
            <script type="text/javascript">
                function valid()
                {
                    if (document.chngpwd.password.value !== document.chngpwd.confirmpassword.value)
                    {
                        alert(" Password and Confirm Password Field do not match!! Please enter the same data.");
                        document.chngpwd.confirmpassword.focus();
                        return false;
                    }
                    return true;
                }
            </script>
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
            <!--Java script for check username availability-->
            <script>
                function checkUsernameAvailability() {
                    $("#loaderIcon").show();
                    jQuery.ajax({
                        url: "check_availability.php",
                        data: 'username=' + $("#username").val(),
                        type: "POST",
                        success: function (data) {
                            $("#username-availability-status").html(data);
                            $("#loaderIcon").hide();
                        },
                        error: function () {
                        }
                    });
                }
            </script>

            <!--Java script for check email availability-->
            <script>
                function checkEmailAvailability() {
                    $("#loaderIcon").show();
                    jQuery.ajax({
                        url: "check_availability.php",
                        data: 'email=' + $("#email").val(),
                        type: "POST",
                        success: function (data) {

                            $("#email-availability-status").html(data);
                            $("#loaderIcon").hide();
                        },
                        error: function () {
                            event.preventDefault();
                        }
                    });
                }
            </script>
        </head>
        <body>
            <?php include('includes/header.php'); ?>
            <div class="ts-main-content">
                <?php include('includes/leftbar.php'); ?>
                <div class="content-wrapper">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">

                                <h2 class="page-title"><font face="Comic Sans MS" color="red">Create New Hospital Account</font></h2>

                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="color: green;">Form fields</div>
                                            <div class="panel-body">
                                                <form method="post" name="chngpwd"  class="form-horizontal" enctype="multipart/form-data">

                                                    <!--Error Message-->
                                                    <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div>
                                                    <?php } ?>
                                                    <!--Success Message-->
                                                    <?php if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
                                                    <?php } ?>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Hospital Name<span style="color:red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" id="hname" name="hname"  pattern="[a-zA-Z\s]+" title="Hospital name must contain letters only" class="form-control" required>
                                                            <p class="help-block">Hospital name can contain any letters only</p>
                                                        </div>
                                                        <label class="col-sm-2 control-label">Username<span style="color:red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" id="username" name="username" onBlur="checkUsernameAvailability()"  pattern="^[a-zA-Z][a-zA-Z0-9-_.]{5,12}$" title=" Username can contain any letters, numbers or underscore, without spaces and between 6 to 12 characters" class="form-control" required>
                                                            <span id="username-availability-status" style="font-size:12px;"></span> 
                                                            <p class="help-block">Username can contain any letters,numbers or underscore, without spaces 6 to 12 chars </p>                                                       
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="email" id="email" name="email" placeholder="" onBlur="checkEmailAvailability()" class="form-control" required>
                                                            <span id="email-availability-status" style="font-size:12px;"></span> 
                                                            <p class="help-block">Please provide General Hospital Email</p>                         
                                                        </div>
                                                        <label class="col-sm-2 control-label">Contact Number<span style="color:red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" id="phonenumber" name="phonenumber" pattern="[0-9]{10}" maxlength="10"  title="Remove any character/spaces/negative numbers. Enter numbers only, e.g 0325553693."   class="form-control" required>
                                                            <p class="help-block">Contact Number contains only 10 digit numeric values</p>                                          
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Password<span style="color:red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="password" id="password" name="password" pattern="^\S{6,12}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Password must be between 6 to 12 characters' : '');
                                                                        if (this.checkValidity())
                                                                            form.password_two.pattern = this.value;"  required class="form-control">
                                                            <p class="help-block">Password must be between 6 to 12 characters</p>                
                                                        </div>                  

                                                        <label class="col-sm-2 control-label">Confirm Password<span style="color:red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
                                                        </div>
                                                    </div>
                                                    <div class="hr-dashed"></div>                                                    

                                                    <div class="form-group">
                                                        <div class="col-sm-8 col-sm-offset-4">
                                                            <button class="btn  btn-default" type="reset"><font face="Trebuchet MS" style="font-size:14px;"><span class="glyphicon glyphicon-remove-sign"></span>&nbsp;<b>Reset</b></font></button>
                                                            <button class="btn btn-primary btn-lg" name="signup" type="submit"><font face="Trebuchet MS" style="font-size:14px;"><span class="glyphicon glyphicon-plus"></span>&nbsp;<b>Create Account</b></font></button>
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